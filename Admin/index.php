<?php
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","boox.co");


if(!isset($_SESSION['admin'])){
	echo "<script>alert('Anda harus login');</script>";
	echo "<script>location='loginboox.php';</script>";
	header('location:loginboox.php');
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BooX.CO Admin</title>
    <link href="l\resources\views\style.css" rel="stylesheet" />
    <link href="font.css" rel="stylesheet" />
    <link href="custom.css" rel="stylesheet" />
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
    
</body>
</html>
