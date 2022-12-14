<?php include 'header.php'; ?>
<?php
if (!isset($_SESSION["pengguna"])) {
    echo "<script> alert('Harap login terlebih dahulu');</script>";
    echo "<script> location ='login.php';</script>";
}
$id = $_SESSION["pengguna"]["idpengguna"];
$ambil = $koneksi->query("SELECT *FROM pengguna WHERE idpengguna='$id'");
$pecah = $ambil->fetch_assoc(); ?>
<div class="jumbotron jumbotron-fluid jumbotronatas">
    <div class="container">
        <h1 class="text-white text-center" style="background-color: rgba(0,0,0,0.2);border-radius:10px;">Akun Saya</h1>
    </div>
</div>
<section id="home-section" class="hero">
    <form method="post" enctype="multipart/form-data">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama</label>
                        <input value="<?php echo $pecah['nama']; ?>" type="text" value="" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="<?php echo $pecah['email']; ?>" type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input value="<?php echo $pecah['telepon']; ?>" type="number" class="form-control" name="telepon">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea value="<?php echo $pecah['alamat']; ?>" class="form-control" name="alamat" id="alamat" rows="5"><?php echo $pecah['alamat']; ?></textarea>
                        <script>
                            CKEDITOR.replace('alamat');
                        </script>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password">
                        <input type="hidden" class="form-control" name="passwordlama" value="<?php echo $pecah['password']; ?>">
                        <span class="text-danger">Kosongkan Password jika tidak ingin mengganti</span>
                    </div>
                    <button class="btn btn-primary float-right pull-right" name="ubah"><i class="glyphicon glyphicon-saved"></i>Simpan</a></button>
                </div>
            </div>
        </div>
    </form>
</section>
<br><br>
<?php
if (isset($_POST['ubah'])) {
    if ($_POST['password'] == "") {
        $password = $_POST['passwordlama'];
    } else {
        $password = $_POST['password'];
    }

    $koneksi->query("UPDATE pengguna SET password='$password',nama='$_POST[nama]', email='$_POST[email]',telepon='$_POST[telepon]', alamat='$_POST[alamat]' WHERE idpengguna='$id'") or die(mysqli_error($koneksi));
    echo "<script>alert('Profil Berhasil Di Ubah');</script>";
    echo "<script>location='akun.php';</script>";
}
include 'footer.php';
?>