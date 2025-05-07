<?php
$conn = new mysqli("localhost", "root", "", "hbwebsite");

if ($conn->connect_error) {
    die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}
?>
