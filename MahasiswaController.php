<?php
// Memuat file konfigurasi database dan model yang dibutuhkan
require_once 'config/Database.php';
require_once 'models/MahasiswaModel.php';

// Kelas Controller untuk entitas Mahasiswa
class MahasiswaController {
    // Properti untuk menampung instansiasi dari MahasiswaModel
    private $model;

    // Konstruktor dijalankan otomatis saat objek MahasiswaController dibuat (di index.php)
    public function __construct() {
        // Membuat koneksi ke database
        $database = new Database();
        $db = $database->getConnection();
        
        // Menginisialisasi model dengan menyematkan koneksi database ke dalamnya
        $this->model = new MahasiswaModel($db);
    }

    // Method untuk menampilkan halaman utama (Daftar Mahasiswa)
    public function index() {
        // Menangkap kata kunci pencarian dari URL (jika ada), jika tidak ada maka kosong ("")
        // Di sini kita bisa juga menggunakan Null Coalescing Operator: $_GET['search'] ?? ""
        $keyword = $_GET['search'] ?? "";
        
        // Meminta model untuk mengambil data (berdasarkan keyword jika ada)
        $stmt = $this->model->read($keyword);
        
        // Mengubah hasil query menjadi bentuk array asosiatif untuk dikirim ke View
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Memuat View 'list.php' yang akan merender tampilan tabel menggunakan $data
        require_once 'views/list.php';
    }

    // Method untuk menangani proses penambahan data
    public function create() {
        // Mengecek apakah request yang datang adalah POST (berarti user men-submit form)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Meminta model untuk menyimpan data baru ke database
            $this->model->create($_POST['nim'], $_POST['nama'], $_POST['kelas'], $_POST['nilai_tugas']);
            // Redirect (mengarahkan kembali) pengguna ke halaman utama setelah berhasil
            header("Location: index.php");
        } else {
            // Jika request bukan POST (misal saat baru klik tombol "Tambah Data"), tampilkan form create
            require_once 'views/create.php';
        }
    }

    // Method untuk menangani proses perubahan (update) data
    public function edit() {
        // Jika form edit di-submit (POST), proses update data ke model
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model->update($_POST['id'], $_POST['nim'], $_POST['nama'], $_POST['kelas'], $_POST['nilai_tugas']);
            header("Location: index.php");
        } else {
            // Jika diakses via link "Edit" (GET), ambil parameter ID dari URL
            $id = $_GET['id'];
            // Minta model untuk mengambil 1 baris data lama berdasarkan ID
            $data = $this->model->show($id);
            
            // Tampilkan form edit dan kirimkan variabel $data agar form terisi nilai lama
            require_once 'views/edit.php';
        }
    }

    // Method untuk menangani proses penghapusan data
    public function delete() {
        // Menangkap ID data yang ingin dihapus dari URL
        $id = $_GET['id'];
        // Memerintahkan model mengeksekusi query DELETE
        $this->model->delete($id);
        
        // Arahkan kembali pengguna ke halaman utama
        header("Location: index.php");
    }
}
?>
