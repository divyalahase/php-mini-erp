@extends('layouts.admin')

@section('content')
<h2>Confirmed Sales Orders</h2>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Order No</th>
            <th>Customer</th>
            <th>Order Date</th>
            <th>Total Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
        <tr>
            <td>{{ $order->order_no }}</td>
            <td>{{ $order->customer->name ?? 'N/A' }}</td>
            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y h:i:s A') }}</td>
            <td>₹ {{ number_format($order->items->sum('amount'), 2) }}</td>
            <td><span class="badge bg-success">{{ ucfirst($order->status) }}</span></td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No Confirmed Orders Found</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
