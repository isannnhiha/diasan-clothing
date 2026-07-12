<?php
include "koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM pesanan WHERE id='$id'");
$d = mysqli_fetch_array($data);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2 align="center">EDIT PESANAN</h2>

<form action="update.php" method="POST">

<input type="hidden" name="id" value="<?php echo $d['id']; ?>">

<table align="center">

<tr>
<td>Nama</td>
<td>
<input type="text" name="nama"
value="<?php echo $d['nama']; ?>" required>
</td>
</tr>

<tr>
<td>Alamat</td>
<td>
<input type="text" name="alamat"
value="<?php echo $d['alamat']; ?>" required>
</td>
</tr>

<tr>
<td>No HP</td>
<td>
<input type="text" name="no_hp"
value="<?php echo $d['no_hp']; ?>" required>
</td>
</tr>

<tr>
<td>Produk</td>
<td>

<select name="produk">

<option <?php if($d['produk']=="Kaos Basic") echo "selected"; ?>>
Kaos Polos
</option>

<option <?php if($d['produk']=="Sweater Cream") echo "selected"; ?>>
Kaos Basic
</option>

<option <?php if($d['produk']=="Jaket Kulit") echo "selected"; ?>>
Jaket Kulit
</option>

<option <?php if($d['produk']=="Jaket Hodie") echo "selected"; ?>>
Jaket Hodie
</option>

<option <?php if($d['produk']=="Kemeja Flanel") echo "selected"; ?>>
Kemeja Flanel 
</option>

</select>

</td>
</tr>

<tr>
<td>Ukuran</td>
<td>

<select name="ukuran">

<option <?php if($d['ukuran']=="S") echo "selected"; ?>>S</option>
<option <?php if($d['ukuran']=="M") echo "selected"; ?>>M</option>
<option <?php if($d['ukuran']=="L") echo "selected"; ?>>L</option>
<option <?php if($d['ukuran']=="XL") echo "selected"; ?>>XL</option>

</select>

</td>
</tr>

<tr>
<td>Jumlah</td>
<td>
<input type="number"
name="jumlah"
value="<?php echo $d['jumlah']; ?>"
required>
</td>
</tr>

<tr>
<td></td>
<td>

<button type="submit">

Update

</button>

</td>
</tr>

</table>

</form>

</body>
</html>