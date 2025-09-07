@extends('layouts.admin')

@section('content')
<h2>Inventory</h2>

<table class="table table-bordered mt-3" id="ordersTable">
    <thead>
        <tr>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Unit of Measure</th>
            <th>Opening Stock</th>
            <th>Actual Stock</th>
            <th>Company</th>
        </tr>
    </thead>
    <tbody>
        @forelse($itemsList as $item)
<tr>
    <td>{{ $item->item_code }}</td>
    <td>{{ $item->item_name }}</td>
    <td>{{ $item->unit_of_measure }}</td>
    <td>{{ number_format($item->opening_stock, 2) }}</td>
    <td>{{ number_format($item->stock, 2) }}</td>
    <td>{{ $item->company->name ?? 'N/A' }}</td>
   
</tr>
@empty
<tr>
    <td colspan="7" class="text-center">No Items Found</td>
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
