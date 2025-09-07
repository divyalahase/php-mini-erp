@extends('layouts.admin')

@section('content')
<h2>Item Stock Balance</h2>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Unit</th>
            <th>Opening Stock</th>
            <th>Current Stock</th>
            <th>Company</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
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
            <td colspan="6" class="text-center">No Items Found</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
