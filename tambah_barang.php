<?php

$conn = mysqli_connect(
"localhost",
"root",
"",
"inventaris_db"
);

$nama = $_POST['nama_barang'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];

$gambar = $_FILES['gambar']['name'];

$tmp = $_FILES['gambar']['tmp_name'];

move_uploaded_file(
$tmp,
"upload/".$gambar
);

mysqli_query($conn,
"INSERT INTO barang VALUES(

NULL,
'$nama',
'$jumlah',
'$harga',
'$gambar'

)");

header("Location: dashboard.php");

?>