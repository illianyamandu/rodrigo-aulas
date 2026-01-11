<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('register');
    }

    public function store(Request $request) {
        $dados = $request->all();
        $usuario = User::create([
            'name' => $dados['name'],
            'email' => $dados['arroz'],
            'password' => bcrypt($dados['password']),
        ]);
        
        return response()->json([
            'message' => 'Usuário registrado com sucesso!',
            'data' => $usuario
        ], 201);
    }
}
