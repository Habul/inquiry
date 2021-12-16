<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Intisera | Log in</title>
  <link rel='icon' href="<?php echo base_url(); ?>assets/logo/PNG-LOGO.gif" type="image/gif">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <style>
  .login-page {
  background-image: url('http://it.intisera.com/gambar/website/IMG_1479.jpg') ;
  background-color: #cccccc;
  height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
  }
  </style>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
</head>

<body class="hold-transition login-page text-sm">
  <div class="login-box">
    <div class="card shadow-lg">
      <div class="card-body">
      <div class="login-logo">
        <a href="#"><img src="<?php echo base_url() . 'gambar/website/Intisera2.png' ?>" style="width:250px;height:110px;"></a>
      </div>
        <form action="<?php echo base_url() . 'login/aksi' ?>" id="loginform" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" id="username" name="username" required>
            <div class="input-group-append">
              <div class="input-group-text">                
                <span class="fas fa-user">&nbsp;</span>
              </div>
            </div>
          </div>
          <?php echo form_error('username'); ?>
          <div class="input-group mb-3">
            <input id="password-field" type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span toggle="#password-field" class="fa fa-fw fa-lock field-icon toggle-password"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('password'); ?>
          <div class="row">
            <div class="col-12">
              <button type="submit" id="loginbtn" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <br />
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
  <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#loginbtn").click(function() {
        $('#loginbtn').text('Sign in...');
        $("#loginbtn").attr("disabled", true);
        $('#loginform').submit();
      });
    });

    $(".toggle-password").click(function() {
      $(this).toggleClass("fa-lock fa-lock-open");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  </script>
  <script>
    $(function() {
      $.validator.setDefaults({
        submitHandler: function() {
          alert("Form successful submitted!");
        }
      });
      $('#loginform').validate({
        rules: {
          text: {
            required: true,
            text: true,
          },
          password: {
            required: true,
            minlength: 5
          },
        },
        messages: {
          text: {
            required: "Please enter a email address",
            text: "Please enter a valid email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>
</body>

</html>