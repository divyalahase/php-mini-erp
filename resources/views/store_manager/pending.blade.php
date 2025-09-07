@extends('layouts.admin')

@section('content')
<h2>Pending Orders</h2>

<table class="table table-bordered mt-3" id="ordersTable">
    <thead>
        <tr>
            <th>Order No</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Total Amount</th>
            <th>Order Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
        <tr id="order-{{ $order->id }}">
            <td>{{ $order->order_no }}</td>
            <td>{{ $order->customer->name ?? 'N/A' }}</td>
            <td>{{ $order->order_date }}</td>
            <td>{{ $order->items->sum('amount') }}</td>
            <td id="status-{{ $order->id }}">{{ ucfirst($order->status) }}</td>
           <td class="action-cell">    
   <a href="{{ route('store_manager.orders.show', $order->id) }}" class="btn btn-info btn-sm">View Order</a>
   @if($order->status === 'pending' && auth()->user()->role == 'store_manager')
            <button class="btn btn-success btn-sm confirm-btn" data-id="{{ $order->id }}">Confirm</button>
            <button class="btn btn-danger btn-sm reject-btn" data-id="{{ $order->id }}">Reject</button>
        @endif
</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No pending orders</td>
        </tr>
        @endforelse
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // function updateActionButtons(status) {
    //     $(".action-cell")
    //     .html('<span class="badge ' + (status === "confirmed" ? "bg-success" : "bg-danger") + '">' + status.toUpperCase() + '</span>');
    // }

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
                    location.reload();
                    // updateActionButtons('confirmed'); // Update buttons to "CONFIRMED"
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
                    location.reload();
                    // updateActionButtons('rejected'); // Update buttons to "REJECTED"
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
