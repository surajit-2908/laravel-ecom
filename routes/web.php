<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CartController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Login
Route::get('/',[HomeController::class, 'index']);
Route::get('/redirect',[HomeController::class, 'redirect']);

//Category
Route::post('/category/add',[AdminController::class, 'add']);
Route::get('/category/list',[AdminController::class, 'list']);
Route::get('/category/delete/{id}',[AdminController::class, 'delete'])->name('category.delete');

//Product
Route::get('/product/create',[ProductController::class, 'create'])->name('product.create');
Route::post('/product/add',[ProductController::class, 'add'])->name('product.add');
Route::get('/product/list',[ProductController::class, 'list'])->name('product.list');
Route::get('/product/delete/{id}',[ProductController::class, 'delete'])->name('product.delete');
Route::get('/product/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/edit/{id}',[ProductController::class, 'update'])->name('product.update');

// User Product details
Route::get('/product/details/{id}',[ProductController::class, 'details'])->name('product.details');

//Cart
Route::post('/cart/add/{id}',[CartController::class, 'add'])->name('cart.add');
Route::get('/cart/view',[CartController::class, 'view'])->name('cart.view');
Route::get('/cart/delete/{id}',[CartController::class, 'delete'])->name('cart.delete');

//Order
Route::get('/order/cash',[HomeController::class, 'cash_order'])->name('order.cash');
Route::get('/stripe/{totalprice}',[HomeController::class, 'stripe'])->name('stripe');
Route::post('/stripe',[HomeController::class, 'stripePost'])->name('stripe.post');

//Admin Order
Route::get('/order/list',[AdminController::class, 'orderList'])->name('order.list');
Route::get('/delivered/{id}',[AdminController::class, 'delivered'])->name('delivered');
Route::get('/print_pdf/{id}',[AdminController::class, 'print_pdf'])->name('print_pdf');