<?php

namespace App\Cart;

/**
 * Interface CartInterface
 * Définit le comportement que chaque gestionnaire de panier doit suivre.
 * Principe SOLID : Open/Closed — on peut ajouter de nouvelles stratégies
 * sans modifier le code existant.
 */
interface CartInterface
{
    /**
     * Ajoute un produit au panier.
     *
     * @param int $productId  L'identifiant du produit
     * @param int $quantity   La quantité à ajouter
     */
    public function add(int $productId, int $quantity): void;

    /**
     * Supprime un produit du panier.
     *
     * @param int $productId  L'identifiant du produit à supprimer
     */
    public function remove(int $productId): void;

    /**
     * Retourne le contenu complet du panier.
     * Format : [productId => quantity, ...]
     *
     * @return array
     */
    public function getItems(): array;

    /**
     * Vide complètement le panier.
     */
    public function clear(): void;

    /**
     * Retourne le nombre total d'articles dans le panier.
     *
     * @return int
     */
    public function count(): int;
}
