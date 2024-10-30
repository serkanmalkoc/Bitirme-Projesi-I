<?php
include 'db.php'; // Veritabanı bağlantısını ekleyin

// Düzenlenecek film id'sini alalım
$film_id = $_GET['id'];

// Veritabanından film bilgilerini al
$sql = "SELECT * FROM filmler WHERE id = $film_id";
$result = $conn->query($sql);

// Film bilgisi alınamadıysa hata mesajı
if (!$result) {
    echo "Film bilgileri alınamadı: " . $conn->error;
    exit;
}

$film = $result->fetch_assoc();

// Film türlerini almak için sorgu
$sql_turler = "SELECT * FROM turler"; // 'turler' tablosu film türlerini içermeli
$result_turler = $conn->query($sql_turler);

// Türler alınamadıysa hata mesajı
if (!$result_turler) {
    echo "Tür bilgileri alınamadı: " . $conn->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Düzenle</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #0056b3;
        }

        @media screen and (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.8rem;
            }

            button {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Film Düzenle</h1>
        <form action="film_duzenle_islem.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $film['id']; ?>">

            <label for="baslik">Film Başlığı:</label>
            <input type="text" id="baslik" name="baslik" value="<?php echo $film['baslik']; ?>" required>

            <label for="yonetmen">Yönetmen:</label>
            <input type="text" id="yonetmen" name="yonetmen" value="<?php echo $film['yonetmen']; ?>" required>

            <label for="yil">Yıl:</label>
            <input type="text" id="yil" name="yil" value="<?php echo $film['yil']; ?>" required>

            <label for="tur">Film Türü:</label>
            <input type="text" id="tur" name="tur" value="<?php echo $film['tur']; ?>" required>

            <label for="afis">Afiş Yükle (Opsiyonel):</label>
            <input type="file" name="afis">

            <label for="aciklama">Açıklama:</label>
            <textarea id="aciklama" name="aciklama" rows="4" required><?php echo $film['aciklama']; ?></textarea>

            <button type="submit">Güncelle</button>
        </form>
        <a class="back-link" href="index.php">Geri Dön</a>
    </div>
</body>
</html>
