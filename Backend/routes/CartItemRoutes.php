<?php

/**
 * @OA\Get(
 *     path="/carts/{cart_id}/items",
 *     tags={"cart_items"},
 *     summary="Get all items for a specific cart",
 *     @OA\Parameter(
 *         name="cart_id",
 *         in="path",
 *         required=true,
 *         description="Cart ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of items for the given cart"
 *     )
 * )
 */
Flight::route('GET /carts/@cart_id/items', function($cart_id) {

    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);

    $logged_user = Flight::get('user');
    $cart = Flight::cartService()->getById($cart_id);

    if ($logged_user->role === Roles::USER && $cart['user_id'] != $logged_user->user_id) {
        Flight::halt(403, "You cannot view items from another user's cart.");
    }

    Flight::json(Flight::cartItemService()->getItemsForCart($cart_id));
});



/**
 * @OA\Post(
 *     path="/carts/{cart_id}/items",
 *     tags={"cart_items"},
 *     summary="Add an item to a cart",
 *     @OA\Parameter(
 *         name="cart_id",
 *         in="path",
 *         required=true,
 *         description="Cart ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"product_id", "quantity"},
 *             @OA\Property(property="product_id", type="integer", example=5),
 *             @OA\Property(property="quantity", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Item added to cart"
 *     )
 * )
 */
Flight::route('POST /carts/@cart_id/items', function($cart_id) {

    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);

    $logged_user = Flight::get('user');
    $cart = Flight::cartService()->getById($cart_id);

    if ($logged_user->role === Roles::USER && $cart['user_id'] != $logged_user->user_id) {
        Flight::halt(403, "You cannot add items to another user's cart.");
    }

    $data = Flight::request()->data->getData();
    $data['cart_id'] = $cart_id;

    Flight::json(Flight::cartItemService()->addItemToCart($data));
});



/**
 * @OA\Put(
 *     path="/cart-items/{id}",
 *     tags={"cart_items"},
 *     summary="Update an existing cart item",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Cart item ID",
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"cart_id", "product_id", "quantity"},
 *             @OA\Property(property="cart_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=7),
 *             @OA\Property(property="quantity", type="integer", example=5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart item updated"
 *     )
 * )
 */
Flight::route('PUT /cart-items/@id', function($id) {

    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);

    $cart_item = Flight::cartItemService()->getById($id);
    $cart = Flight::cartService()->getById($cart_item['cart_id']);
    $logged_user = Flight::get('user');

    if ($logged_user->role === Roles::USER && $cart['user_id'] != $logged_user->user_id) {
        Flight::halt(403, "You cannot update items in another user's cart.");
    }

    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartItemService()->update($id, $data));
});



/**
 * @OA\Delete(
 *     path="/cart-items/{id}",
 *     tags={"cart_items"},
 *     summary="Delete a cart item",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Cart item ID",
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart item deleted"
 *     )
 * )
 */
Flight::route('DELETE /cart-items/@id', function($id) {

    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);

   
    $cart_item = Flight::cartItemService()->getById($id);
    $cart = Flight::cartService()->getById($cart_item['cart_id']);
    $logged_user = Flight::get('user');

    if ($logged_user->role === Roles::USER && $cart['user_id'] != $logged_user->user_id) {
        Flight::halt(403, "You cannot delete items from another user's cart.");
    }

    Flight::json(Flight::cartItemService()->delete($id));
});

?>
