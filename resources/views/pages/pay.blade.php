@extends('layouts.app')
@section('title','Pembayaran')

@section('content')
<div id="payment-status" class="alert alert-info d-none mt-3"></div>

<div class="container py-5">
  <h3 class="mb-2">Pembayaran</h3>
  <p class="text-muted mb-4">Order: <strong>{{ $order->order_number }}</strong></p>

  <div class="card p-4">
    <p class="mb-3">Klik tombol di bawah untuk menampilkan QR / metode pembayaran.</p>

    <button id="pay-button" class="btn btn-dark w-100">
      Tampilkan QR / Bayar
    </button>


  </div>
</div>
@endsection

@section('scripts')
<script
  src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
</script>

<script>
const statusBox = document.getElementById('payment-status');

document.getElementById('pay-button').addEventListener('click', function () {
  window.snap.pay("{{ $order->snap_token }}", {
    onSuccess: function(){
      statusBox.className = "alert alert-success mt-3";
      statusBox.innerText = "Pembayaran berhasil 🎉";
      statusBox.classList.remove('d-none');
    },
    onPending: function(){
      statusBox.className = "alert alert-warning mt-3";
      statusBox.innerText = "Menunggu pembayaran QRIS ⏳";
      statusBox.classList.remove('d-none');
    },
    onError: function(){
      statusBox.className = "alert alert-danger mt-3";
      statusBox.innerText = "Pembayaran gagal ❌";
      statusBox.classList.remove('d-none');
    }
  });
});
</script>



<script>
document.getElementById('pay-button').addEventListener('click', function () {
  window.snap.pay("{{ $order->snap_token }}", {
    onSuccess: function(result){
      document.getElementById('result-json').innerHTML = JSON.stringify(result, null, 2);
      window.location.href = "/order-status";
    },
    onPending: function(result){
      document.getElementById('result-json').innerHTML = JSON.stringify(result, null, 2);
    },
    onError: function(result){
      document.getElementById('result-json').innerHTML = JSON.stringify(result, null, 2);
      alert("Pembayaran gagal. Coba lagi ya.");
    },
    onClose: function(){
      // user nutup popup -> status masih pending
    }
  });
});
</script>
@endsection
