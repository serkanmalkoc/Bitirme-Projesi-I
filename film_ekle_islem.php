<?php
include 'db.php'; // Veritabanı bağlantısı

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST['baslik'];
    $yonetmen = $_POST['yonetmen'];
    $yil = $_POST['yil'];
    $turler = $_POST['turler']; // Çoklu tür dizisi
    $aciklama = $_POST['aciklama'];

    // Afiş yükleme işlemi
    $afis_dizin = "afisler/";
    $afis_dosya = $afis_dizin . basename($_FILES["afis"]["name"]);
    
    // Afişi yükle
    if (move_uploaded_file($_FILES["afis"]["tmp_name"], $afis_dosya)) {
        // Filmi veritabanına ekleme işlemi
        $sql = "INSERT INTO filmler (baslik, yonetmen, yil, afis, aciklama) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $baslik, $yonetmen, $yil, $afis_dosya, $aciklama);

        if ($stmt->execute()) {
            $film_id = $conn->insert_id; // Yeni eklenen filmin ID'si

            // Seçilen türleri ekleyelim
            foreach ($turler as $tur_id) {
                $sql_tur = "INSERT INTO film_turleri (film_id, tur_id) VALUES (?, ?)";
                $stmt_tur = $conn->prepare($sql_tur);
                $stmt_tur->bind_param("ii", $film_id, $tur_id);
                $stmt_tur->execute();
                $stmt_tur->close();
            }

            echo "Film başarıyla eklendi!";
            header("Location: filmler.php"); // Filmler sayfasına yönlendirme
        } else {
            echo "Hata: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Afiş yüklenirken bir hata oluştu.";
    }

    $conn->close();
}
?>
