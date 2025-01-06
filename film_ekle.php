<?php
session_start(); 



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
    padding-left: 20px;
    font-family: 'Sharp Grotesk SmBold 20 Regular', sans-serif;
    padding-right: 50px;
}

header nav ul {
    list-style: none;
    padding: 0;
    text-align: center;
    font-family: 'Sharp Grotesk SmBold 20 Regular', sans-serif;
}

header nav ul li {
    display: inline;
    margin-right: 15px;
}

header nav ul li a {
    color: #556678;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

header nav ul li a:hover {
    color: #fff;
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
/* Giriş Modalı */
.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: none;
    background-color: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
}

.modal-content {
    position: relative;
    background-color: #1c1e22;
    color: #f5f5f5;
    margin: 10% auto;
    padding: 20px;
    border: none;
    border-radius: 10px;
    width: 400px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
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
    background-color: #2c3e50;
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
    background-color: #3498db;
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
    background-color: #2980b9;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    color: #ccc;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s ease;
}

.close:hover {
    color: #fff;
}

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
    </style>
</head>
<body>
<div class="container">
        <header>
        <div style="display: flex; align-items: center;">
        <!-- <img src="logo/logo0.png" alt="Sinema Logo" style="width: 50px; height: auto; margin-right: 0px;"> -->
        <h1><a href="index.php" style="color: white; text-decoration: none;">Beyazperde</a></h1>
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
                    <label for="tur">Türler:</label>
                    <input type="text" name="tur" required>
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

<!-- Giriş Modalı -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method="POST" action="giris_yap.php">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" name="username" required>
            <label for="password">Şifre:</label>
            <input type="password" name="password" required>
            <button type="submit">Giriş Yap</button>
        </form>
    </div>
</div>


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
        // PHP'den kullanıcı adını al
        <?php if (isset($_SESSION['username'])): ?>
            var username = "<?php echo $_SESSION['username']; ?>";
            document.getElementById("welcomeMessage").innerHTML = "Sefalar getirdiniz, " + username + ", iyi eğlenceler!";
        <?php endif; ?>

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
