<?php 
include 'db.php'; // Veritabanı bağlantısı

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
            background-color: #14171C;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #14171C;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            font-size: 2.5rem;
            color: #fff;
            text-align: center;
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
            font-size: 1.1rem;
            margin: 10px 0;
            color: #fff;
        }

        .film-details strong {
            color: #555;
        }

        .back-link, .edit-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #444;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-link:hover, .edit-link:hover {
            background-color: #333;
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
        <a class="edit-link" href="film_duzenle.php?id=<?php echo $film['id']; ?>">Düzenle</a> <!-- Düzenleme butonu -->
        <a class="back-link" href="filmler.php">Geri Dön</a>
    </div>

</body>
</html>

<?php
$conn->close(); // Veritabanı bağlantısını kapatma
?>
