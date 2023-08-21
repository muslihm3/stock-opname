<?php
//if blm login

if($_SESSION['role']==""){
		header("location:login.php?pesan=gagal");
	}