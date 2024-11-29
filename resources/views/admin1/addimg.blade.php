<!-- resources/views/products/upload-images.blade.php -->
@extends('layout.form')

@section('content')
    <h1>Upload Images for Product</h1>
<!-- Display success or error messages -->
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('products.addImages', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="images[]" multiple>
    <button type="submit" class="btn btn-primary btn-sm">Upload Images</button>
</form>

@endsection
