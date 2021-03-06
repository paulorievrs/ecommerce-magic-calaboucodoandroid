<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\CardStateController;
use App\Http\Controllers\LaguagesController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BankController;
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

Route::get('/', [ CardController::class, 'welcome' ]);

Route::group(['prefix' => 'version', 'middleware' => 'admin'], function () {
    Route::get('/', [VersionController::class, 'index']);
    Route::get('/create', [VersionController::class, 'create']);
    Route::post('/create', [VersionController::class, 'store']);
//    Route::get('/search', [VersionController::class, 'search']);
    Route::put('/update/{id}', [VersionController::class, 'update']);
    Route::get('/edit/{id}', [VersionController::class, 'edit']);

    Route::delete('/delete/{id}', [VersionController::class, 'destroy']);
});

Route::group(['prefix' => 'cardstate', 'middleware' => 'admin'], function () {
    Route::get('/', [CardStateController::class, 'index']);
    Route::get('/create', [CardStateController::class, 'create']);
    Route::post('/create', [CardStateController::class, 'store']);
//    Route::get('/search', [CardStateController::class, 'search']);
    Route::put('/update/{id}', [CardStateController::class, 'update']);
    Route::get('/edit/{id}', [CardStateController::class, 'edit']);

    Route::delete('/delete/{id}', [CardStateController::class, 'destroy']);
});

Route::group(['prefix' => 'language', 'middleware' => 'admin'], function () {
    Route::get('/', [LaguagesController::class, 'index']);
    Route::get('/create', [LaguagesController::class, 'create']);
    Route::post('/create', [LaguagesController::class, 'store']);
//    Route::get('/search', [LaguagesController::class, 'search']);
    Route::put('/update/{id}', [LaguagesController::class, 'update']);
    Route::get('/edit/{id}', [LaguagesController::class, 'edit']);

    Route::delete('/delete/{id}', [LaguagesController::class, 'destroy']);
});

Route::group(['prefix' => 'card', 'middleware' => 'admin'], function () {
    Route::get('/', [CardController::class, 'index']);
    Route::get('/create', [CardController::class, 'create']);
    Route::post('/create', [CardController::class, 'store']);
    Route::get('/edit/{id}', [CardController::class, 'edit']);
    Route::put('/update/{id}', [CardController::class, 'update']);
    Route::delete('/delete/{id}', [CardController::class, 'destroy']);
    Route::get('/store/getCards', [ CardController::class, 'getCards' ]);
});

Route::get('/card/search', [CardController::class, 'searchHome']);
Route::get('/card/{name}', [CardController::class, 'show']);

Route::group(['prefix' => 'cart', 'middleware' => 'client'], function () {
    Route::get('/', [CartController::class, 'show']);
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

Route::group(['prefix' => 'profile', 'middleware' => 'client'], function () {
    Route::get('/', [ProfileController::class, 'index']);
    Route::get('/create', [ProfileController::class, 'create']);
    Route::post('/create', [ProfileController::class, 'store']);

    Route::get('/address', [AddressController::class, 'index']);
    Route::get('/bank', [BankController::class, 'index']);

//    Route::get('/search', [ProfileController::class, 'search']);
    Route::put('/update', [ProfileController::class, 'update']);
    Route::delete('/delete/{id}', [ProfileController::class, 'destroy']);
});+

Route::group(['prefix' => 'address', 'middleware' => 'client'], function () {
    Route::post('/create', [AddressController::class, 'store']);

    Route::put('/update/{id}', [AddressController::class, 'update']);
    Route::delete('/delete/{id}', [AddressController::class, 'destroy']);
});

Route::group(['prefix' => 'bank', 'middleware' => 'client'], function () {
    Route::post('/create', [BankController::class, 'store']);

    Route::put('/update/{id}', [BankController::class, 'update']);
    Route::delete('/delete/{id}', [BankController::class, 'destroy']);
});


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
