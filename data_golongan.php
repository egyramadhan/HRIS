<?php include "header.php"; ?>
    <?php
        $view = isset($_GET['view']) ? $_GET['view'] : null;

        switch ($view) {
            default:
            ?>
            <?php
              if (isset($_GET['e']) && $_GET['e'] == 'sukses') {
                 echo "<center> proses berhasil ... </center>";
              }elseif (isset($_GET['e']) && $_GET['e'] == 'gagal') {
                echo "<center> proses gagal ... </center>";
              }
            ?>
                  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Golongan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a class="btn btn-primary btn-sm" href="data_golongan.php?view=tambah" style="margin-bottom : 5px;">Tambah Data</a>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Kode Golongan</th>
                      <th>Tunjangan Keluarga</th>
                      <th>Tunjangan Anak</th>
                      <th>Uang Makan</th>
                      <th>Uang lembur</th>
                      <th>Ansuransi Kesehatan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $sql = mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                        $no = 1;

                        while ($d = mysqli_fetch_array($sql)) {
                            echo "
                            <tr>
                                <td align='center'>$no</td>
                                <td>$d[kode_golongan]</td>
                                <td>$d[nama_golongan]</td>
                                <td>$d[tunjangan_suami_istri]</td>
                                <td>$d[tunjangan_anak]</td>
                                <td>$d[uang_makan]</td>
                                <td>$d[uang_lembur]</td>
                                <td><a class='btn btn-warning btn-sm' href ='data_golongan.php?view=edit&id=$d[kode_golongan]'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href ='aksi_golongan.php?act=del&id=$d[kode_golongan]'>Delete</a>
                                </td>
                            </tr>
                            ";
                            $no++;
                        }
                        
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
            <?php
        break;
            case 'tambah':
               $simbol = 'G';
               $query  = mysqli_query($konek, "SELECT max(kode_golongan) AS last FROM golongan WHERE kode_golongan LIKE '$simbol%'");
               $data   = mysqli_fetch_array($query);
               
               $kodegolongan = $data['last'];
               $nomorgolongan = substr($kodegolongan,1,2);
               $nextnomor   = $nomorgolongan + 1;
               $nextkode    = $simbol.sprintf('0%s',$nextnomor);
            ?>
            <?php
              if (isset($_GET['e']) && $_GET['e'] == 'bl') {
                 echo "<center> data belum lengkap ... </center>";
              }
            ?>
                <div class="content-wrapper">
                    <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1></h1>
                        </div>
                        </div>
                    </div>
                    </section>
                    <!-- Main content -->
                    <section class="content"> 
                    <div class="container-fluid">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="row">
                        <div class="col-md-12">

                            <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Input Data</h3>
                            </div>
                            <div class="card-body">
                                <!-- Date dd/mm/yyyy -->
                                <form action="aksi_golongan.php?act=insert" method="POST">
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Kode Golongan</label>
                                    <input type="text" class="form-control" name="kodegolongan" value="<?php echo $nextkode; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Nama Golongan</label>
                                    <input type="text" class="form-control" name="namagolongan" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Tunjangan Keluarga</label>
                                    <input type="number" class="form-control" name="tunjangankeluarga" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Tunjangan Anak</label>
                                    <input type="number" class="form-control" name="tunjangananak" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Uang Makan</label>
                                    <input type="number" class="form-control" name="uangmakan" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Uang Lembur</label>
                                    <input type="number" class="form-control" name="uanglembur" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Ansuransi Kesehatan</label>
                                    <input type="number" class="form-control" name="askes" required>
                                    </div>
                                    
                                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
                                    <a href="data_golongan.php" class="btn btn-danger btn-sm">Batal</a>
                                </form>

                                <?php
                                if(isset($_POST['simpan'])){
                                echo "asdfs";
                                }
                                ?>
                            </div>
                            
                            <!-- /.card-body -->
                            </div>

                        </div>
                        
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                
            <?php
        break;
            case 'edit':
                $sqlEdit = mysqli_query($konek, "SELECT * FROM golongan WHERE kode_golongan = '$_GET[id]'");
                $e = mysqli_fetch_array($sqlEdit);
            ?>
                <div class="content-wrapper">
                    <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1></h1>
                        </div>
                        </div>
                    </div>
                    </section>
                    <!-- Main content -->
                    <section class="content"> 
                    <div class="container-fluid">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="row">
                        <div class="col-md-12">

                            <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Data</h3>
                            </div>
                            <div class="card-body">
                                <!-- Date dd/mm/yyyy -->
                                <form action="aksi_golongan.php?act=update" method="POST">
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Kode jabatan</label>
                                    <input type="text" class="form-control" name="kodegolongan" value="<?php echo $e['kode_golongan']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Nama golongan</label>
                                    <input type="text" class="form-control" name="namagolongan" value="<?php echo $e['nama_golongan']; ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Tunjangan Keluarga</label>
                                    <input type="number" class="form-control" name="tunjangankeluarga" value="<?php echo $e['tunjangan_suami_istri']; ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Tunjangan Anak</label>
                                    <input type="number" class="form-control" name="tunjangananak" value="<?php echo $e['tunjangan_anak']; ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Uang Makan</label>
                                    <input type="number" class="form-control" name="uangmakan" value="<?php echo $e['uang_makan']; ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Uang Lembur</label>
                                    <input type="number" class="form-control" name="uanglembur" value="<?php echo $e['uang_lembur']; ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Ansuransi Kesehatan</label>
                                    <input type="number" class="form-control" name="askes" value="<?php echo $e['askes']; ?>">
                                    </div>
                                    
                                    <input type="submit" class="btn btn-primary btn-sm" value="update data">
                                    <a href="data_golongan.php" class="btn btn-danger btn-sm">Batal</a>
                                </form>
                            </div>
                            
                            <!-- /.card-body -->
                            </div>

                        </div>
                        
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