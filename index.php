<?php
session_start();
if (empty($_SESSION['nama'])) {
    header('Location:login.php');
}

$page = $_GET['page'] ?? "";
require_once 'utility/library.php';
$lib = new Library();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Express Eats :: Admin
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <script src="assets/js/core/jquery.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="assets/js/plugins/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="assets/js/plugins/chartist.min.js"></script>


</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="green" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo"><a href="index.php" class="simple-text logo-mini">
                    <span class="material-icons">
                        local_shipping
                    </span>
                </a>
                <a href="index.php" class="simple-text logo-normal">
                    EXPRESS EATS
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="assets/img/default-avatar.png" />
                    </div>
                    <div class="user-info">
                        <a href="?page=profil" class="username">
                            <span>
                                <?= $_SESSION['nama']; ?>
                            </span>
                        </a>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item <?= $page == '' ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php">
                            <i class="material-icons">dashboard</i>
                            <p> Dashboard </p>
                        </a>
                    </li>
                    <li class="nav-item <?= $page == 'kelola-pesanan' ? 'active' : ''; ?>">
                        <a class="nav-link" href="?page=kelola-pesanan">
                            <i class="material-icons">assignment</i>
                            <p> Kelola Pesanan </p>
                        </a>
                    </li>
                    <li class="nav-item <?= $page == 'kelola-menu' ? 'active' : ''; ?>">
                        <a class="nav-link" href="?page=kelola-menu">
                            <i class="material-icons">fastfood</i>
                            <p> Kelola Menu </p>
                        </a>
                    </li>
                    <li class="nav-item <?= $page == 'kelola-pelanggan' ? 'active' : ''; ?>">
                        <a class="nav-link" href="?page=kelola-pelanggan">
                            <i class="material-icons">people</i>
                            <p> Kelola Pelanggan </p>
                        </a>
                    </li>
                    <li class="nav-item <?= $page == 'laporan' ? 'active' : ''; ?>"">
                        <a class=" nav-link" href="?page=laporan">
                        <i class="material-icons">timeline</i>
                        <p> Laporan </p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                            </button>
                        </div>
                        <?php
                        if (isset($_GET['page'])) {
                            if (strpbrk($_GET['page'], "-")) {
                                $word = explode("-", $_GET['page']);
                                $title = $word[0];
                                $title .= " ";
                                $title .= $word[1];
                            } else {
                                $title = $_GET['page'];
                            }
                        }
                        ?>
                        <a class="navbar-brand" href="javascript:;">
                            <?= isset($_GET['page']) ? ucwords($title) : 'Dashboard'; ?>
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <span id="timestamp" class="nav-link" style="font-size: 20px;"></span>
                                <script>
                                    // Function ini dijalankan ketika Halaman ini dibuka pada browser
                                    $(function() {
                                        setInterval(timestamp, 1000); //fungsi yang dijalan setiap detik, 1000 = 1 detik
                                    });

                                    //Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
                                    function timestamp() {
                                        $.ajax({
                                            url: './utility/ajax-timestamp.php',
                                            success: function(data) {
                                                $('#timestamp').html(data);
                                            },
                                        });
                                    }
                                </script>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification" id="notif"></span>
                                    <p class="d-lg-none d-md-block">
                                        Some Actions
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" id="pesan" aria-labelledby="navbarDropdownMenuLink">
                                    <!-- <a class="dropdown-item" href="#">Mike John responded to your email</a>
                                    <a class="dropdown-item" href="#">You have 5 new tasks</a>
                                    <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                                    <a class="dropdown-item" href="#">Another Notification</a>
                                    <a class="dropdown-item" href="#">Another One</a> -->
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">person</i>
                                    <p class="d-lg-none d-md-block">
                                        Account
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="?page=profil">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php" onclick="return confirm('Apakah anda yakin ingin logout?')">Log out</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="content">
                    <div class="container-fluid">
                        <?php

                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                            switch ($page) {
                                case 'kelola-pesanan';
                                    include 'pages/pesanan/index.php';
                                    break;
                                case 'kelola-menu';
                                    include 'pages/menu/index.php';
                                    break;
                                case 'kelola-pelanggan';
                                    include 'pages/pelanggan/index.php';
                                    break;
                                case 'laporan';
                                    include 'pages/laporan/index.php';
                                    break;
                                case 'error-404';
                                case 'profil';
                                    include 'pages/profil.php';
                                    break;
                                case 'error-404';
                                    include 'pages/404.php';
                                    break;
                                default:
                                    echo "
                                    <script>
                                        window.location.href = 'index.php?page=error-404';
                                    </script>
                                ";
                                    break;
                            }
                        } else {
                            include 'pages/dashboard.php';
                        }

                        ?>


                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="float-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Get Apps
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    About Us
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright float-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, made with <i class="material-icons">favorite</i> by
                        <a href="#" target="_blank">Express Eats Dev Team</a>
                    </div>
                </div>
            </footer>
        </div>

        <style>
            .material-icons.checked {
                color: #FB8C00;
            }
        </style>
    </div>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for the momentJs  -->
    <script src="assets/js/plugins/moment.min.js"></script>

    <!-- Forms Validations Plugin -->
    <script src="assets/js/plugins/jquery.validate.min.js"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="assets/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="assets/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="assets/js/plugins/nouislider.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="assets/js/plugins/arrive.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chartist JS -->
    <script src="assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <!-- <script src="assets/demo/demo.js"></script> -->
    <script>
        $(document).ready(function() {

            $('.dataTable').DataTable();

            // Javascript method's body can be found in assets/js/demos.js
            // md.initDashboardPageCharts();

            // md.initVectorMap();
            selesai();



        });


        function selesai() {
            setTimeout(function() {
                jumlah();
                selesai();
                pesan();
            }, 2000);
        }

        function jumlah() {
            $.getJSON("./pages/pesanan/data.php", function(datas) {
                $("#notif").html(datas.jumlah);
            });
        }



        function pesan() {
            $.getJSON("pages/pesanan/data-pesanan.php", function(data) {
                $("#pesan").empty();
                var no = 1;
                $.each(data.result, function() {
                    $("#pesan").append(
                        '<a class="dropdown-item" href="?page=kelola-pesanan">Pesanan baru dari ' + this["username"] + '</a>'
                    );
                });
            });
        }
    </script>
</body>

</html>