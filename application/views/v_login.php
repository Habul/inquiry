<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Intisera | Log in</title>
  <link rel='icon' href="<?php echo base_url(); ?>gambar/website/Untitled-1-02.png" type="image/gif">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <style>
    .login-page {
      background-image: url('http://it.intisera.com/gambar/website/IMG_1479.jpg');
      background-color: #cccccc;
      height: 500px;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }
    .special-card {
  background-color: rgba(245, 245, 245, 0.5);
}
  </style>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
</head>

<body class="hold-transition login-page text-sm">
  <div class="login-box">
    <div class="card card-transparent">
      <div class="card-body">
        <div class="login-logo">
          <a href="#"><img src="<?php echo base_url() . 'gambar/website/Intisera2.png' ?>" style="width:250px;height:110px;"></a>
        </div>
        <form action="<?php echo base_url() . 'login/proses' ?>" onsubmit="logbtn.disabled = true; return true;" id="loginform" method="post">
          <div class="input-group mb-3">            
            <input type="text" class="form-control" placeholder="Username" id="username" name="username" required="" oninvalid="this.setCustomValidity('Field username belum diisi')" oninput="setCustomValidity('')" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user">&nbsp;</span>
              </div>
            </div>
          </div>
          <?php echo form_error('username'); ?>
          <div class="input-group mb-3">
            <input id="password-field" type="password" class="form-control" name="password" placeholder="Password" required="" oninvalid="this.setCustomValidity('Field Password belum diisi')" oninput="setCustomValidity('')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span toggle="#password-field" class="fa fa-fw fa-lock field-icon toggle-password"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('password'); ?>          
          <div class="row">
            <div class="col-12">
              <button type="submit" id="logbtn" class="btn btn-primary btn-block">Login</button>
            </div>            
          </div>
        </form>
        <p class="d-block text-center mt-2 mb-0">Not registered? <a href="<?php echo base_url() . 'login/register' ?>"><u>Register Now!</u></a></p>
      </div>
    </div>
    <br />
    <?php
    if (isset($_GET['alert'])) {
      if ($_GET['alert'] == "gagal") {
        echo "<div class='alert alert-warning font-weight-bold text-center'><i class='icon fas fa-exclamation-triangle'></i>Login Gagal!</div>";
      } else if ($_GET['alert'] == "belum_login") {
        echo "<div class='alert alert-danger font-weight-bold text-center'><i class='icon fas fa-ban'></i>Anda Harus Login Terlebih Dulu!</div>";
      } else if ($_GET['alert'] == "logout") {
        echo "<div class='alert alert-success font-weight-bold text-center'><i class='icon fas fa-bell'></i>Anda Telah Logout!</div>";
      } else if ($_GET['alert'] == "registered") {
        echo "<div class='alert alert-success font-weight-bold text-center'><i class='icon fas fa-bell'></i>User berhasil di tambah</div>";
      }
    }
    ?>
  </div>
  <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".toggle-password").click(function() {
        $(this).toggleClass("fa-lock fa-lock-open");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    });
  </script>
</body>

</html>