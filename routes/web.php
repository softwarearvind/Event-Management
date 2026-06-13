<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Manager\EventCotroller;
use App\Http\Controllers\Admin\EventApprovalController;
use App\Http\Controllers\FrountController;
use App\Http\Controllers\Manager\ProductController;
use App\Http\Controllers\CartController;



// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[FrountController::class,'index']);

Route::get('/event/{id}', [FrountController::class, 'show'])->name('event.details');
Route::get('/events/{id}/ticket', [FrountController::class, 'ticket'])->name('event.ticket');
Route::post('/eventes/{id}/register', [FrountController::class, 'register'])->name('event.register');
Route::get('product/{slug}',[FrountController::class,'details'])->name('product.details');



Route::middleware('auth')->group(function () {

    Route::get('/cart',[CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}',[CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/checkout',[CartController::class,'checkout'])->name('checkout');
    Route::post('/payment',[CartController::class,'payment'])->name('payment');

});





Route::middleware(['auth','role:Admin'])->group(function () {

    Route::get('/admin', [AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/roles',[AdminController::class,'role'])->name('roles.index');
    Route::post('/roles/permission/assign',[AdminController::class,'assignPermission'])->name('roles.permission.assign');
    Route::post('/roles/store',[AdminController::class,'store'])->name('roles.store');
    Route::resource('users', UserController::class);

    //approved Route

    Route::get('/events', [EventApprovalController::class, 'index'])->name('admin.events');
    Route::post('/events/{id}/approve', [EventApprovalController::class, 'approve'])->name('admin.events.approve'); 
    Route::post('/events/{id}/reject', [EventApprovalController::class, 'reject'])->name('admin.events.reject');

    //product approved

    Route::get('/product/approved',[AdminController::class,'approved'])->name('product.approved');
    Route::post('/admin/product/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/product/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');


});

 Route::middleware(['auth','role:Manager'])->group(function () {
 Route::get('/manager', [ManagerController::class,'index'])->name('manager.index');
 Route::get('/event',[EventCotroller::class,'index'])->name('event.index');
 Route::get('/create',[EventCotroller::class,'create'])->name('events.create');
 Route::post('/addevent',[EventCotroller::class,'store'])->name('events.store');
 Route::get('/edit/{id}',[EventCotroller::class,'edit'])->name('event.edit');
 Route::put('/update/{id}',[EventCotroller::class,'update'])->name('events.update');
 Route::delete('/events/{id}', [EventCotroller::class, 'destroy'])->name('events.destroy');

 // product route

 Route::get('/product',[ProductController::class,'index'])->name('product.index');
 Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
 Route::post('/product/store',[ProductController::class,'store'])->name('product.store');

});



require __DIR__.'/auth.php';
