<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Intisera | Register</title>
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

	</style>
	<link rel="stylesheet" type="text/css"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="hold-transition login-page text-sm">
	<div class="login-box">
		<div class="card card-info card-outline">
			<div class="card-body">
				<div class="login-logo">
					<a href="#"><img src="<?php echo base_url() . 'gambar/website/Intisera2.png' ?>"
							style="width:250px;height:110px;"></a>
				</div>
				<form onsubmit="regbtn.disabled = true; return true;"
					action="<?php echo base_url('login/register_proses') ?>" method="post">
					<div class="input-group mb-2">
						<input type="text" name="nama" class="form-control" placeholder="Full name"
							value="<?= set_value('nama'); ?>" required autofocus>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user-tie"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-2">
						<input type="text" name="username" class="form-control" placeholder="Username"
							value="<?= set_value('username'); ?>" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-2">
						<input type="email" name="email" class="form-control" placeholder="Email"
							value="<?= set_value('email'); ?>" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-2">
						<input type="password" id="password-field" name="password" class="form-control" placeholder="Password"
							required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span toggle="#password-field" class="fa fa-fw fa-lock field-icon toggle-password"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" id="password-field2" name="password2" class="form-control"
							placeholder="Retype password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span toggle2="#password-field2" class="fa fa-fw fa-lock field-icon toggle-password2"></span>
							</div>
						</div>
					</div>
					<div class="g-recaptcha col-md-12" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
					<br />
					<div class="row">
						<div class="col-12">
							<button type="submit" id="regbtn" class="btn btn-primary btn-block">Register</button>
						</div>
					</div>
				</form>
				<p class="d-block text-center mt-2 mb-0">Already registered? <a
						href="<?php echo base_url() . 'login' ?>"><u>Sign In</u></a></p>
			</div>
		</div>
		<br />
		<?php
    if (isset($_GET['alert'])) {
       if ($_GET['alert'] == "registered") {
        echo "<div class='alert alert-success font-weight-bold text-center'><i class='icon fas fa-bell'></i>User berhasil di tambah</div>";
      } else if ($_GET['alert'] == "not_registered") {
        echo "<div class='alert alert-warning font-weight-bold text-center'><i class='icon fas fa-bell'></i>User gagal di tambah!</div>";
      }
    }
    ?>
	</div>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
	<script>
		$(document).ready(function () {
			$(".toggle-password").click(function () {
				$(this).toggleClass("fa-lock fa-lock-open");
				var input = $($(this).attr("toggle"));
				if (input.attr("type") == "password") {
					input.attr("type", "text");
				} else {
					input.attr("type", "password");
				}
			});

			$(".toggle-password2").click(function () {
				$(this).toggleClass("fa-lock fa-lock-open");
				var input = $($(this).attr("toggle2"));
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
