<?php
session_start();
require_once 'db.php'; // Veritabanı bağlantısı ve oturum başlatma
checkLogin(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST['baslik'];
    $yonetmen = $_POST['yonetmen'];
    $yil = $_POST['yil'];
    $tur = $_POST['tur']; // Tür verisini alıyoruz
    $aciklama = $_POST['aciklama'];

    // Afiş yükleme işlemi
    $afis_dizin = "afisler/";
    $afis_dosya = $afis_dizin . basename($_FILES["afis"]["name"]);
    
    if (move_uploaded_file($_FILES["afis"]["tmp_name"], $afis_dosya)) {
        // Film ekleme sorgusu
        $sql = "INSERT INTO filmler (baslik, yonetmen, yil, tur, afis, aciklama) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisss", $baslik, $yonetmen, $yil, $tur, $afis_dosya, $aciklama);

        if ($stmt->execute()) {
            echo "Film başarıyla eklendi!";
            header("Location: filmler.php");
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
