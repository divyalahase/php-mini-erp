<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Mini ERP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- Admin Menus -->
                @if(auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Companies
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.companies') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Companies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.companies.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Company</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Reports -->
                 <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reports.pending') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending Sales Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.confirmed') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Confirmed Sales Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.itemstock') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Item Stock Balance</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Sales Menus -->
                @if(auth()->user()->role == 'sales'|| auth()->user()->role == 'admin')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Sales
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sales.customers') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sales.orders') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Store Manager Menus -->
                @if(auth()->user()->role == 'store_manager' || auth()->user()->role == 'admin')
                    <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Store
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li  class="nav-item">
                            <a href="{{ route('store_manager.orders.inventory') }}" class="nav-link">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>Inventory</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('store_manager.orders.pending') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('store_manager.confirmed') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Confirmed Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('store_manager.rejected') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rejected Orders</p>
                            </a>
                        </li>
                    </ul>  
                    </li> 
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
