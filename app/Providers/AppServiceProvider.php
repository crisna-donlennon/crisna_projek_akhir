<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart; // Adjust the namespace based on your actual Cart model


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
    public function boot()
    {
        View::composer('components.header', function ($view) {
            // Fetch the cart item count here
            $cartItemCount = 0;
    
            // Assuming you have a Cart model with a relationship to products
            $user = auth()->user();
            if ($user) {
                $cart = $user->cart;
                if ($cart) {
                    $cartItemCount = $cart->products->count();
                }
            }
    
            $view->with('cartItemCount', $cartItemCount);
        });
    }
}    