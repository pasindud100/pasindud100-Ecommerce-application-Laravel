<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductManager extends Controller
{
    function index(){
        //in here pagination also can be added.
        $products =Products::paginate(0);
        return view('products', compact('products'));
    }

    function details($slug){
        $product = Products::where('slug', $slug )->first();
        return view('details', compact('product'));
    }

    function addToCart($id){
        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->product_id= $id;

        if($cart->save()){
            return redirect()->back()->with('success',"Product added successfully..");
        }
        return redirect()->back()->with('error',"Something went wrong..");

    }
}
