<?php
session_start();
include 'db.php'; // Veritabanı bağlantısını ekleyin



// Kullanıcı ID'sini oturumdan alıyoruz
$user_id = $_SESSION['user_id']; // Giriş yapan kullanıcının ID'si

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
        $sql = "INSERT INTO filmler (baslik, yonetmen, yil, tur, afis, aciklama, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisssi", $baslik, $yonetmen, $yil, $tur, $afis_dosya, $aciklama, $user_id); // Kullanıcı ID'sini ekliyoruz

        if ($stmt->execute()) {
            echo "Film başarıyla eklendi!";
            header("Location: filmler.php"); // Başarıyla ekledikten sonra filmler sayfasına yönlendir
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
