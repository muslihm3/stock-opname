<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stock Barang</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

            <!-- Nav Item - Pages Collapse Menu Stock -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="index.php" data-toggle="collapse" data-target="#stocks" aria-expanded="true" aria-controls="stocks">
                    <i class="fas fa-list"></i>
                    <span>Stocks</span>
                </a>
                <div id="stocks" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Stocks:</h6>
                        <a class="collapse-item" href="index.php">Stocks Barang</a>
                        <a class="collapse-item" href="masuk.php">Stock Masuk</a>
                        <a class="collapse-item" href="keluar.php">Stock Keluar</a>
                    </div>
                </div>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Stock Barang</h1>
                        <a href="export.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export Data</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Barang
                            </button>
                        </div>
                        <div class="card-body">


                            <?php
                            //stock habis
                            $infostock = mysqli_query($conn, "select * from stock where stock < 1");

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
                            $infostock = mysqli_query($conn, "select * from stock where stock BETWEEN 1 AND 5");

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

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <th>Setting</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilstock = mysqli_query($conn, "select * from stock");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilstock)) {
                                            $namabarang = $data['namabarang'];
                                            $deskripsi = $data['deskripsi'];
                                            $stock = $data['stock'];
                                            $idb = $data['idbarang'];

                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $namabarang; ?></td>
                                                <td><?= $deskripsi; ?></td>
                                                <td><?= $stock; ?></td>
                                                <td>
                                                    <a href="detail.php?id=<?= $idb; ?>" class="btn btn-info">View</a>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $idb; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $idb; ?>">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?= $idb; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="Text" name="namabarang" value="<?= $namabarang ?>" class="form-control" required>
                                                                <br>
                                                                <input type="Text" name="deskripsi" value="<?= $deskripsi ?>" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <button type="submit" class="btn btn-primary" name="edit"> Submit </button>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hapus Modal -->
                                            <div class="modal fade" id="hapus<?= $idb; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah yakin untuk menghapus <?= $namabarang; ?> ?
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <br>
                                                                <br>

                                                                <button type="submit" class="btn btn-danger" name="hapus"> Hapus </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

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

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                        <input type="Text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                        <br>
                        <input type="Text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
                        <br>
                        <input type="number" name="stock" placeholder="Stock Barang" class="form-control" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="addnewbarang"> Submit </button>
                    </div>
                </form>


            </div>
        </div>
    </div>


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