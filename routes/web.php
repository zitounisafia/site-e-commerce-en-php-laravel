<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

route::get('/',[HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


route::get('/redirect',[HomeController::class,'redirect']);


// Admin==============
route::get('/view_category',[AdminController::class,'view_category']);
route::post('/add_category',[AdminController::class,'add_category']);
route::get('/delete_category/{id}',[AdminController::class,'delete_category']);
route::get('/view_product',[AdminController::class,'view_product']);
route::post('/add_product',[AdminController::class,'add_product']);
route::get('/show_product',[AdminController::class,'show_product']);
route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
route::get('/updat_product/{id}',[AdminController::class,'updat_product']);
route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);
route::get('/order',[AdminController::class,'order']);
route::get('/delete_order/{id}',[AdminController::class,'delete_order']);
route::get('/delivered/{id}',[AdminController::class,'delivered']);
route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);







route::any('/product_details/{id}',[HomeController::class,'product_details']);
route::get('/products',[HomeController::class,'products']);
route::get('/categories',[HomeController::class,'categorys']);
route::get('/categories/{name}',[HomeController::class,'products_category']);
route::any('/add_to_cart/{id}',[HomeController::class,'add_to_cart']);
route::get('/show_cart',[HomeController::class,'show_cart']);
route::get('/cash_order',[HomeController::class,'cash_order']);
route::get('/remove_card/{id}',[HomeController::class,'remove_card']);
route::get('/stripe/{totalprice}',[HomeController::class,'stripe']);
route::get('/contact',[HomeController::class,'contact']);
Route::post('stripe/{totalprice}',[HomeController::class, 'stripePost'])->name('stripe.post');

