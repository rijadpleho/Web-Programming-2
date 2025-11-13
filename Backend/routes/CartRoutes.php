<?php
/**
 * @OA\Get(
 *     path="/users/{user_id}/cart",
 *     tags={"carts"},
 *     summary="Get active cart for a user",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Active cart for the user"
 *     )
 * )
 */
Flight::route('GET /users/@user_id/cart', function($user_id) {
    Flight::json(Flight::cartService()->getOrCreateCart($user_id));
});
/**
 * @OA\Put(
 *     path="/carts/{id}",
 *     tags={"carts"},
 *     summary="Update an existing cart",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Cart ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="completed")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart updated"
 *     )
 * )
 */
Flight::route('PUT /carts/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartService()->update($id, $data));
});
/**
 * @OA\Delete(
 *     path="/carts/{id}",
 *     tags={"carts"},
 *     summary="Delete a cart by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Cart ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart deleted"
 *     )
 * )
 */
Flight::route('DELETE /carts/@id', function($id) {
    Flight::json(Flight::cartService()->delete($id));
});
/**
 * @OA\Get(
 *     path="/carts",
 *     tags={"carts"},
 *     summary="Get all carts",
 *     @OA\Response(
 *         response=200,
 *         description="List of all carts"
 *     )
 * )
 */
Flight::route('GET /carts', function() {
    Flight::json(Flight::cartService()->getAll());
});
/**
 * @OA\Get(
 *     path="/carts/{id}",
 *     tags={"carts"},
 *     summary="Get a cart by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Cart ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Cart details"
 *     )
 * )
 */
Flight::route('GET /carts/@id', function($id) {
    Flight::json(Flight::cartService()->getById($id));
});
?>