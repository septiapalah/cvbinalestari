<?php
include 'header.php';
if (!empty($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
} else {
    $keyword = "";
}
?>
<div class="jumbotron jumbotron-fluid jumbotronatas">
    <div class="container">
        <h1 class="text-white text-center" style="background-color: rgba(0,0,0,0.2);border-radius:10px;">Produk Kami</h1>
    </div>
</div>
<section>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <form method="post">
                    <div class="row">
                        <div class="col-md-9  my-auto">
                            <div class="form-group">
                                <input type="text" name="keyword" value="<?= $keyword ?>" placeholder="Masukkan kata pencarian, nama perumahan, tipe, harga, alamat" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" name="cari" value="cari" class="btn btn-primary btn-lg btn-block">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            if (isset($_POST['cari'])) {
                $ambil = $koneksi->query("SELECT *FROM produk WHERE namaproduk LIKE '%$keyword%' OR namaproduk LIKE '%$keyword%' OR hargaproduk LIKE '%$keyword%' OR tiperumah LIKE '%$keyword%' order by idproduk desc");
            } else {
                $ambil = $koneksi->query("SELECT *FROM produk order by idproduk desc");
            }
            while ($produk = $ambil->fetch_assoc()) {
                $ambilfoto = $koneksi->query("SELECT * FROM produkfoto WHERE idproduk='$produk[idproduk]' limit 1");
                $foto = $ambilfoto->fetch_assoc();
            ?>
                <div class="col-md-4 ftco-animate">
                    <div class="product">
                        <a href="detail.php?id=<?php echo $produk['idproduk']; ?>" class="img-prod"><img class="img-fluid" src="foto/<?php echo $foto['foto'] ?>" style="height:300px;width:100%" alt="">
                            <div class=" overlay">
                            </div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="detail.php?id=<?php echo $produk['idproduk']; ?>"><?php echo $produk['namaproduk'] ?></a></h3>
                            <p class=""><span>Tipe : <?= $produk['tiperumah'] ?></span></p>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>Rp <?php echo number_format($produk['hargaproduk']) ?></span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="detail.php?id=<?php echo $produk['idproduk']; ?>" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="fa fa-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>