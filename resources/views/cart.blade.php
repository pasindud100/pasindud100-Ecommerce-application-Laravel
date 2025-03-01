@extends('layouts.default')
@section('title', 'Ecom - Cart')
@section('content')
    <main class="container py-5" style="max-width: 900px;">
        <section>
            @if (session()->has('success'))
                <div class="alert alert-success mt-4">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mt-4">
                    {{ session('error') }}
                </div>
            @endif

            @foreach ($cartItems as $cart)
                <div class="card mb-4 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $cart->image }}" class="img-fluid rounded-start" alt="{{ $cart->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-primary">
                                    <a href="{{ route('products.details', $cart->slug) }}"
                                        class="text-decoration-none">{{ $cart->title }}</a>
                                </h5>
                                <p class="card-text text-muted">Price: <span class="text-success">LKR
                                        {{ $cart->price }}</span></p>
                                <p class="card-text"><strong>Quantity:</strong> {{ $cart->quantity }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-between mt-4">
                <div>
                    {{ $cartItems->links() }}
                </div>
                <div>
                    <a href="{{ route('checkout.show') }}" class="btn btn-success btn-lg px-4">Proceed to Checkout</a>
                </div>
            </div>
        </section>
    </main>
    @include('includes.footerForOthe')
@endsection
