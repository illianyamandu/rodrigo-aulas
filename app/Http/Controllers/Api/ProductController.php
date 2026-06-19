<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $permissions = $user->permissions()->get();

        $hasPermission = $permissions->where('name', 'list-products')->first();
        if (!$hasPermission) {
            return response()->json(['error' => 'Acesso negado'], 403);
        }

        // UM MILHÃO DE COISAS AQUI PARA LISTAR PRODUTROS

        return response()->json([
            'products' => [
                ['id' => 1, 'name' => 'Produto A', 'price' => 10.00],
                ['id' => 2, 'name' => 'Produto B', 'price' => 20.00],
                ['id' => 3, 'name' => 'Produto C', 'price' => 30.00],
            ],
        ]);
    }
    public function destroy(){
        $user = Auth::guard('sanctum')->user();
        $permissions = $user->permissions()->get();

        $hasPermission = $permissions->where('name', 'delete-products')->first();
        if (!$hasPermission) {
            return response()->json(['error' => 'Acesso negado'], 403);
        }

        return response()->json(['message' => 'apagado com sucesso']);
    }
}
