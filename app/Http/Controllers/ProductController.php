<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get(int $id): JsonResponse
    {
        $product = Product::where('id', $id)->first();

        if (!$product) {
            return response()->json([
                'errors' => [
                    'message' => "product not found",
                ],
            ]);
        } else {
            return response()->json([
                'data' => [
                    'name' => $product->name,
                    'value' => $product->value,
                    'quantity' => $product->quantity,
                ],
            ]);
        }
    }

    public function delete(int $id): JsonResponse
    {
        $product = Product::where('id', $id)->first();

        if (!$product) {
            return response()->json([
                'errors' => [
                    'message' => "product not found",
                ],
            ]);
        } else {
            $product->delete();
            return response()->json([
                "message" => "product deleted",
            ]);
        }
    }


    public function update(int $id, Request $request): JsonResponse
    {
        $product = Product::where('id', $id)->first();

        if (!$product) {
            return response()->json([
                'errors' => [
                    'message' => "product not found",
                ],
            ]);
        } else {
            $data = $request->validate([
                'name' => 'nullable|string|max:50|min:3',
                'value' => 'nullable|integer',
                'quantity' => 'nullable|integer|min:1',

            ]);

            $product->update($data);

            return response()->json([
                'data' => [
                    'name' => $product->name,
                    'value' => $product->value,
                    'quantity' => $product->quantity,
                ],
            ]);
        }
    }


    public function create(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:50|min:3',
            'value' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = new Product($data);
        $product->save();

        return response()->json(
            [
                'data' => [
                    'name' => $product->name,
                    'value' => $product->value,
                    'quantity' => $product->quantity,
                ],
            ],
            201
        );
    }
}
