<?php 
session_start(); // Oturumu başlatıyoruz
include 'db.php'; // Veritabanı bağlantısı

// Yeni eklenen filmleri veritabanından çekelim
$sql = "SELECT * FROM filmler ORDER BY eklenme_tarihi DESC LIMIT 5";
$result = $conn->query($sql);
if (!$result) {
    die("Sorgu başarısız: " . $conn->error);
}

// Kullanıcı adı ve şifre doğrulaması
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Burada veritabanında doğrulama yapılır
    // Giriş başarılı ise:
    $_SESSION['username'] = $_POST['username'];
    header('Location: index.php'); // Giriş yapıldıktan sonra ana sayfaya yönlendir
}

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beyaz Perde - Ana Sayfa</title>
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
    flex-wrap: nowrap;
    gap: 20px;
    justify-content: center;
}

.film-item {
    background: #14171C;
    border-radius: 8px;
    overflow: hidden;
    width: 220px;
    margin: 0 2px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
    text-decoration: none;
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

input[type="text"] {
    border: 1px solid #556678;
    border-radius: 30px;
    padding: 5px;
    width: 200px;
    display: inline-block;
}

input[type="password"] {
    border: 1px solid #556678;
    border-radius: 30px;
    padding: 5px;
    width: 200px;
    display: inline-block;
}

form label {
    display: block;
    font-size: 14px;
    color: #fff;
    margin-bottom: 5px;
}

form input {
    padding: 8px;
    width: 100%;
    max-width: 300px;
}

.welcome-message {
    text-align: center;
    margin: 30px 0;
    font-size: 18px;
    color: white;
    font-family: 'Arial', sans-serif;
}

  </style>
</head>
<body>
    <div class="container">
        <header>
        <div style="display: flex; align-items: center;">
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
        <div class="welcome-message">
        <p id="welcomeMessage">
            <?php
            // Eğer oturumda kullanıcı adı varsa, hoş geldiniz mesajını göster
            if (isset($_SESSION['username'])) {
                echo "Başarıyla giriş yaptınız! " . $_SESSION['username'] . " iyi eğlenceler!";
            } else {
                echo "Hoş geldiniz, lütfen giriş yapınız veya kayıt olunuz.";
            }
            ?>
        </p>
    </div>



    <section>
        <h2>En Yüksek Puanlı Filmler</h2>
        <div class='film-list'>
            <?php
            // OMDB API anahtarını ekleyin
            $omdb_key = '83f75584'; // Kendi anahtarınızı buraya koyun

            // En yüksek puanlı filmleri göstermek için yeni bir bölüm
            $sql_top = "SELECT * FROM filmler";
            $result_top = $conn->query($sql_top);

            if ($result_top && $result_top->num_rows > 0) {
                $films_with_ratings = [];
                while ($row = $result_top->fetch_assoc()) {
                    $title = urlencode($row['baslik']);
                    $omdb_url = "http://www.omdbapi.com/?t={$title}&apikey={$omdb_key}";
                    $omdb_data = file_get_contents($omdb_url);
                    $omdb_json = json_decode($omdb_data, true);
                    
                    if ($omdb_json && isset($omdb_json['imdbRating'])) {
                        $row['imdbRating'] = $omdb_json['imdbRating'];
                        $films_with_ratings[] = $row;
                    }
                }

                // Puanlara göre sıralama
                usort($films_with_ratings, function ($a, $b) {
                    return $b['imdbRating'] <=> $a['imdbRating'];
                });

                // İlk 5 filmi göster
                foreach (array_slice($films_with_ratings, 0, 5) as $film) {
                    echo "<a href='view_movie.php?id=" . $film['id'] . "' class='film-item'>";
                    echo "<img src='" . $film['afis'] . "' alt='" . $film['baslik'] . "'>";
                    echo "<h3>" . $film['baslik'] . "</h3>";
                    echo "<p>IMDB Puanı: " . $film['imdbRating'] . "</p>";
                    echo "</a>";
                }
            } else {
                echo "<p>Henüz yüksek puanlı film bulunmamaktadır.</p>";
            }
            ?>
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


    </section>
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
            document.getElementById("welcomeMessage").innerHTML = "Başarıyla giriş yaptınız! " + username + ", iyi eğlenceler!";
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

<?php
$conn->close(); // Veritabanı bağlantısını kapatma
?>
