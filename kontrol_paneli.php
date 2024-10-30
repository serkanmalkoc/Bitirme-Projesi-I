<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: giris_yap.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Hoş Geldiniz, <?php echo $_SESSION['username']; ?></h2>
    <a href="logout.php">Çıkış Yap</a>
</body>
</html>
