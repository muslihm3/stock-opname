<?php

// cek login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    //cocokin database
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where email ='$email' and password='$password'");
    //hitung jumlah data
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        $_SESSION['log'] = 'True';
        header('location:index.php');
    } else {
        header('location:login.php?pesan=gagal');
    };
}

if (!isset($_SESSION['log'])) {
} else {
    header('location:index.php');
}


?>