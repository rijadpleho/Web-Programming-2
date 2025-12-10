<?php
require __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/CategoryService.php';
require_once __DIR__ . '/services/ProductService.php';
require_once __DIR__ . '/services/CartService.php';
require_once __DIR__ . '/services/CartItemService.php';
require_once __DIR__ . '/services/OrderService.php';
require_once __DIR__ . '/services/OrderItemService.php';
require_once __DIR__ . '/services/AuthService.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


Flight::register('userService',      'UserService');
Flight::register('categoryService',  'CategoryService');
Flight::register('productService',   'ProductService');
Flight::register('cartService',      'CartService');
Flight::register('cartItemService',  'CartItemService');
Flight::register('orderService',     'OrderService');
Flight::register('orderItemService', 'OrderItemService');
Flight::register('auth_service',     'AuthService');


Flight::route('/*', function() {

   
    if (
        strpos(Flight::request()->url, '/auth/login') === 0 ||
        strpos(Flight::request()->url, '/auth/register') === 0
    ) {
        return TRUE;
    }

    try {
    
        $token = Flight::request()->getHeader("Authentication");

        if (!$token) {
            Flight::halt(401, "Missing authentication header");
        }

      
        $decoded = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

       
        Flight::set('user', $decoded->user);
        Flight::set('jwt_token', $token);

        return TRUE;

    } catch (Exception $e) {
        Flight::halt(401, $e->getMessage());
    }
});


require_once __DIR__ . '/routes/AuthRoutes.php';
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/CategoryRoutes.php';
require_once __DIR__ . '/routes/ProductRoutes.php';
require_once __DIR__ . '/routes/CartRoutes.php';
require_once __DIR__ . '/routes/CartItemRoutes.php';
require_once __DIR__ . '/routes/OrderRoutes.php';
require_once __DIR__ . '/routes/OrderItemRoutes.php';


Flight::start();
?>
