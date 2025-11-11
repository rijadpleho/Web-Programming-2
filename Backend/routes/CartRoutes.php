<?php
Flight::route('GET /users/@user_id/cart', function($user_id) {
    Flight::json(Flight::cartService()->getOrCreateActiveCart($user_id));
});
Flight::route('PUT /carts/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartService()->update($id, $data));
});
Flight::route('DELETE /carts/@id', function($id) {
    Flight::json(Flight::cartService()->delete($id));
});
Flight::route('GET /carts', function() {
    Flight::json(Flight::cartService()->getAll());
});
Flight::route('GET /carts/@id', function($id) {
    Flight::json(Flight::cartService()->getById($id));
});
?>