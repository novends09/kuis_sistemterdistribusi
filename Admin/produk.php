<?php
include 'koneksi.php';

?>
<h2>Data Buku</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>Kode Buku</th>
			<th>Judul Buku</th>
			<th>Penulis</th>
			<th>Penerbit</th>
			<th>Tahun Terbit</th>
			<th>Jumlah Halaman</th>
			<th>Harga Buku</th>
			<th>Deskripsi</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php $ambil = $koneksi->query("SELECT * FROM buku"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['judul_buku']; ?></td>
			<td><?php echo $pecah['penulis']; ?></td>
			<td><?php echo $pecah['penerbit']; ?></td>
			<td><?php echo $pecah['tahun_terbit']; ?></td>
			<td><?php echo $pecah['jumlah_halaman']; ?></td>
			<td><?php echo $pecah['harga_buku']; ?></td>
			<td><?php echo $pecah['deskripsi_buku']; ?></td>
			<td>
				<img src="../fotobuku/<?php echo $pecah['foto_buku']; ?>" width="100"> 
			</td>
			<td>
				<a href="index.php?halaman=hapusbuku&kd=<?php 
					echo $pecah['kd_buku']; ?>" class="btn btn-danger">hapus</a>
				<a href="index.php?halaman=ubahbuku&kd=<?php 
					echo $pecah['kd_buku']; ?>" class="btn btn-warning">ubah</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
<a href="index.php?halaman=tambahbuku" class="btn btn-primary">Tambah Buku</a>	