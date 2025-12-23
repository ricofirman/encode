@extends('layouts.app')
@section('title','Order Status')

@section('content')
<div class="container py-5">
  <h3 class="mb-3">Status Pesanan</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="card p-4">
    <p class="mb-1"><strong>Order ID:</strong> {{ request('order_id') ?? '-' }}</p>
    <p class="mb-1"><strong>Status Code:</strong> {{ request('status_code') ?? '-' }}</p>
    <p class="mb-0"><strong>Status Transaksi:</strong> {{ request('transaction_status') ?? '-' }}</p>

    <hr>

    <a href="/my-orders" class="btn btn-dark">Lihat Pesanan Saya</a>
    <a href="/products" class="btn btn-outline-secondary ms-2">Belanja Lagi</a>
  </div>
</div>
@endsection
