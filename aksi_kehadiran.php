<?php

    session_start();
    include "koneksi.php";

    if(!isset($_SESSION['login'])){
        header('location:login.php');
    }

    if (isset($_POST['anip'])) {

        $sqljabatan = mysqli_query($konek, "SELECT * FROM pegawai WHERE nip = ". $_POST['anip']);
        $d = mysqli_fetch_array($sqljabatan);

        echo json_encode($d);
    }

    if(isset($_GET['act'])){
        if($_GET['act'] == 'insert'){
            $nip            = $_POST['nip'];
            $namap          = $_POST['namapegawai'];
            $tanggal        = $_POST['tgl'];
            $jammasuk       = $_POST['time_masuk'];
            $jamkeluar      = $_POST['time_keluar'];
            $status         = $_POST['status'];

            if($nip == '' || $namap == '' || $tanggal == ''){
                header('location:data_kehadiran.php?view=tambah&e=bl');
            }else{
                $simpan = mysqli_query($konek, "INSERT INTO kehadiran(nip,nama_karyawan,tanggal,jam_masuk,jam_keluar,statuses)
                                        VALUES('$nip', '$namap', '$tanggal', '$jammasuk', '$jamkeluar', '$status')");
                if($simpan){
                    header('location:data_kehadiran.php?view=tambah&e=sukses');
                }else{
                    header('location:data_kehadiran.php?view=tambah&e=gagal');
                }
            }
        }elseif ($_GET['act'] == 'update') {
            $id             = $_POST['id_hidden2'];
            $nip            = $_POST['nip2'];
            $namap          = $_POST['namapegawai2'];
            $tanggal        = $_POST['tgl2'];
            $jammasuk       = $_POST['time_masuk2'];
            $jamkeluar      = $_POST['time_keluar2'];
            $status         = $_POST['status2'];

            // return print_r($_POST);

            if($nip === '' || $namap === '' || $tanggal === ''){
                header('location:data_kehadiran.php?view=tambah&e=bl');
            }else{
                $update = mysqli_query($konek, "UPDATE kehadiran SET tanggal='$tanggal', jam_masuk='$jammasuk', jam_keluar= '$jamkeluar', statuses = '$status' 
                                                WHERE id = '$id'") or die (mysqli_error($konek)); 

                if($update){
                    header('location:data_kehadiran.php?view=tambah&e=sukses');
                }else{
                    header('location:data_kehadiran.php?view=tambah&e=gagal');
                }
            }
        }elseif ($_GET['act'] == 'del') {
            $hapus = mysqli_query($konek, "DELETE FROM kehadiran WHERE id = '$_GET[id]'");
            if($hapus){
                header('location:data_kehadiran.php?view=tambah&e=sukses');
            }else{
                header('location:data_kehadiran.php?view=tambah&e=gagal');
            }
        }
    }
