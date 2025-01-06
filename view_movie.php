<?php 
include 'db.php'; // Veritabanı bağlantısını

session_start(); // Oturum başlat

// URL'den film ID'sini alalım
if (isset($_GET['id'])) {
    $film_id = $_GET['id'];

    // Veritabanından bu ID'ye ait film bilgilerini çekelim
    $sql = "SELECT * FROM filmler WHERE id = $film_id";
    $result = $conn->query($sql);

    // Film bulunursa bilgileri gösterelim
    if ($result->num_rows > 0) {
        $film = $result->fetch_assoc();
    } else {
        echo "Bu ID'ye ait film bulunamadı.";
        exit;
    }
} else {
    echo "Film ID'si belirtilmedi.";
    exit;
}

// OMDb API'den IMDb puanını almak için API isteği
$apiKey = '83f75584'; // Buraya kendi OMDb API anahtarınızı girin
$filmTitle = urlencode($film['baslik']); // Film başlığını URL formatına dönüştür
$apiUrl = "http://www.omdbapi.com/?t=$filmTitle&apikey=$apiKey";

$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

// IMDb puanı
$imdbPuan = isset($data['imdbRating']) ? $data['imdbRating'] : 'N/A'; // Puan yoksa 'N/A' göster

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $film['baslik']; ?> - Film Detayları</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #14171C; /* Koyu bir arka plan rengi */
    color: #E1E8ED; /* Açık gri metin rengi */
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #1C2630; /* Film detayları için koyu gri zemin */
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    padding: 30px;
}

h1 {
    font-size: 2.5rem;
    text-align: center;
    color: #fff; /* Başlık beyaz */
    margin-bottom: 20px;
}

.film-details {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.film-details img {
    max-width: 100%;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.film-details p {
    font-size: 1.2rem;
    margin: 10px 0;
    color: #E1E8ED; /* Açık gri metin */
}

.film-details strong {
    color: #AAB8C2; /* Başlıklar için daha açık gri */
}

.edit-link, .back-link {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 20px;
    background-color: #1DA1F2; /* Twitter mavi rengi */
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.edit-link:hover, .back-link:hover {
    background-color: #1991C2; /* Hoverda mavi ton değişir */
}

.edit-link {
    background-color: #17BF63; /* Yeşil renk düzenle için */
}

.edit-link:hover {
    background-color: #1A9D4A;
}

.back-link {
    background-color: #F5F8FA; /* Geri dön butonu için açık renk */
    color: #14171C; /* Koyu metin rengi */
}

.back-link:hover {
    background-color: #E1E8ED;
    color: #1DA1F2; /* Geri dön butonunun hover rengini mavi yapar */
}

@media screen and (max-width: 768px) {
    .container {
        padding: 15px;
    }

    h1 {
        font-size: 2rem;
    }

    .film-details p {
        font-size: 1rem;
    }
}
.delete-btn {
    display: inline-block;
    padding: 12px 20px;
    margin-top: 20px;
    background-color: #e63946;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.delete-btn:hover {
    background-color: #c3001a;
}
    </style>
</head>
<body>

    <div class="container">
        <h1><?php echo $film['baslik']; ?></h1>
        <div class="film-details">
            <img src="<?php echo $film['afis']; ?>" alt="<?php echo $film['baslik']; ?>">
            <p><strong>Yönetmen:</strong> <?php echo $film['yonetmen']; ?></p>
            <p><strong>Yıl:</strong> <?php echo $film['yil']; ?></p>
            <p><strong>Tür:</strong> <?php echo $film['tur']; ?></p> <!-- Tür bilgisi -->
            <p><strong>IMDb Puanı:</strong> <?php echo $imdbPuan; ?></p> <!-- IMDb puanı buraya eklendi -->
            <p><strong>Açıklama:</strong> <?php echo $film['aciklama']; ?></p>
        </div>

        <?php
        // Kullanıcı giriş yapmamışsa
        if (!isset($_SESSION['username'])) {
            echo '<p>Lütfen film düzenlemek için giriş yapınız.</p>';
            // Düzenleme linkine tıklandığında yönlendirme yapacak şekilde form ekleyelim
            echo '<form method="POST" action="giris_yap.php">
                    <input type="hidden" name="redirect" value="view_movie.php?id=' . $film['id'] . '">
                    <button type="submit" class="edit-link">Giriş Yap ve Düzenle</button>
                  </form>';
        } else {
            // Kullanıcı giriş yaptıysa düzenleme linkini göster
            echo '<a class="edit-link" href="film_duzenle.php?id=' . $film['id'] . '">Düzenle</a>';
        }
        ?>
<a href="film_sil.php?id=<?php echo $film['id']; ?>" class="delete-btn" onclick="return confirm('Bu filmi silmek istediğinizden emin misiniz?');">Filmi Sil</a>
        <a class="back-link" href="filmler.php">Geri Dön</a>
    </div>
    
</body>
</html>

<?php
$conn->close(); // Veritabanı bağlantısını kapatma
?>
