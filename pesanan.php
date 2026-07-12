<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("Location: login.php");
    exit;
}

include "koneksi.php";

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Data Pesanan</title>

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

background:

linear-gradient(rgba(15,23,42,.65),rgba(15,23,42,.65)),

url("https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=2000&q=80");

background-size:cover;

background-position:center;

background-attachment:fixed;

min-height:100vh;

}

/* NAVBAR */

nav{

display:flex;

justify-content:space-between;

align-items:center;

padding:22px 45px;

background:rgba(255,255,255,.08);

backdrop-filter:blur(18px);

border-bottom:1px solid rgba(255,255,255,.15);

position:sticky;

top:0;

z-index:999;

}

nav h1{

color:white;

font-size:28px;

font-weight:700;

}

nav ul{

display:flex;

list-style:none;

gap:28px;

}

nav a{

color:white;

text-decoration:none;

font-weight:500;

transition:.3s;

}

nav a:hover{

color:#60a5fa;

}

/* CONTAINER */

.container{

width:92%;

max-width:1450px;

margin:auto;

padding:45px 0;

}

/* HEADER */

.page-header{

background:rgba(255,255,255,.10);

backdrop-filter:blur(20px);

border-radius:25px;

padding:35px;

margin-bottom:35px;

color:white;

box-shadow:0 15px 35px rgba(0,0,0,.25);

border:1px solid rgba(255,255,255,.15);

}

.page-header h1{

font-size:42px;

margin-bottom:10px;

}

.page-header p{

color:#ddd;

font-size:17px;

}

/* SEARCH */

.search-box{

display:flex;

gap:15px;

margin-bottom:30px;

}

.search-box input{

flex:1;

padding:15px;

border:none;

border-radius:12px;

background:rgba(255,255,255,.12);

color:white;

backdrop-filter:blur(12px);

}

.search-box input::placeholder{

color:#ddd;

}

.search-box button{

padding:15px 30px;

border:none;

border-radius:12px;

background:#2563eb;

color:white;

font-weight:bold;

cursor:pointer;

transition:.3s;

}

.search-box button:hover{

background:#1d4ed8;

}

/* TABLE */

.table-box{

background:rgba(255,255,255,.10);

backdrop-filter:blur(18px);

border-radius:25px;

overflow:hidden;

box-shadow:0 15px 35px rgba(0,0,0,.25);

border:1px solid rgba(255,255,255,.15);

}

table{

width:100%;

border-collapse:collapse;

color:white;

}

th{

background:rgba(255,255,255,.15);

padding:18px;

}

td{

padding:16px;

text-align:center;

border-top:1px solid rgba(255,255,255,.08);

}

tr:hover{

background:rgba(255,255,255,.06);

}

/* BUTTON */

.edit{

background:#16a34a;

padding:8px 18px;

border-radius:8px;

color:white;

text-decoration:none;

}

.hapus{

background:#dc2626;

padding:8px 18px;

border-radius:8px;

color:white;

text-decoration:none;

}

.edit:hover{

background:#15803d;

}

.hapus:hover{

background:#b91c1c;

}

/* FOOTER */

footer{

margin-top:60px;

padding:30px;

text-align:center;

color:white;

background:rgba(255,255,255,.08);

backdrop-filter:blur(18px);

}

</style>

</head>

<body>

<nav>

<h1>DIASAN ADMIN</h1>

<ul>

<li>

<a href="dashboard.php">

Dashboard

</a>

</li>

<li>

<a href="pesanan.php">

Data Pesanan

</a>

</li>

<li>

<a href="history.php">

History

</a>

</li>

<li>

<a href="logout.php">

Logout

</a>

</li>

</ul>

</nav>

<div class="container">

<div class="page-header">

<h1>

 Data Pesanan

</h1>

<p>

Kelola seluruh data transaksi pelanggan
DIASAN CLOTHING.

</p>

</div>

<br>

<form method="GET" class="search-box">

<input
type="text"
name="cari"
placeholder="Cari pelanggan">

<button
type="submit"
class="btn">

Cari

</button>

</form>

<br><br>

<div class="table-box">

<table>

<tr>

<th>No</th>

<th>Nama</th>

<th>Alamat</th>

<th>No HP</th>

<th>Produk</th>

<th>Ukuran</th>

<th>Jumlah</th>

<th>Total</th>

<th>Aksi</th>

</tr>

<?php

$no=1;

if(isset($_GET['cari']))
{

$cari=$_GET['cari'];

$data=mysqli_query(

$conn,

"SELECT *
FROM pesanan

WHERE nama
LIKE '%$cari%'

ORDER BY id DESC"

);

}
else
{

$data=mysqli_query(

$conn,

"SELECT *
FROM pesanan

ORDER BY id DESC"

);

}

while($d=mysqli_fetch_array($data))
{

?>

<tr>

<td>

<?php echo $no++; ?>

</td>

<td>

<?php echo $d['nama']; ?>

</td>

<td>

<?php echo $d['alamat']; ?>

</td>

<td>

<?php echo $d['no_hp']; ?>

</td>

<td>

<?php echo $d['produk']; ?>

</td>

<td>

<?php echo $d['ukuran']; ?>

</td>

<td>

<?php echo $d['jumlah']; ?>

</td>

<td>

Rp

<?php

echo number_format(

$d['total_harga']

);

?>

</td>

<td>

<a class="edit"
href="edit.php?id=<?php echo $d['id']; ?>">

Edit

</a>


|


<a class="hapus"
href="hapus.php?id=<?php echo $d['id']; ?>"

onclick="return confirm('Yakin?')"

>

Hapus

</a>

</td>

</tr>

<?php

}

?>

</table>

</div>

<footer>

<p>

© 2026 DIASAN CLOTHING

</p>

</footer>

</body>

</html>