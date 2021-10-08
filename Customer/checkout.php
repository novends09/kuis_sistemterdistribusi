<?php
session_start();

include 'koneksi.php';


//jika tidak ada session_pelanggan(blm login) maka ke login.php
if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>checkout</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<!--navbar-->
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
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php $totalbelanja = 0; ?>
					<?php foreach ($_SESSION["keranjang"] as $kd_buku => $jumlah): ?>
					<!-- menampilkan buku yg sedang diperulangkan berdasarkan kd_buku -->
					<?php
						$ambil = $koneksi->query("SELECT * FROM buku 
							WHERE kd_buku='$kd_buku'");
						$pecah = $ambil->fetch_assoc();
						$subharga = $pecah["harga_buku"]*$jumlah;
								
					?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["judul_buku"]; ?></td>
						<td>Rp. <?php echo number_format($pecah["harga_buku"]); ?></td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp. <?php echo number_format($subharga); ?></td>
				
					</tr>
					<?php $nomor++; ?>
					<?php $totalbelanja+=$subharga; ?>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja) ?></th>
					</tr>
				</tfoot>
			</table>
			
	
			<form method="post">
				
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] 
							?>" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] 
							?>" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<select class="form-control" name="id_ongkir">
							<option value="">Pilih Ongkos Kirim</option>
							<?php
							$ambil = $koneksi->query("SELECT * FROM ongkir");
							while($perongkir = $ambil->fetch_assoc()){
							?>
							<option value="<?php echo $perongkir["id_ongkir"] ?>">
								<?php echo $perongkir['jasa_pengiriman'] ?> -
								Rp. <?php echo number_format($perongkir['tarif']) ?> 
							</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label>Alamat Lengkap Pengiriman</label>
					<textarea class="form-control" name="alamat_pengiriman" placeholder="Masukkan alamat lengkap pengiriman"></textarea>
				</div>
				<button class="btn btn-primary" name="checkout">Checkout</button>
			</form>
			<?php
			if (isset($_POST["checkout"]))
			{
				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
				$id_ongkir = $_POST["id_ongkir"];
				$tanggal_pembelian = date("Y-m-d");
				$alamat_pengiriman = $_POST['alamat_pengiriman'];
				
				$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
				$arrayongkir = $ambil->fetch_assoc();
				$jasa_pengiriman = $arrayongkir['jasa_pengiriman'];
				$tarif = $arrayongkir['tarif'];
				$total_pembelian = $totalbelanja + $tarif;
				
				//menyimpan data ke tabel pembelian 
				$koneksi->query("INSERT INTO pembelian (
					id_pelanggan,id_ongkir,jasa_pengiriman,tarif,tanggal_pembelian,total_pembelian,alamat_pengiriman)
					VALUES ('$id_pelanggan','$id_ongkir','$jasa_pengiriman','$tarif','$tanggal_pembelian','$total_pembelian','$alamat_pengiriman')");
				//get id_pembelian yang baru terjadi
				$id_pembelian_baru = $koneksi->insert_id;
				
				foreach ($_SESSION["keranjang"] as $kd_buku => $jumlah)
				{
					//get buku berdasarkan kd_buku
					$ambil = $koneksi->query("SELECT * FROM buku WHERE kd_buku='$kd_buku'");
					$perbuku = $ambil->fetch_assoc();
					
					$judul = $perbuku['judul_buku'];
					$harga = $perbuku['harga_buku'];
					
					$subharga = $perbuku['harga_buku']*$jumlah;
					
					$koneksi->query("INSERT INTO pembelian_buku (id_pembelian,kd_buku,judul_buku,harga_buku,subharga,jumlah)
						VALUES ('$id_pembelian_baru','$kd_buku','$judul','$harga','$subharga','$jumlah') ");
				
					//skrip udate stok
					$koneksi->query("UPDATE buku SET stok_buku=stok_buku - $jumlah WHERE kd_buku='$kd_buku'");
				}
				
				//mengkosongkan keranjang belanja
				unset($_SESSION["keranjang"]);
				
				//tampilan dialihkan ke halaman nota, nota dari pembelian yang baru
				echo "<script>alert('pembelian sukses');</script>";
				echo "<script>location='nota.php?id=$id_pembelian_baru';</script>";
			}
			?>
		</div>
	</section>

	<pre><?php print_r($_SESSION['pelanggan']) ?></pre>
	<pre><?php print_r($_SESSION["keranjang"]) ?></pre>


</body>
</html>
		
