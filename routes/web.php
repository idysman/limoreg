<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ServicesComponentController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\VehicleTypesController;


// use App\Http\Controllers\VehicleTypes

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
    return redirect()->route('login');
});

Route::get('/register', function(){
    // Register router  disabled
    return redirect()->route('login');
});

// Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Users
    Route::get('/users', [UsersController::class, "index"])->name("users.all");
    Route::get('/users/create', [UsersController::class, "create"])->name("users.create");
    
    Route::post('/users/store', [UsersController::class, "store"])->name("users.store");

    Route::get('/users/{user}/edit', [UsersController::class, "edit"])->name("users.edit");
    
    Route::put('/users/{user}', [UsersController::class, "update"])->name("users");
    
    Route::get('/users/{user}', [UsersController::class, "show"]);
    
    Route::patch('/users/{user}', [UsersController::class, "disable"]);
    
    Route::delete('/users/{user}', [UsersController::class, "destroy"]);

    // Invoicing
    Route::get('/invoices/{vehicle}/generate', [InvoiceController::class, 'create'])->name("invoice.generate");
    
    Route::post('/invoices/{vehicle}/store', [InvoiceController::class, 'store'])->name("invoice.store");

    // FShow Invoice file
    Route::get("/invoices/show", [InvoiceController::class, "showInvoice"]);

    // Vehicle Types
    Route::get("/vehicle_types", [vehicleTypesController::class, 'index'])->name("vehicleTypes.all");
    
    Route::post('/vehicle_types/store', [VehicleTypesController::class, "store"])->name("vehicleTypes.store");

    Route::get('/vehicle_types/{type}/edit', [VehicleTypesController::class, "edit"])->name("vehicleTypes.edit");
    
    Route::put('/vehicle_types/{id}', [VehicleTypesController::class, "update"])->name("vehicleTypes");
    
    Route::delete('/vehicle_types/{type}', [VehicleTypesController::class, "destroy"]);

    // Vehicles
    Route::get('/vehicles', [VehiclesController::class, "index"])->name("vehicles.all");
    
    Route::get('/vehicles/register', [VehiclesController::class, "register"])->name("vehicles.register");
    
    Route::post('/vehicles/store', [VehiclesController::class, "store"])->name("vehicles.store");
    
    Route::get('/vehicles/{vehicle}/edit', [VehiclesController::class, "edit"])->name("vehicles.edit");
    
    Route::put('/vehicles/{vehicle}', [VehiclesController::class, "update"])->name("vehicles");
    
    Route::get('/vehicles/{vehicle}', [VehiclesController::class, "show"]);
    
    Route::delete('/vehicles/{vehicle}', [VehiclesController::class, "delete"]);

    Route::post('/vehicles/verify', [VehiclesController::class, 'verify_vehicle'])->name('vehicles.verify');
   
    // Services
    Route::get("/services", [ServicesController::class, 'index'])->name("services.all");
    
    Route::post('/services/store', [ServicesController::class, "store"])->name("services.store");

    Route::get('/services/{service}/edit', [ServicesController::class, "edit"])->name("services.edit");
    
    Route::put('/services/{id}', [ServicesController::class, "update"])->name("services");
    
    Route::delete('/services/{service}', [ServicesController::class, "destroy"]);

    // Service Components
    Route::get("/services/components", [ServicesComponentController::class, 'index'])->name("services_comp.all");
    
    Route::post('/services/components/store', [ServicesComponentController::class, "store"])->name("services_comp.store");

    Route::get('/services/components/{component}/edit', [ServicesComponentController::class, "edit"])->name("services_comp.edit");
    
    Route::put('/services/components/{id}', [ServicesComponentController::class, "update"])->name("services_comp");
    
    Route::delete('/services/components/{component}', [ServicesComponentController::class, "destroy"]);

});

