<?php

namespace App\Cart;

/**
 * CartItem DTO
 * Représente un article dans le panier.
 * C'est un simple objet de transfert de données (DTO).
 */
class CartItem
{
    public function __construct(
        private int $productId,
        private int $quantity
    ) {}

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;
        return $this;
    }
}
