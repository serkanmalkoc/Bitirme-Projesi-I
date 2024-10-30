<?php
$servername = "localhost";
$username = "root";
$password = "150305"; // XAMPP varsayılan olarak root kullanıcısı için şifre koymaz
$dbname = "sinema";

// Veritabanı bağlantısı
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
