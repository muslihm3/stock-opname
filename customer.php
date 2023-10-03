<?php
require 'functioncustomer.php';
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

    <title>ONTY</title>

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

            <!-- Nav Item - Pages Collapse Menu totaltransaksi -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="index.php" data-toggle="collapse" data-target="#stocks" aria-expanded="true" aria-controls="stocks">
                    <i class="fas fa-list"></i>
                    <span>Stock</span>
                </a>
                <div id="stocks" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Stocks:</h6>
                        <a class="collapse-item" href="index.php">Stock Barang</a>
                        <a class="collapse-item" href="masuk.php">Barang Masuk</a>
                        <a class="collapse-item" href="keluar.php">Barang Keluar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Pages Collapse Menu Customer -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="customer.php" data-toggle="collapse" data-target="#customer" aria-expanded="true" aria-controls="customer">
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

            <!-- Heading Setting -->
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Customer Onty</h1>
                        <a href="export.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export Data</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Customer
                            </button>

                            <!-- Button to Open the Import Modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">
                                Import Data
                            </button>
                        </div>
                        <br>
                        <div class="row mt-2">
                            <div class="col">
                                <form  class="form-inline">
                                     <input type="number" id="minTotalOrder" name="minTotalOrder" class="form-control ml-3" min="0" placeholder="Minimum Total Order" />
                                    <button id="filterBtn" class="btn btn-info ml-3">Filter</button>
                                </form>
                            </div>
                        </div>
                       

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Customer</th>
                                            <th>Nomer</th>
                                            <th>Total Order</th>
                                            <th>Total Pesanan</th>
                                            <th>Total Transaksi</th>
                                            <th>Setting</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilcustomer = mysqli_query($conn, "select * from customer");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilcustomer)) {
                                            $namacustomer = $data['namacustomer'];
                                            $numbercustomer = $data['numbercustomer'];
                                            $emailcustomer = $data['emailcustomer'];
                                            $totalpesanan = $data['qty'];
                                            $totaltransaksi = $data['total'];
                                            $idc = $data['idcustomer'];

                                            $cekcustomer = mysqli_query($conn, "select * from pesanan where idcustomer='$idc'");
                                            $totalorder = mysqli_num_rows($cekcustomer);


                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $namacustomer; ?></td>
                                                <td><a href="https://wa.me/<?= $numbercustomer; ?>" target="_blank"><?= $numbercustomer; ?></a></td>
                                                <td><?= $totalorder . ' Kali'; ?></td>
                                                <td><?= $totalpesanan; ?></td>
                                                <td><?= 'Rp. ' .  number_format( $totaltransaksi,0,",",".")  ?></td>
                                                <td>
                                                    <a href="detailcustomer.php?id=<?= $idc; ?>" class="btn btn-info">View</a>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $idc; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $idc; ?>">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?= $idc; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Customer</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="Text" name="namacustomer" value="<?= $namacustomer ?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="numbercustomer" value="<?= $numbercustomer ?>" class="form-control">
                                                                <br>
                                                                <input type="Email" name="emailcustomer" value="<?= $emailcustomer ?>" class="form-control">
                                                                <br>

                                                                <input type="hidden" name="idc" value="<?= $idc; ?>">
                                                                <button type="submit" class="btn btn-primary" name="editcustomer"> Submit </button>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hapus Modal -->
                                            <div class="modal fade" id="hapus<?= $idc; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Customer</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah yakin untuk menghapus <?= $namacustomer; ?> ?
                                                                <input type="hidden" name="idc" value="<?= $idc; ?>">
                                                                <br>
                                                                <br>

                                                                <button type="submit" class="btn btn-danger" name="hapuscustomer"> Hapus </button>
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
                    <h4 class="modal-title">Tambah Customer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                        <input type="text" name="namacustomer" placeholder="Nama Customer" class="form-control" required>
                        <br>
                        <input type="number" name="numbercustomer" placeholder="Nomer Customer" class="form-control">
                        <br>
                        <input type="Email" name="emailcustomer" placeholder="Email Customer" class="form-control">
                        <br>

                        <button type="submit" class="btn btn-primary" name="addnewCustomer"> Submit </button>
                    </div>
                </form>

                


            </div>
        </div>
    </div>

    <!-- Modal Impor Data -->
    <div class="modal fade" id="importModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Import Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Isi Modal -->
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="file" id="file" accept=".xls, .xlsx" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="importData">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Skrip JavaScript untuk filter -->
    <script>
        document.getElementById("filterBtn").addEventListener("click", function (e) {
            e.preventDefault(); // Ini akan mencegah reload halaman default saat tombol ditekan.

            var minTotalOrder = parseInt(document.getElementById("minTotalOrder").value);

            // Loop melalui setiap baris tabel dan sembunyikan yang tidak memenuhi kriteria
            var tableRows = document.querySelectorAll("#dataTable tbody tr");
            tableRows.forEach(function (row) {
                var totalOrder = parseInt(row.cells[3].textContent.split(" ")[0]); // Ambil jumlah pesanan dari kolom ke-4

                if (isNaN(totalOrder) || totalOrder < minTotalOrder) {
                    row.style.display = "none"; // Sembunyikan baris yang tidak memenuhi kriteria
                } else {
                    row.style.display = ""; // Tampilkan baris yang memenuhi kriteria
                }
            });
        });
    </script>



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