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
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RecieptController;
use Illuminate\Support\Facades\Auth;

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


// Route::get('/login', [LoginController::class, "showLoginForm"])->name('login')->middleware('guest');

// Route::post('/login', [LoginController::class, "login"])->middleware('guest');

Auth::routes();
// Route::get('/register',  [RegisterController::class, "index"])->name('users.register')->middleware('guest');
// Route::post('/users/new/store', [RegisterController::class, "create"])->name("users.new.store")->middleware('guest');

Route::get('/', function () {
    return redirect()->route('login');
});


// Route::get('/logout', [LoginController::class, "logout"])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/users/profile', [UsersController::class, "show"])->name('users.profile');

    Route::middleware(['is_superAdmin'])->group(function () {
         // Users
        Route::get('/users', [UsersController::class, "index"])->name("users.all");

        Route::get('/users/create', [UsersController::class, "create"])->name("users.create");

        Route::post('/users/store', [UsersController::class, "store"])->name("users.store");

        Route::get('/users/{user}/edit', [UsersController::class, "edit"])->name("users.edit");

        Route::put('/users/{user}', [UsersController::class, "update"])->name("users");

        Route::patch('/users/{user}', [UsersController::class, "disable"]);

        Route::delete('/users/{user}', [UsersController::class, "destroy"]);

         // Vehicle Types
        Route::get("/vehicle_types", [vehicleTypesController::class, 'index'])->name("vehicleTypes.all");

        Route::post('/vehicle_types/store', [VehicleTypesController::class, "store"])->name("vehicleTypes.store");

        Route::get('/vehicle_types/{type}/edit', [VehicleTypesController::class, "edit"])->name("vehicleTypes.edit");

        Route::put('/vehicle_types/{id}', [VehicleTypesController::class, "update"])->name("vehicleTypes");

        Route::delete('/vehicle_types/{type}', [VehicleTypesController::class, "destroy"]);

            // Services
        Route::get("/services", [ServicesController::class, 'index'])->name("services.all");

        Route::post('/services/store', [ServicesController::class, "store"])->name("services.store");

        Route::get('/services/{service}/edit', [ServicesController::class, "edit"])->name("services.edit");

        Route::put('/services/{id}', [ServicesController::class, "update"])->name("services");

        Route::delete('/services/{service}', [ServicesController::class, "destroy"]);

        // Service Components
        Route::get("/services/components", [ServicesComponentController::class, 'index'])->name("services_comp.all");

        Route::get("/services/{service_id}/components", [ServicesComponentController::class, 'index'])->name("service.services_comp");

        Route::post('/services/components/store', [ServicesComponentController::class, "store"])->name("services_comp.store");

        Route::get('/services/components/{component}/edit', [ServicesComponentController::class, "edit"])->name("services_comp.edit");

        Route::put('/services/components/{id}', [ServicesComponentController::class, "update"])->name("services_comp");

        Route::delete('/services/components/{component}', [ServicesComponentController::class, "destroy"]);

    });

    //Invoices
    Route::get('invoices/all', [InvoiceController::class, 'index'])->name('invoices.all');

    Route::get('/invoices/preview', [InvoiceController::class, 'preview'])->name('invoices.preview');

    Route::post('/invoices/download', [InvoiceController::class, 'download'])->name('invoices.download');

    Route::get('/invoices/{invoice}/details', [InvoiceController::class, 'invoice_breakdown'])->name("invoices.breakdown");

    Route::get('/invoices/{vehicle}/generate', [InvoiceController::class, 'create'])->name("invoice.generate");

    Route::post('/invoices/{vehicle}/store', [InvoiceController::class, 'store'])->name("invoice.store");

    // Vehicles
    Route::get('/vehicles', [VehiclesController::class, "index"])->name("vehicles.all");

    Route::get('/vehicles/register', [VehiclesController::class, "register"])->name("vehicles.register");

    Route::post('/vehicles/store', [VehiclesController::class, "store"])->name("vehicles.store");

    // Functionality can only be accessed by super Admins
    Route::get('/vehicles/{vehicle}/edit', [VehiclesController::class, "edit"])->name("vehicles.edit")->middleware('is_superAdmin');

    Route::put('/vehicles/{vehicle}', [VehiclesController::class, "update"])->name("vehicles")->middleware('is_superAdmin');;

    Route::get('/vehicles/{vehicle}', [VehiclesController::class, "show"]);

    // Functionality can only be used by superadmin
    Route::delete('/vehicles/{vehicle}', [VehiclesController::class, "delete"])->middleware('is_superAdmin');

    Route::post('/vehicles/verify', [VehiclesController::class, 'verify_vehicle'])->name('vehicles.verify');

    Route::get('/reciepts/all',[RecieptController::class,'index'])->name('reciepts.all');

    Route::get('/reciepts/{id}/show',[RecieptController::class,'show'])->name('reciepts.show');

    Route::get('/reciepts/{id}/download',[RecieptController::class,'download'])->name('reciepts.download');



});

Route::get("/invoices/show", [InvoiceController::class, "showInvoice"]);

Route::get('test',[InvoiceController::class,'test_download']);

Route::get("update_invoice/test", [InvoiceController::class, "test_update"])->name('update.test');
Route::post("invoices/initiate/update_invoice", [InvoiceController::class, "invoice_update"])->name('update');

Route::get('/leetcode',[RecieptController::class,'leetcode']);
