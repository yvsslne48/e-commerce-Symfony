<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // CATEGORIES
        $categoriesData = [
            [
                //we can add img in this file ex: 'image' => 'mouse.jpg'
                'name'        => 'Electronics',
                'description' => 'Headphones, speakers, gadgets and more',
                'badgeColor'  => 'primary',
                'products' => [
                    ['name' => 'Wireless Headphones',      'price' => '79.99',  'sku' => 'WH-001', 'image' => 'wireless-headphones.png',    'description' => '...'],
                    ['name' => 'Bluetooth Speaker',        'price' => '59.99',  'sku' => 'BS-001', 'image' => 'bluetooth-speaker.png',      'description' => '...'],
                    ['name' => 'Smartphone Stand',         'price' => '19.99',  'sku' => 'SS-001', 'image' => 'smartphone-stand.png',       'description' => '...'],
                    ['name' => 'USB-C Cable 2m',           'price' => '12.99',  'sku' => 'UC-001', 'image' => 'usb-c_cable.png',            'description' => '...'],
                    ['name' => 'Wireless Mouse',           'price' => '29.99',  'sku' => 'WM-001', 'image' => 'mouse.png',                  'description' => '...'],
                    ['name' => 'Mechanical Keyboard',      'price' => '89.99',  'sku' => 'MK-001', 'image' => 'mechanical-keyboard.png',    'description' => '...'],
                    ['name' => 'Webcam HD 1080p',          'price' => '49.99',  'sku' => 'WC-001', 'image' => 'webCam.png',                 'description' => '...'],
                    ['name' => 'Power Bank 20000mAh',      'price' => '39.99',  'sku' => 'PB-001', 'image' => 'power-bank.png',             'description' => '...'],
                    ['name' => 'Smart Watch Pro',          'price' => '199.99', 'sku' => 'SW-001', 'image' => 'smart-watch.png',            'description' => '...'],
                    ['name' => 'Noise Cancelling Earbuds', 'price' => '69.99',  'sku' => 'NE-001', 'image' => 'earphone.png',               'description' => '...'],
                ],
            ],
            [
                'name'        => 'Fashion',
                'description' => 'Clothing, accessories and footwear',
                'badgeColor'  => 'warning',
                'products'    => [
                    ['name' => 'Classic Leather Jacket', 'price' => '149.99', 'sku' => 'LJ-001', 'description' => 'Genuine leather jacket with a timeless design. Soft inner lining and multiple pockets.'],
                    ['name' => 'Slim Fit Jeans',         'price' => '59.99',  'sku' => 'SJ-001', 'description' => 'Premium denim slim fit jeans available in multiple washes. Comfortable stretch fabric.'],
                    ['name' => 'Cotton Polo Shirt',      'price' => '29.99',  'sku' => 'CP-001', 'description' => '100% organic cotton polo shirt. Breathable and easy to care for. Available in 8 colors.'],
                    ['name' => 'Running Sneakers',       'price' => '89.99',  'sku' => 'RS-001', 'description' => 'Lightweight running sneakers with cushioned sole and breathable mesh upper.'],
                    ['name' => 'Wool Scarf',             'price' => '24.99',  'sku' => 'WS-001', 'description' => 'Soft merino wool scarf available in classic patterns. Warm and stylish.'],
                ],
            ],
            [
                'name'        => 'Home & Garden',
                'description' => 'Furniture, decor and gardening tools',
                'badgeColor'  => 'success',
                'products'    => [
                    ['name' => 'Smart Plant Sensor',    'price' => '34.99',  'sku' => 'SP-001', 'description' => 'Monitor soil moisture, light and temperature for your plants via a smartphone app.'],
                    ['name' => 'Scented Candle Set',    'price' => '22.99',  'sku' => 'SC-001', 'description' => 'Set of 3 soy wax scented candles with 50h burn time each. Fragrances: lavender, vanilla and cedar.'],
                    ['name' => 'Bamboo Cutting Board',  'price' => '18.99',  'sku' => 'BC-001', 'description' => 'Eco-friendly bamboo cutting board with juice groove. Naturally antibacterial.'],
                    ['name' => 'Indoor Plant Pot Set',  'price' => '29.99',  'sku' => 'IP-001', 'description' => 'Set of 3 ceramic plant pots with drainage holes and matching saucers.'],
                    ['name' => 'LED Desk Lamp',         'price' => '39.99',  'sku' => 'DL-001', 'description' => 'Adjustable LED desk lamp with 5 color temperatures and wireless charging base.'],
                ],
            ],
            [
                'name'        => 'Sports & Fitness',
                'description' => 'Workout gear, yoga mats and equipment',
                'badgeColor'  => 'info',
                'products'    => [
                    ['name' => 'Yoga Mat Premium',      'price' => '29.99',  'sku' => 'YM-001', 'description' => 'Non-slip premium yoga mat, 6mm thick with alignment lines and carrying strap.'],
                    ['name' => 'Resistance Bands Set',  'price' => '19.99',  'sku' => 'RB-001', 'description' => 'Set of 5 resistance bands with different tension levels. Ideal for home workouts.'],
                    ['name' => 'Water Bottle 1L',       'price' => '24.99',  'sku' => 'WB-001', 'description' => 'Insulated stainless steel water bottle. Keeps drinks cold 24h or hot 12h.'],
                    ['name' => 'Jump Rope',             'price' => '14.99',  'sku' => 'JR-001', 'description' => 'Adjustable jump rope with ball bearings for smooth rotation. Suitable for all levels.'],
                ],
            ],
            [
                'name'        => 'Books',
                'description' => 'Fiction, non-fiction and educational',
                'badgeColor'  => 'danger',
                'products'    => [
                    ['name' => 'Web Development Guide', 'price' => '24.99',  'sku' => 'WD-001', 'description' => 'Complete guide to modern web development covering HTML, CSS, JavaScript and popular frameworks.'],
                    ['name' => 'PHP & Symfony Mastery', 'price' => '29.99',  'sku' => 'PS-001', 'description' => 'In-depth guide to PHP 8 and Symfony 7. Covers controllers, entities, forms and security.'],
                    ['name' => 'Clean Code',            'price' => '34.99',  'sku' => 'CC-001', 'description' => 'A handbook of agile software craftsmanship. Learn to write clean, readable and maintainable code.'],
                ],
            ],
            [
                'name'        => 'Beauty & Health',
                'description' => 'Skincare, cosmetics and wellness',
                'badgeColor'  => 'secondary',
                'products'    => [
                    ['name' => 'Vitamin C Serum',       'price' => '29.99',  'sku' => 'VC-001', 'description' => 'Brightening vitamin C serum with hyaluronic acid. Reduces dark spots and boosts collagen.'],
                    ['name' => 'Electric Toothbrush',   'price' => '49.99',  'sku' => 'ET-001', 'description' => 'Rechargeable electric toothbrush with 3 brushing modes and 2-minute timer.'],
                    ['name' => 'Face Moisturizer SPF30','price' => '22.99',  'sku' => 'FM-001', 'description' => 'Daily face moisturizer with SPF30 protection. Lightweight and non-greasy formula.'],
                    ['name' => 'Hair Mask Treatment',   'price' => '17.99',  'sku' => 'HM-001', 'description' => 'Deep conditioning hair mask with argan oil and keratin. Restores shine and softness.'],
                ],
            ],
        ];

        foreach ($categoriesData as $categoryData) {
            $category = new Category();
            $category->setName($categoryData['name']);
            $category->setDescription($categoryData['description']);
            $category->setBadgeColor($categoryData['badgeColor']);

            $manager->persist($category);

            foreach ($categoryData['products'] as $productData) {
                $product = new Product();
                $product->setName($productData['name']);
                $product->setPrice($productData['price']);
                $product->setSku($productData['sku']);
                $product->setDescription($productData['description']);
                $product->setInStock(true);
		$product->setImage($productData['image'] ?? null);
                $product->setCategory($category);

                $manager->persist($product);
            }
        }

        $manager->flush();
    }
}
