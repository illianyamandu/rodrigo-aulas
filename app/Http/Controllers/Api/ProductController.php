<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
            'products' => [
                ['id' => 1, 'name' => 'Produto A', 'price' => 10.00],
                ['id' => 2, 'name' => 'Produto B', 'price' => 20.00],
                ['id' => 3, 'name' => 'Produto C', 'price' => 30.00],
            ],
        ]);
    }

    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();
        Gate::forUser($user)->authorize(PermissionName::PRODUCTS_MANAGE->value);

        return response()->json(['message' => 'apagado com sucesso']);
    }
}
