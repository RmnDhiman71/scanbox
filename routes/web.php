<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BarCodeController;
use App\Http\Controllers\Admin\RequestMoneyController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ConfigController;

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

Route::get('home', function () {
    return view('home2');
})->name('home');

Route::get('test', function () {
    return view('test');
})->name('test');

Auth::routes();

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('login', [AuthController::class, 'authenticate'])->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [HomePageController::class, 'index'])->name('dashboard');

    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('update-profile', [AuthController::class, 'update'])->name('update-profile');

    Route::group(['prefix' => 'barcode'], function () {
        // Route::get('/', [BarCodeController::class, 'index'])->name('barcodes');
        Route::get('add', [BarCodeController::class, 'add'])->name('add-barcode');
        Route::post('store', [BarCodeController::class, 'store'])->name('store-barcode');
        Route::get('list', [BarCodeController::class, 'list'])->name('barcode-list');
        Route::get('/', [BarCodeController::class, 'batches'])->name('barcodes');
        Route::get('list/{batch}', [BarCodeController::class, 'batchList'])->name('batches-list');
        Route::get('delete/{batch}', [BarCodeController::class, 'destroy'])->name('delete-batch');
        Route::get('update/{batch}', [BarCodeController::class, 'update'])->name('update-batch');
    });

    Route::group(['prefix' => 'money-requests'], function () {
        Route::get('/', [RequestMoneyController::class, 'index'])->name('money-requests');
        Route::get('approved', [RequestMoneyController::class, 'approved'])->name('approved-money-requests');
        Route::get('transferred', [RequestMoneyController::class, 'transferred'])->name('transferred-money-requests');
        Route::get('update/{transaction}', [RequestMoneyController::class, 'update'])->name('update-money-status');
        Route::get('edit/{transaction}/{status}', [RequestMoneyController::class, 'edit'])->name('edit-money-status');
    });
    
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
    });

    Route::group(['prefix' => 'configurations'], function () {
        Route::get('/', [ConfigController::class, 'index'])->name('configurations');
    });
});