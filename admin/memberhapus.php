<?php
$koneksi->query("DELETE FROM pengguna WHERE idpengguna='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=memberdaftar';</script>";
