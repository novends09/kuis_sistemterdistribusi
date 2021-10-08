<?php
session_start();
//koneksi ke database
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BooX.CO | Home </title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
   
   <div class="wrapper">
<!--NAVIGATION-->
       <nav>
          <h1>BooX.CO</h1>
          <ul>
              <li><a href="welcome.php">Home</a></li>
              <li><a href="indexx.php">Shop</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<!-- Jika sudah login(ada session pelanggan) -->
				<?php if (isset($_SESSION["pelanggan"])): ?>
					<li><a href="riwayat.php">Riwayat Belanja</a></li>
					<li><a href="logout.php">Logout</a></li>
				<!-- selain itu(belum login||belum ada session pelanggan) -->
				<?php else: ?>
					<li><a href="login.php">Login</a></li>
					<li><a href="daftar.php">Registrasi</a></li>
				<?php endif ?>
					<li><a href="checkout.php">Checkout</a></li>
          </ul>
       </nav>
<!--END OF NAVIGATION-->
      
      <div class="section">
          <h1>Pilihlah Buku Terbaikmu selama <br> #DIRUMAHAJA</h1>
          <p>Aplikasi BooX.CO adalah solusi untuk semua kebutuhan buku, buku sekolah, majalah dan lain-lain. <br>
         	BooX.CO menawarkan kemudahan dan kenyaman dalam pengalaman berbelanja bagi mereka yang mencari penawaran menarik baik online dan offline.
      		Dilengkapi dengan kemudahan sistem, seperti pengambilan barang di toko atau pengiriman online dengan dukungan pengiriman di seluruh Indonesia.
      		Menyediakan kemudahan bagi pengguna dan pengalaman berbelanja yang menyenangkan. Toko Buku Online BooX.CO menyediakan aneka buku berkualitas dan terlengkap. Nikmati promo buku murah dengan pengiriman beragam. </p>
          
          <a href="index.php"><button class="btn-1">MORE BOOKS</button></a>

      </div>
<!--END OF SECTION-->
   </div>
<!--END OF WRAPPER-->
   
<!--SHOWCASE-->
   <showcase>
       	<h1>RECOMMANDED</h1>
       	<div id="courses">
       		<?php $ambil = $koneksi->query("SELECT * FROM buku"); ?>
				<?php  while($perbuku = $ambil->fetch_assoc()){ ?>
           	<div class="cs">
               <img src="../fotobuku/<?php echo $perbuku['foto_buku']; ?>" alt=""> 
					<h3><?php echo $perbuku['judul_buku']; ?></h3>
					<h5>Rp. <?php echo number_format($perbuku['harga_buku']); ?></h5>
					<a href="buy.php?kd=<?php echo $perbuku['kd_buku']; ?>" class="apply">Buy</a>
					<a href="detail.php?kd=<?php echo $perbuku["kd_buku"]; ?>" class="apply">Detail</a>
			</div>
			<?php } ?>
      	</div>
   </showcase>
<!--END OF SHOWCASE-->
   
   <footer>
       <p>Copyright &copy; 2020, BooX.CO</p>
   </footer>
    
</body>
</html>