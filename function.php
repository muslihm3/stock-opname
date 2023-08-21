<?php
session_start();

//membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "admin");

//menambah barang
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "insert into stock (namabarang, deskripsi, stock) values('$namabarang','$deskripsi', '$stock')");
    if ($addtotable) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//menambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];
    $penerima = $_POST['penerima'];

    $cekstocks = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildata = mysqli_fetch_array($cekstocks);

    $stocks = $ambildata['stock'];
    $tambahstocks = $stocks + $qty;

    //GAMBAR
    $allowed_extention = array('png', 'jpg');
    $nama = $_FILES['file']['name']; //mengambil nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //ekstensi
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name']; //lokasi

    //penamaan file gambar
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //nama file


    if (in_array($ekstensi, $allowed_extention) === true) {
        //ukuran
        if ($ukuran < 150000000) {
            move_uploaded_file($file_tmp, 'img/' . $image);

            $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, qty, total, image, keterangan) values('$barangnya','$qty','$total', '$image','$penerima')");
            $updatestocks = mysqli_query($conn, "update stock set stock='$tambahstocks' where idbarang='$barangnya'");
            if ($addtomasuk && $updatestocks) {
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }
        } else {
            //>15mb
            echo '
            <script>
                alert("File harus <script 15mb");
                window.location.href="masuk.php";
            </script>
            ';
        }
    } else {
        //bukan png/jpg
        echo '
        <script>
            alert("File harus png/jpg");
            window.location.href="masuk.php";
        </script>
        ';
    }
}

//mengurangi barang keluar
if (isset($_POST['barangkeluar'])) {
    $barangnya = $_POST['barangnya'];
    $qty = $_POST['qty'];
    $petugas = $_POST['petugas'];

    $cekstocks = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildata = mysqli_fetch_array($cekstocks);

    $stocks = $ambildata['stock'];

    if ($stocks >= $qty) {
        //kalau barang cukup

        $tambahstocks = $stocks - $qty;

        $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, qty, petugas) values('$barangnya','$qty','$petugas')");
        $updatestocks = mysqli_query($conn, "update stock set stock='$tambahstocks' where idbarang='$barangnya'");
        if ($addtokeluar && $updatestocks) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    } else {
        //kalau barang habis
        echo '
        <script>
            alert("Stock tidak mencukupi");
            window.location.href="keluar.php";
        </script>
            ';
    }
}

//Edit barang
if (isset($_POST['edit'])) {
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $edit = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idb'");
    if ($edit) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Hapus barang
if (isset($_POST['hapus'])) {
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if ($hapus) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Edit barang masuk
if (isset($_POST['editmasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];
    $penerima = $_POST['penerima'];

    $cekstocks = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($cekstocks);
    $stocks = $stocknya['stock'];

    $qtys = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtys);
    $qtys = $qtynya['qty'];

    if ($qty > $qtys) {
        $selisih = $qty - $qtys;
        $kurangin = $stocks + $selisih;
        $kstocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty',total='$total', keterangan='$penerima' where idmasuk='$idm'");
        if ($kstocknya && $updatenya) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    } else {
        $selisih = $qtys - $qty;
        $kurangin = $stocks - $selisih;
        $kstocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', total='$total', keterangan='$penerima' where idmasuk='$idm'");
        if ($kstocknya && $updatenya) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    }
}

//hapus barang masuk
if (isset($_POST['hapusmasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $qty = $_POST['kty'];

    $image = mysqli_query($conn, "select * from masuk where idbarang='$idm'");
    $get = mysqli_fetch_array($image);
    $img = 'img/' . $get['image'];
    unlink($img);


    $getstocks = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($getstocks);
    $stocks = $stocknya['stock'];

    $selisih = $stocks - $qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapus = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if ($update && $hapus) {
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//Edit barang keluar
if (isset($_POST['editkeluar'])) {
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $qty = $_POST['qty'];
    $petugas = $_POST['petugas'];

    $cekstocks = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($cekstocks);
    $stocks = $stocknya['stock'];

    $qtys = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtys);
    $qtys = $qtynya['qty'];

    if ($qty > $qtys) {
        $selisih = $qty - $qtys;
        $kurangin = $stocks - $selisih;
        $kstocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', petugas='$petugas' where idkeluar='$idk'");
        if ($kstocknya && $updatenya) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    } else {
        $selisih = $qtys - $qty;
        $kurangin = $stocks + $selisih;
        $kstocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', petugas='$petugas' where idkeluar='$idk'");
        if ($kstocknya && $updatenya) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    }
}

//hapus barang keluar
if (isset($_POST['hapuskeluar'])) {
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $qty = $_POST['kty'];


    $getstocks = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($getstocks);
    $stocks = $stocknya['stock'];

    $selisih = $stocks + $qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapus = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if ($update && $hapus) {
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}

//menambah admin
if (isset($_POST['addadmin'])) {
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = md5($_POST['password']);

    $addadmin = mysqli_query($conn, "insert into login (email,role, password) values('$email','$role','$password')");
    if ($addadmin) {
        header('location:admin.php');
    } else {
        echo 'Gagal';
        header('location:admin.php');
    }
}

//Edit admin
if (isset($_POST['editadmin'])) {
    $iduser = $_POST['iduser'];
    $emailbaru = $_POST['emailbaru'];
    $passwordbaru = md5($_POST['passwordbaru']);

    $editadmin = mysqli_query($conn, "update login set email='$emailbaru', password='$passwordbaru' where iduser='$iduser'");
    if ($editadmin) {
        header('location:admin.php');
    } else {
        echo 'Gagal';
        header('location:admin.php');
    }
}

//Hapus admin
if (isset($_POST['hapusadmin'])) {
    $iduser = $_POST['iduser'];

    $hapus = mysqli_query($conn, "delete from login where iduser='$iduser'");
    if ($hapus) {
        header('location:admin.php');
    } else {
        echo 'Gagal';
        header('location:admin.php');
    }
}
