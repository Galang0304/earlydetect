<?php 
session_start();
include 'includes/header.php'; 
?>

<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
    <?php if(isset($_SESSION['login_success'])): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 relative" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm">
                        <?php 
                        echo $_SESSION['login_success'];
                        unset($_SESSION['login_success']);
                        ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Hero Section -->
    <div class="container mx-auto px-4 py-16">
        <div class="text-center max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <div class="flex justify-center items-center">
                    <img src="assets/images/logo-header.png" alt="EarlyDetect Logo" class="h-32 w-32">
                </div>
                <h1 class="text-5xl font-bold text-gray-800 mb-6 leading-tight">
                    Deteksi Dini Autisme pada Balita dengan <span class="text-blue-600">EarlyDetect</span>
                </h1>
            </div>
            <p class="text-xl text-gray-600 mb-12 leading-relaxed">
                Gunakan M-CHAT-R/F (Modified Checklist for Autism in Toddlers, Revised with Follow-Up) untuk mengevaluasi 
                risiko Autism Spectrum Disorder (ASD) pada anak Anda.
            </p>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="quiz.php" 
                   class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition duration-300 shadow-lg">
                    <span>Mulai Skrining Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            <?php else: ?>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="login.php" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition duration-300 shadow-lg">
                        <span>Login untuk Mulai</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="register.php" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-50 transition duration-300 shadow-lg border-2 border-blue-600">
                        <span>Daftar Akun Baru</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                        </svg>
                    </a>
                    <a href="admin_login.php" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition duration-300 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        <span>Login Perawat</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mx-auto px-4 py-16">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Mudah Digunakan</h3>
                <p class="text-gray-600">
                    Kuesioner sederhana dengan pertanyaan yang mudah dipahami tentang perilaku anak Anda sehari-hari.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Hasil Instan</h3>
                <p class="text-gray-600">
                    Dapatkan hasil evaluasi dan rekomendasi tindak lanjut segera setelah menyelesaikan kuesioner.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Privasi Terjamin</h3>
                <p class="text-gray-600">
                    Data Anda dilindungi dengan aman dan hanya dapat diakses oleh Anda dan tenaga kesehatan yang berwenang.
                </p>
            </div>
        </div>
    </div>

    <?php if(!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])): ?>
    <!-- Info Sections -->
    <div class="container mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 gap-12">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl shadow-lg">
                <h3 class="text-2xl font-bold text-blue-800 mb-4">Mengapa Perlu Login?</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-blue-600 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-blue-900">Menyimpan riwayat skrining Anda</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-blue-600 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-blue-900">Memantau perkembangan anak secara berkala</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-blue-600 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-blue-900">Mendapatkan rekomendasi yang personal</span>
                    </li>
                </ul>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-2xl shadow-lg">
                <h3 class="text-2xl font-bold text-green-800 mb-4">Akses untuk Perawat</h3>
                <p class="text-green-900 mb-6">
                    Sebagai perawat, Anda dapat mengakses dashboard khusus untuk mengelola dan memantau hasil skrining pasien.
                </p>
                <a href="admin_login.php" 
                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-bold rounded-full hover:bg-green-700 transform hover:scale-105 transition duration-300 shadow-lg">
                    <span>Login sebagai Perawat</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.616a1 1 0 01.894-1.79l1.599.8L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?> 