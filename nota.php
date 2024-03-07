<?php
require 'functioncustomer.php';
require 'cek.php';


$ambilpesanan = mysqli_query($conn,"SELECT * FROM pesanan WHERE idpesanan = idpesanan");
$data=mysqli_fetch_array($ambilpesanan);
$namapesanan = $data['pesanan'];
$deskripsi = $data['transaksi'];
$stock = $data['admin'];
$idp = $data['idpesanan'];
?>

<html>
<head>
  <title>INVOICE NO<?= $idp; ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<body>
    <div class="container">
    <h2>INVOICE NO<?= $idp; ?></h2>
    <h4>Customernya <?= $idp; ?></h4>
        <div class="data-tables datatable-dark">
            <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pesanan</th>
                        <th>Deskripsi</th>
                        <th>Pesanan</th>
                        <th>Base Cake</th>
                        <th>Ukuran</th>
                        <th>Warna</th>
                        <th>Tulisan di cake</th>
                        <th>Catatan</th>
                        <th>Total</th>
                        <th>DP/Lunas</th>
                        <th>Kekurangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ambilpesanan = mysqli_query($conn,"SELECT * FROM pesanan WHERE idpesanan = idpesanan");
                    $i = 1;
                    while($data=mysqli_fetch_array($ambilpesanan)){
                        $namapesanan = $data['pesanan'];
                        $deskripsi = $data['transaksi'];
                        $stock = $data['admin'];
                        $idp = $data['idpesanan'];
                    ?>
                    <tr>
                        <td>pesanan</td>
                        <td><?php echo $idp;?></td>
                        <td><?php echo $namapesanan;?></td>
                        <td><?php echo $deskripsi;?></td>
                        <td><?php echo $stock;?></td>
                        <td><?php echo $stock;?></td>
                        <td><?php echo $stock;?></td>
                        <td><?php echo $stock;?></td>
                        <td><?php echo $stock;?></td>
                        <td><?php echo $stock;?></td>
                        <td><?php echo $stock;?></td>
                        <td><?php echo $stock;?></td>
                    </tr>

                    <?php
                    };
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</body>

</html>

