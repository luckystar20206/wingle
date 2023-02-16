<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
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

Auth::routes(['verify' => true]);

Route::get('/', [ProductController::class, 'index']);
Route::get('/search-pincode', [AreaController::class, 'searchArea']);
Route::get('/change-area', [AreaController::class, 'searchArea']);

Route::get('/products', [ProductController::class, 'showProducts'])->middleware(['checkusersession']);

Route::get('/products/{id}', [ProductController::class, 'productDetail']);
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/account', [AccountController::class, 'index'])->middleware('auth');
Route::post('/account/save-changes', [AccountController::class, 'saveChanges'])->middleware('auth');
Route::get('/account/request-admin-access', [AccountController::class, 'requestAdminAccess'])->middleware(['auth', 'verified']);
Route::post('/account/upload/profile_photo', [AccountController::class, 'uploadProfilePhoto']);
Route::get('/add-area', [AreaController::class, 'create']);
Route::post('/add-area-req', [AreaController::class, 'store']);

Route::get("/add-product", [ProductController::class, "createproduct"])->middleware("auth");
Route::post("/add-product-post", [ProductController::class, "store"]);

Route::get('/account/list_admin_requests', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'admin']);
Route::get('/account/list_admin_request/decision', [AdminController::class, 'decideRequest'])->middleware(['auth', 'verified', 'admin']);

Auth::routes();

//Route::get('/register', [UserController::class, 'create'])->middleware('guest');
//Route::post('/create-account', [UserController::class, 'store'])->middleware('guest');
//Route::get('/login', [SessionController::class, 'create'])->middleware('guest');
//Route::post('login', [SessionController::class, 'store']);
//Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');
