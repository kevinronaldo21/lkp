<?php

$conn = mysqli_connect(
"localhost",
"root",
"",
"inventaris_db"
);

$data = mysqli_query($conn,
"SELECT * FROM barang");

?>

<!DOCTYPE html>
<html>
<head>

<title>Laporan Inventaris</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
padding: 30px;
}

h2{
text-align: center;
margin-bottom: 30px;
}

</style>

</head>

<body>

<h2>LAPORAN INVENTARIS BARANG</h2>

<table class="table table-bordered">

<tr class="table-dark">

<th>No</th>
<th>Nama Barang</th>
<th>Jumlah</th>
<th>Harga</th>

</tr>

<?php

$no = 1;

while($d = mysqli_fetch_array($data)){

?>

<tr>

<td><?php echo $no++; ?></td>

<td><?php echo $d['nama_barang']; ?></td>

<td><?php echo $d['jumlah']; ?></td>

<td>
Rp <?php echo number_format($d['harga']); ?>
</td>

</tr>

<?php } ?>

</table>

<script>

window.print();

</script>

</body>
</html>