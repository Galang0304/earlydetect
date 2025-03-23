<?php
session_start();

// Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "Anda tidak memiliki izin untuk mengakses halaman ini.";
    header("Location: admin_login.php");
    exit();
}

include 'config/database.php';

// Validasi parameter result_id
if (!isset($_GET['result_id']) || empty($_GET['result_id'])) {
    $_SESSION['error'] = "ID hasil skrining tidak valid.";
    header("Location: admin_dashboard.php");
    exit();
}

$result_id = mysqli_real_escape_string($conn, $_GET['result_id']);

// Hapus hasil skrining
$delete_result_query = "DELETE FROM quiz_results WHERE id = ?";
$stmt = mysqli_prepare($conn, $delete_result_query);
mysqli_stmt_bind_param($stmt, "i", $result_id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Hasil skrining berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus hasil skrining. " . mysqli_error($conn);
}

header("Location: admin_dashboard.php");
exit();
?> 