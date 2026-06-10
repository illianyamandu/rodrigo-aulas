<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ], [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'password.required' => 'O campo de senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::query()->where('email', $request->input('email'))->first();
        if (! $user || ! password_verify($request->input('password'), $user->password)) {
            return redirect()->back()
                ->withErrors(['credentials' => 'Credenciais inválidas.'])
                ->withInput();
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'O campo de nome é obrigatório.',
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'password.required' => 'O campo de senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::query()->where('email', $request->input('email'))->first();
        if($user){
            return redirect()->back()
                ->withErrors(['email' => 'O e-mail já existe'])
                ->withInput();
        }
        else{
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            return response()->json([
                'message' => 'Usuário criado com sucesso',
                'user' => $user
            ], 201);
        }

    }    

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
