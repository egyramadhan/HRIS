<?php

    session_start();
    include "koneksi.php";

    if(!isset($_SESSION['login'])){
        header('location:login.php');
    }

    if(isset($_GET['act'])){

        if($_GET['act'] == 'insert'){
            $nip = $_POST['nip'];
            $nama = $_POST['namapegawai'];
            $jab = $_POST['jabatan'];
            $gol = $_POST['golongan'];
            $status = $_POST['status'];
            $jum = $_POST['jumlahanak'];

            if($nip == '' || $nama == '' || $jab == '' || $gol == '' || $status == ''){
                header('location:data_pegawai.php?view=tambah&e=bl');
            }else{
                $simpan = mysqli_query($konek, "INSERT INTO pegawai(nip, nama_pegawai, kode_jabatan, kode_golongan, statuses, jumlah_anak)
                                        VALUES('$nip', '$nama', '$jab', '$gol', '$status', '$jum')");
                if($simpan){
                    header('location:data_pegawai.php?e=sukses');
                }else{
                    header('location:data_pegawai.php?e=gagal');
                }
            }
        }elseif ($_GET['act'] == 'update') {
            $nip = $_POST['nip'];
            $nama = $_POST['namapegawai'];
            $jab = $_POST['jabatan'];
            $gol = $_POST['golongan'];
            $status = $_POST['status'];
            $jum = $_POST['jumlahanak'];

            if($nip == '' || $nama == '' || $jab == '' || $gol == '' || $status == ''){
                header('location:data_pegawai.php?view=tambah&e=bl');
            }else{
                $update = mysqli_query($konek, "UPDATE pegawai SET nama_pegawai='$nama', kode_jabatan='$jab', kode_golongan= '$gol',
                 statuses = '$status', jumlah_anak = '$jum'WHERE nip = '$nip'");
                if($update){
                    header('location:data_pegawai.php?e=sukses');
                }else{
                    header('location:data_pegawai.php?e=gagal');
                }
            }
        }elseif ($_GET['act'] == 'del') {
            $hapus = mysqli_query($konek, "DELETE FROM pegawai WHERE nip = '$_GET[id]'");
            if($hapus){
                header('location:data_pegawai.php?e=sukses');
            }else{
                header('location:data_pegawai.php?e=gagal');
            }
        }
    }

?>