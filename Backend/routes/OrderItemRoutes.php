<?php
Flight::route('GET /orders/@order_id/items', function($order_id) {
    Flight::json(Flight::orderItemService()->getItemsForOrder($order_id));
});
Flight::route('POST /orders/@order_id/items', function($order_id) {
    $data = Flight::request()->data->getData();
    $data['order_id'] = $order_id;
    Flight::json(Flight::orderItemService()->create($data));
});
Flight::route('PUT /order-items/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderItemService()->update($id, $data));
});
Flight::route('DELETE /order-items/@id', function($id) {
    Flight::json(Flight::orderItemService()->delete($id));
});
?>