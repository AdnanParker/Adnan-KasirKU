<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "KasirKU";

$conn = mysqli_connect($server, $user, $password, $database);
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

?> 
