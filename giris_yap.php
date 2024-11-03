<?php
include 'db.php';
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$errorMessage = ""; // Hata mesajı için değişken

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Kullanıcı adı ve şifreyi kontrol et
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Şifre kontrolü
        if (password_verify($inputPassword, $user['password'])) {
            // Giriş başarılı, oturumu başlat
            $_SESSION['username'] = $user['username'];
            header("Location: index.php"); // Ana sayfaya yönlendir
            exit();
        } else {
            $errorMessage = "Yanlış şifre.";
        }
    } else {
        $errorMessage = "Kullanıcı bulunamadı.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
</head>
<body>
    <form method="POST" action="giris_yap.php">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Şifre:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Giriş Yap</button>
    </form>
    <?php if ($errorMessage): ?>
        <p style="color:red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
</body>
</html>
