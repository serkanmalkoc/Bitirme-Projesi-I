<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "sinema";

// Veritabanı bağlantısı
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
