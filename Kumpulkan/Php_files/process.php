<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['tambah'])) {
    $kegiatan = $_POST['ToDoList'];
    $stmt = $conn->prepare("INSERT INTO ToDoList (kegiatan, status, user_id) VALUES (?, 'pending', ?)");
    $stmt->bind_param("si", $kegiatan, $user_id);
    $stmt->execute();
    header("Location: kegiatan.php");
    exit;
}

if (isset($_GET['selesai'])) {
    $id_kegiatan = (int)$_GET['selesai'];
    $stmt = $conn->prepare("UPDATE ToDoList SET status='done' WHERE id_kegiatan = ? AND user_id = ?");
    $stmt->bind_param("ii", $id_kegiatan, $user_id);
    $stmt->execute();
    header("Location: kegiatan.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id_kegiatan = (int)$_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM ToDoList WHERE id_kegiatan = ? AND user_id = ?");
    $stmt->bind_param("ii", $id_kegiatan, $user_id);
    $stmt->execute();
    header("Location: kegiatan.php");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: login.php");
    exit;
}
