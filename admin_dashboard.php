<?php
session_start();

// Set timezone untuk Indonesia/Jakarta
date_default_timezone_set('Asia/Jakarta');

if(!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/database.php';
include 'includes/header.php';

// Set timezone di level MySQL juga
mysqli_query($conn, "SET time_zone = '+07:00'");

// Mengambil total pengguna
$total_users_query = "SELECT COUNT(*) as total FROM users";
$total_users_result = mysqli_query($conn, $total_users_query);
$total_users = mysqli_fetch_assoc($total_users_result)['total'];

// Mengambil total skrining
$total_screenings_query = "SELECT COUNT(*) as total FROM quiz_results";
$total_screenings_result = mysqli_query($conn, $total_screenings_query);
$total_screenings = mysqli_fetch_assoc($total_screenings_result)['total'];

// Mengambil total risiko tinggi
$high_risk_query = "SELECT COUNT(*) as total FROM quiz_results WHERE risk_level = 'TINGGI'";
$high_risk_result = mysqli_query($conn, $high_risk_query);
$high_risk_count = mysqli_fetch_assoc($high_risk_result)['total'];

// Mengambil data skrining terbaru
$recent_screenings_query = "SELECT qr.*, u.username, 
                          DATE_FORMAT(CONVERT_TZ(qr.created_at, '+00:00', '+07:00'), '%d/%m/%Y %H:%i') as formatted_date
                          FROM quiz_results qr 
                          JOIN users u ON qr.user_id = u.id 
                          ORDER BY qr.created_at DESC 
                          LIMIT 10";
$recent_screenings_result = mysqli_query($conn, $recent_screenings_query);
$recent_screenings = [];
while($row = mysqli_fetch_assoc($recent_screenings_result)) {
    $recent_screenings[] = $row;
}

$active_tab = $_GET['tab'] ?? 'results';
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$results_query = "
    SELECT 
        u.username,
        u.email,
        qr.id,
        qr.total_score,
        qr.risk_level,
        DATE_FORMAT(qr.created_at, '%d/%m/%Y %H:%i') as test_date
    FROM quiz_results qr
    JOIN users u ON qr.user_id = u.id
    WHERE u.username LIKE '%$search%' OR u.email LIKE '%$search%'
    ORDER BY qr.created_at DESC";

$results = mysqli_query($conn, $results_query);
?>

<!-- Header Section -->
<nav class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <div class="flex items-center mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-white">Dashboard Perawat</h1>
            </div>
            <div class="flex items-center space-x-4">
                <a href="manage_users.php" class="flex items-center text-white hover:text-blue-200 transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Manajemen Pengguna
                </a>
                <a href="admin_logout.php" class="flex items-center text-white hover:text-blue-200 transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Search Bar -->
    <div class="mb-8">
        <form method="GET" class="flex gap-4">
            <input type="text" 
                   name="search" 
                   value="<?php echo htmlspecialchars($search); ?>" 
                   placeholder="Cari nama atau email pasien..." 
                   class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Cari
            </button>
            <?php if($search): ?>
                <a href="admin_dashboard.php" 
                   class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-300">
                    Reset
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500">Total Pengguna</p>
                    <p class="text-2xl font-semibold"><?php echo $total_users; ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500">Total Skrining</p>
                    <p class="text-2xl font-semibold"><?php echo $total_screenings; ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500">Risiko Tinggi</p>
                    <p class="text-2xl font-semibold"><?php echo $high_risk_count; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Hasil Skrining Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAMA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">EMAIL</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TANGGAL TES</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKOR</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RISIKO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AKSI</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php while($row = mysqli_fetch_assoc($results)): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['username']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($row['email']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo $row['test_date']; ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium"><?php echo $row['total_score']; ?>/20</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php
                                $risk_class = 'bg-green-100 text-green-800';
                                if ($row['risk_level'] === 'TINGGI') {
                                    $risk_class = 'bg-red-100 text-red-800';
                                } else if ($row['risk_level'] === 'MEDIUM') {
                                    $risk_class = 'bg-yellow-100 text-yellow-800';
                                }
                                ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $risk_class; ?>">
                                    <?php echo $row['risk_level']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <a href="view_result.php?id=<?php echo $row['id']; ?>" 
                                       class="text-blue-600 hover:text-blue-900">
                                        Lihat Detail
                                    </a>
                                    <a href="delete_screening.php?result_id=<?php echo $row['id']; ?>" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus hasil skrining ini?');"
                                       class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Export Button -->
    <div class="mt-8 flex justify-end">
        <a href="export_results.php" 
           class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Export Data
        </a>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 