<?php

namespace App\Cart;

use App\DTO\Cart;
use App\DTO\CartItem;
use App\Cart\CartInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    private const CART_KEY = 'cart';

    public function __construct(
        private readonly RequestStack $requestStack
    ) {}

    public function add(CartItem $item, Cart $cart): Cart
    {
        $items = $cart->getItems();

        foreach ($items as $existingItem) {
            if ($existingItem->getProductId() === $item->getProductId()) {
                $existingItem->setQuantity(
                    $existingItem->getQuantity() + $item->getQuantity()
                );
                $cart->setItems($items);
                $this->save($cart);
                return $cart;
            }
        }

        $items[] = $item;
        $cart->setItems($items);
        $this->save($cart);

        return $cart;
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        $items = array_filter(
            $cart->getItems(),
            fn(CartItem $i) => $i->getProductId() !== $item->getProductId()
        );

        $cart->setItems(array_values($items));
        $this->save($cart);

        return $cart;
    }

    public function getCart(string $identifier): Cart
    {
        $data = $this->requestStack
            ->getSession()
            ->get(self::CART_KEY . '_' . $identifier, []);

        $cart  = new Cart($identifier);
        $items = array_map(
            fn(array $d) => new CartItem($d['productId'], $d['quantity']),
            $data
        );

        $cart->setItems($items);

        return $cart;
    }

    public function clearCart(string $identifier): void
    {
        $this->requestStack
            ->getSession()
            ->remove(self::CART_KEY . '_' . $identifier);
    }

    private function save(Cart $cart): void
    {
        $data = array_map(
            fn(CartItem $item) => [
                'productId' => $item->getProductId(),
                'quantity'  => $item->getQuantity(),
            ],
            $cart->getItems()
        );

        $this->requestStack
            ->getSession()
            ->set(self::CART_KEY . '_' . $cart->getIdentifier(), $data);
    }
}
