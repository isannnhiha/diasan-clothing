<?php

include "koneksi.php";

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];

if(!preg_match('/^[0-9]+$/', $no_hp))
{
    die("Nomor HP hanya boleh angka");
}

$produk = $_POST['produk'];

$harga = $_POST['harga'];

$ukuran = $_POST['ukuran'];

$jumlah = $_POST['jumlah'];

$total = $_POST['total_harga'];

mysqli_query($conn,

"INSERT INTO pesanan
(
nama,
alamat,
no_hp,
produk,
ukuran,
jumlah,
total_harga
)

VALUES
(
'$nama',
'$alamat',
'$no_hp',
'$produk',
'$ukuran',
'$jumlah',
'$total'
)

");

header("Location: selesai.php");

exit;

?>
