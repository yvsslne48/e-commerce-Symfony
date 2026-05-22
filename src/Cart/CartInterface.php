<?php

namespace App\Cart;

use App\DTO\Cart;
use App\DTO\CartItem;

interface CartInterface
{
    /**
     * Ajoute un CartItem dans le Cart et retourne le Cart mis à jour.
     */
    public function add(CartItem $item, Cart $cart): Cart;

    /**
     * Supprime un CartItem du Cart et retourne le Cart mis à jour.
     */
    public function remove(CartItem $item, Cart $cart): Cart;

    /**
     * Récupère le Cart depuis le stockage via son identifiant.
     */
    public function getCart(string $identifier): Cart;

    /**
     * Vide complètement le Cart identifié par son identifiant.
     */
    public function clearCart(string $identifier): void;
}
