<?php
// Tampilkan error jika ada masalah syntax
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'controllers/MahasiswaController.php';

// Inisiasi Controller
$controller = new MahasiswaController();

// Mengambil aksi dari URL
$action = $_GET['action'] ?? 'index';

// Simple Routing
switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}
?>