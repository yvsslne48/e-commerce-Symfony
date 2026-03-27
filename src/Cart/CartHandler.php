<?php

namespace App\Cart;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use App\Cart\SessionCart;

/**
 * Gestionnaire principal du panier.
 * Principe SOLID :
 * - Single Responsibility : CartHandler ne fait que déléguer
 * - Open/Closed : on peut changer de stratégie sans modifier CartHandler
 * - Dependency Inversion : dépend de l'interface, pas d'une implémentation
 *
 * L'attribut #[Autowire] permet d'injecter la bonne stratégie.
 * Pour basculer vers ApiCart, il suffit de changer l'attribut #[Autowire].
 */
class CartHandler
{
    public function __construct(
        #[Autowire(service: SessionCart::class)]
        private readonly CartInterface $cart
    ) {}

    /**
     * Ajoute un produit au panier.
     */
    public function add(int $productId, int $quantity = 1): void
    {
        $this->cart->add($productId, $quantity);
    }

    /**
     * Supprime un produit du panier.
     */
    public function remove(int $productId): void
    {
        $this->cart->remove($productId);
    }

    /**
     * Retourne le contenu du panier.
     * Format : [productId => quantity, ...]
     */
    public function getItems(): array
    {
        return $this->cart->getItems();
    }

    /**
     * Vide le panier.
     */
    public function clear(): void
    {
        $this->cart->clear();
    }

    /**
     * Retourne le nombre total d'articles dans le panier.
     */
    public function count(): int
    {
        return $this->cart->count();
    }
}
