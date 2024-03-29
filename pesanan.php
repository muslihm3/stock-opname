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
                <div id="customer" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customer:</h6>
                        <a class="collapse-item" href="customer.php">Customer</a>
                        <a class="collapse-item active" href="pesanan.php">Pesanan</a>
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
                    <h1 class="h3 mb-2 text-gray-800">Pesanan Masuk</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            

                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Pesanan Masuk
                            </button>

                            <!-- Button to Open the Import Modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">
                                Import Data
                            </button>
                            <br>
                            <div class="row mt-4">
                                <div class="col">
                                    <form method="POST" class="form-inline">
                                        <input type="date" name="tgl_mulai" class="form-control">
                                        <input type="date" name="tgl_selesai" class="form-control ml-3">
                                        <input  id="searchPesanan" name="searchPesanan" class="form-control ml-3" placeholder="Search Pesanan" />
                                        <button type="submit" name="filter" class="btn btn-info ml-3">Filter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Transaksi</th>
                                            <th>Nama Customer</th>
                                            <th>Pesanan</th>
                                            <th>Outlet</th>
                                            <th>Jumlah</th>
                                            <th>Transaksi</th>
                                            <th>Admin</th>
                                            <th>Setting</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['filter'])) {
                                            $mulai = $_POST['tgl_mulai'];
                                            $selesai = $_POST['tgl_selesai'];
                                            $search = $_POST['searchPesanan'];

                                            $query = "SELECT * FROM pesanan p, customer c WHERE c.idcustomer = p.idcustomer";

                                            if (!empty($mulai) && !empty($selesai)) {
                                                $query .= " AND tanggal_transaksi BETWEEN '$mulai' AND '$selesai'";
                                            } elseif (empty($search)) {
                                                // Jika tanggal tidak diisi dan search tidak diisi, tampilkan data dari satu bulan terakhir
                                                $lastMonth = date("Y-m-d", strtotime("-1 month"));
                                                $query .= " AND tanggal_transaksi >= '$lastMonth'";
                                            }

                                            // Tambahkan filter pencarian pesanan dan customer
                                            if (!empty($search)) {
                                                $query .= " AND (c.namacustomer LIKE '%$search%' OR p.pesanan LIKE '%$search%')";
                                            }

                                            $query .= " ORDER BY idpesanan DESC";

                                            $ambilpesanan = mysqli_query($conn, $query);
                                        } else {
                                            // Jika filter tidak digunakan, tampilkan data dari satu bulan terakhir
                                            $lastMonth = date("Y-m-d", strtotime("-1 month"));
                                            $query = "SELECT * FROM pesanan p, customer c WHERE c.idcustomer = p.idcustomer AND tanggal_transaksi >= '$lastMonth' ORDER BY idpesanan DESC";
                                            $ambilpesanan = mysqli_query($conn, $query);
                                        }


                                        // if (isset($_POST['filter'])) {
                                        //     $mulai = $_POST['tgl_mulai'];
                                        //     $selesai = $_POST['tgl_selesai'];

                                        //     if ($mulai != null || $selesai != null) {

                                        //         $ambilpesanan = mysqli_query($conn, "select * from pesanan p, customer c where c.idcustomer = p.idcustomer and tanggal_transaksi BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) order by idpesanan DESC");
                                        //     } else {
                                        //         $ambilpesanan = mysqli_query($conn, "select * from pesanan p, customer c where c.idcustomer = p.idcustomer order by idpesanan DESC");
                                        //     }
                                        // } else {
                                        //     $ambilpesanan = mysqli_query($conn, "select * from pesanan p, customer c where c.idcustomer = p.idcustomer order by idpesanan DESC");
                                        // }
                                

                                        while ($data = mysqli_fetch_array($ambilpesanan)) {
                                            $tanggal = $data['tanggal_transaksi'];
                                            $outlet_pesanan = $data['outlet'];
                                            $namacustomer = $data['namacustomer'];
                                            $pesanan = $data['pesanan'];
                                            $jumlah = $data['jumlah'];
                                            $transaksi = $data['transaksi'];
                                            $admin = $data['admin'];
                                            $idc = $data['idcustomer'];
                                            $idp = $data['idpesanan'];


                                        ?>
                                            <tr>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $namacustomer; ?></td>
                                                <td><?= $pesanan; ?></td>
                                                <td><?= $outlet_pesanan; ?></td>
                                                <td><?= $jumlah; ?></td>
                                                <td><?= 'Rp. ' .  number_format( $transaksi,0,",",".") ?></td>
                                                <td><?= $admin; ?></td>
                                                <td>
                                                    <a href="detailcustomer.php?id=<?= $idc; ?>" class="btn btn-info">View</a>
                                                     <a href="nota.php?id=<?= $idp; ?>" class="btn btn-warning">Nota</a>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $idp; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $idp; ?>">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?= $idp; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Pesanan</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                
                                                                <!-- Input untuk jenis pesanan -->
                                                                <div class="form-group">
                                                                    <label for="pesanan">Pesanan:</label>
                                                                    <input type="text" name="pesanan" value="<?= $pesanan ?>" class="form-control" required>
                                                                </div>

                                                                <!-- Dropdown untuk memilih jenis pesanan -->
                                                                <div class="form-group">
                                                                    <label for="outlet_pesanan">Outlet Pesanan:</label>
                                                                     <select class="form-control" id="outlet_pesanan" name="outlet_pesanan">
                                                                        <option value="Onty 1" <?= ($outlet_pesanan == 'Onty 1') ? 'selected' : ''; ?>>Onty 1</option>
                                                                        <option value="Onty 2" <?= ($outlet_pesanan == 'Onty 2') ? 'selected' : ''; ?>>Onty 2</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Input untuk jumlah pesanan (qty) -->
                                                                <div class="form-group">
                                                                    <label for="qty">Jumlah:</label>
                                                                    <input type="number" name="jumlah" value="<?= $jumlah ?>" class="form-control" required>
                                                                </div>

                                                                <!-- Input untuk total transaksi -->
                                                                <div class="form-group">
                                                                    <label for="total">Transaksi:</label>
                                                                    <input type="number" name="total" value="<?= $transaksi ?>" class="form-control" required>
                                                                </div>

                                                                <!-- Input untuk tanggal transaksi -->
                                                                <div class="form-group">
                                                                    <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                                                                    <input type="date" name="tanggal_transaksi" value="<?= $tanggal ?>" class="form-control" required>
                                                                </div>
                                                                
                                                                <!-- Input untuk Admin -->
                                                                <div class="form-group">
                                                                    <label for="tanggal_transaksi">Admin</label>
                                                                    <input type="text" name="admin" value="<?= $admin ?>" class="form-control" required>
                                                                </div>

                                                                <!-- <input type="Text" name="pesanan" value="<?= $pesanan ?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="jumlah" value="<?= $jumlah ?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="total" value="<?= $transaksi ?>" class="form-control" required>
                                                                <br> -->
                                                                <input type="hidden" name="idc" value="<?= $idc; ?>">
                                                                <input type="hidden" name="idp" value="<?= $idp; ?>">
                                                                <button type="submit" class="btn btn-primary" name="editpesanan"> Submit </button>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hapus Modal -->
                                            <div class="modal fade" id="hapus<?= $idp; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Pesanan</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah yakin untuk menghapus <?= $pesanan; ?> ?
                                                                <input type="hidden" name="idc" value="<?= $idc; ?>">
                                                                <input type="hidden" name="idp" value="<?= $idp; ?>">
                                                                <input type="hidden" name="kty" value="<?= $jumlah; ?>">
                                                                <input type="hidden" name="total" value="<?= $transaksi; ?>">
                                                                <br>
                                                                <br>

                                                                <button type="submit" class="btn btn-danger" name="hapuspesanan"> Hapus </button>
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
                    <h4 class="modal-title">Pesanan Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">

                        <div class="form-group">
                        <label for="outlet_pesanan">Customer:</label>
                        <select name="customernya" class="form-control">
                            <?php
                            $ambildata = mysqli_query($conn, "select * from customer");
                            while ($fetchcharray = mysqli_fetch_array($ambildata)) {
                                $namacustomernya = $fetchcharray['namacustomer'];
                                $idcustomernya = $fetchcharray['idcustomer'];

                            ?>

                                <option value="<?= $idcustomernya; ?>"><?= $namacustomernya; ?></option>

                            <?php
                            }
                            ?>
                        </select>
                        </div>
                        
                        <!-- Input untuk jenis pesanan -->
                        <div class="form-group">
                            <label for="pesanan">Pesanan:</label>
                            <input type="text" name="pesanan" placeholder="Pesanan" class="form-control" required>
                        </div>

                        <!-- Dropdown untuk memilih jenis pesanan -->
                        <div class="form-group">
                            <label for="outlet_pesanan">Outlet Pesanan:</label>
                            <select class="form-control" id="outlet_pesanan" name="outlet_pesanan">
                                <option value="Onty 1">Onty 1</option>
                                <option value="Onty 2">Onty 2</option>
                            </select>
                        </div>

                        <!-- Input untuk jumlah pesanan (qty) -->
                        <div class="form-group">
                            <label for="qty">Jumlah:</label>
                            <input type="number" name="qty" placeholder="Jumlah" class="form-control" required>
                        </div>

                        <!-- Input untuk total transaksi -->
                        <div class="form-group">
                            <label for="total">Transaksi:</label>
                            <input type="number" name="total" placeholder="Transaksi" class="form-control" required>
                        </div>

                        <!-- Input untuk Admin -->
                        <div class="form-group">
                            <label for="tanggal_transaksi">Admin</label>
                            <input type="text" name="admin" placeholder="Admin" class="form-control" required>
                        </div>

                        <!-- Input untuk tanggal transaksi -->
                        <div class="form-group">
                            <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                            <input type="date" name="tanggal_transaksi" placeholder="Tanggal Transaksi" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="pesananmasuk">Submit</button>
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
                        <button type="submit" class="btn btn-primary" name="importPesanan">Import</button>
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