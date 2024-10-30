<?php
session_start();
include 'db.php'; // db.php dosyasını dahil edin

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı adının veritabanında var olup olmadığını kontrol et
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    if ($stmt === false) {
        die("Sorgu hazırlama hatası: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Bu kullanıcı adı zaten alınmış.";
    } else {
        // Kullanıcıyı kaydet
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $username, $hashed_password);
        
        if ($stmt->execute()) {
            echo "Kullanıcı başarıyla kaydedildi.";
        } else {
            echo "Kullanıcı kaydedilirken bir hata oluştu: " . $stmt->error;
        }
    }

    $stmt->close();
}
$conn->close();
?>

<!-- HTML Formu -->
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
</head>
<body>
    <h2>Kayıt Ol</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Kullanıcı Adı" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <button type="submit">Kayıt Ol</button>
    </form>
</body>
</html>
