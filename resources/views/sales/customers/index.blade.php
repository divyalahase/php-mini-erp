@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Customers</h2>
    @if(auth()->user()->role != 'admin' && auth()->user()->role != 'store_manager')
    <a href="{{ route('sales.customers.create') }}" class="btn btn-primary">Add Customer</a>
@endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Company</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->company->name ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
