<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Ekle</title>
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
        header {
            background-color: #14171C;
            color: white;
            padding: 0px 0;
            text-align: center;
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
            background-color: #1c1e22;
            color: #f5f5f5;
            margin: 10% auto;
            padding: 20px;
            border: none;
            border-radius: 8px;
            width: 350px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        /* Modal Kapatma Butonu */
        .close {
            color: #888;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: #bbb;
            cursor: pointer;
        }
        /* Genel sayfa düzeni */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
<div class="container">
        <header>
        <div style="display: flex; align-items: center;">
        <img src="logo/logo0.png" alt="Sinema Logo" style="width: 50px; height: auto; margin-right: 0px;">
        <h1><a href="index.php" style="color: white; text-decoration: none;">Sinema Arşivi</a></h1>
            <nav>
                <ul>
                    <?php if (isset($_SESSION['username'])): ?>
                    <!-- Kullanıcı giriş yaptıysa çıkış butonu göster -->
                    <li><a href="cikis.php" class="button">ÇIKIŞ YAP</a></li>
                    <?php else: ?>
                    <li><a href="#" id="loginBtn" class="button">GİRİŞ YAP</a></li>
                    <li><a href="#" id="registerBtn" class="button">KAYIT OL</a></li> 
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
