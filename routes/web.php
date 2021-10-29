<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', [LoginController::class, "showLoginForm"])->name('login.showForm')->middleware('guest');

Route::post('/login', [LoginController::class, "login"])->name('login.store')->middleware('guest');

Route::get('/', function () {
    return redirect()->route('login.showForm');
});

Route::get('/register', function(){
    // Register router  disabled
    return redirect()->route('login.store');
});

// Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/users', [UsersController::class, "index"])->name("users");
    Route::get('/users/create', [UsersController::class, "create"])->name("create.user");
    
    Route::post('/users/store', [UsersController::class, "store"])->name("store.user");

    Route::get('/users/{user}/edit', [UsersController::class, "edit"])->name("edit.user");
    
    Route::put('/users/{user}', [UsersController::class, "update"])->name("update.user");
    
    Route::get('/users/{user}', [UsersController::class, "show"])->name("show.user");
    
    Route::patch('/users/{user}', [UsersController::class, "disable"])->name("disable.user");
    
    Route::get('/users/{user}', [UsersController::class, "destroy"])->name("destroy.user");

    // Route::get('/payments)

});

