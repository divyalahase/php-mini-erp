@extends('layouts.app')

@section('content')
<h2>Create Sales Order</h2>
<form id="sales-form" action="{{ route('sales.orders.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Customer</label>
        <select name="customer_id" class="form-control">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>

    <h4>Items</h4>
    <div id="items-container">
        <div class="item-row mb-2">
            <select name="items[0][item_id]" class="form-control d-inline-block w-25">
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                @endforeach
            </select>
            <input type="number" name="items[0][qty]" class="form-control d-inline-block w-25 qty" placeholder="Qty" value="0">
            <input type="number" step="0.01" name="items[0][rate]" class="form-control d-inline-block w-25 rate" placeholder="Rate" value="0">
            <span class="amount d-inline-block w-25">0.00</span>
        </div>
    </div>

    <button type="button" id="add-item" class="btn btn-secondary btn-sm mt-2">Add More Item</button>
    <br>
    <h2 class="mt-3">Grand Total: ₹<span id="grand-total">0.00</span></h2>

   
    <p id="error-msg" class="text-danger" style="display:none;">Please enter at least one item with Qty > 0</p>

    <button type="submit" class="btn btn-success mt-3">Create Order</button>
</form>

<script>
let i = 1;

document.getElementById('add-item').addEventListener('click', function() {
    let container = document.getElementById('items-container');
    let html = `
    <div class="item-row mb-2">
        <select name="items[${i}][item_id]" class="form-control d-inline-block w-25">
            @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
            @endforeach
        </select>
        <input type="number" name="items[${i}][qty]" class="form-control d-inline-block w-25 qty" placeholder="Qty" value="0">
        <input type="number" step="0.01" name="items[${i}][rate]" class="form-control d-inline-block w-25 rate" placeholder="Rate" value="0">
        <span class="amount d-inline-block w-25">0.00</span>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    i++;
    calculateTotal(); 
});

function calculateTotal() {
    let rows = document.querySelectorAll(".item-row");
    let grandTotal = 0;

    rows.forEach(row => {
        let qty = parseFloat(row.querySelector(".qty").value) || 0;
        let rate = parseFloat(row.querySelector(".rate").value) || 0;
        let amount = qty * rate;
        row.querySelector(".amount").innerText = amount.toFixed(2);
        grandTotal += amount;
    });

    document.getElementById("grand-total").innerText = grandTotal.toFixed(2);
}

document.addEventListener("input", function(e) {
    if (e.target.classList.contains("qty") || e.target.classList.contains("rate")) {
        calculateTotal();
    }
});
calculateTotal();


document.getElementById("sales-form").addEventListener("submit", function(event) {
    let valid = false;
    let rows = document.querySelectorAll(".item-row");

    rows.forEach(row => {
        let qty = parseFloat(row.querySelector(".qty").value) || 0;
        if (qty > 0) {
            valid = true;
        }
    });

    if (!valid) {
        event.preventDefault(); 
        document.getElementById("error-msg").style.display = "block";
    } else {
        document.getElementById("error-msg").style.display = "none";
    }
});
</script>
@endsection
