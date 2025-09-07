@extends('layouts.app')

@section('content')
<h2>Add Company</h2>
<form action="{{ route('admin.companies.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Address</label>
        <textarea name="address" class="form-control"></textarea>
    </div>
    <button class="btn btn-success mt-2">Save</button>
</form>
@endsection
