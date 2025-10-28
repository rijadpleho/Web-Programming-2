<?php
require_once 'dao/UserDao.php';
require_once 'dao/CategoryDao.php';
require_once 'dao/ProductDao.php';
require_once 'dao/CartDao.php';
require_once 'dao/CartItemDao.php';
require_once 'dao/OrderDao.php';
require_once 'dao/OrderItemDao.php';


$userDao      = new UserDao();
$categoryDao  = new CategoryDao();
$productDao   = new ProductDao();
$cartDao      = new CartDao();
$cartItemDao  = new CartItemDao();
$orderDao     = new OrderDao();
$orderItemDao = new OrderItemDao();


$userDao->insert([
   'name'     => 'John',
   'surname'  => 'Doe',
   'email'    => 'john@example.com',
   'password' => password_hash('password123', PASSWORD_DEFAULT)
]);


$categoryDao->insert([
   'name'        => 'Hockey Sticks',
   'description' => 'Top quality ice hockey sticks for all levels'
]);


$productDao->insert([
   'name'        => 'Bauer Vapor Stick',
   'price'       => 219.99,
   'category_id' => 1
]);


$cartDao->insert([
   'user_id' => 1,
   'status'  => 'active'
]);


$cartItemDao->insert([
   'cart_id'    => 1,
   'product_id' => 1,
   'quantity'   => 2
]);


$orderDao->insert([
   'user_id' => 1,
   'status'  => 'pending',
   'total'   => 439.98
]);


$orderItemDao->insert([
   'order_id'   => 1,
   'product_id' => 1,
   'quantity'   => 2
]);


echo "<pre>";

echo "USERS:\n";
print_r($userDao->getAll());

echo "\nCATEGORIES:\n";
print_r($categoryDao->getAll());

echo "\nPRODUCTS:\n";
print_r($productDao->getAll());

echo "\nCARTS:\n";
print_r($cartDao->getAll());

echo "\nCART ITEMS:\n";
print_r($cartItemDao->getAll());

echo "\nORDERS:\n";
print_r($orderDao->getAll());

echo "\nORDER ITEMS:\n";
print_r($orderItemDao->getAll());

echo "</pre>";
?>