<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Foods\FoodsController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Admin\AdminsController;


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

/* Route::get('/', function () {
    return view('welcome');
});
 */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');



Route::group(['prefix'=> 'foods'], function () {
    Route::get('/food-details/{id}', [FoodsController::class, 'foodDetails'])->name('food.details');
    //cart
    Route::post('/add-to-cart/{id}', [FoodsController::class, 'cart'])->name('food.cart');
    Route::get('/cart', [FoodsController::class, 'displayCartItems'])->name('food.display.cart');
    Route::get('/delete-cart/{id}', [FoodsController::class, 'deleteCartItems'])->name('food.delete.cart');



//checkout
    Route::post('/prepare-checkout', [FoodsController::class, 'preparecheckout'])->name('prepare.checkout');

//insert user info for checkout
    Route::get('/checkout', [FoodsController::class, 'checkout'])->name('foods.checkout');
    Route::post('/checkout', [FoodsController::class, 'storeCheckout'])->name('foods.checkout.store');


//pay with paypal
    Route::get('/pay', [FoodsController::class, 'pay'])->name('foods.pay');
    Route::get('/success', [FoodsController::class, 'success'])->name('foods.success');

//booking tables
    Route::post('/booking', [FoodsController::class, 'bookingTables'])->name('foods.booking.table');


//menu
    Route::get('/menu', [FoodsController::class, 'menu'])->name('foods.menu');

});






Route::group(['prefix'=> 'users'], function () {


//users
        Route::get('/all-bookings', [UsersController::class, 'getBooking'])->name('users.bookings');
        Route::get('/all-orders', [UsersController::class, 'getOrders'])->name('users.orders');


//reviews
        Route::get('/write-review', [UsersController::class, 'viewReview'])->name('users.review.create');
        Route::post('/write-review', [UsersController::class, 'submitReview'])->name('users.review.store');

});





//admin login
Route::get('admin/login', [AdminsController::class, 'viewLogin'])->name('view.login')->middleware('checkforauth');
Route::post('admin/login', [AdminsController::class, 'checkLogin'])->name('check.login');

Route::group(['prefix'=> 'admin','middleware'=>'auth:admin'], function () {

//admin index
    Route::get('/index', [AdminsController::class, 'index'])->name('admins.dashboard');

//admins display
Route::get('/all-admins', [AdminsController::class, 'allAdmins'])->name('admins.all');

//create admin
Route::get('/create-admins', [AdminsController::class, 'createAdmins'])->name('admins.create');
Route::post('/create-admins', [AdminsController::class, 'storeAdmins'])->name('admins.store');

//working with orders
Route::get('/all-orders', [AdminsController::class, 'allOrders'])->name('admins.all.orders');
Route::get('/edit-orders/{id}', [AdminsController::class, 'editOrders'])->name('admins.edit.orders');
Route::post('/edit-orders/{id}', [AdminsController::class, 'updateOrders'])->name('admins.update.orders');
Route::get('/delete-orders/{id}', [AdminsController::class, 'deleteOrders'])->name('admins.delete.orders');


//working with booking
Route::get('/all-booking', [AdminsController::class, 'allBooking'])->name('admins.all.bookings');
Route::get('/edit-booking/{id}', [AdminsController::class, 'editBooking'])->name('admins.edit.booking');
Route::post('/edit-booking/{id}', [AdminsController::class, 'updateBooking'])->name('admins.update.booking');
Route::get('/delete-booking/{id}', [AdminsController::class, 'deleteBooking'])->name('admins.delete.booking');



//working with food
Route::get('/all-food', [AdminsController::class, 'allFood'])->name('admins.all.foods');
Route::get('/create-food', [AdminsController::class, 'createFood'])->name('admins.create.foods');
Route::post('/create-food', [AdminsController::class, 'storeFood'])->name('admins.store.foods');
Route::get('/delete-food/{id}', [AdminsController::class, 'deleteFood'])->name('admins.delete.food');
Route::get('/foods/{id}/edit', [AdminsController::class, 'edit'])->name('foods.edit');
Route::put('/foods/{id}', [AdminsController::class, 'update'])->name('foods.update');

//working with category
Route::get('/all-category', [AdminsController::class, 'allCategory'])->name('admins.all.category');
Route::get('/create-category', [AdminsController::class, 'createCategory'])->name('admins.create.category');
Route::post('/create-category', [AdminsController::class, 'storeCategory'])->name('admins.store.category');
Route::get('/delete-category/{id}', [AdminsController::class, 'deleteCategory'])->name('admins.delete.category');
Route::get('/categories/{id}/edit', [AdminsController::class, 'editCategory'])->name('categories.edit');
Route::put('/categories/{id}', [AdminsController::class, 'updateCategory'])->name('categories.update');


//working with subcategory
Route::get('/all-subcategory', [AdminsController::class, 'allSubcategory'])->name('admins.all.subcategory');
Route::get('/create-subcategory', [AdminsController::class, 'createSubcategory'])->name('admins.create.subcategory');
Route::post('/create-subcategory', [AdminsController::class, 'storeSubcategory'])->name('admins.store.subcategory');
Route::get('/delete-subcategory/{id}', [AdminsController::class, 'deleteSubcategory'])->name('admins.delete.subcategory');
Route::get('/subcategories/{id}/edit', [AdminsController::class, 'editSubcategory'])->name('subcategories.edit');
Route::put('/subcategories/{id}', [AdminsController::class, 'updateSubcategory'])->name('subcategories.update');

//jquery
Route::get('/get-subcategories/{category}', [AdminsController::class, 'getSubcategories']);


});








