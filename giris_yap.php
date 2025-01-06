<?php
include 'db.php';
session_start();

$errorMessage = ""; // Hata mesajı için değişken

// Form verileri POST ile gönderildi mi kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
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
    <link rel="stylesheet" href="style.css">
    <style>
       body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 400px;
    margin: 100px auto;
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 2rem;
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.input-field {
    margin-bottom: 20px;
    width: 100%;
}

.input-field label {
    font-size: 1rem;
    color: #333;
    margin-bottom: 5px;
    display: block;
}

.input-field input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    color: #333;
    font-size: 1rem;
    box-sizing: border-box; /* Inputların box modelini düzenler */
}

.input-field input:focus {
    outline: none;
    border-color: #5c8e8c;
}

.submit-btn {
    width: 100%;
    padding: 10px;
    background-color: #5c8e8c;
    color: #fff;
    font-size: 1.1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-sizing: border-box; /* Butonun da box modelini düzenler */
}

.submit-btn:hover {
    background-color: #4b7a7a;
}

.error-message {
    color: #ff4d4d;
    text-align: center;
    font-size: 1rem;
    margin-top: 20px;
}

.back-link {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #ccc;
    color: #333;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    text-align: center;
}

.back-link:hover {
    background-color: #bbb;
}

@media screen and (max-width: 768px) {
    .container {
        padding: 20px;
    }

    h1 {
        font-size: 1.8rem;
    }
}
    </style>
</head>
<body>

    <div class="container">
        <h1>Giriş Yap</h1>
        <form method="POST" action="giris_yap.php">
            <div class="input-field">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-field">
                <label for="password">Şifre</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="submit-btn">Giriş Yap</button>
        </form>
        
        <?php if ($errorMessage): ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        
        <a class="back-link" href="index.php">Ana Sayfaya Dön</a>
    </div>

</body>
</html>
