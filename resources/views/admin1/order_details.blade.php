<!-- resources/views/orderDetails/index.blade.php -->

@extends('layout.table')

@section('content')
<div class="container">
    <h1>Order Details</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th> <!-- Add this line -->
            </tr>
        </thead>
        <tbody>
            @foreach ($orderDetails as $detail)
                <tr>
                    <td>{{ $detail->id }}</td>
                    <td>{{ $detail->order_id }}</td>
                    <td>{{ $detail->product_id }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->total_amount }}</td>
                    <td>{{ $detail->status }}</td>
                    <td>{{ $detail->created_at }}</td>
                    <td>{{ $detail->updated_at }}</td>
                    <td>
                        <a href="{{ route('orderDetails.edit', $detail->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
