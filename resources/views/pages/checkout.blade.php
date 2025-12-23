@extends('layouts.app')
@section('title','Checkout')

@section('content')
<div class="container py-4">
  <h3 class="mb-3">Checkout</h3>

  {{-- Optional: ringkasan total (kalau kamu kirim compact('total') dari controller) --}}
  @isset($total)
    <div class="alert alert-secondary">
      Total (belum pajak): <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
    </div>
  @endisset

  <form method="POST" action="{{ url('/checkout') }}">
    @csrf

    <div class="mb-2">
      <label>Nama</label>
      <input name="name" class="form-control" required>
    </div>

    <div class="mb-2">
      <label>Email</label>
      <input name="email" type="email" class="form-control" required>
    </div>

    <div class="mb-2">
      <label>Alamat</label>
      <textarea name="address" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
      <label>Metode Bayar</label>
      <select name="payment" class="form-control" required>
        <option value="midtrans" selected>Payment Option</option>
        <option value="cod">COD</option>
      </select>
    </div>

    <button class="btn btn-dark w-100" type="submit">
      Bayar Sekarang
    </button>
  </form>
</div>
@endsection
