<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AtletheController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\ProductListController;
use App\Http\Controllers\User\ProductDetailController;
use App\Http\Controllers\User\NewsListController;
use App\Http\Controllers\User\NewsDetailController;
use App\Http\Controllers\User\AtletheListController;
use App\Http\Controllers\User\AtletheDetailController;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//user


Route::get('/', [UserController::class,'index'])->name('home');
Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


     //chekcout
     Route::prefix('checkout')->controller(CheckoutController::class)->group((function()  {
        Route::post('order','store')->name('checkout.store');
        Route::get('success','success')->name('checkout.success');
        Route::get('cancel','cancel')->name('checkout.cancel');
    }));
});


//admin

Route::group(['prefix' => 'admin', 'middleware' => 'redirectAdmin'], function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});


    //products routes
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/products/store',[ProductController::class,'store'])->name('admin.products.store');
    Route::put('/products/update/{id}',[ProductController::class,'update'])->name('admin.products.update');
    Route::delete('/products/image/{id}',[ProductController::class,'deleteImage'])->name('admin.products.image.delete');
    Route::delete('/products/destory/{id}',[ProductController::class,'destory'])->name('admin.products.destory');


    //news routes
    Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');
    Route::post('/news/store',[NewsController::class,'store'])->name('admin.news.store');
    Route::put('/news/update/{id}',[NewsController::class,'update'])->name('admin.news.update');
    Route::delete('/news/image/{id}',[NewsController::class,'deleteImage'])->name('admin.news.image.delete');
    Route::delete('/news/destory/{id}',[NewsController::class,'destory'])->name('admin.news.destory');



       //atlethes routes
       Route::get('/atlethes', [AtletheController::class, 'index'])->name('admin.atlethes.index');
       Route::post('/atlethes/store',[AtletheController::class,'store'])->name('admin.atlethes.store');
       Route::put('/atlethes/update/{id}',[AtletheController::class,'update'])->name('admin.atlethes.update');
       Route::delete('/atlethes/image/{id}',[AtletheController::class,'deleteImage'])->name('admin.atlethes.image.delete');
       Route::delete('/atlethes/destory/{id}',[AtletheController::class,'destory'])->name('admin.atlethes.destory');
   
} );

Route::prefix('checkout')->controller(CheckoutController::class)->group((function()  {
    Route::post('order','store')->name('checkout.store');
    Route::get('success','success')->name('checkout.success');
    Route::get('cancel','cancel')->name('checkout.cancel');
}));
  //add to cart

Route::prefix('cart')->controller(CartController::class)->group(function () {
    Route::get('view','view')->name('cart.view');
    Route::post('store/{product}','store')->name('cart.store');
    Route::patch('update/{product}','update')->name('cart.update');
    Route::delete('delete/{product}','delete')->name('cart.delete');
});



//routes for news list and filter
Route::prefix('news')->controller(NewsListController::class)->group(function ()  {
    Route::get('/','index')->name('news.index');
});


//routes for products list and filter
Route::prefix('products')->controller(ProductListController::class)->group(function ()  {
    Route::get('/','index')->name('products.index');
    
});


//routes for atlethe list and filter
Route::prefix('atlethes')->controller(AtletheListController::class)->group(function ()  {
    Route::get('/','index')->name('atlethes.index');
    
});
Route::get('/products/{product}', [ProductDetailController::class, 'show'])->name('products.show');
Route::get('/news/{news}', [NewsDetailController::class, 'show'])->name('news.show');
Route::get('/atlethes/{atlethe}', [AtletheDetailController::class, 'show'])->name('atlethes.show');


//legal

Route::get('/Legal', function () {
    return Inertia::render('User/Legal'); 
})->name('legal');

require __DIR__.'/auth.php';
