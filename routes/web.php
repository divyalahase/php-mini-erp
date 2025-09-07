<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Default dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Login Routes (Breeze)
|--------------------------------------------------------------------------
*/

// Show login page at /admin
Route::get('/admin', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('admin.login');

// Handle login POST
Route::post('/admin/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('admin.login.submit');

// Handle logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (after login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/companies', [AdminController::class, 'companies'])->name('admin.companies');
    Route::get('/companies/create', [AdminController::class, 'createCompany'])->name('admin.companies.create');
    Route::post('/companies', [AdminController::class, 'storeCompany'])->name('admin.companies.store');
    
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/itemstock', [ReportController::class, 'itemStock'])->name('itemstock');
        Route::get('/pending-orders', [ReportController::class, 'pendingOrders'])->name('pending');
        Route::get('/confirmed-orders', [ReportController::class, 'confirmedOrders'])->name('confirmed');
        Route::get('/rejected-orders', [ReportController::class, 'rejectedOrders'])->name('rejected');
    });
});

/*
|--------------------------------------------------------------------------
| Sales Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:sales'])->prefix('sales')->group(function () {
    Route::get('/customers', [SalesController::class,'customers'])->name('sales.customers');
    Route::get('/orders', [SalesController::class,'orders'])->name('sales.orders');
    Route::get('/orders/create', [SalesController::class,'createOrder'])->name('sales.orders.create');
    Route::post('/orders', [SalesController::class,'storeOrder'])->name('sales.orders.store');
    Route::get('/customers/create', [SalesController::class,'createCustomer'])->name('sales.customers.create');
    Route::post('/customers', [SalesController::class,'storeCustomer'])->name('sales.customers.store');
    Route::post('/orders/{order}/confirm', [SalesController::class, 'confirmOrder'])->name('sales.orders.confirm');
    Route::post('/sales/orders/{id}/confirm', [SalesController::class, 'confirmOrder'])->name('sales.orders.confirm');
    Route::get('/orders/{id}', [SalesController::class, 'showSalesOrder'])->name('sales.orders.show');

});

/*
|--------------------------------------------------------------------------
| Store Routes
|--------------------------------------------------------------------------
*/
Route::prefix('store_manager')->name('store_manager.')->group(function () {
    Route::get('/orders/pending', [SalesController::class, 'pendingOrders'])
        ->name('orders.pending');
    Route::get('/orders/confirmed', [SalesController::class, 'confirmedOrders'])
        ->name('orders.confirmed');
    Route::post('/orders/{id}/confirm', [SalesController::class, 'ajaxConfirmOrder'])
        ->name('orders.ajaxConfirm');
    Route::post('/orders/{id}/reject', [SalesController::class, 'ajaxRejectOrder'])
         ->name('orders.ajaxReject');
    Route::get('confirmed', [SalesController::class, 'confirmedOrders'])->name('confirmed');
    Route::get('rejected', [SalesController::class, 'rejectedOrders'])->name('rejected');
    Route::get('/orders/{id}', [SalesController::class, 'show'])->name('orders.show');
    Route::get('/items', [SalesController::class, 'showItems'])->name('orders.inventory');
});


// Include Breeze auth routes
require __DIR__.'/auth.php';
