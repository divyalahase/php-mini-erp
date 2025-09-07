@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}</p>
    </div>
@endsection
