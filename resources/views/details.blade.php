@extends('layouts.default')
@section("title","Ecom - Home")
@section("content")
    <main class="container" style="max-width:900px">
        <section>
            <img src="{{$product->image}}" width="80%" alt="">
            <h1>{{$product->title}}</h1>
            <p>LKR {{$product->price}}</p>
            <p>{{$product->description}}</p>
            <a href="{{route("cart.add", $product->id)}}" class="btn btn-success"> Add to cart</a>
        </section>

    </main>
@endsection
