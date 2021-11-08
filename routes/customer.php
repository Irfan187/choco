<?php
use App\Http\Controllers\Catalog\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Catalog\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;


Route::prefix('customer')->middleware(['auth','role:Customer'])->group(function () {

Route::get('suppliers',[CustomerController::class,'getSupplier']);


Route::get('/supplierdetails/{id}', function ($id) {

    $supplier = User::role('Supplier')->find($id);
    $categories=Category::where('isActive',1)->get();
    
    return view('customer.supplier_detail',compact('supplier','categories'));
})->name('supplierdetails');

Route::get('/cart_page', function () {

    $suppliers = User::role('Supplier')->get();

    return view('customer.cart_page',compact('suppliers'));
})->name('cart_page');


Route::get('/myorders', function () {

        $orders = Order::where('customer_id',auth()->user()->id)->get();

    return view('customer.myorder',compact('orders'));


});

// Route::get('product/category', [ProductController::class, 'productsByCategory'])->name('customer.product.category');

Route::get('session_add_to_cart', [CartController::class, 'addToCart'])->name('session_add_to_cart');
Route::get('add_to_cart', [CartController::class, 'addToCartt'])->name('add_to_cart');

Route::post('confirm_order', [CartController::class, 'confirmOrder'])->name('confirm_order');

Route::get('remove/{id}', [CartController::class, 'removeItem'])->name('remove_item');



});

/*
Route::get('add_to_cart', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::get('confirm_order', [CartController::class, 'confirmOrder'])->name('confirm_order');

Route::get('/supplerdetails/{id}', function ($id) {

    $supplier = Supplier::find($id);
    $products = Product::where('supplier_id',$supplier->id)->get();
    $categories = [];
    foreach($products as $product){
        $cat = Category::find($product->category_id);
        array_push($categories,$cat);
    }

    return view('customer.dashboard',compact('products','supplier','categories'));
})->middleware(['auth'])->name('supplerdetails');



Route::get('/cart_page', function () {

    $carts = Cart::all();


    return view('customer.cart_page',compact('carts'));
})->middleware(['auth'])->name('cart_page');


Route::get('/myorders', function () {

        $orders = Order::where('customer_id',auth()->user()->id)->get();


    return view('customer.myorder',compact('orders'));
})->middleware(['auth']);


*/
