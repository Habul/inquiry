<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Intisera | Log in</title>
  <link rel='icon' href="<?php echo base_url(); ?>assets/logo/PNG-LOGO.gif" type="image/gif">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><img src="<?php echo base_url().'gambar/website/Intisera2.png'?>" style="width:250px;height:110px;">
    </div>
     <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"><b>Log Into Your Account</b></p>
        <form action="<?php echo base_url() . 'login/aksi' ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <?php echo form_error('username'); ?>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <?php echo form_error('password'); ?>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <label>
                  <a type="button" href="<?php echo base_url(); ?>">Back</a>
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <br/>
     <?php
    if (isset($_GET['alert'])) {
      if ($_GET['alert'] == "gagal") {
        echo "<div class='alert alert-danger font-weight-bold text-center'>Maaf! Username & Password Salah.</div>";
      } else if ($_GET['alert'] == "belum_login") {
        echo "<div class='alert alert-danger font-weight-bold text-center'>Anda Harus Login Terlebih Dulu!</div>";
      } else if ($_GET['alert'] == "logout") {
        echo "<div class='alert alert-success font-weight-bold text-center'>Anda Telah Logout!</div>";
      }
    }
    ?>
  </div>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
</body>

</html>