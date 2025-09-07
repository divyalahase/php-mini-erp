<!DOCTYPE html>
<html>
<head>
    <title>Store Manager Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('store_manager.dashboard') }}">Store Manager</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('store_manager.orders.confirmed') }}">Confirmed Orders</a></li>
      </ul>
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('store_manager.orders.pending') }}">Pending Orders</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>
</body>
</html>
