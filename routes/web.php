<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariationController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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


Route::get('/admin', [MainController::class, 'index'])->name('admin.home');

Route::prefix('/admin')->group(function(){
    Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'index'])->name('admin.login');
    Route::post('/login/store', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login.store');
});

// Hien thi admin
Route::prefix('/admin-manage')->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin-create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin-create', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{admin}/edit', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

// Hien thi user
Route::prefix('/user-manage')->group(function(){
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user-create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user-create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}/edit', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});

// Hien thi category
Route::prefix('/category-manage')->group(function(){
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category-create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category-create', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{category}/edit', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

// Hien thi brand
Route::prefix('/brand-manage')->group(function(){
    Route::get('/brand', [BrandController::class, 'index'])->name('brand');
    Route::get('/brand-create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/brand-create', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/{brand}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/brand/{brand}/edit', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/brand/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');
});

//Hien thi product
Route::prefix('/product-manage')->group(function(){
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product-create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product-create', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}/edit', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/view/{product}', [ProductController::class, 'show'])->name('product.show');
    // Product Variation
    Route::get('/variation-create', [ProductVariationController::class, 'create'])->name('variation.create');
    Route::post('/variation-create', [ProductVariationController::class, 'store'])->name('variation.store');
    Route::get('/variation/{variation}/edit', [ProductVariationController::class, 'edit'])->name('variation.edit');
    Route::put('/variation/{variation}/edit', [ProductVariationController::class, 'update'])->name('variation.update');
    Route::delete('/variation/{variation}', [ProductVariationController::class, 'destroy'])->name('variation.destroy');
});

// Hien thi contact
Route::prefix('/contact-manage')->group(function(){
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
});

// Hien thi comment
Route::prefix('/comment-manage')->group(function(){
    Route::get('/comment', [CommentController::class, 'index'])->name('comment');
});

//Hien thi order
Route::prefix('/order-manage')->group(function(){
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::put('/order/{order}/check', [OrderController::class, 'update'])->name('order.update');
    Route::get('/view/{order}', [OrderController::class, 'show'])->name('order.detail');

    Route::get('/revenue/day', [OrderController::class, 'dayRevenue'])->name('revenue.day');
    Route::get('detail-day-revenue/{date}', [OrderController::class, 'dayOrderDetail'])->name('revenue.dayDetail');
    Route::get('/revenue/month', [RevenueController::class, 'monthRevenue'])->name('revenue.month');
    Route::get('/revenue/year', [RevenueController::class, 'yearRevenue'])->name('revenue.year');
    // Route::get('detail-month-revenue/{day}', [OrderController::class, 'monthOrderDetail'])->name('revenue.monthDetail');
});


Route::get('/home', [App\Http\Controllers\User\MainController::class, 'index'])->name('user.home');

Route::prefix('/home')->group(function(){
    Route::get('/login', [\App\Http\Controllers\User\LoginController::class, 'index'])->name('user.login');
    Route::post('/login/store', [\App\Http\Controllers\User\LoginController::class, 'login'])->name('login.store');
    Route::get('/register', [\App\Http\Controllers\User\RegisterController::class, 'index'])->name('user.register');
    Route::post('/register-user', [\App\Http\Controllers\User\RegisterController::class, 'register'])->name('register.store');

    Route::get('/product/{product}', [\App\Http\Controllers\User\ProductController::class, 'show'])->name('home.product');
    Route::get('/shop', [\App\Http\Controllers\User\ShopController::class, 'index'])->name('home.shop');
    Route::get('/category/{id}', [\App\Http\Controllers\User\ShopController::class, 'showByCategory'])->name('home.category');
    Route::get('/brand/{id}', [\App\Http\Controllers\User\ShopController::class, 'showByBrand'])->name('home.brand');
    Route::get('/LowToHight', [\App\Http\Controllers\User\ShopController::class, 'sortByPriceLowToHigh'])->name('price.asc');
    Route::get('/HightToLow', [\App\Http\Controllers\User\ShopController::class, 'sortByPriceHightToLow'])->name('price.desc');
    Route::get('/contact', [\App\Http\Controllers\User\ContactController::class, 'index'])->name('user.contact');
    Route::post('/contact-create', [\App\Http\Controllers\User\ContactController::class, 'create'])->name('contact.create');
    Route::get('/search', [\App\Http\Controllers\User\SearchController::class, 'index'])->name('home.search');

    Route::prefix('/sort')->group(function(){
        Route::get('/Popularity', [\App\Http\Controllers\User\ShopController::class, 'sortPopular'])->name('sort.popular');
        Route::get('/Newest', [\App\Http\Controllers\User\ShopController::class, 'sortNewest'])->name('sort.newest');
    });
});

Route::middleware(['auth'])->group(function (){
    Route::get('/cart', [\App\Http\Controllers\User\CartController::class, 'viewCart'])->name('home.cart');
    Route::post('add-cart', [\App\Http\Controllers\User\CartController::class, 'addProduct']);
    Route::get('/delete-cart-item/{id}', [\App\Http\Controllers\User\CartController::class, 'deleteProduct']);
    Route::post('/update-cart', [\App\Http\Controllers\User\CartController::class, 'updateCart'])->name('update.cart');
    Route::post('/carts', [\App\Http\Controllers\User\CartController::class, 'addCart'])->name('addCart');
    Route::get('/checkout', [\App\Http\Controllers\User\CheckoutController::class, 'index'])->name('home.checkout');
  
    Route::get('/history', [\App\Http\Controllers\User\HistoryController::class, 'index'])->name('home.history');
    Route::get('/detail/{order}', [\App\Http\Controllers\User\HistoryController::class, 'show']);
    Route::put('/history/{order}', [\App\Http\Controllers\User\HistoryController::class, 'update'])->name('history.update');
    Route::get('/review/{id}', [\App\Http\Controllers\User\ReviewController::class, 'show'])->name('product.review');
    Route::post('/add-review', [\App\Http\Controllers\User\ReviewController::class, 'addReview']);
    Route::get('/myaccount', [\App\Http\Controllers\User\LoginController::class, 'myaccount'])->name('home.myaccount');
    Route::get('/change-password/{user}', [\App\Http\Controllers\User\LoginController::class, 'changePassword'])->name('home.changepassword');
    Route::put('/password-store/{user}', [\App\Http\Controllers\User\LoginController::class, 'updatePassword'])->name('password.store');
    Route::get('/account-info/{user}', [\App\Http\Controllers\User\LoginController::class, 'accountInfo'])->name('account');
    Route::put('/account-update/{user}', [\App\Http\Controllers\User\LoginController::class, 'update'])->name('account.update');
});

Route::post('/vnpay_payment', [\App\Http\Controllers\User\PaymentController::class, 'vnpay_payment']);

// Route::controller(PaymentController::class)
//     ->prefix('paypal')
//     ->group(function () {
//         Route::view('payment', 'paypal.index')->name('create.payment');
//         Route::get('handle-payment', 'handlePayment')->name('make.payment');
//         Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
//         Route::get('payment-success', 'paymentSuccess')->name('success.payment');
//     });
Route::prefix('/paypal')->group(function(){
    Route::get('/payment', [\App\Http\Controllers\User\PaypalController::class, 'index'])->name('create.payment');
    Route::get('/handle-payment', [\App\Http\Controllers\User\PaypalController::class, 'handlePayment'])->name('make.payment');
    Route::get('/cancel-payment', [\App\Http\Controllers\User\PaypalController::class, 'paymentCancel'])->name('cancel.payment');
    Route::get('/payment-success', [\App\Http\Controllers\User\PaypalController::class, 'paymentSuccess'])->name('success.payment');
});
