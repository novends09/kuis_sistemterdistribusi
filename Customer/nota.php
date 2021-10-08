<?php
session_start();
include 'koneksi.php';
?>



<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<!--navbar-->
	<?php include 'menu.php'; ?>
	
	<section class="konten">
		<div class="container">
			<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<!-- jika pelanggan yg beli tidak sama dengan pelanggan yg login, maka dilarikan ke
riwayat.php karena tidak berhak melihat nota orang lain -->
<!-- pelanggan yg beli harus pelanggan yang login -->
<?php
	//get id_pelanggan yg beli
	$idpelangganyangbeli = $detail["id_pelanggan"];
	
	//get id_pelanggan yg login
	$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];
	
	if ($idpelangganyangbeli !== $idpelangganyanglogin)
	{
		echo "<script>alert('privacy, please');</script>";
		echo "<script>location='riwayat.php';</script>";
		exit();
	}
?>

<div class ="row">
<div class="col-md-4">
	<h3>Pembelian</h3>
	<strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong> <br>
	Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
	Total Pembelian : Rp. <?php echo number_format($detail['total_pembelian']); ?>
</div>
<div class="col-md-4">
	<h3>Pelanggan</h3>
	<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
	<p>
		<?php echo $detail['telepon_pelanggan']; ?><br>
		<?php echo $detail['email_pelanggan']; ?>
	</p>
</div>
<div class="col-md-4">
	<h3>Pengiriman</h3>
	<strong><?php echo $detail['jasa_pengiriman']; ?></strong><br>
	Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?><br>
	Alamat Pengiriman: <?php echo $detail['alamat_pengiriman']; ?>
</div>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Judul Buku</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_buku WHERE id_pembelian='$_GET[id]'"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['judul_buku']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga_buku']); ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
			
			<div class="row">
				<div class="col-md-7">
					<div class="alert alert-info">
						<p>
							Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
							<strong>Bank BCA 1771001256 AN. BOOXCO</strong>
						</p>
					</div>
				</div>
			</div>
		
		</div>
	</section>
</body>
</html>