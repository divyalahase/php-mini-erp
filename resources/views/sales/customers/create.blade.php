@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Add Customer</h2>
    <form action="{{ route('sales.customers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        
        <div class="form-group mt-2">
            <label>Email:</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="form-group mt-2">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="form-group mt-2">
            <label>Company:</label>
            <select name="company_id" class="form-control" required>
                <option value="">-- Select Company --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save</button>
    </form>
</div>
@endsection
