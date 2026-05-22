<?php

namespace App\Controller;

use App\Cart\CartHandler;
use App\DTO\Cart;
use App\DTO\CartItem;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShopController extends AbstractController
{
    private const CART_ID = 'main_cart';

    #[Route('/', name: 'app_home')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'categories' => $categoryRepository->findAllWithProductCount(),
        ]);
    }

    #[Route('/products', name: 'app_products')]
    public function products(CategoryRepository $categoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'categories' => $categoryRepository->findAllWithProductCount(),
        ]);
    }

    // #[Route('/login', name: 'app_login')]
    // public function login(): Response
    // {
    //     return $this->render('auth/login.html.twig');
    // }
    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('user/profile.html.twig');
    }

    #[Route('/categories', name: 'app_browse_categories')]
    public function browseCategories(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/browse.html.twig', [
            'categories' => $categoryRepository->findAllWithProductCount(),
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

        return $this->render('category/products.html.twig', [
            'category' => $category,
            'products' => $productRepository->findByCategory($id),
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

    #[Route('/cart', name: 'app_cart')]
    public function cart(
        CartHandler $cartHandler,
        ProductRepository $productRepository
    ): Response {
        $cart     = $cartHandler->getCart(self::CART_ID);
        $products = [];
        $total    = 0;

        foreach ($cart->getItems() as $cartItem) {
            $product = $productRepository->find($cartItem->getProductId());
            if ($product) {
                $subtotal   = $product->getPrice() * $cartItem->getQuantity();
                $total     += $subtotal;
                $products[] = [
                    'product'  => $product,
                    'quantity' => $cartItem->getQuantity(),
                    'subtotal' => $subtotal,
                ];
            }
        }

        return $this->render('cart/index.html.twig', [
            'cartItems' => $products,
            'total'     => $total,
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function addToCart(
        int $id,
        Request $request,
        CartHandler $cartHandler,
        ProductRepository $productRepository
    ): Response {
        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit introuvable.');
        }

        $quantity = max(1, (int) $request->request->get('quantity', 1));
        $cartItem = new CartItem($id, $quantity);
        $cart     = $cartHandler->getCart(self::CART_ID);

        $cartHandler->handle($cart, 'add', $cartItem);

        $this->addFlash('success', sprintf('"%s" ajouté au panier.', $product->getName()));

        return $this->redirectToRoute('app_product_details', ['id' => $id]);
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove', requirements: ['id' => '\d+'])]
    public function removeFromCart(
        int $id,
        CartHandler $cartHandler
    ): Response {
        $cartItem = new CartItem($id, 0);
        $cart     = $cartHandler->getCart(self::CART_ID);

        $cartHandler->handle($cart, 'remove', $cartItem);

        $this->addFlash('success', 'Produit retiré du panier.');

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/clear', name: 'app_cart_clear')]
    public function clearCart(CartHandler $cartHandler): Response
    {
        $cartHandler->clearCart(self::CART_ID);

        $this->addFlash('success', 'Panier vidé.');

        return $this->redirectToRoute('app_cart');
    }
}
