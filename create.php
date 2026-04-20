<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Mahasiswa</title>
    <!-- Memuat Bootstrap CSS dari CDN agar form tampil rapi dan responsif -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light">
<div class="container mt-5">
    <!-- Menggunakan komponen Card Bootstrap dengan ukuran lebar 50% (w-50) di tengah layar (mx-auto) -->
    <div class="card shadow w-50 mx-auto">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tambah Data Mahasiswa</h5>
        </div>
        <div class="card-body">
            <!-- Form dikirim ke aksi 'create' menggunakan method POST agar data aman (tidak tampil di URL) -->
            <form action="index.php?action=create" method="POST">
                <!-- Bagian input data mahasiswa. Atribut 'name' sangat penting karena harus sesuai dengan yang ditangkap di Controller ($_POST['...']) -->
                <div class="mb-3">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama Mahasiswa</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nilai Tugas</label>
                    <input type="number" name="nilai_tugas" class="form-control" required>
                </div>
                
                <!-- Tombol aksi untuk menyimpan data baru atau membatalkan (kembali ke index) -->
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<!-- Memuat file Javascript Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
