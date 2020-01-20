<?php

    session_start();
    include "koneksi.php";

    if(!isset($_SESSION['login'])){
        header('location:login.php');
    }

    if(isset($_GET['act'])){

        if($_GET['act'] == 'insert'){
            $kode = $_POST['kodegolongan'];
            $nama = $_POST['namagolongan'];
            $tjkeluarga = $_POST['tunjangankeluarga'];
            $tjanak = $_POST['tunjangananak'];
            $um = $_POST['uangmakan'];
            $ul = $_POST['uanglembur'];
            $askes    = $_POST['askes'];

            if($kode == '' || $nama == '' || $tjkeluarga == '' || $tjanak == '' || $um == '' || $ul == '' || $askes == ''){
                header('location:data_golongan.php?view=tambah&e=bl');
            }else{
                $simpan = mysqli_query($konek, "INSERT INTO golongan(kode_golongan,nama_golongan,tunjangan_suami_istri,tunjangan_anak,uang_makan,uang_lembur,askes)
                                        VALUES('$kode', '$nama', '$tjkeluarga', '$tjanak', '$um', '$ul', '$askes')");
                if($simpan){
                    header('location:data_golongan.php?e=sukses');
                }else{
                    header('location:data_golongan.php?e=gagal');
                }
            }
        }elseif ($_GET['act'] == 'update') {
            $kode = $_POST['kodegolongan'];
            $nama = $_POST['namagolongan'];
            $tjkeluarga = $_POST['tunjangankeluarga'];
            $tjanak = $_POST['tunjangananak'];
            $um = $_POST['uangmakan'];
            $ul = $_POST['uanglembur'];
            $askes    = $_POST['askes'];
            if($kode == '' || $nama == '' || $tjkeluarga == '' || $tjanak == '' || $um == '' || $ul == '' || $askes == ''){
                header('location:data_golongan.php?view=tambah&e=bl');
            }else{
                $update = mysqli_query($konek, "UPDATE golongan SET nama_golongan='$nama', tunjangan_suami_istri='$tjkeluarga', tunjangan_anak= '$tjanak',
                 uang_makan = '$um', uang_lembur = '$ul', askes = '$askes' WHERE kode_golongan = '$kode'");
                if($update){
                    header('location:data_golongan.php?e=sukses');
                }else{
                    header('location:data_golongan.php?e=gagal');
                }
            }
        }elseif ($_GET['act'] == 'del') {
            $hapus = mysqli_query($konek, "DELETE FROM golongan WHERE kode_golongan = '$_GET[id]'");
            if($hapus){
                header('location:data_golongan.php?e=sukses');
            }else{
                header('location:data_golongan.php?e=gagal');
            }
        }
    }

?>