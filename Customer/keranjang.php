<?php
	session_start();
	
	//echo "<pre>";
	//print_r($_SESSION['keranjang']);
	//echo "</pre>";
	
	include 'koneksi.php';
	
	if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])){
		echo "<script>alert('Keranjang kosong, silahkan belanja terlebih dahulu');</script>";
		echo "<script>location='indexx.php';</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<!-- navbar -->
	<?php include 'menu.php'; ?>
	
	<section class="konten">
		<div class="container">
			<h1>Keranjang Belanja</h1>
			<hr>
			<table class="table table-boardered">
				<thead>
					<tr>
						<th>No</th>
						<th>Judul Buku</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subharga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php foreach ($_SESSION["keranjang"] as $kd_buku => $jumlah): ?>
					<?php
						$ambil = $koneksi->query("SELECT * FROM buku WHERE kd_buku='$kd_buku'");
						$pecah = $ambil->fetch_assoc();
						$subharga = $pecah["harga_buku"]*$jumlah;
					?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["judul_buku"]; ?></td>
						<td>Rp. <?php echo number_format($pecah["harga_buku"]); ?></td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp. <?php echo number_format($subharga); ?></td>
						<td>
							<a href="hapuskeranjang.php?kd=<?php echo $kd_buku ?>" 
							class="btn btn-danger btn-xs">Hapus</a>
						</td>
					</tr>
					<?php $nomor++; ?>
					<?php endforeach ?>
				</tbody>
			</table>
			<a href="indexx.php" class="btn btn-default">Lanjutkan Belanja</a>
			<a href="checkout.php" class="btn btn-primary">Checkout</a>
		</div>
	</section>

</body>
</html>