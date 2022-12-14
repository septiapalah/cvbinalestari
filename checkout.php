<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["pengguna"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
}
?>
<?php include 'header.php'; ?><br><br><br>
<section id="home-section" class="hero">
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table table-striped" id="tabel">
						<thead class="thead-white">
							<tr class="text-center">
								<th>No</th>
								<th>Produk</th>
								<th>Harga</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$nomor = 1;
							$totalbelanja = 0;
							foreach ($_SESSION["keranjang"] as $idproduk => $jumlah) : ?>
								<?php
									$ambil = $koneksi->query("SELECT * FROM produk WHERE idproduk='$idproduk'");
									$pecah = $ambil->fetch_assoc();
									$totalharga = $pecah["hargaproduk"] * $jumlah;
									?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['namaproduk']; ?></td>
									<td>Rp <?php echo number_format($pecah['hargaproduk']); ?></td>
								</tr>
							<?php
								$nomor++;
								$totalbelanja += $totalharga;
							endforeach ?>
						</tbody>
						<tfoot>
							<tr class="text-center">
								<td>
								</td>
								<td>
									<b class="text-center">Grand Total</b>
								</td>
								<td>
									<b><?= rupiah($totalbelanja) ?></b>
								</td>
							</tr>
						</tfoot>
					</table>
					<br>
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<div class="container mt-4">
		<form method="post">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Nama Pelanggan</label>
						<input type="text" readonly value="<?php echo $_SESSION["pengguna"]['nama'] ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>No. Handphone Pelanggan</label>
						<input type="text" readonly value="<?php echo $_SESSION["pengguna"]['telepon'] ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Alamat Lengkap</label>
						<textarea class="form-control" name="alamat" placeholder="Masukkan Alamat"><?php echo $_SESSION["pengguna"]['alamat'] ?></textarea>
					</div>
					<button class="btn btn-primary pull-right btn-lg" name="checkout">Checkout</button>
				</div>
			</div>
		</form>
	</div>
</section>
<?php
if (isset($_POST["checkout"])) {
	$notransaksi = '#TP' . date("Ymdhis");
	$id = $_SESSION["pengguna"]["id"];
	$tanggalbeli = date("Y-m-d");
	$waktu = date("Y-m-d H:i:s");
	$alamat = $_POST["alamat"];
	$totalbeli = $totalbelanja;
	$koneksi->query(
		"INSERT INTO pembelian(notransaksi,
				id, tanggalbeli, totalbeli, alamat, statusbeli, waktu)
				VALUES('$notransaksi','$id', '$tanggalbeli', '$totalbeli', '$alamat','Belum Bayar', '$waktu')"
	) or die(mysqli_error($koneksi));
	$idbeli_barusan = $koneksi->insert_id;
	foreach ($_SESSION['keranjang'] as $idproduk => $jumlah) {
		$ambil = $koneksi->query("SELECT*FROM produk WHERE idproduk='$idproduk'");
		$perproduk = $ambil->fetch_assoc();
		$nama = $perproduk['namaproduk'];
		$harga = $perproduk['hargaproduk'];
		$koneksi->query("INSERT INTO pembelianproduk (idbeli, idproduk, nama, harga, jumlah)
					VALUES ('$idbeli_barusan','$idproduk', '$nama','$harga','$jumlah')") or die(mysqli_error($koneksi));
	}
	// unset($_SESSION["keranjang"]);
	echo "<script> alert('Pembelian Sukses');</script>";
	echo "<script> location ='riwayat.php';</script>";
}
?>
<?php
include 'footer.php';
?>