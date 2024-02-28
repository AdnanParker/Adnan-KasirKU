<?php

include_once("../Koneksi/connect.php");

$id = $_GET['ProdukID'];
$result = mysqli_query($conn, "DELETE FROM produk WHERE ProdukID=$id");

header("Location:index.php?page=stok");
?>