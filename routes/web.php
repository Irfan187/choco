<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Catalog\ProductController;
use App\Http\Controllers\Catalog\AllergenController;
use App\Http\Controllers\Catalog\CategoryController;
use App\Http\Controllers\Catalog\UnitController;
use App\Http\Controllers\Catalog\InventoryController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Catalog\CustomerController;
use App\Http\Controllers\Catalog\BroadcastController;
use App\Http\Controllers\Catalog\BroadcastGroupController;
use App\Http\Controllers\Catalog\ManufacturingPartnerController;
use App\Http\Controllers\Catalog\OrderController;
use App\Http\Controllers\Catalog\SupplierController;
use Spatie\Permission\Models\Role;





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
    return view('auth.login');
});

// Catalog
// Route::middleware(['auth','Supplier'])->group(function () {
    Route::middleware(['auth'])->group(function () {

    Route::get('broadcast/status', [BroadcastController::class, 'broadcast_status']);
    Route::get('category/status/{id}', [CategoryController::class, 'status'])->name('category.status');
    Route::resource('category', CategoryController::class);
    Route::get('product/status/{id}', [ProductController::class, 'status'])->name('product.status');
    Route::resource('product', ProductController::class);
    Route::resource('unit', UnitController::class);
    Route::get('unit/status/{id}', [UnitController::class, 'status'])->name('unit.status');
    Route::get('supplier/status/{id}', [SupplierController::class, 'status'])->name('supplier.status');
    Route::get('manufacturing_partner/status/{id}', [ManufacturingPartnerController::class, 'status'])->name('manufacturing_partner.status');
    Route::get('customer/status/{id}', [CustomerController::class, 'status'])->name('customer.status');


    Route::resource('inventory', InventoryController::class);
    Route::post('profile/{id}', [RegisteredUserController::class, 'update'])->name('profile.update');
    Route::resource('customer', CustomerController::class);
    Route::resource('broadcast', BroadcastController::class);
    Route::get('broadcast/group/add/members', [BroadcastGroupController::class, 'add_members'])->name('addmembers');
    Route::post('broadcast/group/add/members', [BroadcastGroupController::class, 'add_members_store'])->name('addmembers.store');
    Route::resource('broadcast_group', BroadcastGroupController::class);
    Route::get('users', [BroadcastGroupController::class, 'get_users'])->name('getusers');
    Route::post('broadcast/groupId', [BroadcastGroupController::class, 'groupId'])->name('groupId');
    Route::resource('manufacturing_partner', ManufacturingPartnerController::class);
    Route::post('search', [ProductController::class, 'search']);
    Route::post('unit/search', [UnitController::class, 'search']);
    Route::post('supplier/search', [SupplierController::class, 'search']);
    Route::post('inventory/search', [InventoryController::class, 'search']);
    Route::post('customer/search', [CustomerController::class, 'search']);
    Route::post('manufacturer/search', [ManufacturingPartnerController::class,'search']);
    Route::post('broadcast_group/search', [BroadcastGroupController::class, 'search'])->name('search');
    Route::post('broadcast/search', [BroadcastController::class, 'search'])->name('search');
    Route::resource('order', OrderController::class);
    Route::post('confirm_order', [OrderController::class, 'confirm_order'])->name('confirm_order');
    Route::resource('supplier', SupplierController::class);


    //Route::post('search', [ProductController::class, 'search'])->name('search');
    // Route::post('search', [ProductController::class, 'search'])->name('search');

    Route::get('new_order',[OrderController::class,'new_order']);


});
Route::get('credentials',[CustomerController::class,'login']);

// Route::middleware(['auth','role:Customer'])->group(function () {
//     Route::get('/ff', function(){
//         return view('auth.login');
//     });
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
