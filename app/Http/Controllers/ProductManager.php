<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductManager extends Controller
{
    function index()
    {
        //in here pagination also can be added.
        $products = Products::paginate(0);
        return view('products', compact('products'));
    }

    function details($slug)
    {
        $product = Products::where('slug', $slug)->first();
        return view('details', compact('product'));
    }

    function addToCart($id)
    {
        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $id;

        if ($cart->save()) {
            return redirect()->back()->with('success', "Product added successfully..");
        }
        return redirect()->back()->with('error', "Something went wrong..");

    }

    //to get product count wen user order more than one items from selected card
    //join query
    function showCart()
    {
        $cartItems = DB::table("cart")
            ->join("products", "cart.product_id", '=', 'products.id')
            ->select(
                "cart.product_id",
                DB::raw("count(*) as quantity"),
                'products.title',
                'products.price',
                'products.image',
                'products.slug'
            )->
            where("cart.user_id", auth()->user()->id)
            ->groupBy("cart.product_id", "products.title", "products.price", 'products.image', 'products.slug')
            ->paginate(perPage: 5);//if cart items in cart more than 5 then apply plagination as $cartItems->links()

        return view('cart', compact('cartItems'));
    }
}
