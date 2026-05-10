<?php

use App\Livewire\HomePage;
use App\Livewire\CategoryPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\Auth\Login;
use App\Http\Controllers\Auth\GoogleController;
use App\Livewire\User\OrderHistory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', \App\Livewire\HomePage::class)->name('home');
Route::get('/brands', \App\Livewire\BrandsPage::class)->name('brands');
Route::get('/collections', \App\Livewire\CollectionsPage::class)->name('collections');
Route::get('/super-category/{slug}', \App\Livewire\SuperCategoryPage::class)->name('super-category');
Route::get('/category/{slug}', CategoryPage::class)->name('category');
Route::get('/product/{id}', ProductDetailPage::class)->name('product.detail');
Route::get('/cart', CartPage::class)->name('cart');

// Legal pages
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');

Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
})->name('terms.conditions');

Route::get('/cookie-policy', function () {
    return view('cookie-policy');
})->name('cookie.policy');



Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/order-history', OrderHistory::class)->name('order.history');
    Route::get('/profile', \App\Livewire\User\UserProfile::class)->name('profile');
    Route::post('/logout', function () {
        auth()->logout();
        return redirect()->route('home');
    })->name('logout');
});
