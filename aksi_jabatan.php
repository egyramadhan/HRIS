<?php

    session_start();
    include "koneksi.php";

    if(!isset($_SESSION['login'])){
        header('location:login.php');
    }

    if(isset($_GET['act'])){

        if($_GET['act'] == 'insert'){
            $kode = $_POST['kodejabatan'];
            $nama = $_POST['namajabatan'];
            $gapok = $_POST['gajipokok'];
            $tun    = $_POST['tunjanganjabatan'];

            if($kode == '' || $nama == '' || $gapok == '' || $tun == ''){
                header('location:data_jabatan.php?view=tambah&e=bl');
            }else{
                $simpan = mysqli_query($konek, "INSERT INTO jabatan(kode_jabatan,nama_jabatan,gapok,tunjangan_jabatan)VALUES('$kode', '$nama', '$gapok', '$tun')");
                if($simpan){
                    header('location:data_jabatan.php?e=sukses');
                }else{
                    header('location:data_jabatan.php?e=gagal');
                }
            }
        }elseif ($_GET['act'] == 'update') {
            $kode = $_POST['kodejabatan'];
            $nama = $_POST['namajabatan'];
            $gapok = $_POST['gajipokok'];
            $tun    = $_POST['tunjanganjabatan'];

            if($kode == '' || $nama == '' || $gapok == '' || $tun == ''){
                header('location:data_jabatan.php?view=tambah&e=bl');
            }else{
                $update = mysqli_query($konek, "UPDATE jabatan SET nama_jabatan='$nama', gapok='$gapok', tunjangan_jabatan= '$tun' WHERE kode_jabatan = '$kode'");
                if($update){
                    header('location:data_jabatan.php?e=sukses');
                }else{
                    header('location:data_jabatan.php?e=gagal');
                }
            }
        }elseif ($_GET['act'] == 'del') {
            $hapus = mysqli_query($konek, "DELETE FROM jabatan WHERE kode_jabatan = '$_GET[id]'");
            if($hapus){
                header('location:data_jabatan.php?e=sukses');
            }else{
                header('location:data_jabatan.php?e=gagal');
            }
        }
    }

?>