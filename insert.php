<?php
// insert.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "karang_taruna";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $gambar = $_FILES['gambar']['name'];

    // Upload gambar
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

    // Insert data ke database
    $sql = "INSERT INTO kegiatan (judul, deskripsi, tanggal, gambar) VALUES ('$judul', '$deskripsi', '$tanggal', '$gambar')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dimasukkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>