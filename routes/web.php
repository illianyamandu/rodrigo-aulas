<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EventsController;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    $events = Event::all();
    return view('home', ['events' => $events]);
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        $users = User::query()->get();

        return view('dashboard', ['users' => $users]);
    })->name('dashboard');

    Route::get('/events', [EventsController::class,'index'])->name('events');
    Route::post('/events', [EventsController::class,'store'])->name('events.store');

    Route::put('/users/{user}', function (Request $request, int $userId) {
        $user = User::query()->where('id', $userId)->first();
        if (! $user) {
            return redirect()->back()->withErrors(['user_not_found' => 'Usuário não encontrado.']);
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('dashboard');
    })->name('users.update');

    Route::delete('/users/{user}', function (int $userId) {
        $user = User::query()->where('id', $userId)->first();
        if (! $user) {
            return redirect()->back()->withErrors(['user_not_found' => 'Usuário não encontrado.']);
        }

        if (auth()->id() === $user->id) {
            return redirect()->back()->withErrors(['cannot_delete_self' => 'Você não pode deletar seu próprio usuário.']);
        }

        $user->delete();

        return redirect()->route('dashboard');
    })->name('users.delete');
});
