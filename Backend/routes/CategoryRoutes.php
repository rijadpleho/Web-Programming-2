<?php
/**
 * @OA\Get(
 *     path="/categories",
 *     tags={"categories"},
 *     summary="Get all categories",
 *     @OA\Response(
 *         response=200,
 *         description="List of all product categories"
 *     )
 * )
 */
Flight::route('GET /categories', function() {
    Flight::json(Flight::categoryService()->getAll());
});
/**
 * @OA\Get(
 *     path="/categories/{id}",
 *     tags={"categories"},
 *     summary="Get category by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Category ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category details"
 *     )
 * )
 */
Flight::route('GET /categories/@id', function($id) {
    Flight::json(Flight::categoryService()->getById($id));
});
/**
 * @OA\Post(
 *     path="/categories",
 *     tags={"categories"},
 *     summary="Create new category",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="Hockey Sticks"),
 *             @OA\Property(property="description", type="string", example="All types of hockey sticks")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category created successfully"
 *     )
 * )
 */
Flight::route('POST /categories', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::categoryService()->createCategory($data));
});
/**
 * @OA\Put(
 *     path="/categories/{id}",
 *     tags={"categories"},
 *     summary="Fully update a category",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Category ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=4)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Category"),
 *             @OA\Property(property="description", type="string", example="Updated description")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category updated successfully"
 *     )
 * )
 */
Flight::route('PUT /categories/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::categoryService()->update($id, $data));
});
/**
 * @OA\Delete(
 *     path="/categories/{id}",
 *     tags={"categories"},
 *     summary="Delete a category",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Category ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=4)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /categories/@id', function($id) {
    Flight::json(Flight::categoryService()->delete($id));
});
?>