<?php

$conn = mysqli_connect(
"localhost",
"root",
"",
"inventaris_db"
);

$id = $_GET['id'];

$data = mysqli_query($conn,
"SELECT * FROM barang WHERE id='$id'");

$d = mysqli_fetch_array($data);

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Barang</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<h2>EDIT BARANG</h2>

<form action="update_barang.php" method="POST">

<input type="hidden"
name="id"
value="<?php echo $d['id']; ?>">

<input type="text"
name="nama_barang"
value="<?php echo $d['nama_barang']; ?>">

<br><br>

<input type="number"
name="jumlah"
value="<?php echo $d['jumlah']; ?>">

<br><br>

<input type="number"
name="harga"
value="<?php echo $d['harga']; ?>">

<br><br>

<button type="submit">
UPDATE
</button>

</form>

</body>
</html>