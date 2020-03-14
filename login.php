<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <!-- <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>HRIS</b>-V2</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $user = $_POST['username'];
          $pass = $_POST['password'];
          $p = md5($pass);

          if ($user == '' || $pass == '') {
        ?>      
            <div class="swalDefaultWarning"></div>

            <?php
          } else {
            include "koneksi.php";
            $sqllogin = mysqli_query($konek, "SELECT * FROM users WHERE username = '$user' AND password = '$p'");
            $d = mysqli_fetch_array($sqllogin);
            $jml = mysqli_num_rows($sqllogin);
            
            // var_dump($sqllogin);
            if ($jml > 0) {
              
              $_SESSION['login']              = TRUE;
              $_SESSION['id']                 = $d['idadmin'];
              $_SESSION['username']           = $d['username'];
              $_SESSION['namalengkap']        = $d['namalengkap'];
              $_SESSION['isadmin']            = $d['isadmin'];

              header('Location:./index.php');
            } else {
            ?>
              <div class="swalDefaultError"></div>

        <?php
            }
          }
        }
        ?>
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" />
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" value="Login">
                Login
              </button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <a href="#" class="btn btn-block btn-warning">
            Lupa kata sandi
          </a>
        </div>
        <!-- /.social-auth-links -->
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- toastr -->
  <!-- <script src="assets/plugins/toastr/toastr.min.js"></script> -->
  <!--  -->
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>

  <script type="text/javascript">
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
      });

      $('.swalDefaultSuccess').click(function() {
        Toast.fire({
          type: 'success',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultInfo').click(function() {
        Toast.fire({
          type: 'info',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultError').click(function() {
        Toast.fire({
          type: 'error',
          title: 'Username dan Password yang anda masukan salah.'
        })
      });
      $('.swalDefaultWarning').click(function() {
        Toast.fire({
          type: 'warning',
          title: 'Mohon untuk mengisikan Username dan Password !.'
        })
      });
      $('.swalDefaultQuestion').click(function() {
        Toast.fire({
          type: 'question',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
    });
  </script>
</body>

</html>