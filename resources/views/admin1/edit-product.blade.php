@extends('layout.edit')

@section('content')
<div class="pagetitle">
    <h1>Edit Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
        <li class="breadcrumb-item">Products</li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12"> <!-- Changed from col-lg-14 to col-lg-12 -->

            <div class="card">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h5 class="card-title">Sửa Sản phẩm</h5>

                    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Tên Sản phẩm:</label>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="form-control">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Mô tả:</label>
                            <div class="col-sm-10">
                                <textarea id="description" name="description" required class="form-control">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="price" class="col-sm-2 col-form-label">Giá:</label>
                            <div class="col-sm-10">
                                <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}" required class="form-control">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="stock" class="col-sm-2 col-form-label">Số lượng:</label>
                            <div class="col-sm-10">
                                <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required class="form-control">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="category_id" class="col-sm-2 col-form-label">Danh mục:</label>
                            <div class="col-sm-10">
                                <select id="category_id" name="category_id" required class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Hình ảnh:</label>
                            <div class="col-sm-10">
                                <input type="file" id="image" name="image" class="form-control">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" width="150">
                                @endif
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="productColor" class="col-sm-2 col-form-label">Màu sắc</label>
                            <div class="col-sm-10">
                                <input type="color" name="color" class="form-control form-control-color" id="productColor" value="{{ old('color') }}" title="Choose your color">
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Cập nhật Sản phẩm</button>
                        </div>
                    </form><!-- End Edit Product Form -->

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
