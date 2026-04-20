<?php
// Kelas Database digunakan untuk mengatur koneksi ke server database MySQL.
// Ini adalah bagian penting agar aplikasi (terutama Model) bisa berinteraksi dengan database.
class Database {
    // Properti (variabel) untuk menyimpan konfigurasi / kredensial database
    private $host = "localhost";
    private $db_name = "db_akademik";
    private $username = "root";
    private $password = "";
    
    // Properti public untuk menampung objek koneksi (PDO)
    public $conn;

    // Method yang dipanggil ketika kita membutuhkan koneksi ke database
    public function getConnection() {
        // Kosongkan koneksi sebelumnya (jika ada) untuk memastikan koneksi yang fresh
        $this->conn = null;
        
        try {
            // Membuat instance / objek PDO baru untuk koneksi ke MySQL menggunakan DSN (Data Source Name)
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Mengatur mode error PDO menjadi Exception agar jika ada error query, program melempar pengecualian (Exception) yang bisa ditangkap (catch)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            // Menangkap dan menampilkan pesan error jika koneksi gagal (misal: server database mati atau password salah)
            echo "Connection error: " . $exception->getMessage();
        }
        
        // Mengembalikan objek koneksi agar bisa digunakan oleh file/kelas lain (seperti MahasiswaModel)
        return $this->conn;
    }
}
?>