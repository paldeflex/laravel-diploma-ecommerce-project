<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/categories', CategoriesPage::class)->name('categories');
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/products/{product}', ProductDetailPage::class)->name('product_one');
Route::get('/checkout', CheckoutPage::class)->name('checkout');
Route::get('/my-orders', MyOrdersPage::class)->name('my_orders');
Route::get('/my-orders/{order}', MyOrderDetailPage::class)->name('my_order');

Route::get('/login', LoginPage::class)->name('login');
Route::get('/register', RegisterPage::class)->name('register');
Route::get('/forgot', ForgotPassword::class)->name('forgot');
Route::get('/reset', ResetPasswordPage::class)->name('reset');

Route::get('/success', SuccessPage::class)->name('success');
Route::get('/cancel', CancelPage::class)->name('cancel');
