<?php

session_start();

include "koneksi.php";

$id = $_GET['id'];

/* Ambil data pesanan terlebih dahulu */

$data = mysqli_query($conn,"
SELECT * FROM pesanan
WHERE id='$id'
");

$d = mysqli_fetch_assoc($data);

/* Simpan nama admin */

$admin = $_SESSION['admin'];

/* Buat aktivitas */

$aktivitas = "🗑️ Menghapus pesanan milik ".$d['nama']." (".$d['produk'].")";

/* Simpan ke tabel history */

mysqli_query($conn,"
INSERT INTO history(admin,aktivitas)
VALUES(
'$admin',
'$aktivitas'
)
");

/* Hapus data pesanan */

mysqli_query($conn,"
DELETE FROM pesanan
WHERE id='$id'
");

/* Kembali */

header("Location: pesanan.php");

?>