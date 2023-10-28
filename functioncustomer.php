<?php
session_start();

//membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "admin");

//menambah customer
// if (isset($_POST['addnewCustomer'])) {
//     $namacustomer = $_POST['namacustomer'];
//     $numbercustomer = $_POST['numbercustomer'];
//     $emailcustomer = $_POST['emailcustomer'];

//     $addtotable = mysqli_query($conn, "insert into customer (namacustomer, numbercustomer, emailcustomer) values('$namacustomer','$numbercustomer','$emailcustomer')");
//     if ($addtotable) {
//         header('location:customer.php');
//     } else {
//         echo 'Gagal';
//         header('location:customer.php');
//     }
// }
if (isset($_POST['addnewCustomer'])) {
    $namacustomer = $_POST['namacustomer'];
    $numbercustomer = $_POST['numbercustomer'];
    $emailcustomer = $_POST['emailcustomer'];

    // Cek apakah nomor customer sudah ada dalam database
    $cekNomorCustomer = mysqli_query($conn, "SELECT * FROM customer WHERE numbercustomer = '$numbercustomer'");
    $count = mysqli_num_rows($cekNomorCustomer);

    if ($count > 0) {
        // Nomor customer sudah ada dalam database, tampilkan pesan kesalahan
        echo "<script>alert('Nomor customer sudah ada dalam database.')</script>";
    } else {
        // Nomor customer belum ada dalam database, tambahkan pelanggan baru
        $addcustomer = mysqli_query($conn, "INSERT INTO customer (namacustomer, numbercustomer, emailcustomer) VALUES ('$namacustomer','$numbercustomer','$emailcustomer')");

        if ($addcustomer) {
            echo "<script>alert('Pelanggan berhasil ditambahkan.')</script>";
        } else {
            echo "<script>alert('Gagal menambahkan pelanggan.')</script>";
        }
    }
}

// Import Customer
require 'vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['importData'])) {
    if ($_FILES['file']['name']) {
        $inputFileName = $_FILES['file']['tmp_name'];
        try {
            $spreadsheet = IOFactory::load($inputFileName);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            foreach ($sheetData as $row) {
                $namacustomer = $row['A'];  
                $numbercustomer = $row['B'];
                $emailcustomer = $row['C'];

                // Periksa apakah nomor customer sudah ada dalam database
                $cekNomorCustomer = mysqli_query($conn, "SELECT * FROM customer WHERE numbercustomer = '$numbercustomer'");
                $count = mysqli_num_rows($cekNomorCustomer);

                if ($count > 0) {
                    // Nomor customer sudah ada dalam database, berikan pesan atau lewati entri ini
                    echo "<script>alert('Nomor customer sudah ada dalam database.')</script>";
                } else {
                    // Nomor customer belum ada dalam database, tambahkan pelanggan baru
                    $addtotable = mysqli_query($conn, "INSERT INTO customer (namacustomer, numbercustomer, emailcustomer) VALUES ('$namacustomer','$numbercustomer','$emailcustomer')");
                }
            }

            header('location:customer.php');
        } catch (Exception $e) {
            echo 'Error loading file: ', $e->getMessage();
        }
    }
}





//menambah pesanan
if (isset($_POST['pesananmasuk'])) {
    $customernya = $_POST['customernya'];
    $pesanan = $_POST['pesanan'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];
    $tgl_transaksi = $_POST['tanggal_transaksi']; // Mengambil nilai tanggal transaksi dari formulir
    $outlet_pesanan = $_POST['outlet_pesanan'];
    $admin = $_POST['admin'];

    

    $cekcustomer = mysqli_query($conn, "select * from customer where idcustomer='$customernya'");
    $ambildata = mysqli_fetch_array($cekcustomer);

    $jumlah = $ambildata['qty'];
    $totaltransaksi = $ambildata['total'];
    $tambahjumlah = $jumlah + $qty;
    $tambahtotal = $totaltransaksi + $total;

    $addtopesanan = mysqli_query($conn, "insert into pesanan (idcustomer, pesanan, jumlah, transaksi,tanggal_transaksi, outlet, admin) values('$customernya','$pesanan','$qty','$total', '$tgl_transaksi', '$outlet_pesanan', '$admin' )");
    $updatepesanan = mysqli_query($conn, "update customer set qty='$tambahjumlah', total='$tambahtotal' where idcustomer='$customernya'");
    if ($addtopesanan && $updatepesanan) {
        header('location:pesanan.php');
    } else {
        echo 'Gagal';
        header('location:pesanan.php');
    }
}

//Edit customer
if (isset($_POST['editcustomer'])) {
    $idc = $_POST['idc'];
    $namacustomer = $_POST['namacustomer'];
    $numbercustomer = $_POST['numbercustomer'];
    $emailcustomer = $_POST['emailcustomer'];

    $editcustomer = mysqli_query($conn, "update customer set namacustomer='$namacustomer', numbercustomer='$numbercustomer', emailcustomer='$emailcustomer' where idcustomer='$idc'");
    if ($editcustomer) {
        header('location:customer.php');
    } else {
        echo 'Gagal';
        header('location:customer.php');
    }
}

//Hapus customer
if (isset($_POST['hapuscustomer'])) {
    $idc = $_POST['idc'];

    $hapus = mysqli_query($conn, "delete from customer where idcustomer='$idc'");
    if ($hapus) {
        header('location:customer.php');
    } else {
        echo 'Gagal';
        header('location:customer.php');
    }
}

//Edit pesanan
if (isset($_POST['editpesanan'])) {
    $idc = $_POST['idc'];
    $idp = $_POST['idp'];
    $pesanan = $_POST['pesanan'];
    $jumlah = $_POST['jumlah'];
    $transaksi = $_POST['total'];
    $admin = $_POST['admin'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $outlet_pesanan = $_POST['outlet_pesanan']; //

    $cekcustomer = mysqli_query($conn, "select * from customer where idcustomer='$idc'");
    $customernya = mysqli_fetch_array($cekcustomer);
    $totaljuml = $customernya['qty'];
    $totaltrans = $customernya['total'];

    $cekpesanan = mysqli_query($conn, "select * from pesanan where idpesanan='$idp'");
    $pesanannya = mysqli_fetch_array($cekpesanan);
    $juml = $pesanannya['jumlah'];
    $trans = $pesanannya['transaksi'];


    if ($jumlah > $juml && $transaksi > $trans) {
        $selisihjuml = $jumlah - $juml;
        $selisihtrans = $transaksi - $trans;
        $kurangijuml = $totaljuml + $selisihjuml;
        $kurangitrans = $totaltrans + $selisihtrans;
        $ksekarang = mysqli_query($conn, "update customer set qty='$kurangijuml', total='$kurangitrans' where idcustomer='$idc'");
        $updatenya = mysqli_query($conn, "update pesanan set pesanan='$pesanan', jumlah='$jumlah', transaksi='$transaksi' , tanggal_transaksi='$tanggal_transaksi', outlet='$outlet_pesanan' , admin='$admin' where idpesanan='$idp'");
        if ($ksekarang && $updatenya) {
            header('location:pesanan.php');
        } else {
            echo 'Gagal';
            header('location:pesanan.php');
        }
    } else {
        $selisihjuml = $juml - $jumlah;
        $selisihtrans = $trans - $transaksi;
        $kurangijuml = $totaljuml - $selisihjuml;
        $kurangitrans = $totaltrans - $selisihtrans;
        $ksekarang = mysqli_query($conn, "update customer set qty='$kurangijuml', total='$kurangitrans' where idcustomer='$idc'");
        $updatenya = mysqli_query($conn, "update pesanan set pesanan='$pesanan', jumlah='$jumlah', transaksi='$transaksi' , tanggal_transaksi='$tanggal_transaksi', outlet='$outlet_pesanan' , admin='$admin'  where idpesanan='$idp'");
        if ($ksekarang && $updatenya) {
            header('location:pesanan.php');
        } else {
            echo 'Gagal';
            header('location:pesanan.php');
        }
    }
}

//hapus pesanan
if (isset($_POST['hapuspesanan'])) {
    $idc = $_POST['idc'];
    $idp = $_POST['idp'];
    $qty = $_POST['kty'];
    $total = $_POST['total'];
    

    $getcustomer = mysqli_query($conn, "select * from customer where idcustomer='$idc'");
    $customer = mysqli_fetch_array($getcustomer);

    $jumlah = $customer['qty'];
    $totaltransaksi = $customer['total'];
    $selisihjumlah = $jumlah - $qty;
    $selisihtotal = $totaltransaksi - $total;

    $update = mysqli_query($conn, "update customer set qty='$selisihjumlah', total='$selisihtotal'  where idcustomer='$idc'");
    $hapus = mysqli_query($conn, "delete from pesanan where idpesanan='$idp'");

    if ($update && $hapus) {
        header('location:pesanan.php');
    } else {
        echo 'Gagal';
        header('location:pesanan.php');
    }
}
