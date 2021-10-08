<?php
session_start();
//koneksi ke database
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BooX.CO | Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                
                <a class="navbar-brand" href="index.html">BooX.CO Admin</a> 
            </div>
        </nav>   
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="avatar.PNG" class="user-image img-responsive"/>
					</li>
					<li><a href="welcome.php"><i class="fa fa-user "></i>Home</a></li>
					<li><a href="index.php?halaman=produk"><i class="fa fa-book "></i>Books</a></li> 
					<li><a href="index.php?halaman=pembelian"><i class="fa fa-shopping-cart"></i>Transaction</a></li>
					<li><a href="index.php?halaman=laporan_pembelian"><i class="fa fa-file"></i>Transaction Reports</a></li>
					<li><a href="index.php?halaman=pelanggan"><i class="fa fa-user "></i>Customers</a></li> 
					<li><a href="index.php?halaman=logout"><i class="fa fa-sign-out "></i>Logout</a></li> 
                </ul>
            </div>
            
        </nav>  
        <div id="page-wrapper" >
            <div id="page-inner">
				<?php
					if (isset($_GET['halaman'])){
						if ($_GET['halaman']=="produk"){
							include 'produk.php';
						} elseif ($_GET['halaman']=="pembelian"){
							include 'pembelian.php';
						} elseif ($_GET['halaman']=="pelanggan"){
							include 'pelanggan.php';
						} elseif ($_GET['halaman']=="detail"){
							include 'detail.php';
						} elseif ($_GET['halaman']=="tambahbuku"){
							include 'tambahbuku.php';
						} elseif ($_GET['halaman']=="hapusbuku"){
							include 'hapusbuku.php';
						} elseif ($_GET['halaman']=="ubahbuku"){
							include 'ubahbuku.php';
						} elseif ($_GET['halaman']=="logout"){
							include 'logout.php';
						} elseif ($_GET['halaman']=="hapuspelanggan"){
							include 'hapuspelanggan.php';
						} elseif ($_GET['halaman']=="pembayaran"){
							include 'pembayaran.php';
						} elseif ($_GET['halaman']=="laporan_pembelian"){
							include 'laporan_pembelian.php';
						} 
					} else {
						include 'home.php';
					}
				?>
			</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
   <header>
     <div class="wrapper">
        <div class="logo">
          <h1>BooX.CO</h1>
        </div>
        <ul class="nav-area">
          <li><a href="welcome.php">Home</a></li>
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
     </div>

     <div class="welcome-text">
       <h1>WELCOME TO BOOX.CO</h1>
       <a href="indexx.php">SHOP NOW</a>
      </div>
  </header>    
</body>
</html>