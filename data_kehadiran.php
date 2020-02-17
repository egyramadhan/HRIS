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
                            <h1>Kehadiran Karyawan</h1>
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
                                <h3 class="card-title">Data Kehadiran Karyawan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" method="get" action="">
                                <div class="form-group">
                                
                                <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-1 col-form-label">Bulan</label>
                                        <div class="col-sm-2">
                                            <select name="bulan" class="form-control">
                                                <option value="">-- Pilih --</option>
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                    <label class="col-sm-1 col-form-label">Tahun</label>
                                        <div class="col-sm-2">
                                            <select name="tahun" class="form-control">
                                                <option value="">-- Pilih --</option>
                                                <?php
                                                    $y = date('Y');
                                                    for ($i = 2019;$i<$y+1;$i++ ){
                                                        echo "<option value='$i'>$i</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                                        </div>
                                        <a href="data_kehadiran.php?view=tambah" class="btn btn-success">Input Kehadiran Karyawan</a>
                                    </div>
                                </div>
                                </div>
                            </form>
                                    <?php
                                        if((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')){
                                            $bulan = $_GET['bulan'];
                                            $tahun = $_GET['tahun'];
                                            $bulantahun = $bulan.$tahun;
                                        }else {
                                            $bulan = date('m');
                                            $tahun = date('Y');
                                            $bulantahun = $bulan.$tahun;
                                        }
                                    ?>
                                    <div class="alert alert-info">
                                        <strong>Bulan: <?php echo $bulan; ?>, Tahun: <?php echo $tahun; ?></strong>
                                    </div>
                                    <!-- Main content -->
                                    <section class="content">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>NIP</th>
                                                                <th>Nama Karyawan</th>
                                                                <th>Jabatan</th>
                                                                <th>Masuk</th>
                                                                <th>Izin</th>
                                                                <th>Alpha</th>
                                                                <th>Lembur</th>
                                                                <th>Potongan</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $sql = mysqli_query($konek, "SELECT master_gaji.*, pegawai.nama_pegawai, pegawai.kode_jabatan,
                                                                jabatan.nama_jabatan
                                                                FROM master_gaji
                                                                INNER JOIN pegawai ON master_gaji.nip = pegawai.nip
                                                                INNER JOIN jabatan ON pegawai.kode_jabatan = jabatan.kode_jabatan
                                                                WHERE master_gaji.bulan = $bulantahun
                                                                ORDER BY pegawai.nip ASC");
                                                            
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
                                                                        <td>$d[lembur]</td>
                                                                        <td>$d[potongan]</td>
                                                                        <td><a  class='btn btn-warning btn-sm' href=''>TESS</a>
                                                                            <a  class='btn btn-warning btn-sm' href=''>TESS</a>
                                                                            <a  class='btn btn-warning btn-sm' href=''>TESS</a>
                                                                        </td>
                                                                    </tr>";
                                                                    $no++;
                                                            }
                                                        ?>
                                            
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>NIP</th>
                                                                <th>Nama Karyawan</th>
                                                                <th>Jabatan</th>
                                                                <th>Masuk</th>
                                                                <th>Izin</th>
                                                                <th>Alpha</th>
                                                                <th>Lembur</th>
                                                                <th>Potongan</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#example').DataTable();
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
            case 'tambah':
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
                            <h1>Import Kehadiran Karyawan</h1>
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
                                <h3 class="card-title">Import Kehadiran Karyawan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" method="get" action="">
                                <div class="form-group">
                                
                                <div class="card-body">
                                <div class="form-group row">
                                <div class="col-md-4">
                                <form action="" method="get">
                                    <input type="hidden" name="view" value="tambah">
                                    <label>Tanggal Awal</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                            <input placeholder="masukkan tanggal Awal" type="date" class="form-control datepicker" name="tgl_awal">
                                        </div>
                                    </div>
                                    <div class = "col-md-4">
                                        <label>Tanggal Akhir</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                                <input placeholder="masukkan tanggal Akhir" type="date" class="form-control datepicker" name="tgl_akhir">
                                            </div>
                                    </div>
                                    <div class = "col-md-4">
                                        <input type="submit" class="btn btn-primary" value="FILTER">
                                    </div>
                                </div>  
                                </form>
                                <form class="form-horizontal" method="POST"enctype="multipart/form-data" action="upload_aksi.php?act=insert">
                                            <div class="form-group row">
                                                <label class="col-sm-1 col-form-label" for="exampleInputFile">File Upload</label>
                                                    <div class="col-sm-2">
                                                        <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile">
                                                    </div>
                                                <button type="submit" class="btn btn-primary">Import</button>
                                            </div>
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Buat Baru</button>
                                </form> 
                                </div>
                                <!-- Modal -->
                                    <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog">
                                        
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">Input Absensi</h4>
                                            </div>
                                            <div class="modal-body">
                                            <div class="form-group">
                                            <form action="aksi_kehadiran.php?act=insert" method="POST">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">NIP</label>
                                                        <select name="nip" id="nip" class="form-control">
                                                            <option value="">--Pilih--</option>
                                                            <?php
                                                                $sqljabatan = mysqli_query($konek, "SELECT * FROM pegawai ORDER BY nip ASC");
                                                                while ($j = mysqli_fetch_array($sqljabatan)) {
                                                                    echo "<option value='$j[nip]'>$j[nip]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="exampleFormControlInput1">Nama Pegawai</label>
                                                        <input type="text" class="form-control" id="namapegawai" name="namapegawai" required>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="exampleFormControlInput1">Tanggal</label>
                                                        <input placeholder="Tanggal" type="date" class="form-control datepicker" name="tgl">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="exampleFormControlInput1">Jam Masuk</label>
                                                        <input type="time" class="form-control datepicker" name="time_masuk">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="exampleFormControlInput1">Jam Keluar</label>
                                                        <input type="time" class="form-control datepicker" name="time_keluar">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="exampleFormControlInput1">Status</label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="">--Pilih--</option>
                                                                <option value="P">Hadir</option>
                                                                <option value="I">Izin</option>
                                                                <option value="S">Sakit</option>
                                                                <option value="A">Alpha</option>
                                                            </select>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
                                                    </div>
                                            </form>
                                        </div>
                                        
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
                                                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>NIP</th>
                                                                <th>Nama Karyawan</th>
                                                                <th>Tanggal</th>
                                                                <th>Jam Masuk</th>
                                                                <th>Jam Keluar</th>
                                                                <th>Status</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            
                                                            if(isset($_GET['tgl_awal'])){
                                                                $tgl = $_GET['tgl_awal'];
                                                                $tgl2 = $_GET['tgl_akhir'];
                                                                $sql = mysqli_query($konek, "SELECT * FROM  kehadiran WHERE tanggal 
                                                                    BETWEEN '" . $tgl . "' AND  '" . $tgl2 . "'
                                                                    ORDER BY nip DESC");
                                                            }else{
                                                                $sql = mysqli_query($konek,"SELECT * FROM  kehadiran");
                                                            }

                                                            $no = 1;
                                                            while ($d = mysqli_fetch_array($sql)) {
                                                                if($d['statuses'] == 'P'){
                                                                    $a = "<span class='badge bg-success'>Hadir</span>";
                                                                } elseif($d['statuses'] == 'A'){
                                                                    $a = "<span class='badge bg-danger'>Alpha</span>";
                                                                } elseif($d['statuses'] == 'I'){
                                                                    $a = "<span class='badge bg-primary'>Izin</span>";
                                                                } elseif($d['statuses'] == 'S'){
                                                                    $a = "<span class='badge bg-warning'>Sakit</span>";
                                                                } 
                                                               echo "<tr>
                                                                        <td>$no <input type='hidden' class='id_hidden' value='$d[id]'></td>
                                                                        <td>$d[nip]</td>
                                                                        <td>$d[nama_karyawan]</td>
                                                                        <td>$d[tanggal]</td>
                                                                        <td>$d[jam_masuk]</td>
                                                                        <td>$d[jam_keluar]</td>
                                                                        <td>$a</td>
                                                                        <td><a  class='btn_edit btn btn-warning btn-sm' data-toggle='modal' data-target='#myModals' href='data_kehadiran.php?view=tambah&id=$d[id]'>Edit data</a>
                                                                            <a  class='btn_delete btn btn-danger btn-sm' href='aksi_kehadiran.php?act=del&id=$d[id]'>Hapus data</a>
                                                                            
                                                                        </td>
                                                               </tr>";
                                                               $no++;
                                                            }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#example').DataTable();
                                                        });

                                                        $(document).ready(function(){
                                                            $('#nip').change(function(){
                                                                var anip = $("#nip").val();
                                                                $.ajax({
                                                                    url : 'aksi_kehadiran.php',
                                                                    method : 'post',
                                                                    data : 'anip=' + anip
                                                                }).done(function(namapegawai){
                                                                    getnama = JSON.parse(namapegawai);
                                                                    console.log(getnama);
                                                                    $('#namapegawai').val(getnama.nama_pegawai);
                                                                })
                                                            })
                                                        });

                                                        $("#example").on('click','.btn_edit',function(){
                                                            var curr_row = $(this).closest('tr')
                                                            let col1 = curr_row.find("td:eq(0) .id_hidden").val()
                                                            let col2 = curr_row.find("td:eq(1)").text()
                                                            let col3 = curr_row.find("td:eq(2)").text()
                                                            let col4 = curr_row.find("td:eq(3)").text()
                                                            let col5 = curr_row.find("td:eq(4)").text()
                                                            let col6 = curr_row.find("td:eq(5)").text()
                                                            let col7 = curr_row.find("td:eq(6)").text()
                                                            console.log(col1);
                                                            $("#id_hidden2").val(col1);
                                                            $("#nip2").val(col2);
                                                            $("#namapegawai2").val(col3);
                                                            $("#tgl2").val(col4);
                                                            $("#time_masuk2").val(col5);
                                                            $("#time_keluar2").val(col6);
                                                            switch (col7) {
                                                                case "Sakit":
                                                                    col7 = "S"
                                                                    break;
                                                                case "Izin":
                                                                    col7 = "I"
                                                                    break;
                                                                case "Hadir":
                                                                    col7 = "P"
                                                                    break;
                                                                case "Alpha":
                                                                    col7 = "A"
                                                                    break;
                                                                default:
                                                                    break;
                                                            }
                                                            $("#status2").val(col7);
                                                            // // $("#mod_delt").modal("show")
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

                                            <!-- Modal -->
                                            <div class="modal fade" id="myModals" role="dialog">
                                                <div class="modal-dialog">
                                                
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                <?php
                                                    $sqlEdit = mysqli_query($konek, "SELECT * FROM kehadiran WHERE id = '$[id]'");
                                                    $e = mysqli_fetch_array($sqlEdit);

                                                    //  var_dump($e);
                                                ?>
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Edit Absensi</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="form-group">
                                                    <form action="aksi_kehadiran.php?act=update" method="POST">
                                                        <div class="form-group">
                                                            <input type="hidden" id="id_hidden2" name="id_hidden2">
                                                            <label for="exampleFormControlInput1">NIP</label>
                                                            <input type="number" class="form-control" id="nip2" name="nip2" readonly>
                                                            </div>
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="exampleFormControlInput1">Nama Pegawai</label>
                                                                <input type="text" class="form-control" id="namapegawai2" name="namapegawai2" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="exampleFormControlInput1">Tanggal</label>
                                                                <input placeholder="Tanggal" type="date" class="form-control datepicker" id="tgl2" name="tgl2">
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="exampleFormControlInput1">Jam Masuk</label>
                                                                <input type="time" class="form-control datepicker" id="time_masuk2" name="time_masuk2">
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="exampleFormControlInput1">Jam Keluar</label>
                                                                <input type="time" class="form-control datepicker" id="time_keluar2" name="time_keluar2">
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="exampleFormControlInput1">Status</label>
                                                                    <select name="status2" id="status2" class="form-control">
                                                                        <option value="">--Pilih--</option>
                                                                        <option value="P">Hadir</option>
                                                                        <option value="I">Izin</option>
                                                                        <option value="S">Sakit</option>
                                                                        <option value="A">Alpha</option>
                                                                    </select>
                                                            </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                                                            <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
                                                            </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
            <?php
        break;
            case 'edit':
            ?>
            <?php
        break;
        }
    ?>
<?php include "footer.php"; ?>