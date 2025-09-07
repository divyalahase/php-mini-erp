@extends('layouts.admin')

@section('content')
<h2>Order Details</h2>
<p><strong>Order ID:</strong> {{ $order->order_no }}</p>
<p><strong>Customer:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
<p><strong>Date:</strong> {{ $order->order_date }}</p>

<h4>Items</h4>
<table class="table table-bordered mt-3" style="table-layout: fixed;">
    <thead>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Rate</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->item->item_name }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ number_format($item->rate,2) }}</td>
            <td>{{ number_format($item->amount,2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p><strong>Total Amount: ₹ {{ number_format($order->items->sum('amount'), 2) }}</strong></p>

<a href="{{ route('store_manager.orders.pending') }}" class="btn btn-primary mt-3">Back</a>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $(".confirm-btn").click(function(){
        let orderId = $(this).data("id");
        let button = $(this);

        $.ajax({
            url: "{{ url('store_manager/orders') }}/" + orderId + "/confirm",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if(response.status === 'success'){
                    alert(response.message);
                    // $("#order-" + orderId).remove(); 
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr){
                alert("Something went wrong!");
            }
        });
    });

     // Reject order
    $(".reject-btn").click(function(){
        let orderId = $(this).data("id");
        if(!confirm("Are you sure you want to reject this order?")) return;

        $.ajax({
            url: "/store_manager/orders/" + orderId + "/reject",
            type: "POST",
            data: { _token: "{{ csrf_token() }}" },
            success: function(response){
                if(response.status === 'success'){
                    alert(response.message);
                    //location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function(){
                alert("Something went wrong!");
            }
        });
    });
});
</script>
@endsection
