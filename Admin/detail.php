<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<!--<pre><?php //print_r($detail); ?></pre>-->

<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
<p>
	<?php echo $detail['telepon_pelanggan']; ?><br>
	<?php echo $detail['email_pelanggan']; ?>
</p>
<p>
	Tanggal Pembelian : <?php echo $detail['tanggal_pembelian']; ?><br>
	Total Pembelian : <?php echo $detail['total_pembelian']; ?>
</p>

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
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_buku 
			JOIN buku ON pembelian_buku.kd_buku=buku.kd_buku
			WHERE pembelian_buku.id_pembelian='$_GET[id]'"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['judul_buku']; ?></td>
			<td><?php echo $pecah['harga_buku']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				<?php echo $pecah['harga_buku']*$pecah['jumlah']; ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
			