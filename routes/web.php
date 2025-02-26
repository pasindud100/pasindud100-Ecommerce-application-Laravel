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

