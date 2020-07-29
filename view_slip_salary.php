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
        <title>Slip Gaji</title>
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
        <p>Slip Gaji </p>
        <p>Bulan : <?php echo bulan_indo(date('m')); ?> </p>
        <table border="1" cellpadding="4" cellspacing="0" width="100%">
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Gol</th>
                <th>Status</th>
                <th>Jumlah Anak</th>
                <th>Gapok</th>
                <th>Tj. Jabatan</th>
                <th>Tj. S/I</th>
                <th>Tj. Anak</th>
                <th>Uang Makan</th>
                <!-- <th>Uang Lembur</th> -->
                <th>BPJS</th>
                <th>Pendapatan</th>
                <th>Potongan</th>
                <th>Total</th>
            </tr>
            <?php
            if (isset($_GET['tgl_awal'])) {
                $tgl    = $_GET['tgl_awal'];
                $tgl2   = $_GET['tgl_akhir'];
                $id = $_GET['id'];
                $sql    = mysqli_query($konek, "SELECT
                                                                                                    kehadiran.nip AS nip,
                                                                                                    pegawai.nama_pegawai,
                                                                                                    jabatan.nama_jabatan,
                                                                                                    golongan.nama_golongan,
                                                                                                    pegawai.statuses,
                                                                                                    pegawai.jumlah_anak,
                                                                                                    jabatan.gapok,
                                                                                                    jabatan.tunjangan_jabatan,
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
                                                                                                    ) AS 'sakit',
                                                                                                    IF(pegawai.statuses = 'Menikah',tunjangan_suami_istri,0) AS tjsi,
                                                                                                    IF(pegawai.statuses = 'Menikah',tunjangan_anak,0) AS tjanak,
                                                                                                    uang_makan AS uangmakan,
                                                                                                    askes,
                                                                                                    (gapok+tunjangan_jabatan+(SELECT tjsi)+(SELECT tjanak)+(SELECT uangmakan)+askes) AS pendapatan,
                                                                                                    (150000 * COUNT(IF (kehadiran.`statuses` = 'A',1, NULL))) AS potongan,
                                                                                                    (SELECT pendapatan)-(150000 * COUNT(IF (kehadiran.`statuses` = 'A',1, NULL))) AS totalgaji
                                                                                                    FROM
                                                                                                    kehadiran
                                                                                                    INNER JOIN pegawai
                                                                                                    ON kehadiran.nip = pegawai.nip
                                                                                                    INNER JOIN golongan
                                                                                                    ON golongan.kode_golongan = pegawai.kode_golongan
                                                                                                    INNER JOIN jabatan
                                                                                                    ON pegawai.kode_jabatan = jabatan.kode_jabatan
                                                                                                WHERE kehadiran.`tanggal` BETWEEN '" . $tgl . "' AND  '" . $tgl2 . "' AND pegawai.`nip` = '$id'
                                                                                                GROUP BY kehadiran.nip ASC");
            } else {
                $id = $_GET['id'];
                $sql    = mysqli_query($konek, "SELECT
                                                                                                    kehadiran.nip AS nip,
                                                                                                    pegawai.nama_pegawai,
                                                                                                    jabatan.nama_jabatan,
                                                                                                    golongan.nama_golongan,
                                                                                                    pegawai.statuses,
                                                                                                    pegawai.jumlah_anak,
                                                                                                    jabatan.gapok,
                                                                                                    jabatan.tunjangan_jabatan,
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
                                                                                                    ) AS 'sakit',
                                                                                                    IF(pegawai.statuses = 'Menikah',tunjangan_suami_istri,0) AS tjsi,
                                                                                                    IF(pegawai.statuses = 'Menikah',tunjangan_anak,0) AS tjanak,
                                                                                                    uang_makan AS uangmakan,
                                                                                                    askes,
                                                                                                    (gapok+tunjangan_jabatan+(SELECT tjsi)+(SELECT tjanak)+(SELECT uangmakan)+askes) AS pendapatan,
                                                                                                    (150000 * COUNT(IF (kehadiran.`statuses` = 'A',1, NULL))) AS potongan,
                                                                                                    (SELECT pendapatan)-(150000 * COUNT(IF (kehadiran.`statuses` = 'A',1, NULL))) AS totalgaji
                                                                                                FROM
                                                                                                    kehadiran
                                                                                                    INNER JOIN pegawai
                                                                                                    ON kehadiran.nip = pegawai.nip
                                                                                                    INNER JOIN golongan
                                                                                                    ON golongan.kode_golongan = pegawai.kode_golongan
                                                                                                    INNER JOIN jabatan
                                                                                                    ON pegawai.kode_jabatan = jabatan.kode_jabatan
                                                                                                WHERE pegawai.`nip` = '$id'
                                                                                                GROUP BY kehadiran.nip ASC");
            }
            $no = 1;

            while ($d = mysqli_fetch_array($sql)) {
                echo "<tr>
                                                                        <td>$no</td>
                                                                        <td>$d[nip]</td>
                                                                        <td>$d[nama_pegawai]</td>
                                                                        <td>$d[nama_jabatan]</td>
                                                                        <td>$d[nama_golongan]</td>
                                                                        <td>$d[statuses]</td>
                                                                        <td>$d[jumlah_anak]</td>
                                                                        <td>" . buatRp($d['gapok']) . "</td>
                                                                        <td>" . buatRp($d['tunjangan_jabatan']) . "</td>
                                                                        <td>" . buatRp($d['tjsi']) . "</td>
                                                                        <td>" . buatRp($d['tjanak']) . "</td>
                                                                        <td>" . buatRp($d['uangmakan']) . "</td>
                                                                        <td>" . buatRp($d['askes']) . "</td>
                                                                        <td>" . buatRp($d['pendapatan']) . "</td>
                                                                        <td>" . buatRp($d['potongan']) . "</td>
                                                                        <td>" . buatRp($d['totalgaji']) . "</td>
                                                                    </tr>";
                $no++;

                $no++;
            }
            ?>

        </table>
        <table width='100%;'>
            <tr>
                <td></td>
                <td width='200px'>
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


        <a href='#' class='no-print' onclick='window.print();'>print</a>

    </body>

    </html>

<?php
} else {
    header('location:login.php');
}
?>