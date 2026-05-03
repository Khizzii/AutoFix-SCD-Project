<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Models\Product;

use App\Models\Service;

// --- Public Pages ---

Route::get('/', function () {
    $products = Product::take(3)->get();
    $services = Service::take(3)->get();
    return view('home', compact('products', 'services'));
})->name('home');

// Seed Categories Helper (Dev Utility)
Route::get('/seed-categories', function() {
    $products = Product::all();
    foreach($products as $product) {
        $category = 'Components'; // Default
        if (stripos($product->name, 'tire') !== false || stripos($product->name, 'wheel') !== false) {
            $category = 'Wheels & Tires';
        } elseif (stripos($product->name, 'chain') !== false || stripos($product->name, 'derailleur') !== false || stripos($product->name, 'brake') !== false) {
            $category = 'Drivetrain';
        } elseif (stripos($product->name, 'saddle') !== false || stripos($product->name, 'seat') !== false) {
            $category = 'Seating';
        } elseif (stripos($product->name, 'handlebar') !== false) {
            $category = 'Steering';
        }
        $product->category = $category;
        $product->save();
    }
    return "Categories Seeded!";
});

// Service Pages
Route::get('/services', [App\Http\Controllers\ServiceController::class, 'frontend'])->name('services');

Route::get('/contact', function () {
    return view('contact');
});

// --- Cart & Checkout Flow ---
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/book', function () {
    $service = request('service');
    $id = request('id');
    return view('book', compact('service', 'id'));
})->name('book');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.submit');

Route::get('/thankyou', function () {
    return view('thankyou');
})->name('thankyou');

// --- Product Catalog & Search ---
Route::get('/parts', [ProductController::class, 'frontend']);
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/search-test', function() { return view('search_test'); });
Route::get('/product/{id}', [ProductController::class, 'showDetail'])->name('product.detail');

// --- Admin Protected Routes ---
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('admin/services', App\Http\Controllers\ServiceController::class)->names('admin.services');
});

// --- Dashboard ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

// --- Profile Management ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User Orders
    Route::get('/my-orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});


require __DIR__.'/auth.php';

