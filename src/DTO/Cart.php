<?php

namespace App\DTO;

use App\DTO\CartItem;

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

    /** @return CartItem[] */
    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): static
    {
        $this->items = $items;
        return $this;
    }

    public function count(): int
    {
        return array_sum(
            array_map(fn(CartItem $item) => $item->getQuantity(), $this->items)
        );
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}
