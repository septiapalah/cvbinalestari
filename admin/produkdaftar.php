<div class="content-body">

	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-md-12 mb-4">
				<div class="card shadow mb-4">
					<div class="card-body">
						<div class="card-title">
							<h4>Data Produk</h4>
						</div>
						<div class="d-sm-flex align-items-center justify-content-between">
							<a href="index.php?halaman=produktambah" class="btn btn-primary shadow-sm float-right pull-right"> Tambah Produk</a>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-striped laporanproduk">
								<thead class="bg-primary text-white">
									<tr>
										<th>No</th>
										<th>Nama Perumahan</th>
										<th>Tipe Rumah</th>
										<th>Harga Rumah</th>
										<th>Alamat</th>
										<th>Foto</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $nomor = 1; ?>
									<?php $ambil = $koneksi->query("SELECT*FROM produk"); ?>
									<?php while ($pecah = $ambil->fetch_assoc()) {
										$ambilfoto = $koneksi->query("SELECT * FROM produkfoto WHERE idproduk='$pecah[idproduk]' limit 1");
										$foto = $ambilfoto->fetch_assoc();
									?>
										<tr>
											<td><?php echo $nomor; ?></td>
											<td><?php echo $pecah['namaproduk'] ?></td>
											<td><?php echo $pecah['tiperumah'] ?></td>
											<td><?php echo rupiah($pecah['hargaproduk']) ?></td>
											<td><?php echo $pecah['alamatrumah'] ?></td>
											<td>
												<img src="../foto/<?php echo $foto['foto'] ?>" width="150px" style="border-radius:10px" alt="">
											</td>
											<td>
												<a href="index.php?halaman=produkdiskusi&id=<?php echo $pecah['idproduk']; ?>" class="btn btn-primary m-1">Diskusi</a>
												<a href="index.php?halaman=produkedit&id=<?php echo $pecah['idproduk']; ?>" class="btn btn-warning m-1">Edit</a>
												<a href="index.php?halaman=produkhapus&id=<?php echo $pecah['idproduk']; ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
											</td>
										</tr>
										<?php $nomor++; ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>