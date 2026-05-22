<?php

namespace App\Cart;

use App\DTO\Cart;
use App\DTO\CartItem;
use App\Cart\CartInterface;

class ApiCart implements CartInterface
{
    public function add(CartItem $item, Cart $cart): Cart
    {
        dd([
            'strategy'   => 'ApiCart',
            'action'     => 'add',
            'identifier' => $cart->getIdentifier(),
            'productId'  => $item->getProductId(),
            'quantity'   => $item->getQuantity(),
            'endpoint'   => 'POST /api/cart/add',
        ]);
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        dd([
            'strategy'   => 'ApiCart',
            'action'     => 'remove',
            'identifier' => $cart->getIdentifier(),
            'productId'  => $item->getProductId(),
            'endpoint'   => 'DELETE /api/cart/' . $item->getProductId(),
        ]);
    }

    public function getCart(string $identifier): Cart
    {
        dd([
            'strategy'   => 'ApiCart',
            'action'     => 'getCart',
            'identifier' => $identifier,
            'endpoint'   => 'GET /api/cart/' . $identifier,
        ]);
    }

    public function clearCart(string $identifier): void
    {
        dd([
            'strategy'   => 'ApiCart',
            'action'     => 'clearCart',
            'identifier' => $identifier,
            'endpoint'   => 'DELETE /api/cart/' . $identifier,
        ]);
    }
}
