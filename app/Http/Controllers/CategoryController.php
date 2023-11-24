<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $productCategories = ProductCategory::all();
        return response()->json($productCategories);
    }

    public function show(ProductCategory $productCategory): JsonResponse
    {
        return response()->json($productCategory);
    }

    public function store(Request $request): JsonResponse
    {
        $productCategory = ProductCategory::query()->create($request->all());
        return response()->json($productCategory, 201);
    }

    public function update(Request $request, ProductCategory $productCategory): JsonResponse
    {
        $productCategory->update($request->all());
        return response()->json($productCategory, 200);
    }

    public function destroy(ProductCategory $productCategory): JsonResponse
    {
        $productCategory->delete();
        return response()->json(null, 204);
    }
}
