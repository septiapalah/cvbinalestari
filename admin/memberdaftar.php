<div class="content-body">
	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-md-12 mb-4">
				<div class="card shadow mb-4">
					<div class="card-body">
						<div class="card-title">
							<h4>Data Member</h4>
						</div>
						<table class="table table-bordered table-striped laporanpengguna">
							<thead class="bg-primary text-white">
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Telepon</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $nomor = 1; ?>
								<?php $ambil = $koneksi->query("SELECT * FROM pengguna"); ?>
								<?php while ($pecah = $ambil->fetch_assoc()) { ?>
									<tr>
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah['nama'] ?></td>
										<td><?php echo $pecah['email'] ?></td>
										<td><?php echo $pecah['telepon'] ?></td>
										<td><?php echo $pecah['alamat'] ?></td>
										<td>
											<a href="index.php?halaman=memberhapus&id=<?php echo $pecah['idpengguna'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
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