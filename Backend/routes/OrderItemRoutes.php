<?php

/**
 * @OA\Get(
 *     path="/orders/{order_id}/items",
 *     tags={"order_items"},
 *     summary="Get all items for a specific order",
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(
 *         name="order_id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of all items for the given order"
 *     )
 * )
 */
Flight::route('GET /orders/@order_id/items', function($order_id) {

    
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);

   
    $logged_user = Flight::get('user');
    if ($logged_user->role === Roles::USER) {
        
        $order = Flight::orderService()->getById($order_id);

        if ($order['user_id'] != $logged_user->user_id) {
            Flight::halt(403, "You cannot view another user's order items.");
        }
    }

    Flight::json(Flight::orderItemService()->getItemsForOrder($order_id));
});



/**
 * @OA\Post(
 *     path="/orders/{order_id}/items",
 *     tags={"order_items"},
 *     summary="Add an item to an existing order",
 *     security={{"ApiKeyAuth": {}}},
 *     description="Creates a new order item for the specified order ID.",
 *
 *     @OA\Parameter(
 *         name="order_id",
 *         in="path",
 *         required=true,
 *         description="ID of the order",
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"product_id", "quantity"},
 *             @OA\Property(property="product_id", type="integer", example=10),
 *             @OA\Property(property="quantity", type="integer", example=3)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Order item added successfully"
 *     )
 * )
 */
Flight::route('POST /orders/@order_id/items', function($order_id) {

    
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    $data = Flight::request()->data->getData();
    $data['order_id'] = $order_id;

    Flight::json(Flight::orderItemService()->create($data));
});



/**
 * @OA\Put(
 *     path="/order-items/{id}",
 *     tags={"order_items"},
 *     summary="Update an order item fully",
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=15),
 *             @OA\Property(property="quantity", type="integer", example=4)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item updated"
 *     )
 * )
 */
Flight::route('PUT /order-items/@id', function($id) {

    
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderItemService()->update($id, $data));
});



/**
 * @OA\Delete(
 *     path="/order-items/{id}",
 *     tags={"order_items"},
 *     summary="Delete an order item",
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=7)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item deleted"
 *     )
 * )
 */
Flight::route('DELETE /order-items/@id', function($id) {

    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    Flight::json(Flight::orderItemService()->delete($id));
});

?>
