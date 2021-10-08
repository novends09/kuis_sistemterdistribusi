<?php
session_start();
include 'koneksi.php';

$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran 
LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian 
WHERE pembelian.id_pembelian = '$id_pembelian'");
$detailbayar = $ambil->fetch_assoc();


if(empty($detailbayar))
{
	echo "<script>alert('belum ada data pembayaran');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

//jika data pelanggan yg membayar tidak sesuai dengan yang login

if($_SESSION["pelanggan"]['id_pelanggan'] != $detailbayar["id_pelanggan"])
{
	echo "<script>alert('Security')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Pembayaran</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	
	<div class="container">
		<h1>Detail Pembayaran</h1>
			<div class="row">
				<div class="col-md-6">
					<table class="table">
						<tr>
							<th>Nama</th>
							<td><?php echo $detailbayar["nama"] ?></td>
						</tr>
						<tr>
							<th>Bank</th>
							<td><?php echo $detailbayar["bank"] ?></td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<td><?php echo $detailbayar["tanggal"] ?></td>
						</tr>
						<tr>
							<th>Jumlah</th>
							<td>Rp. <?php echo number_format($detailbayar["jumlah"]) ?></td>
						</tr>
					</table>
				</div>
				<div class="col-md-6">
					<img src="../Customer/bukti_pembayaran/<?php echo $detailbayar['bukti'] ?>" alt="" class="img-responsive">
				</div>
			</div>
	</div>
</body>
</html>
