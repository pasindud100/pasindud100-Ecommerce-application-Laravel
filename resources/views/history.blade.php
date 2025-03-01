@extends('layouts.default')
@section('title', 'Ecom - Orders')
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

            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-12 mb-4">
                        <div class="card shadow-lg border-light rounded-lg">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title">Order ID: {{ $order->id }}</h5>
                                <p class="mb-0">Payment ID: <strong>{{ $order->payment_id }}</strong></p>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $order->product_details[0]['image'] }}" class="img-fluid rounded-start"
                                        alt="Product Image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Total Price: LKR {{ $order->total_price }}
                                        </h6>
                                        <p><strong>Products:</strong></p>
                                        <ul class="list-unstyled">
                                            @foreach ($order->product_details as $product)
                                                <li class="d-flex justify-content-between align-items-center mb-2">
                                                    <a href="{{ route('products.details', $product['slug']) }}"
                                                        class="text-primary text-decoration-none">
                                                        {{ $product['name'] }}
                                                    </a>
                                                    <span class="badge bg-secondary">Qty: {{ $product['quantity'] }}</span>
                                                    <span class="text-success">LKR {{ $product['price'] }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <a href="{{ route('order.history', $order->id) }}"
                                            class="btn btn-info btn-sm mt-3">View Order Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- add pagination links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        </section>
    </main>
    @include('includes.footerForOthe')
@endsection
