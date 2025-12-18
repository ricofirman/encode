<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manajemen Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container py-4">

    <h2>Manajemen Produk</h2>

    <!-- Tombol Back -->
    <a href="beranda_admin.html" class="btn btn-outline-secondary mb-3">← Kembali ke Beranda</a>

    <a href="tambah_produk.html" class="btn btn-dark mb-3">Tambah Produk</a>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Foto</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><img src="https://via.placeholder.com/50" alt="Produk" class="img-thumbnail"></td>
          <td>Baju A</td>
          <td>Rp 450.000.000</td>
          <td>10</td>
          <td>Baju</td>
          <td>
            <a href="edit_produk.html" class="btn btn-outline-secondary btn-sm">Edit</a>
            <button class="btn btn-outline-danger btn-sm">Hapus</button>
          </td>
        </tr>
      </tbody>

    </table>

  </div>
</body>
</html>