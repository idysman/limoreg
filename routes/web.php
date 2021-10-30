<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InvoiceController;

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


Route::get('/login', [LoginController::class, "showLoginForm"])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, "login"])->middleware('guest');

Route::get('/', function () {
    return redirect()->route('login.showForm');
});

Route::get('/register', function(){
    // Register router  disabled
    return redirect()->route('login');
});

// Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/users', [UsersController::class, "index"])->name("users.all");
    Route::get('/users/create', [UsersController::class, "create"])->name("users.create");
    
    Route::post('/users/store', [UsersController::class, "store"])->name("users.store");

    Route::get('/users/{user}/edit', [UsersController::class, "edit"])->name("users.edit");
    
    Route::put('/users/{user}', [UsersController::class, "update"])->name("users");
    
    Route::get('/users/{user}', [UsersController::class, "show"]);
    
    Route::patch('/users/{user}', [UsersController::class, "disable"]);
    
    Route::delete('/users/{user}', [UsersController::class, "destroy"]);

    Route::get('/invoices/generate', [InvoiceController::class, 'create'])->name("invoice.generate");
    
    Route::post('/invoices/generate', [InvoiceController::class, 'store']);

});

