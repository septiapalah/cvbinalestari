<?php
session_start();
include 'koneksi.php';
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
								<th>Foto Produk</th>
								<th>Harga</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php if (!empty($_SESSION["keranjang"])) { ?>
								<?php foreach ($_SESSION["keranjang"] as $idproduk => $jumlah) : ?>
									<?php
											$ambil = $koneksi->query("SELECT * FROM produk 
								WHERE idproduk='$idproduk'");
											$pecah = $ambil->fetch_assoc();
											$totalharga = $pecah["hargaproduk"] * $jumlah;
											?>
									<tr class="text-center">
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah['namaproduk']; ?></td>
										<td class="image-prod">
											<div class="img" style="background-image:url(foto/<?php echo $pecah["fotoproduk"]; ?>);"></div>
										</td>
										<td>Rp <?php echo number_format($pecah['hargaproduk']); ?></td>
										<td>
											<a href="hapuskeranjang.php?id=<?php echo $idproduk ?>" class="btn btn-danger btn-xs">Hapus</a>
										</td>
									</tr>
									<?php $nomor++; ?>
							<?php endforeach;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<a href="index.php" class="btn btn-warning"><i class="fa fa-cart-plus"></i>Lanjutkan Belanja</a>
			&nbsp;<a href="checkout.php" class="btn btn-primary">Checkout</a>
		</div>
	</div>
</section>

<?php
include 'footer.php';
?>