<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa - Pemrograman Web</title>
    <!-- Memuat Bootstrap CSS dari CDN untuk styling tampilan yang responsif -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <!-- Bagian Header Card: Menampilkan judul dan tombol yang mengarahkan ke halaman Tambah Data -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Mahasiswa - Nilai Tugas Web</h4>
            <a href="index.php?action=create" class="btn btn-light btn-sm">Tambah Data</a>
        </div>
        <div class="card-body">
            <!-- Form Pencarian: Menggunakan method GET agar parameter 'search' dikirim via URL -->
            <form method="GET" action="index.php" class="mb-3">
                <div class="input-group">
                    <!-- Value input diisi dengan kata kunci sebelumnya (jika ada) menggunakan ternary operator agar teks pencarian tidak hilang -->
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Nama atau NIM..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    <a href="index.php" class="btn btn-outline-danger">Reset</a>
                </div>
            </form>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Kelas</th>
                            <th>Nilai Tugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mengecek apakah variabel $data (dikirim dari controller) memiliki isi / tidak kosong -->
                        <?php if(count($data) > 0): ?>
                            <!-- Melakukan perulangan (looping) untuk setiap baris data mahasiswa -->
                            <?php $no = 1; foreach($data as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <!-- htmlspecialchars() digunakan untuk keamanan, yakni mencegah serangan XSS dengan mengubah tag HTML menjadi teks biasa -->
                                <td><?= htmlspecialchars($row['nim']) ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['kelas']) ?></td>
                                <td><?= htmlspecialchars($row['nilai_tugas']) ?></td>
                                <td>
                                    <!-- Link untuk mengedit dan menghapus data berdasarkan ID. Pada link Hapus, disematkan validasi javascript sederhana untuk konfirmasi. -->
                                    <a href="index.php?action=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="index.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Tampilan baris ini muncul jika data di database kosong atau hasil pencarian tidak ditemukan -->
                            <tr><td colspan="6" class="text-center">Data tidak ditemukan</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>