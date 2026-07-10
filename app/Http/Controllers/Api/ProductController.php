<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\PermissionName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        Gate::forUser($user)->authorize(PermissionName::PRODUCTS_LIST->value);

        return response()->json([
            'products' => Product::query()->where('user_id', $user->id)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $product = new Product;
        $product->name = $validated['name'];
        $product->user_id = $user->id;
        $product->save();

        return response()->json(['message' => 'Produto criado com sucesso', 'product' => $product], 201);
    }

    public function destroy(int $id)
    {
        $user = Auth::guard('sanctum')->user();
        $product = Product::findOrFail($id);

        Gate::forUser($user)->authorize('delete', $product);

        $product->delete();

        return response()->json(['message' => 'apagado com sucesso']);
    }
}
