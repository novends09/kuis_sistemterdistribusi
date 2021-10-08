<?php
$ambil = $koneksi->query("SELECT * FROM buku WHERE kd_buku='$_GET[kd]'");
$pecah = $ambil->fetch_assoc();
$fotobuku = $pecah['foto_buku'];
if (file_exists("../fotobuku/$fotobuku")){
	unlink("../fotobuku/$fotobuku");
}

$koneksi->query("DELETE FROM buku WHERE kd_buku='$_GET[kd]'");

echo "<script>alert('Data buku terhapus');</script>";
echo "<script>location='index.php?halaman=buku';</script>";

?>