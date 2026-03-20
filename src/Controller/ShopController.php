<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShopController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/products', name: 'app_products')]
    public function products(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('auth/login.html.twig');
    }

    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('user/profile.html.twig');
    }

    #[Route('/cart', name: 'app_cart')]
    public function cart(): Response
    {
        return $this->render('cart/index.html.twig');
    }

    // ===== PAGES DYNAMISÉES =====

    #[Route('/categories', name: 'app_browse_categories')]
    public function browseCategories(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAllWithProductCount();

        return $this->render('category/browse.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/category/{id}/products', name: 'app_products_by_category', requirements: ['id' => '\d+'])]
    public function productsByCategory(
        int $id,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository
    ): Response {
        $category = $categoryRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Catégorie introuvable.');
        }

        $products = $productRepository->findByCategory($id);

        return $this->render('category/products.html.twig', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_details', requirements: ['id' => '\d+'])]
    public function productDetails(
        int $id,
        ProductRepository $productRepository
    ): Response {
        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit introuvable.');
        }

        return $this->render('product/details.html.twig', [
            'product' => $product,
        ]);
    }
}
