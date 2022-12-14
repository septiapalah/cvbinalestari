<?php
include '../koneksi.php';
$koneksi->query("DELETE FROM produkfoto WHERE idprodukfoto='$_GET[id]'");
echo "<script>alert('Foto Produk Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=produkedit&id=$_GET[idproduk]';</script>";
