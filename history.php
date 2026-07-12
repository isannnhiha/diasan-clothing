<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "koneksi.php";

/* Ambil semua history */

$data = mysqli_query($conn,"
SELECT *
FROM history
ORDER BY waktu DESC
");

if(!$data){
    die("Query Error : ".mysqli_error($conn));
}

/* Statistik */

$total_login = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM history
WHERE aktivitas LIKE '%Login%'
"));

$total_edit = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM history
WHERE aktivitas LIKE '%Mengedit%'
"));

$total_hapus = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM history
WHERE aktivitas LIKE '%Menghapus%'
"));

$total_logout = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM history
WHERE aktivitas LIKE '%Logout%'
"));

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>History Aktivitas</title>

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
linear-gradient(rgba(15,23,42,.70),rgba(15,23,42,.70)),
url("https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=2000&q=80");

background-size:cover;
background-position:center;
background-attachment:fixed;
min-height:100vh;

}

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

font-size:30px;

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

transition:.3s;

}

nav a:hover{

color:#60a5fa;

}

.container{

width:92%;

max-width:1450px;

margin:auto;

padding:40px 0;

}

.history-header{

background:rgba(255,255,255,.08);

backdrop-filter:blur(20px);

padding:40px;

border-radius:25px;

color:white;

text-align:center;

margin-bottom:35px;

box-shadow:0 15px 35px rgba(0,0,0,.25);

}

.history-header h1{

font-size:45px;

margin-bottom:10px;

}

.history-header p{

font-size:18px;

color:#ddd;

}

.history-card{

display:grid;

grid-template-columns:repeat(auto-fit,minmax(220px,1fr));

gap:25px;

margin-bottom:40px;

}

.card{

background:rgba(255,255,255,.08);

backdrop-filter:blur(20px);

-webkit-backdrop-filter:blur(20px);

border:1px solid rgba(255,255,255,.15);

padding:35px;

border-radius:25px;

text-align:center;

color:white;

box-shadow:0 15px 35px rgba(0,0,0,.25);

transition:.35s;

position:relative;

overflow:hidden;

}

.card::before{

content:"";

position:absolute;

top:0;

left:0;

width:100%;

height:4px;

background:rgba(255,255,255,.35);

}

.card:hover{

transform:translateY(-10px);

background:rgba(255,255,255,.12);

box-shadow:0 20px 45px rgba(0,0,0,.35);

}

.card h3{

margin-top:15px;

font-size:22px;

font-weight:600;

}

.card h1{

font-size:50px;

margin:15px 0;

}

.card p{

color:#d6d6d6;

}

.login,
.edit,
.hapus,
.logout{

background:rgba(255,255,255,.08);

backdrop-filter:blur(20px);

-webkit-backdrop-filter:blur(20px);

border:1px solid rgba(255,255,255,.15);

}

.card h3{

font-size:22px;

margin-bottom:15px;

}

.card h1{

font-size:42px;

}

.table-box{

background:rgba(255,255,255,.08);

backdrop-filter:blur(20px);

border-radius:25px;

overflow:hidden;

box-shadow:0 15px 35px rgba(0,0,0,.25);

}

table{

width:100%;

border-collapse:collapse;

color:white;

}

th{

padding:20px;

background:rgba(255,255,255,.15);

font-size:17px;

}

td{

padding:18px;

text-align:center;

border-top:1px solid rgba(255,255,255,.08);

}

tr:hover{

background:rgba(255,255,255,.05);

}

.badge{

padding:8px 18px;

border-radius:30px;

font-weight:bold;

display:inline-block;

}

.badge-login{

background:#2563eb;

}

.badge-edit{

background:#f59e0b;

}

.badge-hapus{

background:#dc2626;

}

.badge-logout{

background:#16a34a;

}

.btn{

display:inline-block;

padding:15px 35px;

background:linear-gradient(135deg,#2563eb,#1d4ed8);

color:white;

text-decoration:none;

border-radius:12px;

transition:.3s;

font-weight:bold;

}

.btn:hover{

transform:translateY(-3px);

}

footer{

margin-top:60px;

background:rgba(255,255,255,.08);

backdrop-filter:blur(20px);

padding:40px;

color:white;

text-align:center;

}

.footer-content h2{

font-size:32px;

margin-bottom:10px;

}

.footer-content hr{

margin:20px 0;

border:none;

height:1px;

background:rgba(255,255,255,.15);

}

</style>

</head>

<body>

<nav>

<h1>DIASAN ADMIN</h1>

<ul>

<li><a href="dashboard.php">Dashboard</a></li>

<li><a href="pesanan.php">Data Pesanan</a></li>

<li><a href="history.php">History</a></li>

<li><a href="logout.php">Logout</a></li>

</ul>

</nav>

<div class="container">

<div class="history-header">

<h1>

 HISTORY AKTIVITAS ADMIN

</h1>

<p>

Seluruh aktivitas admin akan tercatat secara otomatis sebagai audit trail sistem DIASAN CLOTHING.

</p>

</div>
<div class="history-card">

<div class="card login">

<div style="font-size:55px;"></div>

<h3>Login</h3>

<h1><?php echo $total_login['total']; ?></h1>

<p>Total Login Admin</p>

</div>

<div class="card edit">

<div style="font-size:55px;"></div>

<h3>Edit Data</h3>

<h1><?php echo $total_edit['total']; ?></h1>

<p>Pesanan Diedit</p>

</div>

<div class="card hapus">

<div style="font-size:55px;"></div>

<h3>Hapus Data</h3>

<h1><?php echo $total_hapus['total']; ?></h1>

<p>Pesanan Dihapus</p>

</div>

<div class="card logout">

<div style="font-size:55px;"></div>

<h3>Logout</h3>

<h1><?php echo $total_logout['total']; ?></h1>

<p>Admin Logout</p>

</div>

</div>

</div>

<div class="table-box">

<div style="padding:25px;">

<h2 style="color:white;">

 Riwayat Aktivitas

</h2>

<p style="color:#ddd;margin-top:8px;">

Menampilkan seluruh aktivitas administrator.

</p>

</div>

<table>

<tr>

<th width="25%">

🕒 Waktu

</th>

<th width="20%">

👤 Admin

</th>

<th>

📝 Aktivitas

</th>

<th width="20%">

Status

</th>

</tr>

<?php

while($d=mysqli_fetch_assoc($data)){

$status="";
$class="";

if(strpos($d['aktivitas'],"Login")!==false){

$status=" Login";
$class="badge-login";

}
elseif(strpos($d['aktivitas'],"Mengedit")!==false){

$status=" Edit";
$class="badge-edit";

}
elseif(strpos($d['aktivitas'],"Menghapus")!==false){

$status=" Hapus";
$class="badge-hapus";

}
elseif(strpos($d['aktivitas'],"Logout")!==false){

$status=" Logout";
$class="badge-logout";

}
else{

$status=" Aktivitas";
$class="badge-login";

}

?>

<tr>

<td>

<?php

echo date(
"d-m-Y H:i:s",
strtotime($d['waktu'])
);

?>

</td>

<td>

<b>

<?php echo htmlspecialchars($d['admin']); ?>

</b>

</td>

<td>

<?php echo htmlspecialchars($d['aktivitas']); ?>

</td>

<td>

<span class="badge <?php echo $class; ?>">

<?php echo $status; ?>

</span>

</td>

</tr>

<?php } ?>

</table>
</div>

<br><br>

<div style="text-align:center;">

<a href="dashboard.php" class="btn">

⬅ Kembali ke Dashboard

</a>

</div>

</div>

<footer>

<div class="footer-content">

<h2>
<div class="page-header">


<br>

<hr>

<br>

<p>

© <?php echo date("Y"); ?>

DIASAN CLOTHING

</p>

</div>

</footer>

</body>

</html>