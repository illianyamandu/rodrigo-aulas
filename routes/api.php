<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Middleware\CheckApiAuth;
use App\Http\Middleware\CheckProductPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::post('/users', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email'],
        'password' => ['required', 'min:8'],
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $usuario = User::query()->where('email', $request->email)->first();
    if ($usuario) {
        return response()->json(['error' => 'Email já cadastrado'], 409);
    }

    $usuario = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return response()->json($usuario, 201);
});

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware([
    CheckApiAuth::class,
    CheckProductPermission::class,
])->group(function () {
    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->perimssion('products.list');
        Route::post('/', [ProductController::class, 'store']);
        Route::delete('/{id}', [ProductController::class, 'destroy'])->permission('products.delete');
    });
});
