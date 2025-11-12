<?php
Flight::route('POST /users/@user_id/orders/from-cart/@cart_id', function($user_id, $cart_id) {
    Flight::json(Flight::orderService()->createOrderFromCart($user_id, $cart_id));
});
Flight::route('GET /orders', function() {
    Flight::json(Flight::orderService()->getAll());
});
Flight::route('GET /users/@user_id/orders', function($user_id) {
    Flight::json(Flight::orderService()->getOrdersForUser($user_id));
});
Flight::route('GET /orders/@id', function($id) {
    Flight::json(Flight::orderService()->getById($id));
});
Flight::route('PUT /orders/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->update($id, $data));
});
Flight::route('DELETE /orders/@id', function($id) {
    Flight::json(Flight::orderService()->deleteOrderWithItems($id));
});
?>