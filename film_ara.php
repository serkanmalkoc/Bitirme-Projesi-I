<?php 
include 'db.php'; // Veritabanı bağlantısı

// Arama sorgusunu alalım
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Filmleri aramak için SQL sorgusu
$sql = "SELECT * FROM filmler WHERE baslik LIKE '%$query%' ORDER BY eklenme_tarihi DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Arama Sonuçları</title>
    <link rel="stylesheet" href="style.css"> <!-- Stil dosyanız -->
</head>
<body>
    <div class="container">
        <header>
            <h1>Film Arama Sonuçları</h1>
        </header>

        <section>
            <h2><?php echo htmlspecialchars($query); ?> ile ilgili sonuçlar:</h2>
            <div class="film-list">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='film-item'>";
                        echo "<img src='" . $row['afis'] . "' alt='" . $row['baslik'] . "'>";
                        echo "<h3>" . $row['baslik'] . "</h3>";
                        echo "<p>Yönetmen: " . $row['yonetmen'] . "</p>";
                        echo "<p>Yıl: " . $row['yil'] . "</p>";
                        echo "<a href='view_movie.php?id=" . $row['id'] . "'>Detayları Gör</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Aradığınız kritere uygun film bulunamadı.</p>";
                }
                ?>
            </div>
        </section>
    </div>

</body>
</html>

<?php
$conn->close(); // Veritabanı bağlantısını kapatma
?>
