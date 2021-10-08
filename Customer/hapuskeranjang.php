<?php
session_start();
$kd_buku=$_GET["kd"];
unset($_SESSION["keranjang"][$kd_buku]);

echo "<script>alert('Produk buku dihapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>