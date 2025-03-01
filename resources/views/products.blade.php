@extends('layouts.default')
@section('title', 'Ecom - Home')
@section('content')
    <main class="container" style="max-width: 1200px;">
        <section>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card shadow-sm border-0 rounded-3">
                            <img src="{{ $product->image }}" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title text-dark fw-bold">
                                    <a href="{{ route('products.details', $product->slug) }}"
                                        class="text-decoration-none text-dark">
                                        {{ $product->title }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted">LKR {{ $product->price }}</p>
                                <a href="{{ route('products.details', $product->slug) }}" class="btn btn-primary w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </section>
    </main>
@endsection
