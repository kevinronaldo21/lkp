<?php

session_start();

if($_SESSION['username']==""){
header("Location: login.php");
}

$conn = mysqli_connect(
"localhost",
"root",
"",
"inventaris_db"
);

$cari = "";

if(isset($_GET['cari'])){
$cari = $_GET['cari'];
}

$data = mysqli_query($conn,
"SELECT * FROM barang
WHERE nama_barang LIKE '%$cari%'");

?>

<!DOCTYPE html>
<html>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<head>

<title>Dashboard Inventaris</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
overflow-x: hidden;
background: #f1f5f9;
}

.sidebar{
height: 100vh;
background: #0f172a;
padding-top: 20px;
}

.sidebar h3{
color: white;
text-align: center;
margin-bottom: 30px;
}

.sidebar a{
display: block;
color: white;
padding: 15px;
text-decoration: none;
}

.sidebar a:hover{
background: #1e293b;
}

.content{
padding: 20px;
}

.card-box{
border: none;
border-radius: 15px;
box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

</style>
<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<?php

$grafik = mysqli_query($conn,
"SELECT * FROM barang");

$nama_barang = [];
$jumlah_barang = [];

while($g = mysqli_fetch_array($grafik)){

$nama_barang[] = $g['nama_barang'];
$jumlah_barang[] = $g['jumlah'];

}

?>
<script>

const ctx = document.getElementById('grafikBarang');

new Chart(ctx, {

type: 'bar',

data: {

labels: <?php echo json_encode($nama_barang); ?>,

datasets: [{

label: 'Jumlah Stok',

data: <?php echo json_encode($jumlah_barang); ?>,

borderWidth: 1

}]

},

options: {

responsive: true,

scales: {

y: {

beginAtZero: true

}

}

}

});

</script>
<body>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 sidebar">

<h3>INVENTARIS</h3>

<a href="#">
<i class="bi bi-speedometer2"></i>
Dashboard
</a>

<a href="#">
<i class="bi bi-box-seam"></i>
Data Barang
</a>

<a href="logout.php">
<i class="bi bi-box-arrow-right"></i>
Logout
</a>

</div>

<div class="col-md-10 content">

<h2 class="mb-4">
Dashboard Inventaris Barang
</h2>
<a href="laporan.php"
target="_blank"
class="btn btn-danger mb-3">

Cetak Laporan PDF

</a>
<?php

$total_barang = mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM barang")
);

$total_stok = mysqli_fetch_array(
mysqli_query($conn,
"SELECT SUM(jumlah) as total FROM barang")
);

?>

<div class="row mb-4">

<div class="col-md-4">

<div class="card bg-primary text-white p-4 shadow">

<h5>Total Barang</h5>

<h2>
<?php echo $total_barang; ?>
</h2>

</div>

</div>

<div class="col-md-4">

<div class="card bg-success text-white p-4 shadow">

<h5>Total Stok</h5>

<h2>
<?php echo $total_stok['total']; ?>
</h2>

</div>

</div>

</div>

<div class="card card-box p-4 mb-4">

<h4>Tambah Barang</h4>

<form action="tambah_barang.php"
method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<input type="text"
name="nama_barang"
class="form-control"
placeholder="Nama Barang">

</div>

<div class="mb-3">

<input type="number"
name="jumlah"
class="form-control"
placeholder="Jumlah">

</div>

<div class="mb-3">

<input type="number"
name="harga"
class="form-control"
placeholder="Harga">

</div>

<div class="mb-3">

<input type="number"
name="harga"
class="form-control"
placeholder="Harga">

</div>

<div class="mb-3">

<input type="file"
name="gambar"
class="form-control">

</div>

<button type="submit"
class="btn btn-primary">
Tambah Barang
</button>

</form>

</div>

<div class="card card-box p-4">

<div class="d-flex
justify-content-between
mb-3">

<h4>Data Barang</h4>

<form method="GET">

<input type="text"
name="cari"
class="form-control"
placeholder="Cari barang">

</form>

</div>

<table class="table table-bordered">

<tr class="table-dark">

<th>No</th>
<th>Nama Barang</th>
<th>Jumlah</th>
<th>Harga</th>
<th>Gambar</th>
<th>Aksi</th>

</tr>

<?php
$no = 1;

while($d = mysqli_fetch_array($data)){
?>

<tr>

<td><?php echo $no++; ?></td>

<td><?php echo $d['nama_barang']; ?></td>

<td>

<?php

if($d['jumlah'] <= 3){

echo "<span class='badge bg-danger'>
Stok Hampir Habis :
".$d['jumlah']."
</span>";

}else{

echo "<span class='badge bg-success'>
".$d['jumlah']."
</span>";

}

?>

</td>

<td>
Rp <?php echo number_format($d['harga']); ?>
</td>

<td>

<a href="edit_barang.php?id=<?php echo $d['id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="hapus_barang.php?id=<?php echo $d['id']; ?>"
class="btn btn-danger btn-sm">

Hapus

</a>

</td>

</tr>

<?php } ?>

</table>
<div class="card p-4 mb-4">

<h4>Grafik Stok Barang</h4>

<canvas id="grafikBarang"></canvas>

</div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>

new DataTable('#tabelBarang');

</script>

</body>
</div>

</div>

</div>

</div>

</body>
</html>