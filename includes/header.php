<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Early Detect - Deteksi Dini Autisme</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/images/logo-header.png">
    <meta name="description" content="EarlyDetect - Aplikasi deteksi dini autisme pada balita menggunakan metode M-CHAT-R/F. Dikembangkan oleh Andi Arya Galang dari Informatika Universitas Muhammadiyah Makassar.">
    <meta name="keywords" content="deteksi dini autisme, skrining autisme, M-CHAT-R/F, gangguan spektrum autis, kesehatan anak">
    <meta name="author" content="Andi Arya Galang - Informatika UNISMUH Makassar">
    <meta name="robots" content="index, follow">
    <style>
        @media (max-width: 768px) {
            .mobile-menu {
                display: none;
            }
            .mobile-menu.active {
                display: block;
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center">
                        <img src="assets/images/logo-nav.png" alt="EarlyDetect Logo" class="h-12 w-12 mr-3">
                        <span class="font-bold text-xl text-blue-600">EarlyDetect</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:items-center md:space-x-4 lg:space-x-6">
                    <a href="index.php" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Beranda</a>
                    <a href="quiz.php" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Kuis</a>
                    <a href="about.php" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Tentang</a>
                    
                    <?php if(!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])): ?>
                        <a href="admin_login.php" class="text-green-600 hover:text-green-700 px-3 py-2 rounded-md text-sm font-medium flex items-center transition duration-300">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Login Perawat
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Desktop Login/Register -->
                <div class="hidden md:flex md:items-center md:space-x-2">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <span class="text-gray-600 mr-4">Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">Logout</a>
                    <?php elseif(!isset($_SESSION['admin_id'])): ?>
                        <a href="login.php" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium mr-2">Login</a>
                        <a href="register.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Register</a>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="mobile-menu-button text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600" onclick="toggleMenu()">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu md:hidden absolute w-full bg-white shadow-lg" style="display: none;">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="index.php" class="text-gray-600 hover:bg-gray-100 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
                <a href="quiz.php" class="text-gray-600 hover:bg-gray-100 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Kuis</a>
                <a href="about.php" class="text-gray-600 hover:bg-gray-100 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Tentang</a>
                
                <?php if(!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])): ?>
                    <a href="admin_login.php" class="text-green-600 hover:bg-green-50 hover:text-green-700 block px-3 py-2 rounded-md text-base font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Login Perawat
                    </a>
                <?php endif; ?>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-center px-5">
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?></div>
                            </div>
                        </div>
                        <div class="mt-3 px-2">
                            <a href="logout.php" class="block w-full bg-red-500 text-white text-center px-4 py-2 rounded-lg hover:bg-red-600">Logout</a>
                        </div>
                    </div>
                <?php elseif(!isset($_SESSION['admin_id'])): ?>
                    <div class="border-t border-gray-200 pt-4 space-y-2">
                        <a href="login.php" class="block w-full text-center text-blue-600 border border-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50">Login</a>
                        <a href="register.php" class="block w-full text-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Register</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Spacer untuk navbar fixed -->
    <div class="h-16"></div>

    <main class="flex-grow">

    <script>
        function toggleMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            mobileMenu.style.display = mobileMenu.style.display === 'none' ? 'block' : 'none';
        }

        // Menutup menu mobile saat mengklik di luar menu
        document.addEventListener('click', function(event) {
            const mobileMenu = document.querySelector('.mobile-menu');
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.style.display = 'none';
            }
        });
    </script>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "EarlyDetect",
      "description": "Aplikasi deteksi dini autisme pada balita menggunakan metode M-CHAT-R/F",
      "url": "https://earlydetect.ct.ws/",
      "applicationCategory": "Kesehatan",
      "operatingSystem": "Web Browser"
    }
    </script>
</body>
</html> 