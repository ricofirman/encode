@extends('layouts.app')

@section('title', 'My Profile - ENCODE')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">My Profile</h2>
    
    <div class="row">
        <div class="col-lg-4">
            <!-- Profile Card -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px; font-size: 2rem; color: white;">
                            {{ strtoupper(substr(Session::get('user_name'), 0, 1)) }}
                        </div>
                    </div>
                    <h4>{{ Session::get('user_name') }}</h4>
                    <p class="text-muted">{{ Session::get('user_email') }}</p>
                    <p>
                        <span class="badge bg-{{ Session::get('user_role') == 'admin' ? 'danger' : 'primary' }}">
                            {{ Session::get('user_role') == 'admin' ? 'Administrator' : 'Customer' }}
                        </span>
                    </p>
                    <p class="small text-muted">
                        Member since {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <!-- Account Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Account Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Full Name:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->name }}
                            <button class="btn btn-sm btn-outline-primary ms-3" 
                                    data-bs-toggle="modal" data-bs-target="#changeNameModal">
                                <i class="bi bi-pencil"></i> Change
                            </button>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->email }}
                            <span class="badge bg-success ms-2">Verified</span>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Account Type:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->role == 'admin' ? 'Administrator' : 'Regular Customer' }}
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Password:</strong>
                        </div>
                        <div class="col-sm-9">
                            ••••••••
                            <button class="btn btn-sm btn-outline-primary ms-3" 
                                    data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bi bi-key"></i> Change Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order History (Jika ada fitur order) -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    @if($user->orders && $user->orders->count() > 0)
                        <div class="list-group">
                            @foreach($user->orders->take(5) as $order)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>Order #{{ $order->order_number }}</strong><br>
                                        <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->status) }}
                                        </span><br>
                                        <strong>{{ $order->formatted_total }}</strong>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ url('/my-orders') }}" class="btn btn-outline-dark">View All Orders</a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-bag display-6 text-muted"></i>
                            <p class="mt-3">No orders yet</p>
                            <a href="{{ url('/products') }}" class="btn btn-primary">Start Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.profile-modals')

@endsection