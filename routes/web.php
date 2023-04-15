<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RazorpayPaymentController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/search-pincode', [AreaController::class, 'searchArea'])->name('search-pincode');
Route::get('/change-area', [AreaController::class, 'searchArea']);

// Routes regarding products, product detail, add to cart and update cart
Route::get('/products', [ProductController::class, 'showProducts'])->middleware(['checkusersession']);
Route::get('/products/product_name={name}&id={id}', [ProductController::class, 'productDetail']);
Route::post('/add-to-cart', [ProductController::class, 'addToCart'])->middleware('auth');
Route::get('/cart', [ProductController::class, 'viewCart'])->middleware(['auth']);
Route::post('/update-rent-period-in-cart', [ProductController::class, 'updateRentPeriod']);
Route::post('/update-item-quantity-in-cart', [ProductController::class, 'itemQuantity']);
Route::post('/remove-item-from-cart', [ProductController::class, 'removeItemFromCart']);

//Route for filtering the product catalogue
Route::get('/products/price-filter', [ProductController::class, 'priceFilter']);

//Route for contact view
Route::get('/contact', function () {
    return view('contact');
});

Route::post('/send-mail', [HomeController::class, 'contactEmail']);

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
// Route::get('/account/list_admin_requests', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'admin']);
// Route::get('/account/list_admin_request/decision', [AdminController::class, 'decideRequest'])->middleware(['auth', 'verified', 'admin']);
Route::get('/account/users', [AdminController::class, 'users'])->middleware(['auth', 'verified', 'admin']);
Route::post('/account/delete_account', [AccountController::class, 'deleteAccount'])->middleware(['auth']);

//Route for checkout
Route::post('/checkout', [CheckoutController::class, 'show']);

//Routes for razorpay
Route::post('/pay', [RazorpayPaymentController::class, 'makeOrder'])->name('make-order')->middleware(['auth', 'checkusersession', 'verified']);
Route::get('/success', [RazorpayPaymentController::class, 'success'])->name('success')->middleware(['auth', 'checkusersession', 'verified']);

//Route for viewing orders
Route::get('/account/orders', [HomeController::class, "viewOrders"])->name("view-orders")->middleware(['auth']);

//Route for promoting or demoting admin
Route::post('/account/promote_admin', [AdminController::class, 'promoteAdmin'])->middleware(['auth', 'verified', 'admin']);
Route::post('/account/deleteuseraccount', [AdminController::class, 'deleteuseraccount'])->middleware(['auth', 'verified', 'admin']);

//Route::get('/update-product', [ProductController::class, 'listProducts'])->middleware(['auth', 'verified', 'admin']);
Route::get('/remove-product', [ProductController::class, 'listRmProducts'])->middleware(['auth', 'verified', 'admin']);
Route::post('/remove-product', [ProductController::class, 'removeProduct'])->middleware(['auth', 'verified', 'admin']); 