<?php

use App\Http\Controllers\Catalog\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Catalog\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;


Route::prefix('customer')->middleware(['auth', 'role:Customer'])->group(function () {

    Route::get('suppliers', [CustomerController::class, 'getSupplier']);
    Route::post('order/modified', [OrderController::class, 'orderModify']);

    Route::get('/supplierdetails/{id}', function ($id) {

        $supplier = User::IsActive()->role('Supplier')->find($id);
        $categories = Category::IsActive()->where('isActive', 1)->get();

        return view('customer.supplier_detail', compact('supplier', 'categories'));
    })->name('supplierdetails');

    Route::get('/cart_page', function () {

        $suppliers = User::role('Supplier')->get();

        return view('customer.cart_page', compact('suppliers'));
    })->name('cart_page');


    Route::get('/myorders', function () {

        $orders = Order::where('customer_id', auth()->user()->id)->get();

        return view('customer.myorder', compact('orders'));
    });

    // Route::get('product/category', [ProductController::class, 'productsByCategory'])->name('customer.product.category');

    Route::get('session_add_to_cart', [CartController::class, 'addToCart'])->name('session_add_to_cart');
    Route::get('add_to_cart', [CartController::class, 'addToCartt'])->name('add_to_cart');

    Route::post('confirm_order', [CartController::class, 'confirmOrder'])->name('confirm_order');

    Route::get('remove/{id}', [CartController::class, 'removeItem'])->name('remove_item');
    Route::get('remove/order/{id}/{prod}', [OrderController::class, 'removeItemOrder'])->name('remove_item_order');
});
