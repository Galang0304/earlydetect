<?php
session_start();

if(!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/database.php';
include 'includes/header.php';

if(!isset($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$id = intval($_GET['id']);

// Query untuk mengambil detail hasil skrining
$sql = "SELECT qr.*, u.username, u.email,
        DATE_FORMAT(qr.created_at, '%d/%m/%Y %H:%i') as formatted_date
        FROM quiz_results qr 
        JOIN users u ON qr.user_id = u.id 
        WHERE qr.id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$screening = mysqli_fetch_assoc($result);

if(!$screening) {
    header("Location: admin_dashboard.php");
    exit();
}

function getRiskClass($risk_level) {
    switch($risk_level) {
        case 'RENDAH':
            return 'bg-green-100 text-green-800 border-green-200';
        case 'MEDIUM':
            return 'bg-yellow-100 text-yellow-800 border-yellow-200';
        case 'TINGGI':
            return 'bg-red-100 text-red-800 border-red-200';
        default:
            return 'bg-gray-100 text-gray-800 border-gray-200';
    }
}
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="admin_dashboard.php" class="inline-flex items-center text-blue-600 hover:text-blue-900">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-2xl font-bold text-gray-800">Detail Hasil Skrining</h2>
        </div>

        <div class="p-6">
            <!-- Informasi Pasien -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Pasien</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nama</p>
                        <p class="font-medium"><?php echo htmlspecialchars($screening['username']); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-medium"><?php echo htmlspecialchars($screening['email']); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Skrining</p>
                        <p class="font-medium"><?php echo $screening['formatted_date']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Hasil Skrining -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Hasil Skrining</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 rounded-lg <?php echo getRiskClass($screening['risk_level']); ?> border">
                        <p class="text-sm font-medium mb-1">Total Skor</p>
                        <p class="text-3xl font-bold"><?php echo $screening['total_score']; ?> / 20</p>
                    </div>
                    <div class="p-4 rounded-lg <?php echo getRiskClass($screening['risk_level']); ?> border">
                        <p class="text-sm font-medium mb-1">Tingkat Risiko</p>
                        <p class="text-3xl font-bold"><?php echo $screening['risk_level']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Rekomendasi -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Rekomendasi</h3>
                <div class="p-4 rounded-lg bg-blue-50 border border-blue-200">
                    <?php if($screening['risk_level'] == 'RENDAH'): ?>
                        <p class="text-blue-800">
                            Jika anak lebih muda dari 24 bulan, lakukan skrining lagi setelah ulang tahun kedua. 
                            Tidak ada tindakan lanjutan yang diperlukan, kecuali surveilans untuk mengindikasikan risiko ASD.
                        </p>
                    <?php elseif($screening['risk_level'] == 'MEDIUM'): ?>
                        <p class="text-blue-800">
                            Lakukan Follow-up (M-CHAT-R/F tahap kedua) untuk mendapat informasi tambahan tentang respon berisiko. 
                            Disarankan untuk melakukan evaluasi diagnostik dan evaluasi eligibilitas untuk intervensi awal.
                        </p>
                    <?php else: ?>
                        <p class="text-blue-800">
                            Follow-up dapat tidak dilakukan dan pasien dirujuk segera untuk evaluasi diagnostik dan 
                            evaluasi eligibilitas untuk intervensi awal. Sangat disarankan untuk segera berkonsultasi 
                            dengan dokter anak.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 