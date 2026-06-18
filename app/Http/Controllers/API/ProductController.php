<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return response()->json($this->productService->getAllProducts());
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return $product ? response()->json($product) : response()->json(['message' => 'Product not found'], 404);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = $this->productService->createProduct($data);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = $this->productService->updateProduct($id, $data);
        return $product ? response()->json($product) : response()->json(['message' => 'Product not found'], 404);
    }

    public function destroy($id)
    {
        return $this->productService->deleteProduct($id)
            ? response()->json(['message' => 'Product deleted'])
            : response()->json(['message' => 'Product not found'], 404);
    }
}