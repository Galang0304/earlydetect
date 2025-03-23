<?php
session_start();
require_once 'config/database.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID hasil dari parameter URL
$result_id = $_GET['id'] ?? null;
if (!$result_id) {
    $_SESSION['error'] = "ID hasil tidak ditemukan";
    header("Location: dashboard.php");
    exit;
}

// Ambil data hasil dari database
$sql = "SELECT * FROM quiz_results WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $result_id, $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$screening = mysqli_fetch_assoc($result);

if (!$screening) {
    $_SESSION['error'] = "Hasil tidak ditemukan";
    header("Location: dashboard.php");
    exit;
}

include 'includes/header.php';

// Tentukan warna berdasarkan risk level
$risk_color = 'bg-green-100 text-green-800';
if ($screening['risk_level'] === 'TINGGI') {
    $risk_color = 'bg-red-100 text-red-800';
} else if ($screening['risk_level'] === 'MEDIUM') {
    $risk_color = 'bg-yellow-100 text-yellow-800';
}
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8">Hasil Screening</h1>
        
        <!-- Tampilkan skor -->
        <div class="mb-8">
            <div class="<?php echo $risk_color; ?> rounded-lg p-6 text-center">
                <h2 class="text-2xl font-semibold mb-2">Skor Total</h2>
                <p class="text-4xl font-bold mb-4"><?php echo $screening['total_score']; ?> / 20</p>
                <p class="text-xl font-medium">Tingkat Risiko: <?php echo $screening['risk_level']; ?></p>
            </div>
        </div>
        
        <!-- Interpretasi -->
        <div class="bg-white rounded-lg p-6 mb-8 shadow">
            <h2 class="text-xl font-semibold mb-4">Interpretasi Hasil</h2>
            <p class="mb-4">
                <?php if ($screening['risk_level'] === 'RENDAH'): ?>
                    Berdasarkan hasil screening, tingkat risiko Anda tergolong RENDAH. Ini menunjukkan bahwa perkembangan anak Anda berada dalam jalur yang baik.
                <?php elseif ($screening['risk_level'] === 'MEDIUM'): ?>
                    Berdasarkan hasil screening, tingkat risiko Anda tergolong SEDANG. Disarankan untuk melakukan pemeriksaan lanjutan dengan tenaga kesehatan.
                <?php else: ?>
                    Berdasarkan hasil screening, tingkat risiko Anda tergolong TINGGI. Sangat disarankan untuk segera berkonsultasi dengan tenaga kesehatan profesional.
                <?php endif; ?>
            </p>
        </div>
        
        <!-- Rekomendasi -->
        <div class="bg-white rounded-lg p-6 mb-8 shadow">
            <h2 class="text-xl font-semibold mb-4">Rekomendasi</h2>
            <ul class="list-disc pl-6 space-y-2">
                <?php if ($screening['risk_level'] === 'RENDAH'): ?>
                    <li>Lanjutkan pemantauan perkembangan anak secara rutin</li>
                    <li>Tetap lakukan stimulasi sesuai usia anak</li>
                    <li>Lakukan screening ulang setiap 6 bulan</li>
                <?php elseif ($screening['risk_level'] === 'MEDIUM'): ?>
                    <li>Konsultasikan hasil ini dengan tenaga kesehatan</li>
                    <li>Tingkatkan intensitas stimulasi pada anak</li>
                    <li>Lakukan screening ulang dalam 3 bulan</li>
                <?php else: ?>
                    <li>Segera kunjungi tenaga kesehatan profesional</li>
                    <li>Ikuti program intervensi dini yang direkomendasikan</li>
                    <li>Lakukan pemeriksaan menyeluruh</li>
                <?php endif; ?>
            </ul>
        </div>
        
        <!-- Peringatan -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Hasil screening ini bukan diagnosis medis. Selalu konsultasikan dengan tenaga kesehatan profesional untuk evaluasi lebih lanjut.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Tombol aksi -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="quiz.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg text-center transition duration-200">
                Ulangi Screening
            </a>
            <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg text-center transition duration-200">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 