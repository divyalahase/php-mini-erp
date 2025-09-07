
@extends('layouts.app')

@section('content')
<h2>
    Companies 
    <!-- <a href="{{ route('admin.companies.create') }}" class="btn btn-primary float-right">
        Add Company
    </a> -->
</h2>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
    </tr>
    @foreach($companies as $company)
    <tr>
        <td>{{ $company->id }}</td>
        <td>{{ $company->name }}</td>
        <td>{{ $company->address }}</td>
    </tr>
    @endforeach
</table>
@endsection
