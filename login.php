<?php include 'header.php'; ?>
<section id="home-section" class="ftco-section">
	<div class="container mt-4">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<img width="100%" src="foto/daftar.png">
			</div>
			<div class="col-md-6 my-auto">
				<form method="post">
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password">
					</div>
					<br>
					<button class="btn btn-primary btn-block" name="simpan">Masuk</button>
				</form>
			</div>
		</div>
</section>
<?php
if (isset($_POST["simpan"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	$ambil = $koneksi->query("SELECT * FROM pengguna
		WHERE email='$email' AND password='$password' limit 1");
	$akunyangcocok = $ambil->num_rows;
	if ($akunyangcocok == 1) {
		$akun = $ambil->fetch_assoc();
		$_SESSION["pengguna"] = $akun;
		echo "<script> alert('Login berhasil');</script>";
		echo "<script> location ='index.php';</script>";
	} else {
		echo "<script> alert('Email atau password anda salah');</script>";
		echo "<script> location ='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>