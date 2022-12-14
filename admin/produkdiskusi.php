<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE idproduk='$_GET[id]'");
$detail = $ambil->fetch_assoc();
$idproduk = $_GET["id"];
$idadmin = $_SESSION["admin"]["idadmin"];
?>
<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
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
                                                    <img class="d-block w-100" src="../foto/<?php echo $foto["foto"]; ?>" height="700px" style="border-radius: 25px">
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
                                    <!-- <br>
                                    <br>
                                    <p class="text-center">Alamat Rumah : <?php echo $detail["alamatrumah"]; ?></p>
                                    <br>
                                    <br> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="card-body">
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
                                                                        <img src="../foto/<?= $diskusi['fotokomentar'] ?>" style="border-radius: 10px" width="250px">
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a class="btn btn-danger float-right" href="komentarhapus.php?id=<?= $idproduk ?>&iddiskusi=<?= $diskusi['iddiskusi'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Komentar Ini ?')"><i class="fa fa-trash"></i></a>
                                                                </div>
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
                                                                        <img src="../foto/<?= $diskusi['fotokomentar'] ?>" style="border-radius: 10px" width="250px">
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a class="btn btn-danger float-right" href="komentarhapus.php?id=<?= $idproduk ?>&iddiskusi=<?= $diskusi['iddiskusi'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Komentar Ini ?')"><i class="fa fa-trash"></i></a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['simpan'])) {
    $lokasifoto = $_FILES['foto']['tmp_name'];
    if (!empty($lokasifoto)) {
        $foto = $_FILES['foto']['name'];
        move_uploaded_file($lokasifoto, "../foto/$foto");
    } else {
        $foto = '';
    }
    $koneksi->query("INSERT INTO diskusi
    (idproduk,id,rolepengirim,komentar,fotokomentar)
    VALUES('$idproduk','$idadmin','Admin','$_POST[komentar]','$foto')") or die(mysqli_error($koneksi));
    echo "<script>location='index.php?halaman=produkdiskusi&id=$idproduk&skrol=ya';</script>";
} ?>