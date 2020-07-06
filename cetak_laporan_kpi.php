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
                            <h1>Laporan Key Performance Indicators</h1>
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
                                    <h3 class="card-title">Data KPI Tahun 2020</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form class="form-horizontal" method="get" action="">
                                    <div class="form-group">

                                        <div class="card-body">
                                            <div class="form-group row">
                                                <a href="view_laporan_kpi.php" class="btn btn-success">Cetak Laporan</a>
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
                                                        </thead>
                                                        <tbody>
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
                                                        </tbody>

                                                    </table>

                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#example').DataTable({});

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
    case "tambah":

        break;
    case "edit":

        break;
}
?>

<?php include "footer.php"; ?>