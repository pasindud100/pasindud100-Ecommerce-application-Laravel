<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

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
                "products.title",
            )->
            where("cart.user_id", auth()->user()->id)
            ->groupBy("cart.product_id", "products.price", "products.title")
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('cart.show')->with('error', 'Cart is empty.');
        }

        $productIds = [];
        $quantities = [];
        $totalPrice = 0;
        $lineItems = [];

        foreach ($cartItems as $cartItem) {
            $productIds[] = $cartItem->product_id;
            $quantities[] = $cartItem->quantity;
            $totalPrice += $cartItem->price * $cartItem->quantity;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'LKR',
                    'product_data' => [
                        'name' => $cartItem->title,
                    ],
                    'unit_amount' => $cartItem->price * 100,
                ],
                'quantity' => $cartItem->quantity,
            ];
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
            $stripe = new StripeClient(config("app.STRIPE_KEY"));

            $checkoutSession = $stripe->checkout->sessions->create([
                'success_url' => route('payment.success', ['order_id' => $order->id]),
                'cancel_url' => route('payment.error'),
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'customer_email' => auth()->user()->email,
                'metadata' => [
                    'order_id' => $order->id,
                ],
            ]);

            return redirect($checkoutSession->url);
        }
        return redirect(route('cart.show'))->with('error', 'Error Occured.');
    }
    function paymentError()
    {
        return "error";
    }

    function paymentSuccess($order_id)
    {
        return "success " . $order_id;
    }

    function orderHistory()
    {
        $orders = Orders::where("user_id", auth()->user()->id)->orderBy('id', 'DESC')->paginate(3);

        $orders->getCollection()->transform(function($order){
            $productIds = json_decode($order->product_id, true);
            $quantities = json_decode($order->quantity, true);

            $products = Products::whereIn('id', $productIds)->get();

            $order->product_details = $products->map(function ($product) use ($quantities, $productIds) {
                $index = array_search($product->id, $productIds);
                return [
                    'name' => $product->title,
                    'quantity' => $quantities[$index] ?? 0,
                    'price' => $product->price,
                    'slug' => $product->slug,
                    'image' => $product->image,
                ];
            });
            return $order;
        });

        return view('history', compact('orders'));
    }
}
