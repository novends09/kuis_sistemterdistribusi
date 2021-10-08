<h2> Tambah Buku </h2><br>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Judul Buku</label>
		<input type="text" class="form-control" name="title">
	</div>
	<div class="form-group">
		<label>Penulis</label>
		<input type="text" class="form-control" name="penulis">
	</div>
	<div class="form-group">
		<label>Penerbit</label>
		<input type="text" class="form-control" name="penerbit">
	</div>
	<div class="form-group">
		<label>Tahun Terbit</label>
		<input type="number" class="form-control" name="tahun">
	</div>
	<div class="form-group">
		<label>Jumlah Halaman</label>
		<input type="text" class="form-control" name="pages">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="8"></textarea>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php
	if (isset($_POST['save'])){
		$nama = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasi, "../fotobuku/".$nama);
		$koneksi->query("INSERT INTO buku
			(judul_buku, penulis, penerbit, tahun_terbit, jumlah_halaman, harga_buku, deskripsi_buku, foto_buku)
			VALUES('$_POST[title]', '$_POST[penulis]', '$_POST[penerbit]', '$_POST[tahun]', '$_POST[pages]', '$_POST[harga]', '$_POST[deskripsi]', '$nama')");
			
		echo "<div class='alert alert-info'>Data tersimpan</div>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	}
?>