<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//jika tidak ada session pelanggan (blm login)
if(!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

//get id_pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//get id_pelanggan yang melakukan pembelian
$id_pelanggan_beli = $detpem["id_pelanggan"];
//get id_pelanggan yang melakukan login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login != $id_pelanggan_beli)
{
	echo "<script>alert('security');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	
	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<p>Kirim bukti pembayaran Anda disini</p>
		<div class="alert alert-info">Total Tagihan Anda
			<strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?> </strong>
		</div>
		
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Penyetor</label>
				<input type="text" class="form-control" name="nama">
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text" class="form-control" name="bank">
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" min="1">
			</div>
			<div class="form-group">
				<label>Foto Bukti Transfer</label>
				<input type="file" class="form-control" name="bukti">
				<p class="text-danger">Foto bukti transfer harus JPG maksimal 2MB</p>
			</div>
			<button class="btn btn-primary" name="kirim">Kirim</button>
		</form>
	</div>
<?php
//jika klik tombol kirim
if (isset($_POST["kirim"]))
{
	//upload foto terlebih dahulu
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafix = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");
	
	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");
	
	//simpan data pembayaran
	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
	VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafix') ");
	
	//update status pembayaran
	$koneksi->query("UPDATE pembelian SET status_pembelian='telah melakukan pembayaran'
	WHERE id_pembelian='$idpem'");
	echo "<script>alert('Terima kasih telah melakukan pembayaran');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>
</body>
</html>