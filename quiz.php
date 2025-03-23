<?php
session_start();

// Set timezone untuk Indonesia/Jakarta
date_default_timezone_set('Asia/Jakarta');

require_once 'config/database.php';

// Set timezone di level MySQL
mysqli_query($conn, "SET time_zone = '+07:00'");

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil semua pertanyaan dari database menggunakan mysqli
$sql = "SELECT * FROM questions ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
$questions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
}

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answers = $_POST['answers'] ?? [];
    
    // Validasi semua pertanyaan dijawab
    if (count($answers) !== count($questions)) {
        $_SESSION['error'] = "Mohon jawab semua pertanyaan.";
        header("Location: quiz.php");
        exit;
    }
    
    // Hitung total skor
    $total_score = 0;
    $failed_questions = [];
    
    foreach ($questions as $question) {
        $answer = $answers[$question['id']] ?? '';
        if ($answer === $question['correct_answer']) {
            $total_score++;
        } else {
            $failed_questions[] = $question['id'];
        }
    }
    
    // Tentukan tingkat risiko
    $risk_level = 'RENDAH';
    if ($total_score <= 10) {
        $risk_level = 'TINGGI';
    } else if ($total_score <= 15) {
        $risk_level = 'MEDIUM';
    }
    
    // Simpan hasil ke database
    $user_id = $_SESSION['user_id'];
    $failed_questions_str = implode(',', $failed_questions);
    
    $sql = "INSERT INTO quiz_results (user_id, total_score, risk_level, failed_questions, created_at) 
            VALUES (?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiss", $user_id, $total_score, $risk_level, $failed_questions_str);
    
    if (mysqli_stmt_execute($stmt)) {
        $result_id = mysqli_insert_id($conn);
        header("Location: result.php?id=" . $result_id);
        exit;
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menyimpan hasil. Detail: " . mysqli_error($conn);
        header("Location: quiz.php");
        exit;
    }
}

include 'includes/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8">Skrining Deteksi Dini Autisme</h1>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-6">
            <?php foreach ($questions as $index => $question): ?>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <p class="text-lg mb-4">
                        <?php echo ($index + 1) . ". " . htmlspecialchars($question['question_text']); ?>
                    </p>
                    
                    <div class="flex space-x-4">
                        <label class="flex-1">
                            <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="Ya" class="hidden">
                            <div class="cursor-pointer p-4 rounded-lg border-2 border-gray-200 hover:border-green-500 transition-all duration-200 text-center group">
                                <span class="text-lg font-medium group-hover:text-green-600">Ya</span>
                            </div>
                        </label>
                        
                        <label class="flex-1">
                            <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="Tidak" class="hidden">
                            <div class="cursor-pointer p-4 rounded-lg border-2 border-gray-200 hover:border-green-500 transition-all duration-200 text-center group">
                                <span class="text-lg font-medium group-hover:text-green-600">Tidak</span>
                            </div>
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-center mt-8">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-medium text-lg">
                    Selesai & Lihat Hasil
                </button>
            </div>
        </form>
    </div>
</div>

<style>
input[type="radio"]:checked + div {
    border-color: #2563eb;
    background-color: #eff6ff;
    color: #2563eb;
}

input[type="radio"] + div:hover {
    border-color: #2563eb;
}
</style>

<?php include 'includes/footer.php'; ?>
