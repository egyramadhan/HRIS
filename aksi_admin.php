<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header('location:login.php');
}
if (!empty($_GET['act'])) {
    if ($_GET['act'] == 'insert') {

        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $namalengkap = $_POST['namalengkap'];
        $idadmin = $_POST['isadmin'];

        if ($username == '' || $_POST['password'] == '' || $namalengkap == '') {
            echo "Form anda belum lengkap !";
        } else {

            $simpan = mysqli_query($konek, "INSERT INTO users(username, password, namalengkap, isadmin)VALUES('$username', '$password', '$namalengkap', '$idadmin')");
            if ($simpan) {
                header('location:data_user.php?e=sukses');
            } else {
                header('location:data_user.php?e=gagal');
            }
        }
    } elseif ($_GET['act'] == 'update') {

        $idadmin = $_POST['isadmin'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $namalengkap = $_POST['namalengkap'];

        if ($username == '' || $namalengkap == '') {

            echo "Form anda belum lengkap !";
        } else {
            if ($_POST['password'] == '') {
                $update = mysqli_query($konek, "UPDATE users SET username = '$username', namalengkap = '$namalengkap' WHERE idadmin = '$idadmin'");
            } else {
                $update = mysqli_query($konek, "UPDATE users SET username = '$username', password = '$password', namalengkap = '$namalengkap' WHERE idadmin = '$idadmin'");
            }

            if ($update) {
                header('location:data_user.php?e=sukses');
            } else {
                header('location:data_user.php?e=gagal');
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        $hapus = mysqli_query($konek, "DELETE FROM users WHERE idadmin = '$_GET[id]' AND idadmin != '1'");
        if ($hapus) {
            header('location:data_user.php?e=sukses');
        } else {
            header('location:data_user.php?e=gagal');
        }
    } else {
        header('location:data_user.php');
    }
} else {
    header('location:data_user.php');
}
