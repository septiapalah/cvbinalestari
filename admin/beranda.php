<?php
$produk = $koneksi->query("SELECT * FROM produk");
$jumlahproduk = $produk->num_rows;

$member = $koneksi->query("SELECT * FROM pengguna");
$jumlahmember = $member->num_rows;
?>
<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Jumlah Perumahan</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white"><?= $jumlahproduk ?></h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                        <br>
                        <a href="index.php?halaman=produkdaftar" class="btn btn-primary mt-3 btn-sm">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card gradient-3">
                    <div class="card-body">
                        <h3 class="card-title text-white">Jumlah Member</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white"><?= $jumlahmember ?></h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        <br>
                        <a href="index.php?halaman=memberdaftar" class="btn btn-primary mt-3 btn-sm">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <img src="../foto/welcome.webp" width="100%">
            </div>
        </div>
    </div>