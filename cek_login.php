<?php

session_start();

$conn = mysqli_connect(
"localhost",
"root",
"",
"inventaris_db"
);

$username = $_POST['username'];
$password = $_POST['password'];

$data = mysqli_query($conn,
"SELECT * FROM admin
WHERE username='$username'
AND password='$password'");

$cek = mysqli_num_rows($data);

if($cek > 0){

$_SESSION['username'] = $username;

header("Location: dashboard.php");

}else{

echo "LOGIN GAGAL";

}

?>