<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manajemen Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container py-4">

    <h2>Manajemen Pesanan</h2>

    <!-- Tombol Back -->
    <a href="beranda_admin.html" class="btn btn-outline-secondary mb-3">← Kembali ke Beranda</a>

    <table class="table table-bordered table-striped mt-3">
      <thead class="table-dark">
        <tr>
          <th>ID Pesanan</th>
          <th>Nama Pembeli</th>
          <th>Tanggal</th>
          <th>Total Harga</th>
          <th>Status</th>
          
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>#ORD-1001</td>
          <td>Andi Pratama</td>
          <td>2025-12-01</td>
          <td>Rp 520.000</td>
          <td><span class="badge bg-warning text-dark">Menunggu</span></td>
        
        </tr>

        <tr>
          <td>#ORD-1002</td>
          <td>Budi Santoso</td>
          <td>2025-12-02</td>
          <td>Rp 300.000</td>
          <td><span class="badge bg-success">Selesai</span></td>
          
        </tr>
      </tbody>

    </table>

  </div>
</body>
</html>