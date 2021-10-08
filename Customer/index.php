<?php
session_start();
//koneksi ke database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>BooX.CO</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	
	<section class="konten">
		<div class="container">
			<h1>BUKU POPULER</h1>
			
			<div class="row">
				<?php $ambil = $koneksi->query("SELECT * FROM buku"); ?>
				<?php  while($perbuku = $ambil->fetch_assoc()){ ?>
				
				<div class="col-md-3">
					<div class="thumbnail">
						<img src="../fotobuku/<?php echo $perbuku['foto_buku']; ?>" alt=""> 
						<div class="caption">
							<h3><?php echo $perbuku['judul_buku']; ?></h3>
							<h5>Rp. <?php echo number_format($perbuku['harga_buku']); ?></h5>
							<a href="buy.php?kd=<?php echo $perbuku['kd_buku']; ?>" class="btn btn-primary">Buy</a>
							<a href="detail.php?kd=<?php echo $perbuku["kd_buku"]; ?>" class="btn btn-default">Detail</a>
						</div>
					</div>
				</div>
				<?php } ?>
			
			</div>
		
		</div>
	</section>

</body>
</html>
