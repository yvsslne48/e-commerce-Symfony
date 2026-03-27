<?php

namespace App\Cart;
//use App\Cart\CartInterface;

/**
 * Cette classe permet de vérifier que le code respecte le principe SOLID :
 * on peut changer de stratégie sans modifier CartHandler
 * Note : les méthodes utilisent dd() pour simuler les appels API.
 */
class ApiCart implements CartInterface
{
    public function add(int $productId, int $quantity): void
    {
        // Simulation d'un appel API POST /cart/add
        dd([
            'strategy' => 'ApiCart',
            'action'   => 'add',
            'product'  => $productId,
            'quantity' => $quantity,
            'endpoint' => 'POST /api/cart/add',
        ]);
    }

    public function remove(int $productId): void
    {
        // Simulation d'un appel API DELETE /cart/{id}
        dd([
            'strategy' => 'ApiCart',
            'action'   => 'remove',
            'product'  => $productId,
            'endpoint' => 'DELETE /api/cart/' . $productId,
        ]);
    }

    public function getItems(): array
    {
        // Simulation d'un appel API GET /cart
        dd([
            'strategy' => 'ApiCart',
            'action'   => 'getItems',
            'endpoint' => 'GET /api/cart',
        ]);
    }

    public function clear(): void
    {
        // Simulation d'un appel API DELETE /cart
        dd([
            'strategy' => 'ApiCart',
            'action'   => 'clear',
            'endpoint' => 'DELETE /api/cart',
        ]);
    }

    public function count(): int
    {
        // Simulation d'un appel API GET /cart/count
        dd([
            'strategy' => 'ApiCart',
            'action'   => 'count',
            'endpoint' => 'GET /api/cart/count',
        ]);
    }
}
