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
                            <h1>Data Pegawai</h1>
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
                                    <a class="btn btn-primary btn-sm" href="data_pegawai.php?view=tambah" style="margin-bottom : 5px;">Tambah Data</a>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>NIP</th>
                                                <th>Nama Pegawai</th>
                                                <th>Jabatan</th>
                                                <th>Golongan</th>
                                                <th>Status</th>
                                                <th>Jumlah Anak</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = mysqli_query($konek, "SELECT pegawai.*, jabatan.nama_jabatan, golongan.nama_golongan
                                            FROM pegawai
                                            INNER JOIN jabatan ON pegawai.kode_jabatan = jabatan.kode_jabatan
                                            INNER JOIN golongan ON pegawai.kode_golongan = golongan.kode_golongan
                                            ORDER BY pegawai.nama_pegawai ASC");
                                            $no = 1;

                                            while ($d = mysqli_fetch_array($sql)) {
                                                echo "
                            <tr>
                                <td align='center'>$no</td>
                                <td>$d[nip]</td>
                                <td>$d[nama_pegawai]</td>
                                <td>$d[nama_jabatan]</td>
                                <td>$d[nama_golongan]</td>
                                <td>$d[statuses]</td>
                                <td>$d[jumlah_anak]</td>
                                <td><a class='btn btn-warning btn-sm' href ='data_pegawai.php?view=edit&id=$d[nip]'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href ='aksi_pegawai.php?act=del&id=$d[nip]'>Delete</a>
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
                                    <form action="aksi_pegawai.php?act=insert" method="POST">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">NIP</label>
                                            <input type="number" class="form-control" name="nip" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nama Pegawai</label>
                                            <input type="text" class="form-control" name="namapegawai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Jabatan</label>
                                            <select name="jabatan" class="form-control">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                $sqljabatan = mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                                                while ($j = mysqli_fetch_array($sqljabatan)) {
                                                    echo "<option value='$j[kode_jabatan]'>$j[kode_jabatan] - $j[nama_jabatan]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Golongan</label>
                                            <select name="golongan" class="form-control">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                $sqljabatan = mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                                                while ($j = mysqli_fetch_array($sqljabatan)) {
                                                    echo "<option value='$j[kode_golongan]'>$j[kode_golongan] - $j[nama_golongan]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Status</label>
                                            <select name="status" id="status" class="form-control" onChange="autoAnak()">
                                                <option value="">--Pilih--</option>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Jumlah Anak</label>
                                            <input type="number" class="form-control" name="jumlahanak" id="jumlahanak">
                                        </div>

                                        <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
                                        <a href="data_pegawai.php" class="btn btn-danger btn-sm">Batal</a>
                                    </form>

                                    <script type="text/javascript">
                                        function autoAnak() {
                                            var status = $('#status').val();
                                            if (status == 'Belum Menikah') {
                                                $('#jumlahanak').val(0);
                                                $('#jumlahanak').prop('readonly', true);
                                            } else {
                                                $('#jumlahanak').val();
                                                $('#jumlahanak').prop('readonly', false);
                                            }
                                        }
                                    </script>

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
        $sqlEdit = mysqli_query($konek, "SELECT * FROM pegawai WHERE nip = '$_GET[id]'");
        $e = mysqli_fetch_array($sqlEdit);
        // var_dump($e);
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
                                    <form action="aksi_pegawai.php?act=update" method="POST">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">NIP</label>
                                            <input type="number" class="form-control" name="nip" value="<?php echo $e['nip']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nama Pegawai</label>
                                            <input type="text" class="form-control" name="namapegawai" value="<?php echo $e['nama_pegawai']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Jabatan</label>
                                            <select name="jabatan" class="form-control">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                $sqljabatan = mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                                                while ($j = mysqli_fetch_array($sqljabatan)) {

                                                    $selected = ($j['kode_jabatan'] == $e['kode_jabatan']) ? 'selected="selected"' : "";

                                                    echo "<option value='$j[kode_jabatan]' $selected>$j[kode_jabatan] - $j[nama_jabatan]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Golongan</label>
                                            <select name="golongan" class="form-control">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                $sqljabatan = mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                                                while ($j = mysqli_fetch_array($sqljabatan)) {

                                                    $selected = ($j['kode_golongan'] == $e['kode_golongan']) ? 'selected="selected"' : "";

                                                    echo "<option value='$j[kode_golongan]' $selected>$j[kode_golongan] - $j[nama_golongan]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Status</label>
                                            <select name="status" class="form-control" id="status" onChange="autoAnak()">
                                                <option value="<?php echo $e['statuses']; ?>" selected><?php echo $e['statuses']; ?></option>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Jumlah Anak</label>
                                            <input type="number" class="form-control" name="jumlahanak" id="jumlahanak" value="<?php echo $e['jumlah_anak']; ?>">
                                        </div>

                                        <input type="submit" class="btn btn-primary btn-sm" value="update data">
                                        <a href="data_pegawai.php" class="btn btn-danger btn-sm">Batal</a>
                                    </form>

                                    <script type="text/javascript">
                                        function autoAnak() {
                                            var status = $('#status').val();
                                            if (status == 'Belum Menikah') {
                                                $('#jumlahanak').val(0);
                                                $('#jumlahanak').prop('readonly', true);
                                            } else {
                                                $('#jumlahanak').val();
                                                $('#jumlahanak').prop('readonly', false);
                                            }
                                        }
                                    </script>

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