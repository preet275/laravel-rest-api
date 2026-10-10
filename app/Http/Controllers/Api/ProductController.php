<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        // Check if there are no products
        if ($products->isEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'No products found',
                'data' => [],
            ], 200);
        }

        // Return all products with success response
        return response()->json([
            'status' => true,
            'message' => 'All products fetched successfully',
            'data' => $products,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming product data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        // Create product using validated data
        $product = Product::create($validated);

        // Return success response with status code
        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find product by ID
        $product = Product::find($id);
        // Check if product exists
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        }

        // Return single product
        return response()->json([
            'status' => true,
            'message' => 'Product fetched successfully',
            'data' => $product,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find product by ID
        $product = Product::find($id);

        // Check if product exists
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        }

        // Validate incoming product data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        // Update product with validated data
        $product->update($validated);

        // Return updated product
        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => $product,
        ], 200);
    }

    // Delete a product by ID
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
