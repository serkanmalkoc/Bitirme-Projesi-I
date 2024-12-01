<?php 
session_start(); // Oturumu başlatıyoruz
include 'db.php'; // Veritabanı bağlantısı

// Yeni eklenen filmleri veritabanından çekelim
$sql = "SELECT * FROM filmler ORDER BY eklenme_tarihi DESC LIMIT 5";
$result = $conn->query($sql);
if (!$result) {
    die("Sorgu başarısız: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinema Arşivi - Ana Sayfa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://db.onlinewebfonts.com/c/629ed6829f706958b9bdf4f6300dfca0?family=Sharp+Grotesk+SmBold+20+Regular" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Style dosyanız -->
    <style>
* {
    box-sizing: border-box;
}
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #14171C;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0px;
        }
        header {
            background-color: #14171C;
            color: white;
            padding: 10px 20px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        } 
        header h1 {
            color: #fff;
            text-align: left;
            padding-left: 20px; /* Sol taraftan biraz boşluk ekleyebilirsin */
            font-family: 'Sharp Grotesk SmBold 20 Regular', sans-serif; /* Fontu kullan */
            padding-right: 50px;
        }
        header nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
            font-family: 'Sharp Grotesk SmBold 20 Regular', sans-serif; /* Fontu kullan */
        }
        header nav ul li {
            display: inline;
            margin-right: 15px;
        }
        header nav ul li a {
            color: #556678;   
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s; /* Geçiş efekti */
        }
        header nav ul li a:hover {
            color: #fff; /* Üzerine gelindiğinde beyaz renk */
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        h1 {
            margin: 0;
        }
        section {
            margin: 20px 0;
            text-align: center;
        }
        h2 {
            margin: 10;
            font-size: 24px;
            color: #fff;
        }
        /* Film listesi stilleri */
        .film-list {
            display: flex;
            flex-wrap: nowrap; /* Tek satırda tutmak için */
            gap: 20px;
            justify-content: center; /* Filmleri sola yasla */
        }
        .film-item {
            background: #14171C;
            border-radius: 8px;
            overflow: hidden;
            width: 220px;
            margin: 0 2px; /* Yanlara çok az margin verin */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-decoration: none; /* Link alt çizgisini kaldırır */
        }

        .film-item:hover {
            transform: scale(1.05);
        }

        .film-item img {
            width: 100%;
            height: auto;
        }

        .film-item h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #fff;
        }

        .film-item p {
            margin: 5px 0;
            font-size: 14px;
            color: #fff;
        }

        .film-item a {
            display: block;
            padding: 10px;
            background: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 0 0 8px 8px;
        }

        .film-item a:hover {
            background: #45a049;
        }

        /* Giriş Modalı */
        .modal {
            position: fixed;
            z-index: 1;
            left: 50;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            display: none;
        }
        /* İçerik kısmı */
        
        .modal-content {
            position: relative; /* Modal içeriğini bağlamak için relative konumu kullanın */
            background-color: #1c1e22;
            color: #f5f5f5;
            margin: 10% auto; /* Ekran ortasına yerleştirme */
            padding: 20px;
            border: none;
            border-radius: 10px;
            width: 540px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: fadeIn 0.3s ease-in-out;
        }
        
        .modal-content h3 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #E5E7EB;
        }
        .modal-content label {
            font-size: 14px;
            color: #A1A1AA;
            display: block;
            margin-bottom: 8px;
            text-align: left;
        }
        
        .modal-content input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            background-color: #1F2937;
            color: #E5E7EB;
            font-size: 14px;
            outline: none;
            transition: border 0.3s ease;
            border: 1px solid #4B5563;
        }
        
        .modal-content input:focus {
            border-color: #3B82F6;
        }

        .modal-content button {
            background-color: #3B82F6;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
            color: white;
        }

        .modal-content button:hover {
            background-color: #2563EB;
        }
        
        /* Modal Kapatma Butonu */
        .close {
            position: absolute; /* Modal içeriğine bağlanması için absolute */
            top: 10px; /* Modal içeriğin üstünden 10px */
            right: 10px; /* Modal içeriğin sağından 10px */
            color: #888;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease; /* Hover geçişi için */
        }
        
        .close:hover {
            color: #fff;
        }

        /* Modal Açılırken Animasyon */
        @keyframes fadeIn {
            from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
        }

        input[type="text"] {
            border: 1px solid #556678; /* Kenar rengi */
            border-radius: 30px; /* Kenar yuvarlama */
            padding: 5px; /* İç boşluk */
            width: 200px; /* Genişlik */
            display: inline-block; /* Inline blok */
        }
        input[type="password"] {
            border: 1px solid #556678; /* Kenar rengi */
            border-radius: 30px; /* Kenar yuvarlama */
            padding: 5px; /* İç boşluk */
            width: 200px; /* Genişlik */
            display: inline-block; /* Inline blok */
        }
        form label {
            display: block;
            font-size: 14px;
            color: #fff; /* Yazı rengini değiştirin */
            margin-bottom: 5px;
        }          
        form input {
            padding: 8px;
            width: 100%;
            max-width: 300px;
        }

        .welcome-message {
            text-align: center;
            margin: 20px 0; /* Header ve filmler arasına boşluk */
            font-size: 16px;
            color: white; /* Yazı rengini beyaz yap */
            font-family: 'Arial', sans-serif; /* Yazı tipini ayarla */
        }

        .welcome-message a {
            color: #4CAF50; /* Linklerin rengi */
            text-decoration: none;
            font-weight: bold;
        }
            
        .welcome-message a:hover {
            color: #45a049; /* Üzerine gelince renk değişimi */
        }
  </style>
</head>
<body>
    <div class="container">
        <header>
        <div style="display: flex; align-items: center;">
        <!-- <img src="logo/logo0.png" alt="Sinema Logo" style="width: 50px; height: auto; margin-right: 0px;"> -->
        <h1><a href="index.php" style="color: white; text-decoration: none;">Sinema Arşivi</a></h1>
            <nav>
                <ul>
                    <?php if (isset($_SESSION['username'])): ?>
                    <!-- Kullanıcı giriş yaptıysa çıkış butonu göster -->
                    <li><a href="cikis.php" class="button">ÇIKIŞ YAP</a></li>
                    <?php else: ?>
                        <li><a href="#" id="loginBtn">GİRİŞ YAP</a></li>
                        <li><a href="#" id="registerBtn">KAYIT OL</a></li>
                    <?php endif; ?>
                        <li><a href="filmler.php">FİLMLER</a></li>
                        <li><a href="film_ekle.php">EKLE</a></li>
                </ul>
            </nav>
                    <!-- Film Arama Formu -->
        <form method="GET" action="film_ara.php" style="display: inline; float: right; margin-left: 20px;">
            <input type="text" name="query" required style="padding: 5px;">
            <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0; margin-left: -30px;">
            <i class="fas fa-search" style="color: #556678; font-size: 20px;"></i> <!-- Arama simgesi -->
            </button>
        </form>
        </header>
        </div>
        <div class="welcome-message">
            <p>Hoş geldiniz, lütfen <a href="#" id="loginBtn">giriş yapınız</a> veya <a href="#" id="registerBtn">kayıt olunuz.</a></p>
        </div>
        <section>
            <h2>Yeni Eklenen Filmler</h2>
            <div class="film-list">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    // Film kartını tıklanabilir bir bağlantıya dönüştürüyoruz
                    echo "<a href='view_movie.php?id=" . $row['id'] . "' class='film-item'>";
                    echo "<img src='" . $row['afis'] . "' alt='" . $row['baslik'] . "'>";
                    echo "<h3>" . $row['baslik'] . "</h3>";
                    echo "<p>Yönetmen: " . $row['yonetmen'] . "</p>";
                    echo "<p>Yıl: " . $row['yil'] . "</p>";
                    echo "</a>";
                    }
                } else {
                    echo "<p>Henüz eklenen film bulunmamaktadır.</p>";
                }
                ?>
            </div>
        </section>
    <!-- Giriş Modalı -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="POST" action="giris_yap.php">
    <div style="display: flex; align-items: center; margin-bottom: 10px; gap: 10px;">
        <div style="display: flex; flex-direction: column;text-align: left;">
            <label for="username" style="margin-bottom: 5px;">Kullanıcı Adı:</label>
            <input type="text" name="username" required>
        </div>
        <div style="display: flex; flex-direction: column;text-align: left;">
            <label for="password" style="margin-bottom: 5px;">Şifre:</label>
            <input type="password" name="password" required>
        </div>
        <button class="submit"><span>Giriş Yap</span></button>
    </div>
</form>

        </div>
    </div>

    <!-- Kayıt Ol Modalı -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Kayıt Ol</h3>
            <form method="POST" action="kayit_ol.php">
                <label for="new_username">Kullanıcı Adı:</label>
                <input type="text" name="username" required>
                <br>
                <label for="new_password">Şifre:</label>
                <input type="password" name="password" required>
                <br>
                <button type="submit" class="button">Kayıt Ol</button>
            </form>
        </div>
    </div>

    <script>
        // Modal açma ve kapama işlemleri
        var loginModal = document.getElementById("loginModal");
        var registerModal = document.getElementById("registerModal");
        var loginBtn = document.getElementById("loginBtn");
        var registerBtn = document.getElementById("registerBtn");
        var closeBtns = document.getElementsByClassName("close");

        // Giriş butonuna tıklandığında giriş modalını aç
        loginBtn.onclick = function() {
            loginModal.style.display = "block";
            registerModal.style.display = "none"; // Kayıt modalını kapat
        }

        // Kayıt ol butonuna tıklandığında kayıt modalını aç
        registerBtn.onclick = function() {
            registerModal.style.display = "block";
            loginModal.style.display = "none"; // Giriş modalını kapat
        }

        // X butonuna tıklandığında her iki modalı kapat
        for (var i = 0; i < closeBtns.length; i++) {
            closeBtns[i].onclick = function() {
                loginModal.style.display = "none";
                registerModal.style.display = "none";
            }
        }

        // Modal dışına tıklanırsa kapat
        window.onclick = function(event) {
            if (event.target == loginModal) {
                loginModal.style.display = "none";
            }
            if (event.target == registerModal) {
                registerModal.style.display = "none";
            }
        }
    </script>
</body>
</html>

<?php
$conn->close(); // Veritabanı bağlantısını kapatma
?>
