<?php

namespace App\Cart;

use App\DTO\Cart;
use App\DTO\CartItem;
use App\Cart\CartInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class CartHandler
{
    public function __construct(
        #[Autowire(service: SessionCart::class)]
        private readonly CartInterface $strategy
    ) {}

    /**
     * Méthode principale : reçoit un Cart et le gère via la stratégie.
     * CartHandler ne connaît pas la stratégie utilisée — SOLID respecté.
     */
    public function handle(Cart $cart, string $action, ?CartItem $item = null): Cart
    {
        return match($action) {
            'add'    => $this->strategy->add($item, $cart),
            'remove' => $this->strategy->remove($item, $cart),
            default  => $cart,
        };
    }

    public function getCart(string $identifier): Cart
    {
        return $this->strategy->getCart($identifier);
    }

    public function clearCart(string $identifier): void
    {
        $this->strategy->clearCart($identifier);
    }
}
