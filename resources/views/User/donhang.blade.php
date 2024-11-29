@extends('layout.product1')

@section('content')
<style>
    .container {
        width: 80%;
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
       
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 28px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .order {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 20px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .order h2 {
        font-size: 22px;
        color: #007bff;
        margin-bottom: 10px;
    }

    .order p {
        font-size: 16px;
        color: #555;
        margin: 5px 0;
    }

    .product {
        padding: 10px;
        background-color: #f7f7f7;
        border: 1px solid #eee;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .product p {
        margin: 5px 0;
    }

    hr {
        border-top: 1px solid #ddd;
        margin-top: 20px;
    }

    .no-orders {
        text-align: center;
        color: #888;
        font-size: 18px;
        margin-top: 50px;
    }
</style>

<div class="container">
    <h1>Đơn hàng của bạn</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    @if($orders->count() > 0)
        @foreach ($orders as $order)
            <div class="order">
                <h2>Đơn hàng #{{ $order->id }}</h2>
                <p>Ngày đặt hàng: {{ $order->created_at }}</p>
                
                @if($order->details->isNotEmpty())
                    @foreach ($order->details as $detail)
                        <div class="product">
                            @if($detail->product)
                                <p>Tên sản phẩm: {{ $detail->product->name }}</p>
                                <p>Số lượng: {{ $detail->quantity }}</p>
                                <p>Giá: {{ number_format($detail->product->price) }}₫</p>
                                <p>Tổng giá: {{ number_format($detail->quantity * $detail->product->price) }}₫</p>
                            @else
                                <p>Thông tin sản phẩm không có.</p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p>Không có chi tiết đơn hàng.</p>
                @endif
                
                <hr>
            </div>
        @endforeach
    @else
        <p class="no-orders">Không có đơn hàng nào.</p>
    @endif
</div>
@endsection
