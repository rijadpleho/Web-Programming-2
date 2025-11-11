<?php
Flight::route('GET /carts/@cart_id/items', function($cart_id) {
    Flight::json(Flight::cartItemService()->getItemsForCart($cart_id));
});
Flight::route('POST /carts/@cart_id/items', function($cart_id) {
    $data = Flight::request()->data->getData();
    $data['cart_id'] = $cart_id;
    Flight::json(Flight::cartItemService()->addItemToCart($data));
});
Flight::route('PUT /cart-items/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartItemService()->update($id, $data));
});
Flight::route('DELETE /cart-items/@id', function($id) {
    Flight::json(Flight::cartItemService()->delete($id));
});
?>