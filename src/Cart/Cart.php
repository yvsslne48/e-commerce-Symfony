<?php

namespace App\DTO;

use App\Cart\CartItem;

/**
 * Cart DTO
 * Représente le panier complet.
 * Contient un identifiant unique (ex: session ID) et une liste de CartItem.
 */
class Cart
{
    /** @var CartItem[] */
    private array $items = [];

    public function __construct(
        private string $identifier
    ) {}

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): static
    {
        $this->items = $items;
        return $this;
    }

    /**
     * Retourne le nombre total d'articles dans le panier.
     */
    public function count(): int
    {
        return array_sum(
            array_map(fn(CartItem $item) => $item->getQuantity(), $this->items)
        );
    }

    /**
     * Vérifie si le panier est vide.
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}
