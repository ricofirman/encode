@extends('admin.layout')

@section('title', 'Dashboard Admin - ENCODE')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Dashboard</h1>
    <div>
        <span class="text-muted me-3">Last updated: Just now</span>
        <button class="btn btn-sm btn-outline-primary" onclick="loadDashboardData()">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Products</h6>
                        <h3 class="mb-0" id="total-products">{{ $stats['total_products'] ?? 0 }}</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> Active
                        </small>
                    </div>
                    <div class="stat-icon text-primary">
                        <i class="bi bi-box"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Orders</h6>
                        <h3 class="mb-0" id="total-orders">{{ $stats['total_orders'] ?? 0 }}</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> All time
                        </small>
                    </div>
                    <div class="stat-icon text-success">
                        <i class="bi bi-receipt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Pending Orders</h6>
                        <h3 class="mb-0" id="pending-orders-count">{{ $stats['pending_orders'] ?? 0 }}</h3>
                        <small class="text-warning">
                            <i class="bi bi-clock"></i> Need attention
                        </small>
                    </div>
                    <div class="stat-icon text-warning">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Revenue</h6>
                        <h3 class="mb-0" id="total-revenue">Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> Lifetime
                        </small>
                    </div>
                    <div class="stat-icon text-danger">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ url('/admin/products') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Add New Product
                    </a>
                    <a href="{{ url('/admin/orders') }}" class="btn btn-outline-primary">
                        <i class="bi bi-eye me-2"></i> View All Orders
                    </a>
                    <a href="{{ url('/admin/customers') }}" class="btn btn-outline-success">
                        <i class="bi bi-people me-2"></i> Manage Customers
                    </a>
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-info">
                        <i class="bi bi-shop me-2"></i> Visit Store
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="row g-4">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Orders</h5>
                <a href="{{ url('/admin/orders') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_orders as $order)
                            <tr>
                                <td>
                                    <strong>{{ $order->order_number }}</strong>
                                </td>
                                <td>{{ $order->shipping_name }}</td>
                                <td>{{ $order->created_at->format('M d, H:i') }}</td>
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'info') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ url('/admin/orders/' . $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="bi bi-receipt display-6 text-muted"></i>
                                    <p class="mt-2">No orders yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Quick Stats</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Active Products</span>
                        <span class="badge bg-primary">{{ $stats['active_products'] ?? 0 }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Today's Orders</span>
                        <span class="badge bg-success">{{ $stats['today_orders'] ?? 0 }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>New Customers</span>
                        <span class="badge bg-info">{{ $stats['new_customers'] ?? 0 }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Low Stock Products</span>
                        <span class="badge bg-warning">{{ $stats['low_stock'] ?? 0 }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Out of Stock</span>
                        <span class="badge bg-danger">{{ $stats['out_of_stock'] ?? 0 }}</span>
                    </div>
                </div>
                
                <hr class="my-3">
                
                <!-- System Info -->
                <div class="system-info">
                    <h6 class="mb-2">System Information</h6>
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">Laravel Version</small>
                        <small>{{ app()->version() }}</small>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">PHP Version</small>
                        <small>{{ phpversion() }}</small>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">Server Time</small>
                        <small>{{ now()->format('H:i:s') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Update sidebar pending orders badge
document.addEventListener('DOMContentLoaded', function() {
    const pendingCount = {{ $stats['pending_orders'] ?? 0 }};
    const badge = document.getElementById('pending-orders');
    if (badge && pendingCount > 0) {
        badge.textContent = pendingCount;
    } else if (badge) {
        badge.style.display = 'none';
    }
});

// Refresh dashboard data
function loadDashboardData() {
    // Simple reload for now
    window.location.reload();
}
</script>
@endsection
