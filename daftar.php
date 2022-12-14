<?php include 'header.php'; ?>
<section id="home-section" class="ftco-section">
	<div class="container mt-4">
		<div class="row justify-content-center">
			<div class="col-md-6 my-auto">
				<img width="100%" src="foto/daftar.png">
			</div>
			<div class="col-md-6">
				<form method="post" class="form-horizontal">
					<div class="form-group">
						<label class="control-label">Nama</label>
						<input type="text" name="nama" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Email</label>
						<input type="email" name="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="text" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Alamat</label>
						<textarea class="form-control " name="alamat" required></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">Telepon</label>
						<input type="text" name="telepon" class="form-control">
					</div>
					<div class="form-group mt-3">
						<button class="btn btn-primary btn-block" name="daftar">Daftar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php
if (isset($_POST["daftar"])) {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$alamat = $_POST['alamat'];
	$telepon = $_POST['telepon'];
	$ambil = $koneksi->query("SELECT*FROM pengguna 
							WHERE email='$email'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok == 1) {
		echo "<script>alert('Pendaftaran Gagal, email sudah terdaftar')</script>";
		echo "<script>location='daftar.php';</script>";
	} else {
		$koneksi->query("INSERT INTO pengguna (nama, email,  password, alamat, telepon)
								VALUES('$nama','$email','$password','$alamat','$telepon'
								)");
		echo "<script>alert('Pendaftaran Berhasil')</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>