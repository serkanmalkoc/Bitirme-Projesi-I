<?php
require_once 'db.php'; // Veritabanı bağlantısı ve oturum başlatma
checkLogin();          // Giriş kontrolü

// Formdan gelen verileri alın
$film_id = $_POST['id'];
$baslik = $_POST['baslik'];
$yonetmen = $_POST['yonetmen'];
$yil = $_POST['yil'];
$tur = $_POST['tur'];
$aciklama = $_POST['aciklama'];

// Afiş yüklendi mi kontrol et
if (!empty($_FILES['afis']['name'])) {
    $afis_dizin = "afisler/"; // Afiş dosyalarının bulunduğu klasör
    $afis_dosya = $afis_dizin . basename($_FILES["afis"]["name"]);
    move_uploaded_file($_FILES["afis"]["tmp_name"], $afis_dosya);

    // Afiş dosyası ile birlikte güncelleme sorgusu
    $sql = "UPDATE filmler SET baslik = ?, yonetmen = ?, yil = ?, tur = ?, afis = ?, aciklama = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssi", $baslik, $yonetmen, $yil, $tur, $afis_dosya, $aciklama, $film_id);
} else {
    // Afiş dosyası olmadan güncelleme sorgusu
    $sql = "UPDATE filmler SET baslik = ?, yonetmen = ?, yil = ?, tur = ?, aciklama = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissi", $baslik, $yonetmen, $yil, $tur, $aciklama, $film_id);
}

// Güncelleme işlemini çalıştır
if ($stmt->execute()) {
    echo "Film başarıyla güncellendi!";
    // Güncellenen filme geri dön
    header("Location: view_movie.php?id=$film_id");
} else {
    echo "Hata: " . $conn->error;
}

// Bağlantıyı kapat
$stmt->close();
$conn->close();
?>
