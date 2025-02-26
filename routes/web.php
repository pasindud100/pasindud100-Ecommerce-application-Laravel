<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ProductManager;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductManager::class,"index"])
->name("home");

Route::get('/home', [ProductManager::class,"index"])
->name("home");


Route::get("logout",[AuthManager::class, "logout"])
    ->name("logout");

Route::get("login",[AuthManager::class, "login"])
    ->name("login");

Route::post("login",[AuthManager::class, "loginPost"])
    ->name("login.post");

Route::get("register",[AuthManager::class, "register"])
    ->name("register");

Route::post("register",[AuthManager::class, "registerPost"])
    ->name("register.post");

Route::get("/product/{slug}",[ProductManager::class,"details"])
    ->name("product.details");

    //add middleware..the cart functionality work only for logged users. in not logged user he redirect to login page when click add to cart btn
Route::middleware("auth")->group(function(){
    Route::get("/cart/{id}",[ProductManager::class,"addToCart"])
    ->name("cart.add");
});