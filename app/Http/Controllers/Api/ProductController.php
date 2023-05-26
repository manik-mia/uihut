<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function show($id): JsonResponse
    {
        $product = Product::with('preview_images', 'categories')->findOrFail($id);
        return response()->json($product);
    }
}
