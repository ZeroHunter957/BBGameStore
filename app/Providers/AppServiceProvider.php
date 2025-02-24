<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $cartCount = 0;
    
            if (session('accountLogin')) {
                $cartCount = Cart::where('user_id', session('accountLogin'))->count();
            }
    
            $view->with('cartCount', $cartCount);
        });
    }
}
