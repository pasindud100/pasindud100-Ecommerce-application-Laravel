@extends('layouts.default')
@section('title', 'Ecom - Product Details')
@section('content')
    <main class="container" style="max-width: 900px;">
        <section class="py-5">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ $product->image }}" class="img-fluid rounded shadow-sm" alt="{{ $product->title }}">
                </div>
                <div class="col-md-6">
                    <h1 class="fw-bold text-dark">{{ $product->title }}</h1>
                    <p class="fs-4 text-success">LKR {{ $product->price }}</p>
                    <p class="text-muted">{{ $product->description }}</p>

                    @if (session()->has('success'))
                        <div class="alert alert-success mt-3">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif

                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success btn-lg mt-4 w-100">
                        Add to Cart
                    </a>
                </div>
            </div>
        </section>
    </main>
    @include('includes.footerForOthe')
@endsection
