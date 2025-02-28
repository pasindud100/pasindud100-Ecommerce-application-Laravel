<?php

namespace App\Http\Controllers;

use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderManager extends Controller
{
    function showCheckout()
    {
        return view('checkout');
    }

    function checkoutPost(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'pincode' => 'required',
            'phone' => 'required',
        ]);
        //to get produt id and total price
        $cartItems = DB::table("cart")
            ->join("products", "cart.product_id", '=', 'products.id')
            ->select(
                "cart.product_id",
                DB::raw("count(*) as quantity"),
                'products.price',
            )->
            where("cart.user_id", auth()->user()->id)
            ->groupBy("cart.product_id", "products.price")
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('cart.show')->with('error', 'Cart is empty.');
        }

        $productIds = [];
        $quantities = [];
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $productIds[] = $cartItem->product_id;
            $quantities[] = $cartItem->quantity;
            $totalPrice += $cartItem->price * $cartItem->quantity;
        }

        $order = new orders();
        $order->user_id = auth()->user()->id;
        $order->address = $request->address;
        $order->pincode = $request->pincode;
        $order->phone = $request->phone;
        $order->product_id = json_encode($productIds);
        $order->total_price = $totalPrice;
        $order->quantity = json_encode($quantities);

        if ($order->save()) {
            //after save data delete from cart table of related user
            DB::table("cart")->where("user_id", auth()->user()->id)->delete();
            return redirect(route('cart.show'))->with('success', 'Order place successfully.');
        }
        return redirect(route('cart.show'))->with('error', 'Error Occured.');

    }
}
