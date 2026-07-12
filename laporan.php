<?php

include "koneksi.php";

?>

<!DOCTYPE html>

<html>

<head>

<title>Laporan Pesanan</title>

<link rel="stylesheet" href="css/style.css">

<style>

@media print{

button{

display:none;

}

}

</style>

</head>

<body>

<div class="container">

<h1 align="center">

DIASAN CLOTHING

</h1>

<h3 align="center">

LAPORAN DATA PESANAN

</h3>

<br>

<div align="center">

<button onclick="window.print()">

Cetak Laporan

</button>

</div>

<br><br>

<table>

<tr>

<th>No</th>

<th>Nama</th>

<th>Alamat</th>

<th>No HP</th>

<th>Produk</th>

<th>Ukuran</th>

<th>Jumlah</th>

<th>Total Harga</th>

</tr>

<?php

$no=1;

$data=mysqli_query($conn,

"SELECT * FROM pesanan ORDER BY id DESC"

);

while($d=mysqli_fetch_array($data))

{

?>

<tr>

<td>

<?php

echo $no++;

?>

</td>

<td>

<?php

echo $d['nama'];

?>

</td>

<td>

<?php

echo $d['alamat'];

?>

</td>

<td>

<?php

echo $d['no_hp'];

?>

</td>

<td>

<?php

echo $d['produk'];

?>

</td>

<td>

<?php

echo $d['ukuran'];

?>

</td>

<td>

<?php

echo $d['jumlah'];

?>

</td>

<td>

Rp

<?php

echo number_format(

$d['total_harga']

);

?>

</td>

</tr>

<?php

}

?>

</table>

<br><br>

<?php

$total=mysqli_query(

$conn,

"SELECT SUM(total_harga) as total FROM pesanan"

);

$t=mysqli_fetch_assoc($total);

?>

<h2 align="right">

Total Pendapatan :

Rp

<?php

echo number_format(

$t['total']

);

?>

</h2>

</div>

</body>

</html>