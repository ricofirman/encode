@extends('layouts.app')
@section('title','My Orders')

@section('content')
<div class="container py-5">
  <h3 class="mb-4">Pesanan Saya</h3>

  @if($orders->isEmpty())
    <div class="alert alert-secondary">
      Belum ada pesanan. <a href="/products">Mulai belanja</a>
    </div>
  @else
    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Pembayaran</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $o)
            <tr>
              <td class="fw-semibold">{{ $o->order_number }}</td>
              <td>{{ $o->created_at?->format('d M Y H:i') }}</td>
              <td>Rp {{ number_format($o->total ?? 0, 0, ',', '.') }}</td>
              <td>
                <span class="badge bg-dark">{{ $o->payment_method ?? '-' }}</span>
              </td>
              <td>
                @php
                  $ps = strtolower($o->payment_status ?? 'pending');
                  $badge = match($ps) {
                    'paid','settlement','capture' => 'bg-success',
                    'pending' => 'bg-warning text-dark',
                    'cancel','cancelled' => 'bg-secondary',
                    'expire','expired' => 'bg-danger',
                    'deny','failed' => 'bg-danger',
                    default => 'bg-info'
                  };
                @endphp
                <span class="badge {{ $badge }}">{{ $o->payment_status ?? '-' }}</span>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
@endsection
