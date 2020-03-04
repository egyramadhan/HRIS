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
                                <a href="" class="btn btn-success">Cetak Laporan</a>
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
    case "tambah":

    break;
    case "edit":

    break;
}
?>

<?php include "footer.php"; ?>