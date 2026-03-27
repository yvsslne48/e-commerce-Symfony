<?php

namespace App\Cart;

use App\Cart\CartInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * SessionCart
 * Stratégie qui gère le panier via la Session Symfony.
 * Implémente CartInterface — respecte le principe de substitution de Liskov.
 */
class SessionCart implements CartInterface
{
    private const CART_KEY = 'cart';

    public function __construct(
        private readonly RequestStack $requestStack
    ) {}

    /**
     * Ajoute un produit au panier en session.
     * Si le produit existe déjà, on incrémente la quantité.
     */
    public function add(int $productId, int $quantity): void
    {
        $cart = $this->getItems();

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        $this->save($cart);
    }


    //   Supprime un produit du panier en session.
    public function remove(int $productId): void
    {
        $cart = $this->getItems();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->save($cart);
        }
    }

    /**
     * Retourne le contenu du panier depuis la session.
     * Format : [productId => quantity, ...]
     */
    public function getItems(): array
    {
        return $this->requestStack
            ->getSession()
            ->get(self::CART_KEY, []);
    }

     // Vide complètement le panier en session.

    public function clear(): void
    {
        $this->save([]);
    }

     // Retourne le nombre total d'articles dans le panier.

    public function count(): int
    {
        return array_sum($this->getItems());
    }

     //Sauvegarde le panier en session.

    private function save(array $cart): void
    {
        $this->requestStack
            ->getSession()
            ->set(self::CART_KEY, $cart);
    }
}
