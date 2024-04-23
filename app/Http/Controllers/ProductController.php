<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page') ?? 80;
        $products = Product::with('category')
            ->search($request->query('q'))
            ->sort($request->query('sort'))
            ->paginate($perPage)
            ->withQueryString();
        return response()->json($products);
    }

    public function show(Request $request): JsonResponse
    {
        $id = $request->route('id');
        $product = Product::with('category')->find($id);
        return response()->json($product);
    }

    public function store(Request $request): JsonResponse
    {
        $product = Product::query()->create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $data = $request->all();
        if($request->has('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = env('APP_URL')."/images/$imageName";
        }

        $product->update($data);
        return response()->json($product, 200);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
