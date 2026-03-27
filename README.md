# E-Commerce Symfony

## Prérequis

- PHP 8.5
- Symfony 7.4
- Composer
- MySQL 8.0

---

## Étape 1 — Intégration des pages

### Pages créées

| URL                       | Template                      | Description 
|---------------------------|-------------------------------|-------------
| `/`                       | `home/index.html.twig`        | Page d'accueil 
| `/products`               | `home/index.html.twig`        | Liste des produits 
| `/categories`             | `category/browse.html.twig`   | Liste des catégories 
| `/category/{id}/products` | `category/products.html.twig` | Produits par catégorie 
| `/product/{id}`           | `product/details.html.twig`   | Détail d'un produit 
| `/cart`                   | `cart/index.html.twig`        | Panier 
| `/profile`                | `user/profile.html.twig`      | Profil utilisateur 
| `/login`                  | `auth/login.html.twig`        | Connexion / Inscription 

### Structure des templates

```
templates/
├── base.html.twig       <- layout commun (navbar + footer Bootstrap)
├── auth/
│   └── login.html.twig
├── cart/
│   └── index.html.twig
├── category/
│   ├── browse.html.twig
│   └── products.html.twig
├── home/
│   └── index.html.twig
├── product/
│   └── details.html.twig
└── user/
    └── profile.html.twig
```
 
### Images des produits
```
Les images sont dans public/images/ :
public/
└── images/
    ├── bluetooth-speaker.png
    ├── classic-leather-jacket.png
    ├── earphone.png
    ├── ...
    ├── ...
    ├── ...
    └── yoga-mat.png
```
### Lancer le projet (sans BDD)

```bash
composer install
symfony serve
```

---

## Étape 2 — Dynamisation avec la base de données

### Entités créées

- **Category** : `id`, `name`, `description`, `badgeColor`
- **Product** : `id`, `name`, `description`, `price`, `sku`, `inStock`, `image`, `category`
- **Relation** : `Product` -> `ManyToOne` -> `Category`

### Structure ajoutée

```
src/
├── Controller/
│   └── ShopController.php      //toutes les routes
├── Entity/
│   ├── Category.php            //entité Doctrine
│   └── Product.php             //entité Doctrine
├── Repository/
│   ├── CategoryRepository.php  //findAllWithProductCount()
│   └── ProductRepository.php   //findByCategory(int $id)
└── DataFixtures/
    └── AppFixtures.php         // 6 catégories, 33 produits

migrations/
└── Version20260320012626.php   // migration générée automatiquement
```

### Pages dynamisées

| URL                       | Données depuis la BDD
|---------------------------|---------------------------
| `/categories`             | Toutes les catégories 
| `/category/{id}/products` | Produits filtrés par catégorie 
| `/product/{id}`           | Détail complet du produit 

### Configuration

Fichier .env :
    DATABASE_URL="mysql://root:root@127.0.0.1:3306/ecommerce?serverVersion=8.0&charset=utf8mb4"

Fichier .env.dev :
    Ce fichier écrase .env en environnement de développement.
    Il faut aussi le modifier sinon la connexion BDD échoue.

APP_SECRET=(secret)
DATABASE_URL="mysql://root:root@127.0.0.1:3306/ecommerce?serverVersion=8.0&charset=utf8mb4"


### Installation compléte
```
# 1. Installer les dépendances
composer install

# 2. Configurer .env et .env.dev avec la bonne DATABASE_URL

# 3. Créer la base de données
php bin/console doctrine:database:create

# 4. Générer la migration depuis les entités
php bin/console make:migration

# 5. Appliquer la migration (crée les tables category et product)
php bin/console doctrine:migrations:migrate

# 6. Installer le bundle fixtures
composer require --dev orm-fixtures

# 7. Charger les données de test
php bin/console doctrine:fixtures:load

# 8. Vider le cache
php bin/console cache:clear

# 9. Lancer le serveur
symfony serve
```
### Vérifier les données en BDD
```
# Vérifier les catégories
mysql -u root -proot ecommerce -e "SELECT id, name FROM category;"

# Vérifier les produits
mysql -u root -proot ecommerce -e "SELECT id, name, image FROM product LIMIT 5;"

```
