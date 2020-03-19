<?php include "header.php"; 
  if ($_SESSION['isadmin']) {
    
?>

  <?php 
    $view = isset($_GET['view']) ? $_GET['view'] : null;
    switch($view){
      default:
      if (isset($_GET['e']) && $_GET['e'] == 'sukses') {
        echo "<center> proses berhasil ... </center>";
      }elseif (isset($_GET['e']) && $_GET['e'] == 'gagal') {
        echo "<center> proses gagal ... </center>";
      }
  ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data User</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <div class="col-2">
                  <a href="data_user.php?view=tambah"class ="btn btn-block btn-primary">Tambah Data</a>
              </div>
                <h3 class="card-title"></h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Username</th>
                      <th>Nama Lengkap</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $sqladmin = mysqli_query($konek, "SELECT * FROM users ORDER BY username ASC");
                      while($data = mysqli_fetch_array($sqladmin)){
                        echo "<tr>
                          <td class='text-center'>$no</td>
                          <td>$data[username]</td>
                          <td>$data[namalengkap]</td>
                          <td class='text-center'>
                            <a href ='data_user.php?view=edit&id=$data[idadmin]' class='btn btn-warning btn-sm'>Edit</a>
                            <a href ='aksi_admin.php?act=delete&id=$data[idadmin]' class='btn btn-danger btn-sm'>Delete</a>
                          </td>
                        </tr>";
                        $no++;
                      }
                    ?>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
      break;
      case "tambah":
  ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content"> 
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="row">
          <div class="col-md-12">

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Input Data</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <form action="aksi_admin.php?act=insert" method="POST">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Username</label>
                      <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Nama lengkap</label>
                      <input type="text" class="form-control" name="namalengkap" placeholder="namalengkap">
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="isadmin" value="1">
                      <label class="form-check-label">Is Admin</label>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan" name="simpan">
                    <a href="data_user.php" class="btn btn-danger btn-sm">Batal</a>
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
      case "edit":

      $sqlEdit = mysqli_query($konek, "SELECT * FROM users WHERE idadmin = '$_GET[id]'");
      $e = mysqli_fetch_array($sqlEdit);
  ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="row">
          <div class="col-md-12">
          <form action="aksi_admin.php?act=update" method="POST">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Edit Data</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
              
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="	fa fa-address-card"></i></span>
                    </div>
                    <input type="hidden" name="idadmin" value="<?php echo $e['idadmin']; ?>">
                    <input type="text" name="username" class="form-control" value="<?php echo $e['username']; ?>">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- Date mm/dd/yyyy -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="text" name="password" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- phone mask -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                    </div>
                    <input type="text" name="namalengkap" class="form-control" value="<?php echo $e['namalengkap']; ?>">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- phone mask -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm" value="Update" style="margin-right: 3px;">
                    <a href="data_user.php" class="btn btn-danger btn-sm">Batal</a>
                  </div>
                  <!-- /.input group -->
                </div>

              </div>
              <!-- /.card-body -->
            </div>
           
          </div>
          
         </div>
      </form>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
  
    break;
    }
    
  }else{

  
    
  ?>
  <div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger">500</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> <br> Oops! Anda tidak dapat akses modul ini.</h3>

        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
  </div>
  <?php } ?>   
<?php include "footer.php" ?>