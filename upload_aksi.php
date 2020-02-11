<?php

    session_start();
    include "koneksi.php";

    if(!isset($_SESSION['login'])){
        header('location:login.php');
    }

    require 'vendor/autoload.php';
    // var_dump('awdwadwa');
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    
    if(isset($_GET['act'])){
        if($_GET['act'] == 'insert'){
            $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    
            if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
            
                $arr_file = explode('.', $_FILES['berkas_excel']['name']);
                $extension = end($arr_file);
            
                if('csv' == $extension) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
            
                $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
                
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                for($i = 1;$i < count($sheetData);$i++)
                {
                    $nip = $sheetData[$i]['1'];
                    $nama_karyawan = $sheetData[$i]['2'];
                    $tanggal = $sheetData[$i]['3'];
                    $masuk = $sheetData[$i]['4'];
                    $keluar = $sheetData[$i]['5'];
                    $status = $sheetData[$i]['6'];
                    $upload = mysqli_query($konek, "INSERT INTO kehadiran(id,nip,nama_karyawan,tanggal,jam_masuk,jam_keluar,statuses) 
                    VALUES ('','$nip','$nama_karyawan','$tanggal','$masuk','$keluar','$status')");
                }
                
                header('location:data_kehadiran.php?view=tambah&e=sukses');
                // header("Location: data_kehadiran.php?view=tambah"); 
            }
        }
        
    }
?>