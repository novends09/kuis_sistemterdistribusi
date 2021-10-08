<?php include 'koneksi.php'; ?>
<?php
$keyword = $_GET["keyword"];

$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM buku WHERE judul_buku LIKE '%$keyword%' OR penulis LIKE '%$keyword%'");

while($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}

//echo "<pre>";
//print_r ($semuadata);
//echo "</pre>";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pencarian</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'menu.php'; ?>
	<div class="container">
		<h3>Hasil Pencarian : <?php echo $keyword ?><h3>
		
		<?php if(empty($semuadata)): ?>
			<div class="alert alert-danger">Buku </strong><?php echo $keyword ?></strong> tidak ditemukan</div>
		<?php endif ?>
		
		<div class="row">
			<?php foreach ($semuadata as $key => $value): ?>
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="../fotobuku/<?php echo $value['foto_buku']; ?>" class="img-responsive" alt=""> 
						<div class="caption">
							<h3><?php echo $value['judul_buku']; ?></h3>
							<h5>Rp. <?php echo number_format($value['harga_buku']); ?></h5>
							<a href="buy.php?kd=<?php echo $value['kd_buku']; ?>" class="btn btn-primary">Buy</a>
							<a href="detail.php?kd=<?php echo $value["kd_buku"]; ?>" class="btn btn-default">Detail</a>
						</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</body>
</html>