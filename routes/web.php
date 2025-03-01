<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\OrderManager;
use App\Http\Controllers\ProductManager;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductManager::class, "index"])
    ->name("home");

Route::get("login", [AuthManager::class, "login"])
    ->name("login");
    
Route::get("logout", [AuthManager::class, "logout"])
->name("logout");

Route::post("login", [AuthManager::class, "loginPost"])
    ->name("login.post");

Route::get("register", [AuthManager::class, "register"])
    ->name("register");

Route::post("register", [AuthManager::class, "registerPost"])
    ->name("register.post");

Route::get("/product/{slug}", [ProductManager::class, "details"])
    ->name("products.details");

//add middleware..the cart functionality work only for logged users. in not logged user he redirect to login page when click add to cart btn
Route::middleware("auth")->group(function () {
    Route::get("/cart/{id}", [ProductManager::class, "addToCart"])
        ->name("cart.add");

    Route::get("/cart", [ProductManager::class, "showCart"])
        ->name("cart.show");

    Route::get("/checkout", [OrderManager::class, "showCheckout"])
        ->name("checkout.show");

    Route::post("/checkout", [OrderManager::class, "checkoutPost"])
        ->name("checkout.post");

    Route::get("/payment/success/{order_id}", [OrderManager::class, "paymentSuccess"])
        ->name("payment.success");

    Route::get("/payment/error", [OrderManager::class, "paymentError"])
        ->name("payment.error");

    Route::get("/order/history", [OrderManager::class, "orderHistory"])
        ->name("order.history");

});

