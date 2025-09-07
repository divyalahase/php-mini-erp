@extends('layouts.admin')

@section('content')
<h2>Sales Orders</h2>
@if(auth()->user()->role == 'sales')
<a href="{{ route('sales.orders.create') }}" class="btn btn-primary mb-2">Create Sales Order</a>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Order No</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Status</th>
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
            <td id="status-{{ $order->id }}">{{ ucfirst($order->status) }}</td>
            <td>₹{{ number_format($order->total_amount, 2) }}</td>
           <td><a href="{{ route('sales.orders.show', $order->id) }}" class="btn btn-info btn-sm">View Order</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.confirm-btn').forEach(btn => {
    btn.addEventListener('click', function(e){
        e.preventDefault();
        let orderId = this.dataset.id;

        fetch(`/store_manager/orders/${orderId}/confirm`, {
            method:'POST',
            headers:{
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept':'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
                document.getElementById('status-' + orderId).innerText = 'Confirmed';
                this.remove();
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(err => console.error(err));
    });
});

</script>
@endsection
