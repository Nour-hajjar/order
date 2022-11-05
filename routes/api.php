<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


    Route::post('/login', [LoginController::class, 'Login']);

    Route::post('/register', [LoginController::class, 'register']);

    Route::post('/invoice', [InvoiceController::class, 'store']);
    Route::get('/invoice', [InvoiceController::class, 'index']);
     Route::put('/show/edit/{id}', [InvoiceController::class, 'show']);
      Route::put('/status/edit/{id}', [InvoiceController::class, 'status']);
     Route::get('/users', [\App\Http\Controllers\UsersController::class, 'index'])->name('users');
    Route::post('/users', [\App\Http\Controllers\UsersController::class, 'newUser']);
    Route::put('/users/edit/{id}', [\App\Http\Controllers\UsersController::class, 'editUser']);
    Route::put('/users/edit/password/{id}', [\App\Http\Controllers\UsersController::class, 'changePassword']);
    Route::put('/users/edit/email/{id}', [\App\Http\Controllers\UsersController::class, 'changeEmail']);
    Route::delete('/users/delete/{id}', [\App\Http\Controllers\UsersController::class, 'destroy']);
    Route::post('/invoices/{id}/assign', [\App\Http\Controllers\InvoiceController::class, 'create'])->name('invoices.assign');
     Route::get('/getuserinvoice', [\App\Http\Controllers\UsersController::class, 'getuserinvoice']);
     Route::get('/getinvoices/{id}', [\App\Http\Controllers\UsersController::class, 'getinvoices'])->name('assignedInvoices');
      Route::post('generator-docx', [\App\Http\Controllers\HomeController::class, 'index']);
       Route::get('accepted/{id}', [\App\Http\Controllers\InvoiceController::class, 'Accepted'])->name('Accepted');
          Route::get('delivered/{id}', [\App\Http\Controllers\InvoiceController::class, 'Delivered'])->name('Delivered');
            Route::put('/invoices/edit/{id}', [\App\Http\Controllers\InvoiceController::class, 'update']);

  Route::get('Pick/{id}', [\App\Http\Controllers\InvoiceController::class, 'Pick'])->name('Pick');  
Route::get('storeToken', [\App\Http\Controllers\WebNotificationController::class, 'storeToken'])->name('storeToken');

Route::get('sendWebNotification', [\App\Http\Controllers\WebNotificationController::class, 'sendWebNotification'])->name('sendWebNotification');
Route::get('noti', [\App\Http\Controllers\InvoiceController::class, 'noti'])->name('noti');
