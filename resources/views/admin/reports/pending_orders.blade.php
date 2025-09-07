@extends('layouts.admin')

@section('content')
<h2>Pending Sales Orders</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Order No</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
        <tr>
            <td>{{ $order->order_no }}</td>
            <td>{{ $order->customer->name ?? 'N/A' }}</td>
            <td>{{ $order->order_date }}</td>
            <td>₹{{ number_format($order->total_amount, 2) }}</td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">No Pending Orders</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
