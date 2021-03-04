<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\CardStateController;
use App\Http\Controllers\LaguagesController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'version'], function () {
    Route::get('/', [VersionController::class, 'index']);
    Route::get('/create', [VersionController::class, 'create']);
    Route::post('/create', [VersionController::class, 'store']);
//    Route::get('/search', [VersionController::class, 'search']);
    Route::put('/update/{id}', [VersionController::class, 'update']);
    Route::get('/edit/{id}', [VersionController::class, 'edit']);

    Route::delete('/delete/{id}', [VersionController::class, 'destroy']);
});

Route::group(['prefix' => 'cardstate'], function () {
    Route::get('/', [CardStateController::class, 'index']);
    Route::get('/create', [CardStateController::class, 'create']);
    Route::post('/create', [CardStateController::class, 'store']);
//    Route::get('/search', [CardStateController::class, 'search']);
    Route::put('/update/{id}', [CardStateController::class, 'update']);
    Route::get('/edit/{id}', [CardStateController::class, 'edit']);

    Route::delete('/delete/{id}', [CardStateController::class, 'destroy']);
});

Route::group(['prefix' => 'language'], function () {
    Route::get('/', [LaguagesController::class, 'index']);
    Route::get('/create', [LaguagesController::class, 'create']);
    Route::post('/create', [LaguagesController::class, 'store']);
//    Route::get('/search', [LaguagesController::class, 'search']);
    Route::put('/update/{id}', [LaguagesController::class, 'update']);
    Route::get('/edit/{id}', [LaguagesController::class, 'edit']);

    Route::delete('/delete/{id}', [LaguagesController::class, 'destroy']);
});

Route::group(['prefix' => 'card'], function () {
    Route::get('/', [CardController::class, 'index']);
    Route::get('/create', [CardController::class, 'create']);
    Route::post('/create', [CardController::class, 'store']);
//    Route::get('/search', [CardController::class, 'search']);
    Route::get('/edit/{id}', [CardController::class, 'edit']);
    Route::put('/update/{id}', [CardController::class, 'update']);
    Route::delete('/delete/{id}', [CardController::class, 'destroy']);
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index']);
    Route::get('/create', [CartController::class, 'create']);
    Route::post('/create', [CartController::class, 'store']);
//    Route::get('/search', [CartController::class, 'search']);
    Route::put('/update/{id}', [CartController::class, 'update']);
    Route::delete('/delete/{id}', [CartController::class, 'destroy']);
});

Route::group(['prefix' => 'purchase'], function () {
    Route::get('/', [PurchaseController::class, 'index']);
    Route::get('/create', [PurchaseController::class, 'create']);
    Route::post('/create', [PurchaseController::class, 'store']);
//    Route::get('/search', [PurchaseController::class, 'search']);
    Route::put('/update/{id}', [PurchaseController::class, 'update']);
    Route::delete('/delete/{id}', [PurchaseController::class, 'destroy']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
});

