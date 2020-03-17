<?php

    session_start();
    if (isset($_SESSION['login'])) {
        include 'koneksi.php';
        include 'fungsi.php';
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kehadiran</title>
    <style type="text/css">
        body{
            font-family: Monospace;
        }
        table{
            border-collapse: collape;
        }
        @media print{
            .no-print{
                display: none;
            }
        }
    </style>
</head>
<body>
        <table width="100%">
        <tr>
                    <td width="15%"><img src="logo-side.png"></td>
                    <td><h1>PT. ASCLAR INDONESIA</h1>
                        <p style="margin-top:-23px;">Jln. Benda atas no.43 RT.7/RW.6,</p>
                        <p style="margin-top:-12px;">Cilandak Timur, Kec. Ps. Minggu</p>
                        <p style="margin-top:-14px;">Kota Jakarta Selatan Daerah Khusus Ibukota Jakarta 12560</p>
                    </td>
        </tr>
        </table>
        <hr>
        <p>Laporan Kehadiran</p>
        <table border="1" cellpadding="4" cellspacing="0" width="100%">
            <tr>
            <th>No</th>
                                                                <th>NIP</th>
                                                                <th>Nama Karyawan</th>
                                                                <th>Jabatan</th>
                                                                <th>Masuk</th>
                                                                <th>Izin</th>
                                                                <th>Alpha</th>
                                                                <th>Sakit</th>
            </tr>
            <?php
                                                        if (isset($_GET['tgl_awal'])) {
                                                            $tgl = $_GET['tgl_awal'];
                                                            $tgl2 = $_GET['tgl_akhir'];
                                                            $sql = mysqli_query($konek, "SELECT
                                                                                                kehadiran.nip AS nip,
                                                                                                pegawai.nama_pegawai,
                                                                                                jabatan.nama_jabatan,
                                                                                                CONCAT(
                                                                                                MONTH(kehadiran.tanggal),
                                                                                                YEAR(kehadiran.tanggal)
                                                                                                ) AS bulan,
                                                                                                COUNT(
                                                                                                IF (kehadiran.statuses = 'P', 1, NULL)
                                                                                                ) AS 'masuk',
                                                                                                COUNT(
                                                                                                IF (kehadiran.statuses = 'A', 1, NULL)
                                                                                                ) AS 'alpha',
                                                                                                COUNT(
                                                                                                IF (kehadiran.statuses = 'I', 1, NULL)
                                                                                                ) AS 'izin',
                                                                                                COUNT(
                                                                                                IF (kehadiran.statuses = 'S', 1, NULL)
                                                                                                ) AS 'sakit'
                                                                                            FROM
                                                                                                kehadiran
                                                                                                INNER JOIN pegawai
                                                                                                ON kehadiran.nip = pegawai.nip
                                                                                                INNER JOIN jabatan
                                                                                                ON pegawai.kode_jabatan = jabatan.kode_jabatan
                                                                                            WHERE kehadiran.`tanggal` BETWEEN '" . $tgl . "' AND  '" . $tgl2 . "'
                                                                                            GROUP BY kehadiran.nip ASC
                                                                                            ");
                                                        }else {
                                                            $sql = mysqli_query($konek, "SELECT
                                                                                                kehadiran.nip AS nip,
                                                                                                pegawai.nama_pegawai,
                                                                                                jabatan.nama_jabatan,
                                                                                                CONCAT(
                                                                                                MONTH(kehadiran.tanggal),
                                                                                                YEAR(kehadiran.tanggal)
                                                                                                ) AS bulan,
                                                                                                COUNT(
                                                                                                IF (kehadiran.statuses = 'P', 1, NULL)
                                                                                                ) AS 'masuk',
                                                                                                COUNT(
                                                                                                IF (kehadiran.statuses = 'A', 1, NULL)
                                                                                                ) AS 'alpha',
                                                                                                COUNT(
                                                                                                IF (kehadiran.statuses = 'I', 1, NULL)
                                                                                                ) AS 'izin',
                                                                                                COUNT(
                                                                                                IF (kehadiran.statuses = 'S', 1, NULL)
                                                                                                ) AS 'sakit'
                                                                                            FROM
                                                                                                kehadiran
                                                                                                INNER JOIN pegawai
                                                                                                ON kehadiran.nip = pegawai.nip
                                                                                                INNER JOIN jabatan
                                                                                                ON pegawai.kode_jabatan = jabatan.kode_jabatan
                                                                                            GROUP BY kehadiran.nip ASC
                                                                                            ");
                                                        }
                                                            

                                                            $no = 1;
                                                            while ($d = mysqli_fetch_array($sql)) {
                                                                echo "<tr>
                                                                        <td>$no</td>
                                                                        <td>$d[nip]</td>
                                                                        <td>$d[nama_pegawai]</td>
                                                                        <td>$d[nama_jabatan]</td>
                                                                        <td>$d[masuk]</td>
                                                                        <td>$d[izin]</td>
                                                                        <td>$d[alpha]</td>
                                                                        <td>$d[sakit]</td>
                                                                        
                                                                    </tr>";
                                                                    $no++;
                                                            }
                                                    ?>

        </table>
        <table width="100%">
            <tr>
                <td></td>
                <td width="200px">
                    <p>Jakarta, <?php echo tgl_indo(date('Y-m-d')); ?>
                    <br>
                    Manager HR,
                </p>
                <br>
                <br>
                <br>
                <p>________________</p>
                </td>
            </tr>
        </table>
            
        
    <a href="#" class="no-print" onclick="window.print();">print</a>
    
</body>
</html>

<?php
}else {
    header('location:login.php');
}
?>