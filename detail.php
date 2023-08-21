<?php
require 'function.php';
require 'cek.php';

//get id barang
$idbarang = $_GET['id'];
//get info
$get = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
$fetch = mysqli_fetch_assoc($get);
//variable
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];
//generate QR
$urlview= 'http://localhost/admin/detail.php?id='.$idbarang;
$qrcode = 'https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl='.$urlview.'&choe=UTF-8'




?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $namabarang; ?></title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .zoomable {
            width: 100px;
        }

        .zoomable:hover {
            transform: scale(10);
            transition: 0.5s ease;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">

                </div>
                <div class="sidebar-brand-text mx-3">ONTY</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="index.php" data-toggle="collapse" data-target="#stocks" aria-expanded="true" aria-controls="stocks">
                    <i class="fas fa-list"></i>
                    <span>Stocks</span>
                </a>
                <div id="stocks" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Stocks:</h6>
                        <a class="collapse-item" href="index.php">Stocks Barang</a>
                        <a class="collapse-item" href="masuk.php">Stock Masuk</a>
                        <a class="collapse-item" href="keluar.php">Stock Keluar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Pages Collapse Menu Customer -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="customer.php" data-toggle="collapse" data-target="#customer" aria-expanded="true" aria-controls="stocks">
                    <i class="fas fa-list"></i>
                    <span>Customer</span>
                </a>
                <div id="customer" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customer:</h6>
                        <a class="collapse-item" href="customer.php">Customer</a>
                        <a class="collapse-item" href="pesanan.php">Pesanan</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Setting
            </div>
            <!-- Nav Item - Kelola Admin -->
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-user"></i>
                    <span>Kelola Admin</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Detail Barang</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h2><?= $namabarang ?></h2>
                             <img src="<?=$qrcode;?>" alt="">
                        </div>
                        <div class="card-body">


                            <?php
                            //stock habis
                            $infostock = mysqli_query($conn, "select * from stock where idbarang='$idbarang' and stock < 1");

                            while ($fetch = mysqli_fetch_array($infostock)) {
                                $barang = $fetch['namabarang'];
                            ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Perhatian!</strong> Stock <?= $barang ?> Habis. Segera order <?= $barang ?> lagi!
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            //stock mau habis
                            $infostock = mysqli_query($conn, "select * from stock where idbarang='$idbarang' and stock BETWEEN 1 AND 5");

                            while ($fetch = mysqli_fetch_array($infostock)) {
                                $barang = $fetch['namabarang'];
                                $sisa = $fetch['stock'];
                            ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Peringatan!</strong> Stock <?= $barang ?> sisa <?= $sisa ?>
                                </div>

                            <?php
                            }
                            ?>


                            <div class="row">
                                <div class="col-md-3">Deskripsi</div>
                                <div class="col-md-3">: <?= $deskripsi; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Stock</div>
                                <div class="col-md-3">: <?= $stock; ?></div>
                            </div>

                            <br><br>

                            <h3>Stock Masuk</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="masuk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Penerima</th>
                                            <th>Jumlah</th>
                                            <th>Transaksi</th>
                                            <th>Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilmasuk = mysqli_query($conn, "select * from masuk where idbarang='$idbarang'");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilmasuk)) {
                                            $tanggal = $data['tanggal'];
                                            $keterangan = $data['keterangan'];
                                            $qty = $data['qty'];
                                            $total = $data['total'];
                                            $image = $data['image'];
                                            if ($image == null) {
                                                $nota = 'Tidak ada';
                                            } else {
                                                $nota = '<img src="img/' . $image . '" class="zoomable">';
                                            }


                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $keterangan; ?></td>
                                                <td><?= $qty; ?></td>
                                                <td><?= 'Rp. ' . $total; ?></td>
                                                <td><?= $nota; ?></td>


                                            </tr>



                                        <?php
                                        };
                                        ?>

                                    </tbody>
                                </table>
                            </div>

                            <br><br>

                            <h3>Stock Keluar</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="keluar" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Petugas</th>
                                            <th>Jumlah</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilkeluar = mysqli_query($conn, "select * from keluar where idbarang='$idbarang'");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilkeluar)) {
                                            $tanggal = $data['tanggal'];
                                            $petugas = $data['petugas'];
                                            $qty = $data['qty'];

                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $petugas; ?></td>
                                                <td><?= $qty; ?></td>

                                            </tr>

                                        <?php
                                        };
                                        ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Onty 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>