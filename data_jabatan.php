<?php include "header.php"; ?>
<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch ($view) {
  default:
?>
    <?php
    if (isset($_GET['e']) && $_GET['e'] == 'sukses') {
      echo "<center> proses berhasil ... </center>";
    } elseif (isset($_GET['e']) && $_GET['e'] == 'gagal') {
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
              <h1>Data Jabatan</h1>
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
                  <a class="btn btn-primary btn-sm" href="data_jabatan.php?view=tambah" style="margin-bottom : 5px;">Tambah Data</a>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th>Kode Jabatan</th>
                        <th>Nama Jabatan</th>
                        <th>Gaji Pokok</th>
                        <th>Tunjangan Jabatan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                      $no = 1;

                      while ($d = mysqli_fetch_array($sql)) {
                        echo "
                            <tr>
                                <td align='center'>$no</td>
                                <td>$d[kode_jabatan]</td>
                                <td>$d[nama_jabatan]</td>
                                <td>" . buatRp($d['gapok']) . "</td>
                                <td>" . buatRp($d['tunjangan_jabatan']) . "</td>
                                <td><a class='btn btn-warning btn-sm' href ='data_jabatan.php?view=edit&id=$d[kode_jabatan]'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href ='aksi_jabatan.php?act=del&id=$d[kode_jabatan]'>Delete</a>
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
    $simbol = 'H';
    $query  = mysqli_query($konek, "SELECT max(kode_jabatan) AS last FROM jabatan WHERE kode_jabatan LIKE '$simbol%'");
    $data   = mysqli_fetch_array($query);

    $kodejabatan = $data['last'];
    $nomorjabatan = substr($kodejabatan, 1, 2);
    $nextnomor   = $nomorjabatan + 1;
    $nextkode    = $simbol . sprintf('0%s', $nextnomor);
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
                  <form action="aksi_jabatan.php?act=insert" method="POST">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Kode jabatan</label>
                      <input type="text" class="form-control" name="kodejabatan" value="<?php echo $nextkode; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Nama Jabatan</label>
                      <input type="text" class="form-control" name="namajabatan" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Gaji Pokok</label>
                      <input type="number" class="form-control" name="gajipokok" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Tunjangan Jabatan</label>
                      <input type="number" class="form-control" name="tunjanganjabatan" required>
                    </div>

                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
                    <a href="data_jabatan.php" class="btn btn-danger btn-sm">Batal</a>
                  </form>

                  <?php
                  if (isset($_POST['simpan'])) {
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
    $sqlEdit = mysqli_query($konek, "SELECT * FROM jabatan WHERE kode_jabatan = '$_GET[id]'");
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
                  <form action="aksi_jabatan.php?act=update" method="POST">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Kode jabatan</label>
                      <input type="text" class="form-control" name="kodejabatan" value="<?php echo $e['kode_jabatan']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Nama Jabatan</label>
                      <input type="text" class="form-control" name="namajabatan" value="<?php echo $e['nama_jabatan']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Gaji Pokok</label>
                      <input type="number" class="form-control" name="gajipokok" value="<?php echo $e['gapok']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Tunjangan Jabatan</label>
                      <input type="number" class="form-control" name="tunjanganjabatan" value="<?php echo $e['tunjangan_jabatan']; ?>">
                    </div>

                    <input type="submit" class="btn btn-primary btn-sm" value="update data">
                    <a href="data_jabatan.php" class="btn btn-danger btn-sm">Batal</a>
                  </form>

                  <?php
                  if (isset($_POST['simpan'])) {
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
}
?>
<?php include "footer.php"; ?>