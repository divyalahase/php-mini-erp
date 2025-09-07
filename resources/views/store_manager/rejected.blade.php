@extends('layouts.admin')

@section('content')
<h2>Rejected Orders</h2>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Order No</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Total Amount</th>
            <th>View Order</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->order_no }}</td>
            <td>{{ $order->customer->name ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y h:i:s A') }}</td>
            <td>₹{{ number_format($order->total_amount, 2) }}</td>
            <td><a href="{{ route('store_manager.orders.show', $order->id) }}" class="btn btn-info btn-sm">View Order</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
