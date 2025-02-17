<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::middleware(['rol:administrador,recepcionista'])->group(function () {

        //Books
        Route::get('/book/index', [BookController::class, 'index'])->name('book.index');
        Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
        Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
        Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
        Route::put('/book/update/{book}', [BookController::class, 'update'])->name('book.update');
        Route::delete('/book/delete/{id}', [BookController::class, 'delete'])->name('book.delete');

        //Loans
        Route::get('/loan/index', [LoanController::class, 'index'])->name('loan.index');
        Route::get('/loan/create', [LoanController::class, 'create'])->name('loan.create');
        Route::post('/loan/store', [LoanController::class, 'store'])->name('loan.store');
        Route::get('/loan/edit/{id}', [LoanController::class, 'edit'])->name('loan.edit');
        Route::put('/loan/update/{loan}', [LoanController::class, 'update'])->name('loan.update');
        Route::delete('/loan/delete/{id}', [LoanController::class, 'delete'])->name('loan.delete');
        Route::patch('/loans/{id}/close', [LoanController::class, 'close'])->name('loans.close');

        //Clients
        Route::get('/clients/index', [UserController::class, 'indexCliente'])->name('clients.index');
        Route::get('/clients/create', [UserController::class, 'createCliente'])->name('clients.create');
        Route::post('/clients/store', [UserController::class, 'storeCliente'])->name('clients.store');
        Route::get('/clients/edit/{id}', [UserController::class, 'editCliente'])->name('clients.edit');
        Route::put('/clients/update/{user}', [UserController::class, 'updateCliente'])->name('clients.update');
        Route::delete('/clients/delete/{user}', [UserController::class, 'deleteCliente'])->name('clients.delete');

        //receptionist
        Route::get('/receptionists/index', [UserController::class, 'indexRecepcionista'])->name('receptionists.index');
        Route::get('/receptionists/create', [UserController::class, 'createRecepcionista'])->name('receptionists.create');
        Route::post('/receptionists/store', [UserController::class, 'storeRecepcionista'])->name('receptionists.store');
        Route::get('/receptionists/edit/{id}', [UserController::class, 'editRecepcionista'])->name('receptionists.edit');
        Route::put('/receptionists/update/{user}', [UserController::class, 'updateRecepcionista'])->name('receptionists.update');
        Route::delete('/receptionists/delete/{user}', [UserController::class, 'deleteRecepcionista'])->name('receptionists.delete');
        

    });





});
