@extends('layout.product1')

@section('content')
<style>
   .product-container {
       display: flex;
       background-color: white;
       border-radius: 10px;
       overflow: hidden;
       box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
       width: 80%;
       max-width: 1200px;
       margin: 20px auto;
       justify-content: space-between;
       align-items: flex-start;
   }
   .alert {
    max-width: 300px; /* Giới hạn chiều rộng */
    padding: 10px 20px; /* Điều chỉnh khoảng cách nội dung bên trong */
    margin: 10px auto; /* Giảm khoảng cách trên dưới */
    border-radius: 5px;
    text-align: center;
    font-size: 16px;
    line-height: 1.5; /* Điều chỉnh khoảng cách giữa các dòng */
    transition: opacity 0.5s ease-out; /* Hiệu ứng mờ dần khi đóng */
}

.alert-success {
    background-color: #dff0d8; /* Màu nền thành công */
    color: #3c763d; /* Màu chữ thành công */
}



.alert-success {
    background-color: #dff0d8; /* Màu nền thành công */
    color: #3c763d; /* Màu chữ thành công */
    border-color: #c3e6cb; /* Màu border thành công */
}


   .image-gallery {
       width: 20%;
       display: flex;
       flex-direction: column;
       align-items: center;
       background-color: #f9f9f9;
       padding: 10px;
       overflow-y: auto;
       border-right: 1px solid #ddd;
       max-height: 400px;
   }

   .image-gallery img {
       width: 60%;
       margin-bottom: 10px;
       border-radius: 4px;
       cursor: pointer;
       border: 1px solid transparent;
       transition: border-color 0.3s;
   }

   .image-gallery img:hover {
       border-color: #bbb;
       transform: scale(1.05);
   }

   .main-image {
       width: 50%;
       padding: 20px;
       display: flex;
       justify-content: center;
       align-items: center;
   }

   .main-image img {
       width: 100%;
       max-width: 400px;
       height: auto;
       object-fit: cover;
       border-radius: 10px;
       box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
   }

   .product-details {
       width: 30%;
       padding: 20px;
       background-color: #fff;
       box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
   }

   .product-title {
       font-size: 24px;
       font-weight: bold;
       margin-bottom: 10px;
   }

   .product-price {
       font-size: 20px;
       color: #E74C3C;
       margin-bottom: 10px;
   }

   .product-price del {
       color: grey;
       margin-right: 10px;
   }

   .product-description {
       font-size: 16px;
       color: #555;
       margin: 20px 0;
       line-height: 1.5;
   }

   .purchase-section {
       margin-top: 20px;
   }

   .quantity-input {
       width: 50px;
       padding: 5px;
       text-align: center;
       margin-right: 10px;
       border: 1px solid #ddd;
       border-radius: 4px;
   }

   .buy-now-button {
       background-color: #007bff;
       color: white;
       padding: 10px 20px;
       text-align: center;
       border: none;
       border-radius: 5px;
       cursor: pointer;
       display: inline-block;
       transition: background-color 0.3s;
   }

   .buy-now-button:hover {
       background-color: #0056b3;
   }
   .pagetitle {
    font-size: 36px; /* Kích thước chữ */
    font-weight: bold; /* Đậm chữ */
    text-align: center; /* Căn giữa */
    color: #333; /* Màu chữ */
    margin: 20px 0; /* Khoảng cách trên và dưới */
    padding: 10px 20px; /* Khoảng đệm bên trong */
    border-radius: 8px; /* Bo góc */
    background-color: #f9f9f9; /* Màu nền nhạt */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
    letter-spacing: 1.5px; /* Khoảng cách giữa các chữ cái */
    text-transform: uppercase; /* Viết hoa tất cả các chữ cái */
}

.pagetitle span {
    color: #E74C3C; /* Màu chữ cho một phần của tiêu đề nếu bạn muốn nổi bật */
}

</style>
<div class="pagetitle">
    <h1>Danh sách sản phẩm</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/user') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/user/products') }}">Products</a></li>
        </ol>
    </nav>
</div>

<div class="product-container">

    <div class="image-gallery">
        @foreach($product->images as $image)
            <img src="{{ asset('storage/' . $image->image_url) }}" alt="Thumbnail" onclick="changeMainImage('{{ asset('storage/' . $image->image_url) }}')">
        @endforeach
        
    </div>
    <div class="main-image">
        <img id="main-image" src="{{ asset('storage/' . $product->images->first()->image_url) }}" alt="Main Image">
    </div>
    <div class="product-details">
        <h1 class="product-title">{{ $product->name }}</h1>
        <div class="product-price">
            <span>{{ $product->price }}₫</span>
        </div>
        <p class="product-description">{{ $product->description }}</p>
        <div class="purchase-section">
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" class="quantity-input" name="quantity" min="1" value="1">
                <button type="submit" class="buy-now-button">Mua hàng</button>
                @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
            </form>
        </div>
    </div>
    
</div>

<script>
    function changeMainImage(src) {
        document.getElementById('main-image').src = src;
    }
</script>
@endsection
