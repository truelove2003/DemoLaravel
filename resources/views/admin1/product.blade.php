@extends('layout.table')

@section('title', 'Categories')
@section('content')
<div class="pagetitle">
    <h1>Product Table</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Products Table</h5>

                    <!-- Products Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Color</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->category->name }}</td> <!-- Assuming 'category' relationship is defined in Product model -->
                                    <td>
                                        <div style="background-color: {{ $product->color }}; width: 20px; height: 20px; border-radius: 50%;"></div>
                                    </td>
                                    <td>
                                        @if($product->image)
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $product->image)) }}" class="card-img-top" alt="{{ $product->name }}">

                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('products.edit', $product->id) }}" method="get" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm"> Edit </button>
                                        </form>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')"class="btn btn-warning btn-sm">Delete</button>
        </form>
        <form action="{{ route('products.showImages', $product->id) }}" method="get" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-primary btn-sm">Add Images</button>
</form> 

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection