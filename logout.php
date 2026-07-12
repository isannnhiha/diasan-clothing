<?php

session_start();

include "koneksi.php";

/* Simpan username admin */

$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : "Unknown";

/* Simpan history logout */

mysqli_query($conn,"
INSERT INTO history(admin,aktivitas)
VALUES(
'$admin',
'🚪 Logout dari sistem'
)
");

/* Hapus session */

session_destroy();

/* Kembali ke login */

header("Location: login.php");
exit;

?>