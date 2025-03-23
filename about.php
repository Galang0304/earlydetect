<?php 
session_start();
include 'includes/header.php'; 
?>

<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <div class="flex justify-center items-center">
                    <img src="assets/images/logo-header.png" alt="EarlyDetect Logo" class="h-32 w-32">
                </div>
                <h1 class="text-4xl font-bold text-gray-800">Profil Pengembang</h1>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-12" role="alert">
                <p class="text-yellow-700">
                    Skrining ini bukan alat diagnosis. Hasil positif tidak berarti anak Anda pasti memiliki ASD, dan hasil negatif tidak menjamin anak Anda tidak memiliki ASD. Jika Anda memiliki kekhawatiran tentang perkembangan anak Anda, selalu konsultasikan dengan profesional kesehatan.
                </p>
            </div>

            <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Profil Pengembang</h1>
            
            <div class="bg-white shadow-xl rounded-2xl p-8 mb-12">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="w-64 h-64 rounded-full overflow-hidden shadow-lg">
                        <img src="assets/images/galang.jpg" alt="Andi Arya Galang" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-blue-600 mb-4">Andi Arya Galang</h2>
                        <div class="space-y-2">
                            <p class="text-gray-700">
                                <strong>Profesi:</strong> Frontend & Mobile Developer
                            </p>
                            <p class="text-gray-700">
                                <strong>Spesialisasi:</strong> Web Development, Mobile Apps
                            </p>
                            <div class="flex flex-col space-y-2 mt-4">
                                <a href="https://instagram.com/_andigalang_" target="_blank" class="flex items-center text-gray-700 hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                    @_andigalang_
                                </a>
                                <a href="mailto:andiariegalang@gmail.com" class="flex items-center text-gray-700 hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    andiariegalang@gmail.com
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-8 mb-12">
                <h2 class="text-2xl font-bold text-blue-600 mb-6">Motivasi Pengembangan</h2>
                <p class="text-gray-700 mb-4">
                    Sebagai seorang developer independen, saya mengembangkan aplikasi EarlyDetect dengan tujuan untuk memberikan solusi teknologi yang dapat membantu orangtua dan tenaga kesehatan dalam mendeteksi dini gejala Autism Spectrum Disorder (ASD) pada balita.
                </p>
                <p class="text-gray-700">
                    Dengan menggunakan metode M-CHAT-R/F yang teruji, aplikasi ini diharapkan dapat menjadi alat yang mudah diakses dan efektif dalam memahami perkembangan anak dan mendorong intervensi dini yang tepat.
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