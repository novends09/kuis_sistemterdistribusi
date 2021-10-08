<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php

//get kd_buku dari url
$kd_buku = $_GET["kd"];

//query ambil data
$ambil = $koneksi->query("SELECT * FROM buku WHERE kd_buku='$kd_buku'");
$detail = $ambil->fetch_assoc();

//echo "<pre>";
//print_r($detail);
//echo "</pre>";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Detail Produk</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<!--navbar-->
<?php include 'menu.php'; ?>

<section class="kontent">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="../fotobuku/<?php echo $detail["foto_buku"]; ?>"
				alt="" class="img-responsive">
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail["judul_buku"] ?></h2>
				<h4>Rp. <?php echo number_format($detail["harga_buku"]); ?></h4>
				<h4>Penulis : <?php echo $detail["penulis"] ?></h4>
				<h4>Penerbit : <?php echo $detail["penerbit"] ?></h4>
				<h4><?php echo $detail["deskripsi_buku"] ?></h4>
				<h5>Stok : <?php echo $detail['stok_buku'] ?> </h5>
				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah"
							max="<?php echo $detail['stok_buku'] ?>">
							<div class="input-group-btn">
								<button class="btn btn-primary" name="beli">Buy</button>
							<div>
						</div>
					</div>
				</form>
				
				<?php
				//jika klik tombol Buy
				if (isset($_POST["beli"]))
				{
					//get jumlah yang diinputkan
					$jumlah = $_POST["jumlah"];
					//masukkan di keranjang belanja
					$_SESSION["keranjang"]["$kd_buku"] = $jumlah;
					
					echo "<script>alert('produk buku telah masuk ke keranjang belanja');</script>";
					echo "<script>location='keranjang.php';</script>";
				}
				?>
			</div>
		</div>
	</div>
</section>
</body>
</html>