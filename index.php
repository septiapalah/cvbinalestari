<?php include 'header.php'; ?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
				<h1 class="text-warning" style="font-size: 100px;font-weight: 900;">SELAMAT DATANG DI</h1>
			</div>
			<img class="d-block w-100" src="foto/bgdepan.jpg" style="height: 650px;">
		</div>
		<div class="carousel-item">
			<div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
				<h1 class="text-warning" style="font-size: 100px;font-weight: 900;">CV. BINA LESTARI</h1>
			</div>
			<img class="d-block w-100" src="foto/bgdepan2.jpeg" style="height: 650px;">
		</div>
		<div class="carousel-item">
			<div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
				<h1 class="text-warning" style="font-size: 80px;font-weight: 900;">MENJUAL PROPERTY STRATEGIS DAN MURAH</h1>
			</div>
			<img class="d-block w-100" src="foto/bgdepan3.jpg" style="height: 650px;">
		</div>
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
<section id="kategori" class="ftco-section">
	<div class="container">
		<h3 class="mb-4">Tentang Kami</h3>
		<p class="text-justify">CV. BINA LESTARI merupakan perusahaan yang bergerak di bidang penjualan property khususnya perumahan yang berlokasi di Kota Pontianak.</p>
		<p class="text-justify">CV.Bina Lestari memberikan produk perumahan berupa kavling siap bangun. Dengan produk semacam ini, diharapkan kualitas bangunan menjadi 
			sebagaimana yang diinginkan, karena akan terjadi kontrol bersama antara developer dan pembeli pada saat proses pembangunan berlangsung, serta jaminan kualitas dan bentuk atau model bangunan seperti yang diharapkan. Dengan tidak meninggalkan unsur pelayanan yang memuaskan dan sesuai dengan kebutuhan masyarakat pada saat ini. </p>
	</div>
</section>

<section>
	
	<div class="container">
		<div class="row justify-content-center">
			<?php
			$ambil = $koneksi->query("SELECT *FROM produk order by idproduk desc limit 3");
			while ($produk = $ambil->fetch_assoc()) {
				$ambilfoto = $koneksi->query("SELECT * FROM produkfoto WHERE idproduk='$produk[idproduk]' limit 1");
				$foto = $ambilfoto->fetch_assoc();
			?>
			
			<?php } ?>
		</div>
	</div>
</section>
<?php
include 'footer.php';
?>