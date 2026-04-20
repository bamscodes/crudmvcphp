<?php
// Kelas MahasiswaModel bertugas untuk mengelola komunikasi langsung dengan database,
// khususnya untuk tabel 'mahasiswa'. File ini merepresentasikan 'Model' dalam pola MVC.
class MahasiswaModel {
    // Properti untuk menyimpan koneksi database dan nama tabel
    private $conn;
    private $table_name = "mahasiswa";

    // Konstruktor akan menerima koneksi database dari Controller saat objek Model diinisiasi
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read Data & Search: Mengambil semua data atau mencari berdasarkan keyword
    public function read($keyword = "") {
        // Query dasar untuk mengambil semua data
        $query = "SELECT * FROM " . $this->table_name;
        
        // Jika ada keyword pencarian, tambahkan klausa WHERE
        if($keyword != "") {
            $query .= " WHERE nama LIKE :keyword OR nim LIKE :keyword";
        }
        // Urutkan data berdasarkan ID secara menurun (data terbaru di atas)
        $query .= " ORDER BY id DESC";

        // Siapkan statement query (Penting untuk keamanan / Mencegah SQL Injection)
        $stmt = $this->conn->prepare($query);
        
        // Jika ada keyword, bind (ikat) parameter :keyword dengan nilai string pencarian
        if($keyword != "") {
            $keyword = "%{$keyword}%";
            $stmt->bindParam(':keyword', $keyword);
        }
        
        // Eksekusi query dan kembalikan statement
        $stmt->execute();
        return $stmt;
    }

    // Get Single Data: Mengambil satu baris data spesifik berdasarkan ID (digunakan untuk form Edit)
    public function show($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        // Bind parameter ID ke tanda tanya (?) pada query
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        // Mengembalikan hasil dalam bentuk array asosiatif
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create Data: Menambahkan data mahasiswa baru ke tabel database
    public function create($nim, $nama, $kelas, $nilai_tugas) {
        // Query INSERT dengan parameter penampung (:nim, :nama, dll)
        $query = "INSERT INTO " . $this->table_name . " SET nim=:nim, nama=:nama, kelas=:kelas, nilai_tugas=:nilai_tugas";
        $stmt = $this->conn->prepare($query);

        // Bind data dari form ke parameter query untuk mencegah eksekusi kode berbahaya (SQL Injection)
        $stmt->bindParam(":nim", $nim);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":kelas", $kelas);
        $stmt->bindParam(":nilai_tugas", $nilai_tugas);

        // Eksekusi query dan kembalikan nilai boolean (true/false) tergantung keberhasilan
        return $stmt->execute();
    }

    // Update Data: Memperbarui data mahasiswa yang sudah ada berdasarkan ID
    public function update($id, $nim, $nama, $kelas, $nilai_tugas) {
        $query = "UPDATE " . $this->table_name . " SET nim=:nim, nama=:nama, kelas=:kelas, nilai_tugas=:nilai_tugas WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Bind data baru beserta ID-nya sebagai acuan klausa WHERE
        $stmt->bindParam(":nim", $nim);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":kelas", $kelas);
        $stmt->bindParam(":nilai_tugas", $nilai_tugas);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    // Delete Data: Menghapus data dari tabel berdasarkan ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        // Bind parameter ID ke tanda tanya (?)
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>
