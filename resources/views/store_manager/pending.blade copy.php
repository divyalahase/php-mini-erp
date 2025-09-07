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
            <th>View Order</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
        <tr id="order-{{ $order->id }}">
            <td>{{ $order->order_no }}</td>
            <td>{{ $order->customer->name ?? 'N/A' }}</td>
            <td>{{ $order->order_date }}</td>
            <td>{{ $order->items->sum('amount') }}</td>
            <td>
                <button class="btn btn-success btn-sm confirm-btn" data-id="{{ $order->id }}">
                    Confirm
                </button>
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
                    $("#order-" + orderId).remove(); 
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr){
                alert("Something went wrong!");
            }
        });
    });
});
</script>
@endsection
