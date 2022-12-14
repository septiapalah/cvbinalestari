<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['admin'])) {
    echo "<script> alert('Harap login terlebih dahulu');</script>";
    echo "<script> location ='../loginadmin.php';</script>";
    exit();
}
function rupiah($angka)
{
    $hasilrupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasilrupiah;
}
function tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CV Bina Lestari</title>
    <link rel="icon" type="image/x-icon" href="foto/logo.png">
    <link href="assets/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <script src="assets/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
</head>

<body>
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">


        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.php">
                    <span class="brand-title">
                        <span class="text-white" style="padding-left:10px;"> ADMIN PANEL</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li> <a onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?');" class="nav-link" href="index.php?halaman=logout">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> Keluar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="index.php?halaman=beranda" aria-expanded="false">
                            <i class="icon-home menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?halaman=produkdaftar" aria-expanded="false">
                            <i class="icon-list menu-icon"></i><span class="nav-text">Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?halaman=memberdaftar" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Data Member</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div id="page-inner">
                <?php
                if (isset($_GET['halaman'])) {
                    if ($_GET['halaman'] == "produkdaftar") {
                        include 'produkdaftar.php';
                    } elseif ($_GET['halaman'] == "produktambah") {
                        include 'produktambah.php';
                    } elseif ($_GET['halaman'] == "produkedit") {
                        include 'produkedit.php';
                    } elseif ($_GET['halaman'] == "produkdiskusi") {
                        include 'produkdiskusi.php';
                    } elseif ($_GET['halaman'] == "produkhapus") {
                        include 'produkhapus.php';
                    } elseif ($_GET['halaman'] == "memberdaftar") {
                        include 'memberdaftar.php';
                    } elseif ($_GET['halaman'] == "membertambah") {
                        include 'membertambah.php';
                    } elseif ($_GET['halaman'] == "memberedit") {
                        include 'memberedit.php';
                    } elseif ($_GET['halaman'] == "memberhapus") {
                        include 'memberhapus.php';
                    } elseif ($_GET['halaman'] == "beranda") {
                        include 'beranda.php';
                    } elseif ($_GET['halaman'] == "logout") {
                        include 'logout.php';
                    }
                } else {
                    include 'beranda.php';
                }
                ?>
            </div>
        </div>
        <script src="assets/plugins/common/common.min.js"></script>
        <script src="assets/js/custom.min.js"></script>
        <script src="assets/js/settings.js"></script>
        <script src="assets/js/gleek.js"></script>
        <script src="assets/js/styleSwitcher.js"></script>
        <script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>
        <script src="assets/plugins/circle-progress/circle-progress.min.js"></script>
        <script src="assets/plugins/d3v3/index.js"></script>
        <script src="assets/plugins/topojson/topojson.min.js"></script>
        <script src="assets/plugins/datamaps/datamaps.world.min.js"></script>
        <script src="assets/plugins/raphael/raphael.min.js"></script>
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/moment/moment.min.js"></script>
        <script src="assets/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
        <script src="assets/plugins/chartist/js/chartist.min.js"></script>
        <script src="assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
        <script src="assets/js/dashboard/dashboard-1.js"></script>
        <script src="assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#tabel').DataTable();
            });
            $(document).ready(function() {
                $('.laporanproduk').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'csvHtml5',
                            title: 'Data Produk',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Data Produk',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Produk',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            customize: function(doc) {
                                doc.content[1].table.widths =
                                    Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                                doc.defaultStyle.alignment = 'center';
                                doc.styles.tableHeader.alignment = 'center';
                            }

                        },
                        'colvis'
                    ]
                });
                $('.laporanpengguna').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'csvHtml5',
                            title: 'Data Akun Member',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Data Akun Member',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Akun Member',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            },
                            customize: function(doc) {
                                doc.content[1].table.widths =
                                    Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                                doc.defaultStyle.alignment = 'center';
                                doc.styles.tableHeader.alignment = 'center';
                            }

                        },
                        'colvis'
                    ]
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#table').DataTable();
            });
        </script>
        <script type='text/javascript'>
            <?php if (!empty($_GET['skrol'])) { ?>
                $('html, body').animate({
                    scrollTop: $('#open_here').offset().top
                }, 'slow');
            <?php } ?>
        </script>
</body>

</html>