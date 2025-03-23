<?php
session_start();
include 'includes/header.php';
?>

<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-12" role="alert">
                <p class="text-yellow-700">
                    Skrining ini bukan alat diagnosis. Hasil positif tidak berarti anak Anda pasti memiliki ASD, dan hasil negatif tidak menjamin anak Anda tidak memiliki ASD. Jika Anda memiliki kekhawatiran tentang perkembangan anak Anda, selalu konsultasikan dengan profesional kesehatan.
                </p>
            </div>

            <div class="text-center mb-12">
                <div class="flex justify-center items-center space-x-8">
                    <img src="assets/images/logo-header.png" alt="EarlyDetect Logo" class="h-32 w-32">
                    <img src="assets/images/logo-header2.png" alt="Kemenkes Poltekkes Makassar Logo" class="h-32 w-32">
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mt-4">Profil Pengembang</h1>
            </div>
            
            <div class="bg-white shadow-xl rounded-2xl p-8 mb-12">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="w-64 h-64 rounded-full overflow-hidden shadow-lg">
                        <img src="assets/images/willyam.jpg" alt="Willyam Wulan Sari" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-blue-600 mb-4">Willyam Wulan Sari</h2>
                        <div class="space-y-2">
                            <p class="text-gray-700">
                                <strong>Institusi:</strong> Kemenkes Poltekkes Makassar
                            </p>
                            <p class="text-gray-700">
                                <strong>Program Studi:</strong> D-III Keperawatan
                            </p>
                            <p class="text-gray-700">
                                <strong>NIM:</strong> PO7132012210087
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-8 mb-12">
                <h2 class="text-2xl font-bold text-blue-600 mb-6">Motivasi Pengembangan</h2>
                <p class="text-gray-700 mb-4">
                    Aplikasi EarlyDetect dikembangkan sebagai upaya untuk membantu orangtua dan tenaga kesehatan dalam mendeteksi dini gejala Autism Spectrum Disorder (ASD) pada balita.
                </p>
                <p class="text-gray-700">
                    Dengan menggunakan metode M-CHAT-R/F yang teruji, kami berharap dapat memberikan bantuan awal dalam memahami perkembangan anak dan mendorong intervensi dini yang tepat.
                </p>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-blue-600 mb-6">Metode Skrining</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <svg class="h-12 w-12 text-blue-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="font-bold text-lg mb-2">M-CHAT-R/F</h3>
                        <p class="text-sm text-gray-700">
                            Menggunakan Modified Checklist for Autism in Toddlers, Revised with Follow-Up (M-CHAT-R/F)
                        </p>
                    </div>
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <svg class="h-12 w-12 text-blue-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="font-bold text-lg mb-2">Usia Target</h3>
                        <p class="text-sm text-gray-700">
                            Dirancang untuk anak usia 16-30 bulan
                        </p>
                    </div>
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <svg class="h-12 w-12 text-blue-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <h3 class="font-bold text-lg mb-2">Akurasi Tinggi</h3>
                        <p class="text-sm text-gray-700">
                            Metode yang teruji secara klinis dengan tingkat akurasi tinggi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 