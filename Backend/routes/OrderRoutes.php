<?php

/**
 * @OA\Post(
 *     path="/users/{user_id}/orders/from-cart/{cart_id}",
 *     tags={"orders"},
 *     summary="Create an order from a user's cart",
 *     description="Takes all items from a user's active cart and creates a new order.",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="cart_id",
 *         in="path",
 *         required=true,
 *         description="Cart ID",
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order successfully created"
 *     )
 * )
 */
Flight::route('POST /users/@user_id/orders/from-cart/@cart_id', function($user_id, $cart_id) {

   
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);

    
    $logged_user = Flight::get('user');
    if ($logged_user->role === Roles::USER && $logged_user->user_id != $user_id) {
        Flight::halt(403, "You cannot create orders for another user.");
    }

    Flight::json(Flight::orderService()->createOrderFromCart($user_id, $cart_id));
});



/**
 * @OA\Get(
 *     path="/orders",
 *     tags={"orders"},
 *     summary="Get all orders (ADMIN only)",
 *     @OA\Response(
 *         response=200,
 *         description="List of all orders"
 *     )
 * )
 */
Flight::route('GET /orders', function() {

    
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    Flight::json(Flight::orderService()->getAll());
});



/**
 * @OA\Get(
 *     path="/users/{user_id}/orders",
 *     tags={"orders"},
 *     summary="Get all orders for a specific user",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of orders for this user"
 *     )
 * )
 */
Flight::route('GET /users/@user_id/orders', function($user_id) {

    
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);

    
    $logged_user = Flight::get('user');
    if ($logged_user->role === Roles::USER && $logged_user->user_id != $user_id) {
        Flight::halt(403, "You cannot view another user's orders.");
    }

    Flight::json(Flight::orderService()->getOrdersForUser($user_id));
});



/**
 * @OA\Get(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Get an order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Order ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order details"
 *     )
 * )
 */
Flight::route('GET /orders/@id', function($id) {

    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);

    Flight::json(Flight::orderService()->getById($id));
});



/**
 * @OA\Put(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Update an order",
 *     description="Updates order fields such as status or total.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=8)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="status", type="string", example="completed"),
 *             @OA\Property(property="total", type="number", example=199.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order updated"
 *     )
 * )
 */
Flight::route('PUT /orders/@id', function($id) {


    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->update($id, $data));
});



/**
 * @OA\Delete(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Delete an order",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", example=10)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order deleted"
 *     )
 * )
 */
Flight::route('DELETE /orders/@id', function($id) {

    
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    Flight::json(Flight::orderService()->deleteOrderWithItems($id));
});

?>
