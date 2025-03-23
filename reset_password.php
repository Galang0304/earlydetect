<?php
session_start();

if(!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/database.php';
include 'includes/header.php';

$success = '';
$error = '';
$user_data = null;

if(isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    
    // Ambil data user
    $sql = "SELECT username, email FROM users WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $user_data = mysqli_fetch_assoc($result);
        }
        mysqli_stmt_close($stmt);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = intval($_POST['user_id']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $hashed_password, $user_id);
            
            if(mysqli_stmt_execute($stmt)) {
                $success = "Password berhasil direset!";
            } else {
                $error = "Terjadi kesalahan saat mereset password.";
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        $error = "Password baru dan konfirmasi password tidak cocok.";
    }
}
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-8">
        <div class="flex items-center mb-6">
            <a href="admin_dashboard.php?tab=users" class="text-blue-500 hover:text-blue-700 mr-4">
                &larr; Kembali
            </a>
            <h1 class="text-2xl font-bold">Reset Password User</h1>
        </div>
        
        <?php if($user_data): ?>
            <?php if($success): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
            
            <?php if($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <div class="mb-6">
                <p class="text-gray-700">Reset password untuk user:</p>
                <p class="font-semibold"><?php echo htmlspecialchars($user_data['username']); ?></p>
                <p class="text-gray-600"><?php echo htmlspecialchars($user_data['email']); ?></p>
            </div>
            
            <form method="POST" action="">
                <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password">
                        Password Baru
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="new_password" type="password" name="new_password" required>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">
                        Konfirmasi Password Baru
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="confirm_password" type="password" name="confirm_password" required>
                </div>
                
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Reset Password
                    </button>
                </div>
            </form>
        <?php else: ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                User tidak ditemukan.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 