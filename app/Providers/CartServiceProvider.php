<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Pass cartCount to every view that uses the navbar
        View::composer('layouts.navbar', function ($view) {
            // Menghitung jumlah item di keranjang pengguna yang sedang login
            $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');
            $view->with('cartCount', $cartCount); // Mengirimkan cartCount ke view
        });
    }
}
