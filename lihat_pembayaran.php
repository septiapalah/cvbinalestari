<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["pengguna"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
}
$idbeli = $_GET["id"];

$ambil = $koneksi->query("SELECT*FROM pembayaran WHERE idbeli='$idbeli'");
$detail = $ambil->fetch_assoc();
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Lihat Pembayaran</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>

<body>
	<br><br> <br><br> <br><br> <br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<tr>
						<th>Nama</th>
						<th><?php echo $detail['nama'] ?></th>
					</tr>
					<tr>
						<th>Bank</th>
						<th><?php echo $detail['bank'] ?></th>
					</tr>
					<tr>
						<th>Jumlah</th>
						<th><?php echo number_format($detail['jumlah']); ?></th>
					</tr>
					<tr>
						<th>Tanggal</th>
						<th><?php echo $detail['tanggal'] ?></th>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<img src="foto/<?php echo $detail["bukti"] ?>" alt="" class="img-responsive">
			</div>
		</div>

	</div>
</body>

</html>