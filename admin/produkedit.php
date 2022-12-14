<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE idproduk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<div class="content-body">

	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-md-12 mb-4">
				<div class="card shadow mb-4">
					<div class="card-body">
						<div class="card-title">
							<h4>Edit Produk</h4>
						</div>
						<div class="card-body">
							<form method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label>Nama Rumah</label>
									<input type="text" name="nama" class="form-control" value="<?php echo $pecah['namaproduk']; ?>">
								</div>
								<div class="form-group">
									<label>Tipe Rumah</label>
									<input type="text" class="form-control" name="tiperumah" value="<?php echo $pecah['tiperumah']; ?>" required>
								</div>
								<div class="form-group">
									<label>Harga Rumah</label>
									<input type="number" name="harga" class="form-control" value="<?php echo $pecah['hargaproduk']; ?>">
								</div>
								<div class="form-group">
									<label>Alamat Rumah</label>
									<textarea class="form-control" name="alamatrumah" rows="5 " required><?php echo $pecah['alamatrumah']; ?></textarea>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea name="deskripsiproduk" class="form-control" id="deskripsiproduk" rows="10"><?php echo $pecah['deskripsiproduk']; ?></textarea>
								</div>
								<script>
									CKEDITOR.replace('deskripsiproduk');
								</script>
								<div class="form-group">
									<div class="row">
										<?php
										$ambilfoto = $koneksi->query("SELECT * FROM produkfoto where idproduk='$pecah[idproduk]'");
										while ($foto = $ambilfoto->fetch_assoc()) {
										?>
											<div class="col-md-3">
												<img src="../foto/<?php echo $foto['foto']; ?>" width="100%" style="height: 150px;object-fit:cover">
												<a class="btn btn-danger mt-3 float-right" href="produkfotohapus.php?id=<?= $foto['idprodukfoto'] ?>&idproduk=<?= $pecah['idproduk'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus foto ini ?')">Hapus Foto</a>
											</div>
										<?php } ?>
									</div>
								</div>
								<div class="form-group">
									<label>Tambah Foto</label>
									<div class="row">
										<div class="col-md-10">
											<div class="letak-input">
												<input type="file" class="form-control" name="foto[]">
											</div>
										</div>
										<div class="col-md-2">
											<span class="btn btn-primary btn-tambah">
												<i class="fa fa-plus"></i>
											</span>
										</div>
									</div>
								</div>
								<br>
								<button class="btn btn-primary float-right" name="edit">Edit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
if (isset($_POST['edit'])) {
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	$koneksi->query("UPDATE produk SET namaproduk='$_POST[nama]',tiperumah='$_POST[tiperumah]',hargaproduk='$_POST[harga]',alamatrumah='$_POST[alamatrumah]',deskripsiproduk='$_POST[deskripsiproduk]' WHERE idproduk='$_GET[id]'") or die(mysqli_error($koneksi));
	foreach ($namafoto as $key => $tiap_nama) {
		$tiap_lokasi = $lokasifoto[$key];
		if (!empty($tiap_lokasi)) {
			move_uploaded_file($tiap_lokasi, "../foto/" . $tiap_nama);
			$koneksi->query("INSERT INTO produkfoto(idproduk, foto)
			VALUES('$_GET[id]','$tiap_nama')");
		}
	}
	echo "<script>alert('Data Berhasil Di Simpan');</script>";
	echo "<script>location='index.php?halaman=produkdaftar';</script>";
}
?>
<script src="../js/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$(".btn-tambah").on("click", function() {
			$(".letak-input").append("<input type='file' class='form-control mt-3' name='foto[]'>");
		})
	})
</script>