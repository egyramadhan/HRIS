<?php
    // session_start();
    include "koneksi.php";

    // if(!isset($_SESSION['login'])){
    //     header('location:login.php');
    // }

    $sql = mysqli_query($konek, "SELECT
            kehadiran.nip AS nip,
            pegawai.nama_pegawai,
            jabatan.nama_jabatan,
            golongan.nama_golongan,
            pegawai.statuses,
            pegawai.jumlah_anak,
            jabatan.gapok,
            jabatan.tunjangan_jabatan,
            MONTH(kehadiran.`tanggal`) AS bulan,
            YEAR(kehadiran.`tanggal`) AS tahun,
            (COUNT(IF (kehadiran.`statuses` = 'P',1, NULL)) + COUNT(IF (kehadiran.`statuses` = 'I',1, NULL)))/20 * 100 AS kpi
    FROM
        kehadiran
        INNER JOIN pegawai
        ON kehadiran.nip = pegawai.nip
        INNER JOIN golongan
        ON golongan.kode_golongan = pegawai.kode_golongan
        INNER JOIN jabatan
        ON pegawai.kode_jabatan = jabatan.kode_jabatan
    GROUP BY kehadiran.nip, MONTH(kehadiran.`tanggal`), YEAR(kehadiran.`tanggal`);");

    $a = mysqli_fetch_assoc($sql);
    // $b = [];
    //     foreach ($a as $dt) {
    //         $b[] = $dt;
    //     }
    
    $b = json_encode($a);

    echo $b;
    // die();