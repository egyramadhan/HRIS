<?php include "header.php"; ?>
    <?php
        $view = isset($_GET['view']) ? $_GET['view'] : null;

        switch ($view) {
            default:
            ?>
                <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
                <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
                <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
                
                <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                    <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Penggajihan Karyawan</h1>
                        </div>
                        </div>
                    </div><!-- /.container-fluid -->
                    </section>

                <!-- Main content -->
                    <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Gaji Karyawan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" method="get" action="">
                                <div class="form-group">
                                
                                <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-1 col-form-label">Tanggal Awal</label>
                                    <div class="col-sm-2">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                            <input placeholder="masukkan tanggal Awal" type="date" class="form-control datepicker" name="tgl_awal">
                                        </div>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Tanggal Akhir</label>
                                        <div class="col-sm-2">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                                <input placeholder="masukkan tanggal Akhir" type="date" class="form-control datepicker" name="tgl_akhir">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="submit" class="btn btn-primary btn-sm" value="FILTER">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </form>
                                    <!-- Main content -->
                                    <section class="content">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                    <table id="example" class="table table-bordered table-hover table-responsive" style="width:100%">
                                                        <thead>
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
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            
                                                            if (isset($_GET['tgl_awal'])) {
                                                                $tgl    = $_GET['tgl_awal'];
                                                                $tgl2   = $_GET['tgl_akhir'];
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
                                                                                                    WHERE kehadiran.`tanggal` BETWEEN '" . $tgl . "' AND  '" . $tgl2 . "'
                                                                                                    GROUP BY kehadiran.nip ASC"); 
                                                            }else {
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
                                                                        <td>".buatRp($d['gapok'])."</td>
                                                                        <td>".buatRp($d['tunjangan_jabatan'])."</td>
                                                                        <td>".buatRp($d['tjsi'])."</td>
                                                                        <td>".buatRp($d['tjanak'])."</td>
                                                                        <td>".buatRp($d['uangmakan'])."</td>
                                                                        <td>".buatRp($d['askes'])."</td>
                                                                        <td>".buatRp($d['pendapatan'])."</td>
                                                                        <td>".buatRp($d['potongan'])."</td>
                                                                        <td>".buatRp($d['totalgaji'])."</td>
                                                                    </tr>";
                                                                    $no++;
                                                            }
                                                        ?>
                                            
                                                        </tbody>
                                                    </table>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#example').DataTable({
                                                                "order": [[ 1, "desc" ]],
                                                            });
                                                            
                                                        });
                                                    </script>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    <!-- /.row -->
                                    </section>
                                <!-- /.content -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </section>
                <!-- /.content -->
                </div>
            <?php
        break;
        }
    ?>
<?php include "footer.php"; ?>