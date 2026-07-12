<?php

session_start();

include "koneksi.php";

$id=$_POST['id'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$no_hp=$_POST['no_hp'];
$produk=$_POST['produk'];
$ukuran=$_POST['ukuran'];
$jumlah=$_POST['jumlah'];

/* Menentukan harga berdasarkan produk */

if($produk=="Kaos Polos")
{
    $harga=85000;
}
elseif($produk=="Kaos Basic")
{
    $harga=150000;
}
elseif($produk=="Jaket Kulit")
{
    $harga=220000;
}
elseif($produk=="Hodie")
{
    $harga=180000;
}
elseif($produk=="Kemeja Flanel")
{
    $harga=160000;
}
else
{
    $harga=0;
}

$total=$harga*$jumlah;

/* Update pesanan */

mysqli_query($conn,"
UPDATE pesanan SET

nama='$nama',
alamat='$alamat',
no_hp='$no_hp',
produk='$produk',
ukuran='$ukuran',
jumlah='$jumlah',
total_harga='$total'

WHERE id='$id'
");

/* Simpan History */

$admin=$_SESSION['admin'];

$aktivitas="✏️ Mengedit pesanan milik ".$nama;

mysqli_query($conn,"
INSERT INTO history(admin,aktivitas)
VALUES(
'$admin',
'$aktivitas'
)
");

header("Location:pesanan.php");

?>