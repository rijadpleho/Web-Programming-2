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

$db = Database::connect();
$db->beginTransaction();

try {
  echo "<pre>";
 


  $email = 'john+'.time().'@example.com';
  $userDao->insert([
    'name'     => 'John',
    'surname'  => 'Doe',
    'email'    => $email,
    'password' => password_hash('password123', PASSWORD_DEFAULT)
  ]);
  $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
  $stmt->execute([':email'=>$email]);
  $userId = (int)$stmt->fetch()['id'];
  echo "User created (ID: $userId)\n";


  $catName = 'Hockey Sticks';
  $categoryDao->insert([
    'name'        => $catName,
    'description' => 'Top quality ice hockey sticks for all levels'
  ]);
  $stmt = $db->prepare("SELECT id FROM category WHERE name = :n");
  $stmt->execute([':n'=>$catName]);
  $categoryId = (int)$stmt->fetch()['id'];
  echo "Category created (ID: $categoryId)\n";

 
  $prodName = 'Bauer Vapor Stick';
  $productDao->insert([
    'name'        => $prodName,
    'price'       => 219.99,
    'category_id' => $categoryId
  ]);
  $stmt = $db->prepare("SELECT id FROM products WHERE name = :n AND category_id = :cid");
  $stmt->execute([':n'=>$prodName, ':cid'=>$categoryId]);
  $productId = (int)$stmt->fetch()['id'];
  echo "Product created (ID: $productId)\n";

 
  $cartDao->insert([
    'user_id' => $userId,
    'status'  => 'active'
  ]);
  $stmt = $db->prepare("SELECT id FROM carts WHERE user_id = :u AND status = 'active' ORDER BY id DESC LIMIT 1");
  $stmt->execute([':u'=>$userId]);
  $cartId = (int)$stmt->fetch()['id'];
  echo "Cart created (ID: $cartId)\n";

  
  $cartItemDao->insert([
    'cart_id'    => $cartId,
    'product_id' => $productId,
    'quantity'   => 2
  ]);
  echo "Cart item added.\n";


  $total = 2 * 219.99;
  $orderDao->insert([
    'user_id' => $userId,
    'status'  => 'pending',
    'total'   => $total
  ]);
  $stmt = $db->prepare("SELECT id FROM orders WHERE user_id = :u ORDER BY id DESC LIMIT 1");
  $stmt->execute([':u'=>$userId]);
  $orderId = (int)$stmt->fetch()['id'];
  echo "Order created (ID: $orderId)\n";

 
  $orderItemDao->insert([
    'order_id'   => $orderId,
    'product_id' => $productId,
    'quantity'   => 2
  ]);
  echo "Order item added.\n";

  $db->commit();

 
  echo "USERS:\n";        print_r($userDao->getAll());
  echo "\nCATEGORIES:\n"; print_r($categoryDao->getAll());
  echo "\nPRODUCTS:\n";   print_r($productDao->getAll());
  echo "\nCARTS:\n";      print_r($cartDao->getAll());
  echo "\nCART ITEMS:\n"; print_r($cartItemDao->getAll());
  echo "\nORDERS:\n";     print_r($orderDao->getAll());
  echo "\nORDER ITEMS:\n";print_r($orderItemDao->getAll());

 
  echo "</pre>";

} catch (Throwable $e) {
  $db->rollBack();
  http_response_code(500);
  echo "ERROR: " . $e->getMessage();
}
?>