<?php
session_start();
$koneksi = new mysqli("localhost","root","","boox.co");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login BooX.CO</title>
	<link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body>
    <div class="wrapper">
		<img src="avatar.PNG" class="user">
		<h1>BooX.CO</h1>
                         <form role="form" method="post">
                            <div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" name="user" placeholder="Enter Username" />
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
								<input type="password" class="form-control"  name="pass" placeholder="Enter Password" />
							</div>
							<div class="bottom-text">
								<input type="checkbox" name="remember" checked="checked"> Remember me
								<a href="#">Forgot Password ?</a>
							</div>	       
                            <input type="submit" class="btn btn-primary" name="login" value="LOGIN">
						
						</form>
									<?php
									if (isset($_POST['login'])){
										$ambil = $koneksi->query("SELECT * FROM admin WHERE username = '$_POST[user]'
														AND password = '$_POST[pass]'");
										$yangcocok = $ambil->num_rows;
										if ($yangcocok==1){
											$_SESSION['admin']=$ambil->fetch_assoc();
											echo "<div class='alert alert-info'>Login Sukses</div>";
											echo "<meta http-equiv='refresh' content='1;url=welcome.php'>";
										} else {
											echo "<div class='alert alert-danger'>Login Gagal</div>";
											echo "<meta http-equiv='refresh' content='1;url=loginboox.php'>";
										}		
									}
									?>

    </div>
	<div id="overlay-area"></div>
</body>
</html>