<?php
include '../koneksi.php';
$koneksi->query("DELETE FROM diskusi WHERE iddiskusi='$_GET[iddiskusi]'");
echo "<script>alert('Komentar Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=produkdiskusi&id=$_GET[id]&skrol=ya';</script>";
