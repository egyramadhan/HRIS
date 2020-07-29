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
        <title>Laporan KPI</title>
        <style type="text/css">
            body {
                font-family: Monospace;
            }

            table {
                border-collapse: collape;
            }

            @media print {
                .no-print {
                    display: none;
                }
            }
        </style>
    </head>

    <body>
        <table width="100%">
            <tr>
                <td width="15%"><img src="logo-side.png"></td>
                <td>
                    <h1>PT. ASCLAR INDONESIA</h1>
                    <p style="margin-top:-23px;">Jln. Benda atas no.43 RT.7/RW.6,</p>
                    <p style="margin-top:-12px;">Cilandak Timur, Kec. Ps. Minggu</p>
                    <p style="margin-top:-14px;">Kota Jakarta Selatan Daerah Khusus Ibukota Jakarta 12560</p>
                </td>
            </tr>
        </table>
        <hr>
        <p>Laporan Data Key performance Indicator Karyawan</p>
        <table border="1" cellpadding="4" cellspacing="0" width="100%">
            <tr>
                <th>No</th>
                <th>Nip</th>
                <th>Nama Karyawan</th>
                <th>Januari</th>
                <th>Februari</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
                <th>Juli</th>
                <th>Agustus</th>
                <th>September</th>
                <th>Oktober</th>
                <th>November</th>
                <th>Desember</th>
            </tr>
            <?php
            $sql = mysqli_query($konek, "SELECT
                                                                                    nama_karyawan,
                                                                                    nip,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 1,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS jan,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 2,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS feb,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 3,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS mar,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 4,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS apr,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 5,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS mei,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 6,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS jun,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 7,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS jul,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 8,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS ags,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 9,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS sep,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 10,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS okt,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 11,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS nov,
                                                                                    SUM( IF(MONTH(kehadiran.`tanggal`) = 12,IF(kehadiran.`statuses`= 'P',1,0) + IF(kehadiran.`statuses`= 'I',1,0) + IF(kehadiran.`statuses`= 'S',1,0) ,0))/20 * 100 AS des
                                                                                FROM kehadiran
                                                                                GROUP BY nama_karyawan;
                                                        ");
            $no = 1;

            while ($d = mysqli_fetch_array($sql)) {
                echo "
                                                                <tr>
                                                                    <td align='center'>$no</td>
                                                                    <td>$d[nip]</td>
                                                                    <td>$d[nama_karyawan]</td>
                                                                    <td>" . percent($d['jan']) . "</td>
                                                                    <td>" . percent($d['feb']) . "</td>
                                                                    <td>" . percent($d['mar']) . "</td>
                                                                    <td>" . percent($d['apr']) . "</td>
                                                                    <td>" . percent($d['mei']) . "</td>
                                                                    <td>" . percent($d['jun']) . "</td>
                                                                    <td>" . percent($d['jul']) . "</td>
                                                                    <td>" . percent($d['ags']) . "</td>
                                                                    <td>" . percent($d['sep']) . "</td>
                                                                    <td>" . percent($d['okt']) . "</td>
                                                                    <td>" . percent($d['nov']) . "</td>
                                                                    <td>" . percent($d['des']) . "</td>
                                                                </tr>
                                                            ";
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
                    <p>Evis Triayana</p>
                </td>
            </tr>
        </table>


        <a href="#" class="no-print" onclick="window.print();">print</a>

    </body>

    </html>

<?php
} else {
    header('location:login.php');
}
?>