@extends('layout.product1')

@section('content')
<h1 class="product_taital">Chăm Sóc Da Mặt</h1>
<div class="container">
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card mb-4">
               
            <img src="{{ Storage::url($product->image) }}" alt="Product Image" width="50">


                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">${{ $product->price }}</p>
                    <br>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Buy Now</a>
                    @if($product->stock == 0)
                    <div class="alert alert-danger mt-2">Out of Stock</div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
