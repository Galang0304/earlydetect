<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Konfigurasi database
define('DB_HOST', 'sql202.infinityfree.com');
define('DB_USER', 'if0_38452195');
define('DB_PASS', '7yu7RH6wjmJ');
define('DB_NAME', 'if0_38452195_earlydetect1');

// Buat koneksi menggunakan mysqli
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set karakter encoding
if (!mysqli_set_charset($conn, "utf8mb4")) {
    die("Error setting charset utf8mb4: " . mysqli_error($conn));
}

// Set timezone
mysqli_query($conn, "SET time_zone = '+07:00'");

// Fungsi untuk membersihkan koneksi
function closeConnection() {
    global $conn;
    if ($conn) {
        mysqli_close($conn);
    }
}

// Register fungsi cleanup
register_shutdown_function('closeConnection');
?> 