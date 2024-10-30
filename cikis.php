<?php
session_start();
session_unset(); // Tüm oturum değişkenlerini temizle
session_destroy(); // Oturumu yok et
header("Location: index.php"); // Ana sayfaya yönlendir
exit();
?>
