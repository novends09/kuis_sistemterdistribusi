<h2>Ubah Data Buku</h2>
<?php
	$ambil = $koneksi->query("SELECT * FROM buku WHERE kd_buku='$_GET[kd]'");
	$pecah = $ambil->fetch_assoc();
	
	//echo "<pre>";
	//print_r($pecah);
	//echo "</pre>";
?>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Judul Buku</label>
		<input type="text" class="form-control" name="title"
		value="<?php echo $pecah['judul_buku']; ?>">
	</div>
	<div class="form-group">
		<label>Penulis</label>
		<input type="text" class="form-control" name="penulis" 
		value="<?php echo $pecah['penulis']; ?>">
	</div>
	<div class="form-group">
		<label>Penerbit</label>
		<input type="text" class="form-control" name="penerbit"
		value="<?php echo $pecah['penerbit']; ?>">
	</div>
	<div class="form-group">
		<label>Tahun Terbit</label>
		<input type="number" class="form-control" name="tahun"
		value="<?php echo $pecah['tahun_terbit']; ?>">
	</div>
	<div class="form-group">
		<label>Jumlah Halaman</label>
		<input type="text" class="form-control" name="pages"
		value="<?php echo $pecah['jumlah_halaman']; ?>">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga"
		value="<?php echo $pecah['harga_buku']; ?>">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="8">
			<?php echo $pecah['deskripsi_buku']; ?></textarea>
	</div>
	<div class="form-group">
		<img src="../fotobuku/<?php echo $pecah['foto_buku'] ?>" width="200">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
	if (isset($_POST['ubah'])){
		$namafoto=$_FILES['foto']['name'];
		$lokasifoto = $_FILES['foto']['tmp_name'];
		//jika foto diubah
		if (!empty($lokasifoto)){
			move_uploaded_file($lokasifoto, "../fotobuku/$namafoto");
			$koneksi->query("UPDATE buku SET judul_buku='$_POST[title]',
			penulis='$_POST[penulis]', penerbit='$_POST[penerbit]', tahun_terbit='$_POST[tahun]',
			jumlah_halaman='$_POST[pages]', harga_buku='$_POST[harga]', deskripsi_buku='$_POST[deskripsi]',
			foto_buku='$_POST[foto]' WHERE kd_buku='$_GET[kd]'");
		} else {
			$koneksi->query("UPDATE buku SET judul_buku='$_POST[title]',
			penulis='$_POST[penulis]', penerbit='$_POST[penerbit]', tahun_terbit='$_POST[tahun]',
			jumlah_halaman='$_POST[pages]', harga_buku='$_POST[harga]', deskripsi_buku='$_POST[deskripsi]'
			WHERE kd_buku='$_GET[kd]'");
		}
		echo "<script>alert('Data buku telah diubah');</script>";
		echo "<script>location='index.php?halaman=produk';</script>";
	}
?>