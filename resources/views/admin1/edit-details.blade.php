<!-- resources/views/orderDetails/edit.blade.php -->

@extends('layout.edit')

@section('content')
<div class="container">
    <h1>Edit Order Detail Status</h1>
    <form action="{{ route('orderDetails.update', $orderDetail->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ $orderDetail->status }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
@endsection
