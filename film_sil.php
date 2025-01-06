<?php
include 'db.php'; // Veritabanı bağlantısı

// Film id'sini al
$film_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($film_id > 0) {
    // Film bilgilerini sil
    $sql = "DELETE FROM filmler WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $film_id);
    
    if ($stmt->execute()) {
        echo "Film başarıyla silindi.";
        header("Location: index.php"); // Ana sayfaya yönlendir
        exit;
    } else {
        echo "Film silinirken bir hata oluştu: " . $conn->error;
    }
} else {
    echo "Geçersiz film ID.";
}

$conn->close();
?>
