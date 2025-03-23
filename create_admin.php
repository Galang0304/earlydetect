<?php
require_once 'config/database.php';

$username = 'admin2';
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $username, $hashed_password);

if(mysqli_stmt_execute($stmt)) {
    echo "Admin berhasil ditambahkan!\n";
    echo "Username: " . $username . "\n";
    echo "Password: " . $password . "\n";
} else {
    echo "Gagal menambahkan admin: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
closeConnection();
?> 