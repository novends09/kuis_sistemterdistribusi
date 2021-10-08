<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login BooX.CO</title>
	<link rel="stylesheet" type="text/css" href="stylelogin.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- navbar -->
	<?php include 'menu.php'; ?>
	
    <div class="wrapper">
		<img src="avatar.PNG" class="user">
		<h1>BooX.CO</h1>
                         <form role="form" method="post">
                            <div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email" />
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
								<input type="password" class="form-control"  name="password" placeholder="Enter Password" />
							</div>
							<div class="bottom-text">
								<input type="checkbox" name="remember" checked="checked"> Remember me
								<a href="#">Forgot Password ?</a>
							</div>
								<br><br>
                            <input type="submit" class="btn btn-primary" name="login" value="LOGIN">
							Not register ? <a href="daftar.php" >Click Here</a> 
						</form>
									<?php
									//jika ada tombol login (tombol login ditekan)
									if (isset($_POST['login'])){
										$email = $_POST["email"];
										$password = $_POST["password"];
										//lakukan query untuk cek akun di tabel pelanggan pada database
										$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'
												AND password_pelanggan = '$password'");
										//menghitung akun yang terambil
										$yangcocok = $ambil->num_rows;
										//jika 1 akun yang cocok, maka di loginkan
										if ($yangcocok==1){
											//anda sukses login
											//mendapatkan akun dalam bentuk array
											$akun = $ambil->fetch_assoc();
											//simpan di session pelanggan
											$_SESSION["pelanggan"] = $akun;
											echo "<script>alert('Anda sukses login');</script>";
											
											//jika sudah belanja
											if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
											{
												echo "<script>location='checkout.php';</script>";
											}
											else
											{
												echo "<script>location='welcome.php';</script>";
											}
										} else {
											//jika gagal login
											echo "<script>alert('Anda gagal login, periksa akun Anda');</script>";
											echo "<script>location='login.php';</script>";
										}		
									}
									?>

    </div>
	<div id="overlay-area"></div>
</body>
</html>