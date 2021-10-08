<?php
	session_start();
	//get kd_buku dari url
	$kd_buku = $_GET['kd'];
	
	if(isset($_SESSION['keranjang'][$kd_buku])){
		$_SESSION['keranjang'][$kd_buku]+=1;
	} else {
		$_SESSION['keranjang'][$kd_buku] = 1;
	}
	
	//ke halaman keranjang
	echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
	echo "<script>location='keranjang.php';</script>";
?>