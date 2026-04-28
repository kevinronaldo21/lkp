<?php

$conn = mysqli_connect(
"localhost",
"root",
"",
"inventaris_db"
);

$id = $_POST['id'];
$nama = $_POST['nama_barang'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];

mysqli_query($conn,
"UPDATE barang SET

nama_barang='$nama',
jumlah='$jumlah',
harga='$harga'

WHERE id='$id'
");

header("Location: dashboard.php");

?>