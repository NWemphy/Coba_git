<?php
$conn = new mysqli("localhost", "root", "", "Platform");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
