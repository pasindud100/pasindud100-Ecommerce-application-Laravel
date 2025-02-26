<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductManager extends Controller
{
    function index(){
        $products =Products::all();
        return view('products', compact('products'));

    }
}
