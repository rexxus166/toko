<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

// Route login admin
Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

// Dashboard admin
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth:admin');

// Member
Route::get('/admin/member', [DashboardController::class, 'member'])->name('admin.member')->middleware('auth:admin');
Route::get('/admin/member/new', [DashboardController::class, 'newMember'])->name('admin.new-member')->middleware('auth:admin');
Route::get('/admin/member/create', [MemberController::class, 'create'])->name('admin.member.create')->middleware('auth:admin');
Route::post('/admin/member', [MemberController::class, 'store'])->name('admin.member.store')->middleware('auth:admin');

// Supplier
Route::get('/admin/supplier', [SupplierController::class, 'index'])->name('admin.supplier')->middleware('auth:admin');
Route::get('/admin/supplier/new', [SupplierController::class, 'create'])->name('admin.new-supplier')->middleware('auth:admin');
Route::get('/admin/supplier/create', [SupplierController::class, 'create'])->name('admin.supplier.create')->middleware('auth:admin');
Route::get('/admin/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('admin.supplier.edit')->middleware('auth:admin');
Route::put('/admin/supplier/{id}', [SupplierController::class, 'update'])->name('admin.supplier.update')->middleware('auth:admin');
Route::delete('/admin/supplier/{id}', [SupplierController::class, 'destroy'])->name('admin.supplier.destroy')->middleware('auth:admin');
Route::post('/admin/supplier', [SupplierController::class, 'store'])->name('admin.supplier.store')->middleware('auth:admin');

// Produk
Route::get('/admin/produk', [ProductController::class, 'produk'])->name('admin.produk')->middleware('auth:admin');
Route::get('/admin/produk/new', [ProductController::class, 'newProduk'])->name('admin.new-produk')->middleware('auth:admin');
Route::post('/admin/produk', [ProductController::class, 'store'])->name('admin.produk.store')->middleware('auth:admin');
Route::get('/admin/produk/{id}/edit', [ProductController::class, 'edit'])->name('admin.produk.edit')->middleware('auth:admin');
Route::delete('/admin/produk/{id}', [ProductController::class, 'destroy'])->name('admin.produk.destroy')->middleware('auth:admin');
Route::put('/admin/produk/{id}', [ProductController::class, 'update'])->name('admin.produk.update')->middleware('auth:admin');

// Barang Masuk
Route::get('/admin/barang-masuk', [BarangMasukController::class, 'index'])->name('admin.barang-masuk')->middleware('auth:admin');
Route::post('/admin/barang-masuk', [BarangMasukController::class, 'store'])->name('admin.barang-masuk.store')->middleware('auth:admin');

// Barang Keluar
Route::get('/admin/barang-keluar', [BarangKeluarController::class, 'index'])->name('admin.barang-keluar')->middleware('auth:admin');
Route::post('/admin/barang-keluar', [BarangKeluarController::class, 'store'])->name('admin.barang-keluar.store')->middleware('auth:admin');

// Stok Produk
Route::get('/admin/stok', [StokController::class, 'index'])->name('admin.stok')->middleware('auth:admin');

// Transaksi
Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi')->middleware('auth:admin');
Route::get('/admin/transaksi/{transactionId}', [TransaksiController::class, 'show'])->name('admin.transaksi.show')->middleware('auth:admin');


// Logout admin
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');


// Route login user
Route::get('/login', [AuthController::class, 'showUserLoginForm'])->name('user.login');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login.submit');

// Dashboard user
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard')->middleware('auth:web');

// Keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('/checkout', [paymentController::class, 'checkout'])->name('cart.checkout');
Route::post('/payment', [paymentController::class, 'processPayment'])->name('payment');
Route::post('/checkout/callback', [paymentController::class, 'callback']);

// Invoice
Route::get('/dashboard/invoice-{order_id}', [InvoiceController::class, 'show'])->name('invoice.show');

// Route logout user
Route::post('/logout', [AuthController::class, 'userLogout'])->name('user.logout');