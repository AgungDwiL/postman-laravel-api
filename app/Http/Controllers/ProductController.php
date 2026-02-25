<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
