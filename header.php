<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>CV. BINA LESTARI</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/gaya.css">
  <link rel="icon" type="image/x-icon" href="foto/logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="admin/assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
</head>

<body class="goto-here">
  <nav class="navbar navbar-expand-lg navbar-light ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html"><img width="75px" src="foto/logo.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
          <?php
          if (isset($_SESSION["pengguna"])){ 
            echo '<li class="nav-item active"><a href="produk.php" class="nav-link">Perumahan</a></li>';
            echo '<li class="nav-item active"><a href="suratizinperusahaan.php" class="nav-link">Surat Izin Perusahaan</a></li>'; } 
            else{}
            ?>
          
          <?php
          include 'koneksi.php';
          if (isset($_SESSION["pengguna"])) { ?>
            <li class="nav-item active dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Akun </a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="akun.php">Akun</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
          </li>
          <?php } else {  ?>
            <li class="nav-item active"><a href="login.php" class="nav-link">Login</a></li>
            <li class="nav-item active"><a href="daftar.php" class="nav-link">Daftar</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>