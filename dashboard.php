<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "koneksi.php";

/* ==========================
   STATISTIK
========================== */

$total_pesanan=mysqli_query($conn,"SELECT COUNT(*) total FROM pesanan");
$tp=mysqli_fetch_assoc($total_pesanan);

$total_uang=mysqli_query($conn,"SELECT SUM(total_harga) uang FROM pesanan");
$tu=mysqli_fetch_assoc($total_uang);

$kaos=mysqli_query($conn,"SELECT SUM(jumlah) total FROM pesanan WHERE produk='Kaos Polos'");
$k=mysqli_fetch_assoc($kaos);

$basic=mysqli_query($conn,"SELECT SUM(jumlah) total FROM pesanan WHERE produk='Kaos Basic'");
$b=mysqli_fetch_assoc($basic);

$kulit=mysqli_query($conn,"SELECT SUM(jumlah) total FROM pesanan WHERE produk='Jaket Kulit'");
$j=mysqli_fetch_assoc($kulit);

$hoodie=mysqli_query($conn,"SELECT SUM(jumlah) total FROM pesanan WHERE produk='Hodie'");
$h=mysqli_fetch_assoc($hoodie);

$flanel=mysqli_query($conn,"SELECT SUM(jumlah) total FROM pesanan WHERE produk='Kemeja Flanel'");
$f=mysqli_fetch_assoc($flanel);

/* ==========================
   PRODUK TERLARIS
========================== */

$terlaris=mysqli_query($conn,"
SELECT produk,SUM(jumlah) total
FROM pesanan
GROUP BY produk
ORDER BY total DESC
LIMIT 1
");

$top=mysqli_fetch_assoc($terlaris);

/* ==========================
   PESANAN TERBARU
========================== */

$recent=mysqli_query($conn,"
SELECT *
FROM pesanan
ORDER BY id DESC
LIMIT 5
");

?>
<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
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

url("https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&w=2000&q=80");

background-size:cover;

background-position:center;

background-attachment:fixed;

min-height:100vh;

}

/* ===========================
NAVBAR
=========================== */

nav{

position:sticky;

top:0;

display:flex;

justify-content:space-between;

align-items:center;

padding:22px 45px;

background:rgba(255,255,255,.08);

backdrop-filter:blur(18px);

border-bottom:1px solid rgba(255,255,255,.15);

z-index:999;

}

nav h1{

color:white;

font-size:28px;

font-weight:700;

}

nav ul{

display:flex;

gap:30px;

list-style:none;

}

nav a{

color:white;

text-decoration:none;

font-weight:500;

transition:.35s;

}

nav a:hover{

color:#60a5fa;

}

/* ===========================
CONTAINER
=========================== */

.container{

width:92%;

max-width:1450px;

margin:auto;

padding:45px 0;

}

/* ===========================
HEADER
=========================== */

.admin-header{

background:rgba(255,255,255,.10);

backdrop-filter:blur(22px);

border:1px solid rgba(255,255,255,.15);

border-radius:28px;

padding:45px;

color:white;

box-shadow:0 15px 40px rgba(0,0,0,.30);

margin-bottom:35px;

animation:fade .6s;

}

.admin-header h1{

font-size:46px;

margin-bottom:15px;

}

.admin-header p{

font-size:18px;

color:#ddd;

line-height:30px;

}

.admin-header h3{

margin-top:18px;

font-weight:400;

color:#bbb;

}

/* ===========================
STATISTIC
=========================== */

.dashboard{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(250px,1fr));

gap:25px;

}

.box{

background:rgba(255,255,255,.12);

backdrop-filter:blur(18px);

border-radius:25px;

padding:35px;

color:white;

text-align:center;

position:relative;

overflow:hidden;

transition:.35s;

box-shadow:0 15px 35px rgba(0,0,0,.25);

border:1px solid rgba(255,255,255,.15);

}

.box:hover{

transform:translateY(-10px) scale(1.03);

}

.box::after{

content:"";

position:absolute;

right:-30px;

bottom:-30px;

width:120px;

height:120px;

background:rgba(255,255,255,.12);

border-radius:50%;

}

.box h1{

font-size:42px;

margin:12px 0;

font-weight:bold;

}

.box h3{

font-size:20px;

}

.box span{

color:#ddd;

}

.box .icon{

font-size:55px;

margin-bottom:15px;

}

/* ===========================
SECTION
=========================== */

.section-title{

margin-top:55px;

margin-bottom:25px;

color:white;

font-size:30px;

font-weight:600;

}

/* ===========================
QUICK MENU
=========================== */

.quick-menu{

display:flex;

justify-content:center;

}

.quick-card{

width:420px;

background:rgba(255,255,255,.10);

backdrop-filter:blur(18px);

border-radius:25px;

padding:40px;

text-align:center;

color:white;

border:1px solid rgba(255,255,255,.15);

box-shadow:0 15px 35px rgba(0,0,0,.25);

transition:.35s;

}

.quick-card:hover{

transform:translateY(-8px);

}

.quick-icon{

font-size:65px;

margin-bottom:15px;

}

.quick-card h2{

margin-bottom:15px;

}

.quick-card p{

color:#ddd;

line-height:28px;

margin-bottom:25px;

}

.quick-btn{

display:inline-block;

padding:15px 35px;

background:#2563eb;

border-radius:12px;

text-decoration:none;

color:white;

font-weight:600;

transition:.3s;

}

.quick-btn:hover{

background:#1d4ed8;

}

/* ===========================
FOOTER
=========================== */

footer{

margin-top:60px;

padding:30px;

text-align:center;

color:white;

background:rgba(255,255,255,.08);

backdrop-filter:blur(18px);

}

@keyframes fade{

from{

opacity:0;

transform:translateY(30px);

}

to{

opacity:1;

transform:translateY(0);

}

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

<div class="admin-header">

<h1>
Selamat Datang,
<?php echo $_SESSION['admin']; ?>
</h1>

<p>

Kelola seluruh aktivitas
<strong>DIASAN CLOTHING</strong>

dengan lebih cepat, aman, dan profesional.

</p>

<h3>

<?php

$hari=array(
"Minggu",
"Senin",
"Selasa",
"Rabu",
"Kamis",
"Jumat",
"Sabtu"
);

$bulan=array(
1=>"Januari",
"Februari",
"Maret",
"April",
"Mei",
"Juni",
"Juli",
"Agustus",
"September",
"Oktober",
"November",
"Desember"
);

echo $hari[date("w")];

echo ", ";

echo date("d");

echo " ";

echo $bulan[date("n")];

echo " ";

echo date("Y");

?>

</h3>

</div>

<div class="dashboard">

<div class="box">

<div class="icon">

</div>

<h3>Total Pesanan</h3>

<h1>

<?php echo $tp['total']; ?>

</h1>

<span>

Seluruh transaksi

</span>

</div>

<div class="box">

<div class="icon">

</div>

<h3>Pendapatan</h3>

<h1>

Rp

<?php echo number_format($tu['uang']); ?>

</h1>

<span>

Total omzet

</span>

</div>

<div class="box">

<div class="icon">


</div>

<h3>Kaos Polos</h3>

<h1>

<?php echo ($k['total']==NULL)?0:$k['total']; ?>

</h1>

<span>

Terjual

</span>

</div>

<div class="box">

<div class="icon">

</div>

<h3>Kaos Basic</h3>

<h1>

<?php echo ($b['total']==NULL)?0:$b['total']; ?>

</h1>

<span>

Terjual

</span>

</div>

<div class="box">

<div class="icon">

</div>

<h3>Jaket Kulit</h3>

<h1>

<?php echo ($h['total']==NULL)?0:$h['total']; ?>

</h1>

<span>

Terjual

</span>

</div>

<div class="box">

<div class="icon">

</div>

<h3>Hoodie</h3>

<h1>

<?php echo ($j['total']==NULL)?0:$j['total']; ?>

</h1>

<span>

Terjual

</span>

</div>

<div class="box">

<div class="icon">

</div>

<h3>Kemeja Flanel</h3>

<h1>

<?php echo ($f['total']==NULL)?0:$f['total']; ?>

</h1>

<span>

Terjual

</span>

</div>

</div>

<h2 class="section-title">

 Quick Menu

</h2>

<div class="quick-menu">

<div class="quick-card">

<div class="quick-icon">

🖨

</div>

<h2>

Cetak Laporan

</h2>

<p>

Cetak seluruh laporan penjualan
DIASAN CLOTHING dalam format
yang siap dicetak.

</p>

<a
href="laporan.php"
class="quick-btn">

Cetak Sekarang

</a>

</div>

</div>

<footer>

<h2>DIASAN CLOTHING</h2>

<p>Simple Style Better Confidence</p>

<hr>

<p>

© <?php echo date("Y"); ?> DIASAN CLOTHING

</p>

</footer>

</div>

