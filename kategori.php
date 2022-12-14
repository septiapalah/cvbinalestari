<?php include 'header.php';
$kategori = $_GET["id"];


$semuadata = array();
$ambil = $koneksi->query("SELECT*FROM produk WHERE id_kategori LIKE '%$kategori%'");
while ($pecah = $ambil->fetch_assoc()) {
	$semuadata[] = $pecah;
}
?>
<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
	$datakategori[] = $tiap;
}
?>
<?php $am = $koneksi->query("SELECT * FROM kategori where id_kategori='$kategori'");
$pe = $am->fetch_assoc()
?>

<section class="ftco-section">
	<div class="container">
		<div class="row mb-3 pb-3">
			<div class="col-md-12 heading-section ftco-animate">
				<h3 class="mb-4">Kategori : <?php echo $pe["tiperumah"] ?></h3>
				<?php if (empty($semuadata)) : ?>
					<div class="alert alert-danger">Produk <strong><?php echo  $pe["tiperumah"] ?></strong> Kosong</div>
				<?php endif ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<?php foreach ($semuadata as $key => $value) : ?>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="detail.php?id=<?php echo $value['idproduk']; ?>" class="img-prod"><img class="img-fluid" src="foto/<?php echo $value['foto'] ?>" style="height:300px;width:100%" alt="">
							<div class=" overlay">
							</div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="detail.php?id=<?php echo $value['idproduk']; ?>"><?php echo $value['namaproduk'] ?></a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span>Rp <?php echo number_format($value['hargaproduk']) ?></span></p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">

									<a href="detail.php?id=<?php echo $value['idproduk']; ?>" class="buy-now d-flex justify-content-center align-items-center mx-1">
										<span><i class="ion-ios-cart"></i></span>
									</a>

								</div>
							</div>
						</div>

					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>

<?php
include 'footer.php';
?>