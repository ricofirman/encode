@extends('admin.layout')

@section('title', 'Customers Management - ENCODE')

@section('active-customers', 'active')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Customers Management</h1>
</div>

<!-- Customers Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered</th>
                        <th>Orders</th>
                        <th>Total Spent</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->created_at->format('M d, Y') }}</td>
                        <td>
                            @php
                                $orderCount = $customer->orders()->count();
                            @endphp
                            <span class="badge bg-{{ $orderCount > 0 ? 'success' : 'secondary' }}">
                                {{ $orderCount }} orders
                            </span>
                        </td>
                        <td>
                            @php
                                $totalSpent = $customer->orders()->where('status', 'completed')->sum('total');
                            @endphp
                            Rp {{ number_format($totalSpent, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-people display-6 text-muted"></i>
                            <p class="mt-2">No customers yet</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        {{ $customers->links() }}
    </div>
</div>
@endsection