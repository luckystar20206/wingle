<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/products', function (){
    return view('products');
});

Route::get('/products/{id}', function (){
    return view('productDetail');
});

Route::get('/cart', function (){
    return view('cart');
});

Route::get('/contact', function (){
    return view('contact');
});

Route::get('/register', [UserController::class, 'create']);
Route::post('/create-account', [UserController::class, 'store']);

Route::get('/login', function (){
    return view('login');
});
