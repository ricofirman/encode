<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Produk Baru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container py-4">

    <h2>Tambah Produk Baru</h2>

    <form class="mt-4">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Produk</label>
        <input type="text" class="form-control" id="nama" required>
      </div>

      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" required>
      </div>

      <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" class="form-control" id="stok" required>
      </div>

      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" rows="3"></textarea>
      </div>

      <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <select class="form-select" id="kategori">
          <option>Celana</option>
          <option>Baju</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="foto" class="form-label">Upload Foto</label>
        <input class="form-control" type="file" id="foto">
      </div>

      <button type="submit" class="btn btn-dark">Simpan</button>
      <a href="produk_admin.html" class="btn btn-outline-secondary">Kembali</a>

    </form>

  </div>
</body>
</html>