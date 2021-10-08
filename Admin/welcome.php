 <?php

//koneksi ke database
$koneksi = new mysqli("localhost","root","","boox.co");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BooX.CO | Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   <header>
     <div class="wrapper">
        <div class="logo">
          <h1>BooX.CO</h1>
        </div>
        <ul class="nav-area">
          <li><a href="welcome.php"></i>Home</a></li>
          <li><a href="index.php?halaman=produk"></i>Books</a></li> 
          <li><a href="index.php?halaman=pembelian"></i>Transaction</a></li>
          <li><a href="index.php?halaman=laporan_pembelian"></i>Transaction Reports</a></li>
          <li><a href="index.php?halaman=pelanggan"></i>Customers</a></li> 
          <li><a href="index.php?halaman=logout"></i>Logout</a></li> 
        </ul>
     </div>

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
            } elseif ($_GET['halaman']=="ubahbuku")
              {
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

     <div class="welcome-text">
       <h1>WELCOME TO BOOX.CO ADMIN</h1>
       <a href="index.php">MANAGE</a>
      </div>
  </header>    
</body>
</html>