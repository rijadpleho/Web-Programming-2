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
    Flight::json(Flight::cartItemService()->delete($id));
});
?>