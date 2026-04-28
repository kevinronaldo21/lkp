<?php

$conn = mysqli_connect(
"localhost",
"root",
"",
"inventaris_db"
);

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM barang
WHERE id='$id'");

header("Location: dashboard.php");

?>