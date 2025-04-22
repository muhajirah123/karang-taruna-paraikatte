<?php
// fetch.php

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

$sql = "SELECT * FROM kegiatan";
$result = $conn->query($sql);

$kegiatan = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $kegiatan[] = $row;
    }
}

echo json_encode($kegiatan);

$conn->close();
?>