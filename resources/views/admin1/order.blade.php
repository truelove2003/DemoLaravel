@extends('layout.table')

@section('content')
<div class="container">
    <h1>Danh sách đơn hàng</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user ? $order->user->name : 'N/A' }}</td>
                    <td>{{ number_format($order->total_amount) }}₫</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
