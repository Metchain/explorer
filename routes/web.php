<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WalletController;

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

Route::get('/',[WalletController::class,'index'])->name('home');
Route::get('/tx/{tx}',[WalletController::class,'Transactions'])->name('tx');

//User logout
Route::get('/logout',[WalletController::class,'signOut'])->name('signOut');

//Web Wallet user login
Route::post('secure-login', [WalletController::class, 'customLogin'])->name('login.custom');

Route::post('secure-register', [WalletController::class, 'customRegistration'])->name('register.custom');




Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
