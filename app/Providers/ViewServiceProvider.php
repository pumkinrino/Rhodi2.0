<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\users\CartController;
use App\Models\users\Category;
use App\Models\users\Cart;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Chia sẻ biến categories cho tất cả các view
        View::share('categories', Category::all());

        // View Composer riêng cho cartpopup
        View::composer('components.users.cartpopup', function ($view) {
            $customer = session('customer');
            $count = $customer ? Cart::where('customer_id', $customer->customer_id)->count() : "0";
            $cartController = app(CartController::class);
            $cartlist = $cartController->getCart();
            $view->with('count', $count)
                ->with('cartlist', $cartlist);
        });
    }

    public function register()
    {
        //
    }
}
