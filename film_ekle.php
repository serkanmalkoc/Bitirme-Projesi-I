<?php
session_start(); 
include 'header.php';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Ekle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://db.onlinewebfonts.com/c/629ed6829f706958b9bdf4f6300dfca0?family=Sharp+Grotesk+SmBold+20+Regular" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
         /* Genel sayfa düzeni */
         body {
            font-family: Arial, sans-serif;
            background-color: #14171C;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .form-section {
            background-color: white;
            padding: 40px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .form-section h2 {
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-group input[type="file"] {
            padding: 5px;
        }

        .form-group textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

    </style>
</head>
<body>
    <section class="form-section">
        <div class="container">
            <h2>Yeni Film Ekle</h2>
            <form action="film_ekle_islem.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="baslik">Film Başlığı:</label>
                    <input type="text" name="baslik" required>
                </div>

                <div class="form-group">
                    <label for="yonetmen">Yönetmen:</label>
                    <input type="text" name="yonetmen" required>
                </div>

                <div class="form-group">
                    <label for="yil">Yıl:</label>
                    <input type="number" name="yil" required>
                </div>

                <div class="form-group">
                    <label for="turler">Türler:</label>
                    <input type="turler" name="Tür" required>
                </div>

                <div class="form-group">
                    <label for="afis">Afiş Yükle:</label>
                    <input type="file" name="afis" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="aciklama">Açıklama:</label>
                    <textarea id="aciklama" name="aciklama" rows="4" cols="50" required></textarea>
                </div>

                <input type="submit" value="Filmi Ekle">
            </form>
        </div>
    </section>
        <!-- Giriş Modalı -->
        <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3<>Giriş Yap</h3>
            <form method="POST" action="giris_yap.php">
                <label for="username">Kullanıcı Adı:</label>
                <input type="text" name="username" required>
                <br>
                <label for="password">Şifre:</label>
                <input type="password" name="password" required>
                <br>
                <button type="submit" class="button">Giriş Yap</button>
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
