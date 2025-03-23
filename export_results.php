<?php
session_start();

if(!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/database.php';

// Set header untuk download file Excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="hasil_skrining_'.date('d-m-Y').'.xls"');
header('Cache-Control: max-age=0');

// Query untuk mengambil semua data skrining
$sql = "SELECT u.username, u.email, 
        qr.total_score, qr.risk_level,
        DATE_FORMAT(qr.created_at, '%d/%m/%Y %H:%i') as tanggal
        FROM quiz_results qr 
        JOIN users u ON qr.user_id = u.id 
        ORDER BY qr.created_at DESC";

$result = mysqli_query($conn, $sql);

// Output header Excel
echo '<table border="1">';
echo '<tr>';
echo '<th>Nama</th>';
echo '<th>Email</th>';
echo '<th>Skor</th>';
echo '<th>Tingkat Risiko</th>';
echo '<th>Tanggal Skrining</th>';
echo '</tr>';

// Output data
while($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['username']) . '</td>';
    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
    echo '<td>' . $row['total_score'] . '</td>';
    echo '<td>' . $row['risk_level'] . '</td>';
    echo '<td>' . $row['tanggal'] . '</td>';
    echo '</tr>';
}

echo '</table>';
?> 