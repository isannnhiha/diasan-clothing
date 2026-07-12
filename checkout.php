<?php

$produk="";
$harga=0;

if(isset($_GET['produk']))
{
    $produk=$_GET['produk'];
}

if(isset($_GET['harga']))
{
    $harga=$_GET['harga'];
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Checkout</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<header class="simple-header">
<h1>DIASAN CLOTHING</h1>
</header>

<h1 style="color:white;">

DIASAN CLOTHING

</h1>

</div>

<section class="container">

<h2 align="center">

Checkout

</h2>

<br><br>

<form action="proses_checkout.php" method="POST">

<input
type="text"
name="nama"
placeholder="Nama Lengkap"
required>

<input
type="text"
name="alamat"
placeholder="Alamat"
required>

<input
type="text"
name="no_hp"
id="no_hp"
placeholder="Nomor HP"
required>

<label>

Produk

</label>

<input
type="text"
name="produk"
value="<?php echo $produk; ?>"
readonly>

<label>

Harga

</label>

<input
type="text"
value="Rp <?php echo number_format($harga); ?>"
readonly>

<input
type="hidden"
name="harga"
value="<?php echo $harga; ?>">

<label>

Ukuran

</label>

<select name="ukuran">

<option>S</option>

<option>M</option>

<option>L</option>

<option>XL</option>

</select>

<label>

Jumlah

</label>

<input
type="number"
name="jumlah"
id="jumlah"
value="1"
min="1"
onkeyup="hitung()"
onchange="hitung()">

<label>

Total Harga

</label>

<input
type="text"
id="total"
readonly>

<input
type="hidden"
name="total_harga"
id="total_hidden">

<br>

<button
type="submit"
class="btn">

Pesan Sekarang

</button>

</form>

</section>

<script>

var harga=<?php echo $harga; ?>;

function hitung()
{

var jumlah=
document.getElementById(
"jumlah"
).value;

var total=
harga*jumlah;

document.getElementById(
"total"
).value=

"Rp "+
total.toLocaleString();

document.getElementById(
"total_hidden"
).value=total;

}

hitung();


document.getElementById("no_hp").addEventListener("input", function(){

if(/[^0-9]/.test(this.value))
{
    alert("Nomor HP hanya boleh berisi angka!");
    this.value = this.value.replace(/[^0-9]/g,'');
}

});

</script>

</body>

</html>