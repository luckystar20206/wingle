<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
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
Auth::routes();
Auth::routes(['verify' => true]);

//Routes for searching area and setting pincode
Route::get('/', [ProductController::class, 'index']);
Route::get('/search-pincode', [AreaController::class, 'searchArea']);
Route::get('/change-area', [AreaController::class, 'searchArea']);

// Routes regarding products, product detail, add to cart and update cart
Route::get('/products', [ProductController::class, 'showProducts'])->middleware(['checkusersession']);
Route::get('/products/product_name={name}&id={id}', [ProductController::class, 'productDetail']);
Route::post('/add-to-cart', [ProductController::class, 'addToCart'])->middleware('auth');
Route::get('/cart', [ProductController::class, 'viewCart']);
Route::post('/update-rent-period-in-cart', [ProductController::class, 'updateRentPeriod']);
Route::post('/update-item-quantity-in-cart', [ProductController::class, 'itemQuantity']);

//Route for filtering the product catalogue
Route::get('/products/filter={filter}', [ProductController::class, 'filter']);

//Route for contact view
Route::get('/contact', function () {
    return view('contact');
});

//Routes for account and it's integrated functions
Route::get('/account', [AccountController::class, 'index'])->middleware('auth');
Route::post('/account/save-changes', [AccountController::class, 'saveChanges'])->middleware('auth');
Route::get('/account/request-admin-access', [AccountController::class, 'requestAdminAccess'])->middleware(['auth', 'verified']);
Route::get('/account/users', [AccountController::class, 'users'])->middleware(['auth', 'verified']);
Route::post('/account/upload/profile_photo', [AccountController::class, 'uploadProfilePhoto']);

//Routes for adding area
Route::get('/add-area', [AreaController::class, 'create']);
Route::post('/add-area-req', [AreaController::class, 'store']);

//Routes for adding product
Route::get("/add-product", [ProductController::class, "createproduct"])->middleware("auth");
Route::post("/add-product-post", [ProductController::class, "store"]);

//add item to inventory
Route::get('/add-to-inventory', [InventoryController::class, 'viewInventoryForm'])->middleware(['auth', 'admin']);
Route::post('/add-to-inventory', [InventoryController::class, 'storeToInventory']);

//Route for updating product
Route::get('/update-product', [ProductController::class, 'listProducts']);
Route::post('/update-product', [ProductController::class, 'updateProduct']);

//Routes for listing and deciding admin requests + deleting account + display signed users
Route::get('/account/list_admin_requests', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'admin']);
Route::get('/account/list_admin_request/decision', [AdminController::class, 'decideRequest'])->middleware(['auth', 'verified', 'admin']);
Route::get('/account/users', [AdminController::class, 'users'])->middleware(['auth', 'verified', 'admin']);
Route::post('/account/delete_account', [AccountController::class, 'deleteAccount'])->middleware(['auth']);

//Route for checkout
Route::post('/checkout', [CheckoutController::class, 'show']);

//Routes for razorpay
Route::post('/pay', [RazorpayPaymentController::class, 'payment'])->name('payment');
