<?php include 'header.php'; ?>
<?php
$idproduk = $_GET["id"];
$idpengguna = $_SESSION["pengguna"]["idpengguna"];
$ambil = $koneksi->query("SELECT*FROM produk WHERE idproduk='$idproduk'");
$detail = $ambil->fetch_assoc();
$ambilfoto = $koneksi->query("SELECT * FROM produkfoto WHERE idproduk='$detail[idproduk]' limit 1");
$foto = $ambilfoto->fetch_assoc();
?>
<section class="ftco-section ftco-degree-bg">
	<div class="container">
		<div class="row mb-3">
			<div class="col-md-12">
				<h2 class="mb-3"><?php echo $detail["namaproduk"] ?></h2>
				<br>
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php
						$no = 1;
						$ambilfoto = $koneksi->query("SELECT * FROM produkfoto where idproduk='$detail[idproduk]'");
						while ($foto = $ambilfoto->fetch_assoc()) {
							if ($no == '1') {
								$aktif = "active";
							} else {
								$aktif = "";
							}
						?>
							<div class="carousel-item <?= $aktif ?>">
								<img class="d-block w-100" src="foto/<?php echo $foto["foto"]; ?>" height="500px" style="border-radius: 5px">
							</div>
						<?php
							$no++;
						}
						?>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
		<br><br>
		<div class="row mb-3">
			<div class="col-lg-12 ftco-animate">
				<h2 class="mb-3"><?php echo $detail["namaproduk"] ?></h2>
				<p>Tipe Rumah : <?php echo $detail["tiperumah"]; ?></p>
				<p style="color:#ff836d"><span>Harga : Rp. <?php echo number_format($detail["hargaproduk"]); ?></span></p>
				<span class="text-justify"><?php echo $detail["deskripsiproduk"]; ?></span>
				<br>
				<br>
				<p class="text-center">Alamat Rumah : <?php echo $detail["alamatrumah"]; ?></p>
				<br>
				<br>
			</div>
		</div>

		<div class="row mb-3">
			<form class="col-md-12" id="simulasiKredit">
				<h3 class="mb-3 text-center">Form Simulasi KPR</h3>
				<div class="form-group">
					<label for="jumlahKredit">Jumlah Kredit <em>(rupiah)</em>: </label>
					<input type="hidden" class="form-control" id="id" name="id" value="<?= $_GET['id'] ?>">
					<input type="number" class="form-control" id="jumlahKredit" name="jumlahKredit" placeholder="Contoh: 150000000" value="<?= $detail['hargaproduk'] ?>">
				</div>

				<div class="form-group">
					<label for="jangkaWaktu">Jangka Waktu <em>(bulan)</em>: </label>
					<input type="number" class="form-control" id="jangkaWaktu" name="jangkaWaktu" placeholder="Contoh: 120" value="12">
				</div>

				<div class="form-group">
					<label for="bungaPertahun">Bunga Pertahun <em>(%)</em>: </label>
					<input type="number" class="form-control" id="bungaPertahun" name="bungaPertahun" placeholder="Contoh: 10.5" value="1.5">
				</div>

				<div class="form-group">
					<div class="form-check-inline">
						<input type="radio" class="form-check-input" value="1" name="metode" id="Flat" checked>
						<label class="form-check-label" for="Flat">Flat</label>
					</div>

					<div class="form-check-inline">
						<input type="radio" class="form-check-input" value="2" name="metode" id="Efektif">
						<label class="form-check-label" for="Efektif">Efektif</label>
					</div>

					<div class="form-check-inline">
						<input type="radio" class="form-check-input" value="3" name="metode" id="Anuitas">
						<label class="form-check-label" for="Anuitas">Anuitas</label>
					</div>
				</div>

				<div class="form-group float-end float-right pull-right">
					<button id="btnHitung" type="submit" class="btn btn-primary">Hitung</button>
					<button id="btnUlangi" type="submit" class="btn btn-secondary">Ulangi</button>
				</div>
			</form>
		</div>
		<div class="row mb-3">
			<div class="col-md-12">
				<h3 class="mb-3 text-center">Hasil Simulasi KPR</h3>
				<div class="row d-flex justify-content-center">
					<div class="col-3">Total Pinjaman</div>
					<div class="col-9">: <span id="resultTotalPinjaman"></span></div>
				</div>
				<div class="row d-flex justify-content-center">
					<div class="col-3">Lama Pinjaman</div>
					<div class="col-9">: <span id="resultLamaPinjaman"></span></div>
				</div>
				<div class="row d-flex justify-content-center">
					<div class="col-3">Bunga Pertahun</div>
					<div class="col-9">: <span id="resultBungaPertahun"></span></div>
				</div>
				<div class="flatOnly">
					<div class="row d-flex justify-content-center">
						<div class="col-3">Angsuran Pokok Perbulan</div>
						<div class="col-9">: <span id="resultAngPokokBulan"></span></div>
					</div>
					<div class="row d-flex justify-content-center">
						<div class="col-3">Angsuran Bunga Perbulan</div>
						<div class="col-9">: <span id="resultAngBungaBulan"></span></div>
					</div>

					<div class="row d-flex justify-content-center">
						<div class="col-3">Total angsuran per bulan</div>
						<div class="col-9">: <span id="resultAngBulan"></span></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-md-12">
				<br>
				<table id="tableAngsuran" class="table table-bordered table-striped">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Bulan</th>
							<th scope="col">Pokok</th>
							<th scope="col">Bunga</th>
							<th scope="col">Angsuran</th>
							<th scope="col">Sisa Pinjaman</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row mt-5 mb-3" id="open_here">
			<div class="col-md-12">
				<h3 class="mb-3 text-center">Diskusi</h3>
				<br>
				<div class="comment-form">
					<form method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<textarea class="form-control w-100" name="komentar" id="komentar" cols="30" rows="3" placeholder="Tulis komentar anda disini" required></textarea>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<input type="file" class="form-control w-50" name="foto" id="foto">
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<button type="submit" class="btn btn-success btn-lg float-right px-4" name="simpan" value="simpan">Kirim Komentar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php
		$ambildiskusi = $koneksi->query("SELECT *FROM diskusi where idproduk = '$idproduk' order by iddiskusi asc");
		while ($diskusi = $ambildiskusi->fetch_assoc()) {
			if ($diskusi['rolepengirim'] == 'Pengguna') {
				$ambilkomentarpengguna = $koneksi->query("SELECT*FROM pengguna WHERE idpengguna='$diskusi[id]'");
				$komentarpengguna = $ambilkomentarpengguna->fetch_assoc();
		?>
				<div class="row mb-3">
					<div class="col-md-12">
						<div class="card shadow-sm">
							<div class="card-body">
								<div class="user justify-content-between">
									<div class="desc">
										<div class="d-flex justify-content-between">
											<h5>
												<?= $komentarpengguna['nama'] ?>
											</h5>
											<p class="date"> <?= tanggal(date("Y-m-d", strtotime($diskusi['waktu']))) . ' ' . date("H:i", strtotime($diskusi['waktu'])); ?> W.I.B</p>
										</div>
										<div class="row align-items-end">
											<div class="col-md-9">
												<p class="comment">
													<?= $diskusi['komentar'] ?>
												</p>
												<?php if ($diskusi['fotokomentar'] != '') { ?>
													<img src="foto/<?= $diskusi['fotokomentar'] ?>" style="border-radius: 10px" width="250px">
												<?php } ?>
											</div>
											<?php if ($idpengguna == $diskusi['id'] and ($diskusi['rolepengirim'] == 'Pengguna')) { ?>
												<div class="col-md-3">
													<a class="btn btn-danger float-right" href="komentarhapus.php?id=<?= $idproduk ?>&iddiskusi=<?= $diskusi['iddiskusi'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Komentar Ini ?')"><i class="fa fa-trash"></i></a>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			} else {
				$ambilkomentaradmin = $koneksi->query("SELECT*FROM admin WHERE idadmin='$diskusi[id]'");
				$komentaradmin = $ambilkomentaradmin->fetch_assoc();
			?>
				<div class="row mb-3">
					<div class="col-md-12">
						<div class="card shadow-sm">
							<div class="card-body">
								<div class="user justify-content-between">
									<div class="desc">
										<div class="d-flex justify-content-between">
											<h5>
												<?= $komentaradmin['nama'] ?>
											</h5>
											<p class="date"> <?= tanggal(date("Y-m-d", strtotime($diskusi['waktu']))) . ' ' . date("H:i", strtotime($diskusi['waktu'])); ?> W.I.B</p>
										</div>
										<div class="row align-items-end">
											<div class="col-md-9">
												<p class="comment">
													<?= $diskusi['komentar'] ?>
												</p>
												<?php if ($diskusi['fotokomentar'] != '') { ?>
													<img src="foto/<?= $diskusi['fotokomentar'] ?>" style="border-radius: 10px" width="250px">
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
</section>
<?php
include 'footer.php';
?>
<?php
if (isset($_POST['simpan'])) {
	$lokasifoto = $_FILES['foto']['tmp_name'];
	if (!empty($lokasifoto)) {
		$foto = $_FILES['foto']['name'];
		move_uploaded_file($lokasifoto, "foto/$foto");
	} else {
		$foto = '';
	}
	$koneksi->query("INSERT INTO diskusi
    (idproduk,id,rolepengirim,komentar,fotokomentar)
    VALUES('$idproduk','$idpengguna','Pengguna','$_POST[komentar]','$foto')") or die(mysqli_error($koneksi));
	echo "<script> location ='detail.php?id=$idproduk&skrol=ya';</script>";
} ?>
<script type='text/javascript'>
	<?php if (!empty($_GET['skrol'])) { ?>
		$('html, body').animate({
			scrollTop: $('#open_here').offset().top
		}, 'slow');
	<?php } ?>
</script>