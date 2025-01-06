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
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

header h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 2rem;
    color: #222;
}

h2 {
    margin-bottom: 10px;
}

.film-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.film-item {
    background: #fff;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: calc(33.333% - 20px);
    box-sizing: border-box;
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s;
}

.film-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}

.film-item img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
}

.film-item h3 {
    font-size: 1.25rem;
    margin: 10px 0;
}

.film-item p {
    margin: 5px 0;
}

.film-item a {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 16px;
    background-color: #007acc;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.film-item a:hover {
    background-color: #005a9c;
}

p {
    font-size: 1rem;
    line-height: 1.6;
}</style>
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
