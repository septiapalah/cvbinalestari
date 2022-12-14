<div class="content-body">
	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-md-12 mb-4">
				<div class="card shadow mb-4">
					<div class="card-body">
						<div class="card-title">
							<h4>Tambah Produk</h4>
						</div>
						<div class="card-body">
							<form method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label>Nama Rumah</label>
									<input type="text" class="form-control" name="nama" required>
								</div>
								<div class="form-group">
									<label>Tipe Rumah</label>
									<input type="text" class="form-control" name="tiperumah" required>
								</div>
								<div class="form-group">
									<label>Harga Rumah</label>
									<input type="number" class="form-control" name="harga" required>
								</div>
								<div class="form-group">
									<label>Alamat Rumah</label>
									<textarea class="form-control" name="alamatrumah" rows="5 " required></textarea>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea class="form-control" name="deskripsiproduk" id="deskripsiproduk" rows="10" required></textarea>
									<script>
										CKEDITOR.replace('deskripsiproduk');
									</script>
								</div>
								<div class="form-group">
									<label>Foto</label>
									<div class="letak-input" style="margin-bottom: 10px;">
										<input type="file" class="form-control" name="foto[]" required>
									</div>
									<span class="btn btn-primary btn-tambah">
										<i class="fa fa-plus"></i>
									</span>
								</div>
								<button class="btn btn-primary float-right" name="save"><i class="glyphicon glyphicon-saved"></i>Simpan</a></button>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_POST['save'])) {
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	$koneksi->query("INSERT INTO produk
		(namaproduk,tiperumah,hargaproduk,alamatrumah,deskripsiproduk)
		VALUES('$_POST[nama]','$_POST[tiperumah]','$_POST[harga]','$_POST[alamatrumah]','$_POST[deskripsiproduk]')") or die(mysqli_error($koneksi));
	$idproduk = $koneksi->insert_id;
	foreach ($namafoto as $key => $tiap_nama) {
		$tiap_lokasi = $lokasifoto[$key];

		move_uploaded_file($tiap_lokasi, "../foto/" . $tiap_nama);

		$koneksi->query("INSERT INTO produkfoto(idproduk, foto)
			VALUES('$idproduk','$tiap_nama')")  or die(mysqli_error($koneksi));
	}
	echo "<script>alert('Data Berhasil Di Simpan');</script>";
	echo "<script> location ='index.php?halaman=produkdaftar';</script>";
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