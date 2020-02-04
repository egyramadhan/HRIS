<?php include "header.php"; ?>
    <?php
        $view = isset($_GET['view']) ? $_GET['view'] : null;

        switch ($view) {
            default:
            ?>
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
                            $bulan = date('M');
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
                            <table id="example2" class="table table-bordered table-hover">
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
                                </tr>
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
                                            </tr>";
                                            $no++;
                                    }
                                    if (mysqli_num_rows($sql) > 0){
                                        echo "<tr>
                                            <td colspan='9' text-align='center'>
                                                <a href class='btn btn-warning' = 'data_kehadiran.php?view=edit&bulan=$bulan&$tahun'>Edit Data </a>
                                            </td>
                                        </tr>";
                                    }else {
                                            echo "<tr>
                                            <td colspan='9' text-align='center'>
                                                Tidak ada data dibulan dan tahun yang anda pilih !!
                                            </td>
                                        </tr>";
                                    }
                                ?>
                            
                            </table>
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
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script>
         $(document).ready(function() {
            $('#example2').DataTable();
        });
    </script>
  </div>
            <?php
        break;
            case 'tambah':
               
            ?>
            <?php
        break;
            case 'edit':
            ?>
            <?php
        break;
        }
    ?>
<?php include "footer.php"; ?>