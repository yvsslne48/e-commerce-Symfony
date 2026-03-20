<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Retourne les produits d'une catégorie donnée.
     *
     * @return Product[]
     */
    public function findByCategory(int $categoryId): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.category', 'c')
            ->where('c.id = :categoryId')
            ->setParameter('categoryId', $categoryId)
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
