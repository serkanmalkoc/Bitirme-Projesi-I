<?php
session_start(); // Oturum başlatma
include 'db.php'; // Veritabanı bağlantısı
// Veritabanından toplam film sayısını çekme
$sql_total_films = "SELECT COUNT(*) AS total FROM filmler";
$result_total_films = $conn->query($sql_total_films);
$total_films = $result_total_films->fetch_assoc()['total'];





// URL'den tür parametresini alıyoruz
$selected_tur = isset($_GET['tur']) ? $_GET['tur'] : '';  // Varsayılan olarak tüm filmler

// Tür filtresine göre sorgu yazıyoruz
if ($selected_tur != '') {
    // SQL Injection'a karşı güvenlik için prepared statement kullanıyoruz
    $sql = "SELECT * FROM filmler WHERE tur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selected_tur);  // Tür parametresini bağlıyoruz
} else {
    // Eğer tür seçilmemişse tüm filmleri getiriyoruz
    $sql = "SELECT * FROM filmler ORDER BY eklenme_tarihi DESC"; // Yeni eklenen filmler önce
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();  // Sorguyu çalıştırıp sonuçları alıyoruz

// Hata mesajını kontrol edelim
if ($result === false) {
    echo "Veritabanı sorgusu hatalı: " . $conn->error;
    exit;
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmler</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://db.onlinewebfonts.com/c/629ed6829f706958b9bdf4f6300dfca0?family=Sharp+Grotesk+SmBold+20+Regular" rel="stylesheet">
    <style>
* {
    box-sizing: border-box;
}
        body {
            font-family: Arial, sans-serif;
            background-color: #14171C;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0px ;
        }
        header {
            background-color: rgb(20, 23, 28);
    color: rgb(255, 255, 255);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    font-family: Arial, sans-serif;
    box-sizing: border-box;
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
        h2 {
            margin: 10;
            font-size: 24px;
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
        
        /* Film kartlarını grid şeklinde gösterme */
        .film-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .film-card {
            background-color: #14171C;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .film-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .film-card img {
            width: 100%;
            height: auto;
            border-bottom: 2px solid #ddd;
        }

        .film-card h3 {
            font-size: 18px;
            margin: 15px 10px 5px;
            color: #fff;
        }

        .film-card p {
            margin: 0 10px 10px;
            color: #fff;
            font-size: 14px;
        }

        .film-card a {
            display: block;
            text-decoration: none;
            color: inherit;
            height: 100%;
        }
        input[type="text"] {
            display: inline-block; /* Inline blok */
            border: 1px solid #556678; /* Kenar rengi */
            border-radius: 30px; /* Kenar yuvarlama */
            padding: 5px; /* İç boşluk */
            width: 200px; /* Genişlik */
        }
        .sort-form {
    display: flex;
    align-items: center;
}

.sort-form label {
    margin-right: 10px;
    color: #fff;
}
.film-count {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #14171C;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 16px;
    font-family: 'Arial', sans-serif;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}
/* Dropdown Container (Türler Menüsü) */
.filter-container {
    position: relative;
    display: inline-block;
    font-family: Arial, sans-serif;
}

/* Dropdown Başlığı */
.filter-title {
    background-color: #374151; /* Koyu gri */
    color: #ffffff;
    padding: 8px 12px;
    font-size: 13px;
    cursor: pointer;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Dropdown Ok İşareti */
.filter-title::after {
    content: "▼";
    font-size: 11px;
    margin-left: 8px;
}

/* Dropdown Menü (Aşağı Doğru Liste) */
.filter-dropdown {
    display: none;
    position: absolute;
    background-color: #6b7280; /* Açık gri */
    width: 180px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 5px;
    margin-top: 5px;
    padding: 5px 0;
}

/* Dropdown İçindeki Bağlantılar */
.filter-dropdown a {
    display: block; /* Bağlantıları alt alta dizer */
    color: white;
    padding: 6px 10px;
    text-decoration: none;
    font-size: 12px;
}

/* Hover Effect */
.filter-dropdown a:hover {
    background-color: #9ca3af; /* Hover rengi */
    color: black;
}

/* Dropdown Açıkken Görünürlük */
.filter-dropdown.show {
    display: block;
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
    <section class="container">
        <h2>Tüm Filmler</h2>
        <!-- Tür Listesi -->
        <div class="filter-container">
    <h2 class="filter-title" onclick="toggleDropdown()">Türler</h2>
    <div class="filter-dropdown" id="filterDropdown">
    <a href="filmler.php" class="filter-btn <?php echo ($selected_tur == '') ? 'active' : ''; ?>">Tüm Filmler</a>
        <a href="filmler.php?tur=Aksiyon" class="filter-btn <?php echo ($selected_tur == 'Aksiyon') ? 'active' : ''; ?>">Aksiyon</a>
        <a href="filmler.php?tur=Bilim+Kurgu" class="filter-btn <?php echo ($selected_tur == 'Bilim Kurgu') ? 'active' : ''; ?>">Bilim Kurgu</a>
        <a href="filmler.php?tur=Komedi" class="filter-btn <?php echo ($selected_tur == 'Komedi') ? 'active' : ''; ?>">Komedi</a>
        <a href="filmler.php?tur=Dram" class="filter-btn <?php echo ($selected_tur == 'Dram') ? 'active' : ''; ?>">Dram</a>
        <a href="filmler.php?tur=Gerilim" class="filter-btn <?php echo ($selected_tur == 'Gerilim') ? 'active' : ''; ?>">Gerilim</a>
        <a href="filmler.php?tur=Suç" class="filter-btn <?php echo ($selected_tur == 'Suç') ? 'active' : ''; ?>">Suç</a>
        <a href="filmler.php?tur=Savaş" class="filter-btn <?php echo ($selected_tur == 'Savaş') ? 'active' : ''; ?>">Savaş</a>
        <a href="filmler.php?tur=Romantik" class="filter-btn <?php echo ($selected_tur == 'Romantik') ? 'active' : ''; ?>">Romantik</a>
        <a href="filmler.php?tur=Korku" class="filter-btn <?php echo ($selected_tur == 'Korku') ? 'active' : ''; ?>">Korku</a>
        <a href="filmler.php?tur=Müzikal" class="filter-btn <?php echo ($selected_tur == 'Müzikal') ? 'active' : ''; ?>">Müzikal</a>
        <a href="filmler.php?tur=Animasyon" class="filter-btn <?php echo ($selected_tur == 'Animasyon') ? 'active' : ''; ?>">Animasyon</a>
        <a href="filmler.php?tur=Fantastik" class="filter-btn <?php echo ($selected_tur == 'Fantastik') ? 'active' : ''; ?>">Fantastik</a>
        <a href="filmler.php?tur=Gizem" class="filter-btn <?php echo ($selected_tur == 'Gizem') ? 'active' : ''; ?>">Gizem</a>
        <a href="filmler.php?tur=Aile" class="filter-btn <?php echo ($selected_tur == 'Aile') ? 'active' : ''; ?>">Aile</a>
    </div>
</div>






    <script>
    function toggleDropdown() {
        const dropdown = document.getElementById('filterDropdown');
        dropdown.classList.toggle('show');
    }
    // AJAX ile tür bazlı film filtreleme
    function filtrele(tur) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "filmleri_getir.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("film-container").innerHTML = xhr.responseText;
            }
        };
        xhr.send("tur=" + encodeURIComponent(tur));
    }
</script>







    <div class="film-count">
    Toplam Film Sayısı: <?php echo $total_films; ?>
</div>
        <div class="film-grid">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<a href='view_movie.php?id=" . $row['id'] . "'>"; // Tüm film kartını link yapıyoruz
                    echo "<div class='film-card'>";
                    echo "<img src='" . $row['afis'] . "' alt='" . $row['baslik'] . "'>";
                    echo "<h3>" . $row['baslik'] . "</h3>";
                    echo "<p>Yönetmen: " . $row['yonetmen'] . "</p>";
                    echo "<p>Yıl: " . $row['yil'] . "</p>";
                    echo "</div>";
                    echo "</a>"; // Linki burada kapatıyoruz
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
    </script>
</body>
</html>

<?php
$conn->close(); // Veritabanı bağlantısını kapatma
?>
