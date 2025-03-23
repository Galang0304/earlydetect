<?php
session_start();

// Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "Anda tidak memiliki izin untuk mengakses halaman ini.";
    header("Location: admin_login.php");
    exit();
}

include 'config/database.php';

// Validasi parameter user_id
if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    $_SESSION['error'] = "ID pengguna tidak valid.";
    header("Location: manage_users.php");
    exit();
}

$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

// Hapus hasil skrining terkait pengguna terlebih dahulu
$delete_results_query = "DELETE FROM quiz_results WHERE user_id = ?";
$stmt_results = mysqli_prepare($conn, $delete_results_query);
mysqli_stmt_bind_param($stmt_results, "i", $user_id);
mysqli_stmt_execute($stmt_results);

// Hapus pengguna
$delete_user_query = "DELETE FROM users WHERE id = ?";
$stmt_user = mysqli_prepare($conn, $delete_user_query);
mysqli_stmt_bind_param($stmt_user, "i", $user_id);

if (mysqli_stmt_execute($stmt_user)) {
    $_SESSION['success'] = "Pengguna berhasil dihapus beserta semua hasil skriningnya.";
} else {
    $_SESSION['error'] = "Gagal menghapus pengguna. " . mysqli_error($conn);
}

header("Location: manage_users.php");
exit();
?> 