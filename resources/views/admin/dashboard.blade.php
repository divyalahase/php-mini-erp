@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <h1 class="mb-4">Admin Dashboard</h1>

  <div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>150</h3>
          <p>Orders</p>
        </div>
        <div class="icon"><i class="fas fa-shopping-cart"></i></div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>53</h3>
          <p>Users</p>
        </div>
        <div class="icon"><i class="fas fa-users"></i></div>
      </div>
    </div>
  </div>
</div>
@endsection
