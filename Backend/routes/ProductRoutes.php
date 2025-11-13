<?php
/**
 * @OA\Get(
 *     path="/products",
 *     tags={"products"},
 *     summary="Get all products",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all products"
 *     )
 * )
 */
Flight::route('GET /products', function() {
    Flight::json(Flight::productService()->getAll());
});


/**
 * @OA\Get(
 *     path="/products/{id}",
 *     tags={"products"},
 *     summary="Get product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the product with given ID"
 *     )
 * )
 */
Flight::route('GET /products/@id', function($id) {
    Flight::json(Flight::productService()->getById($id));
});

/*Flight::route('GET /products/by-category', function() {
    $catId = Flight::request()->query['cat'] ?? null;
    if ($catId) {
        Flight::json(Flight::productService()->getProductsByCategory($catId));
    } else {
        Flight::json([]);
    }
});*/

/**
 * @OA\Post(
 *     path="/products",
 *     tags={"products"},
 *     summary="Create a new product",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "price", "category_id"},
 *             @OA\Property(property="name", type="string", example="Bauer Vapor Stick"),
 *             @OA\Property(property="price", type="number", example=199.99),
 *             @OA\Property(property="category_id", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Created product"
 *     )
 * )
 */
Flight::route('POST /products', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->createProduct($data));
});

/**
 * @OA\Put(
 *     path="/products/{id}",
 *     tags={"products"},
 *     summary="Update an existing product",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Stick"),
 *             @OA\Property(property="price", type="number", example=249.99),
 *             @OA\Property(property="category_id", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated product"
 *     )
 * )
 */
Flight::route('PUT /products/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->update($id, $data));
});
/**
 * @OA\Delete(
 *     path="/products/{id}",
 *     tags={"products"},
 *     summary="Delete a product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product deleted"
 *     )
 * )
 */
Flight::route('DELETE /products/@id', function($id) {
    Flight::json(Flight::productService()->delete($id));
});
?>