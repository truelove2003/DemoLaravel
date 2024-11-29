@extends('layout.product1')

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>
    @php
$totalAmount = 0;
@endphp

<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                @php
                    $itemTotal = $item->product->price * $item->quantity;
                    $totalAmount += $itemTotal;
                @endphp
                <tr>
                    <td>
                        @if(isset($item->product->image))
                            <img src="{{ Storage::url($item->product->image) }}" alt="Product Image" width="50">
                        @else
                            <img src="{{ asset('default-image.png') }}" alt="Default Image" width="50">
                        @endif
                    </td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->price }}₫</td>
                    <td>
                        <input type="number" name="items[{{ $item->product->id }}][quantity]" value="{{ $item->quantity }}" min="1">
                        <input type="hidden" name="items[{{ $item->product->id }}][id]" value="{{ $item->product->id }}">
                        <input type="hidden" name="items[{{ $item->product->id }}][price]" value="{{ $item->product->price }}">
                    </td>
                    <td>{{ $item->product->price * $item->quantity }}₫</td>
                    <td>
                        <button class="btn btn-danger remove-item" data-id="{{ $item->id }}">Remove</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section mt-5">
        <div class="card">
            <div class="card-body">
                <h5>Tổng Số Tiền (gồm VAT)</h5>
                <p id="total-amount-display" class="text-danger" style="font-size: 24px;">{{ number_format($totalAmount) }}₫</p>
                <input type="hidden" name="total_amount" id="total-amount" value="{{ $totalAmount }}">
                
            </div>
            <br>
            <button type="submit" class="btn btn-secondary">THANH TOÁN</button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.remove-item').on('click', function() {
        var button = $(this);
        var itemId = button.data('id');
        
        $.ajax({
            url: '{{ route('cart.remove') }}',
            type: 'POST',
            data: {
                id: itemId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                // Xóa dòng tương ứng với sản phẩm khỏi bảng
                button.closest('tr').remove();
                alert(result.message);
            },
            error: function(xhr) {
                alert(xhr.responseJSON.error);
            }
        });
    });
});
</script>



<script>
   document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const totalAmountDisplay = document.getElementById('total-amount-display');
    const totalAmountHiddenInput = document.getElementById('total-amount');

    function updateTotalAmount() {
        let totalAmount = 0;
        document.querySelectorAll('.quantity-input').forEach(input => {
            const price = parseFloat(input.getAttribute('data-price'));
            const quantity = parseInt(input.value);
            totalAmount += price * quantity;
        });

        totalAmountDisplay.textContent = totalAmount.toLocaleString('vi-VN') + '₫';
        totalAmountHiddenInput.value = totalAmount;
    }

    quantityInputs.forEach(input => {
        input.addEventListener('input', function() {
            const price = parseFloat(this.getAttribute('data-price'));
            const quantity = parseInt(this.value);
            const itemTotalElement = this.closest('tr').querySelector('.total-price');

            const itemTotal = price * quantity;
            itemTotalElement.textContent = itemTotal.toLocaleString('vi-VN') + '₫';

            updateTotalAmount();
        });
    });

    // Initialize total amount on page load
    updateTotalAmount();
});


</script>




@endsection
