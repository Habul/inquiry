<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Intisera | Sign Up</title>
	<link rel='icon' href="<?php echo base_url(); ?>gambar/website/Untitled-1-02.png" type="image/gif">
	<link rel="stylesheet" type="text/css"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/login.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="hold-transition login-page">
	<div class="wrapper">
		<div class="logo">
			<img src="<?php echo base_url() . 'gambar/website/Untitled-1-02.png' ?>">
		</div>
		<div class="text-center mt-4 name">INTISERA</div>
		<form class="p-3 mt-3" action="<?php echo base_url() . 'login/register_proses' ?>"
			onsubmit="regbtn.disabled = true; return true;" id="loginform" method="post">
			<div class="form-field d-flex align-items-center"><span class="fas fa-user-tie"></span>
				<input type="text" name="nama" placeholder="Full Name.." value="<?= set_value('name'); ?>" autofocus
					required>
			</div>
			<div class=" form-field d-flex align-items-center"><span class="fas fa-user"></span>
				<input type="text" name="username" placeholder="Username.." value="<?= set_value('username'); ?>" required>
			</div>
			<div class="form-field d-flex align-items-center"><span class="fas fa-envelope"></span>
				<input type="email" name="email" placeholder="Email.." value="<?= set_value('email'); ?>" required>
			</div>
			<div class="form-field d-flex align-items-center"><span toggle="#password-field"
					class="fas fa-fw fa-lock field-icon toggle-password"></span>
				<input type="password" name="password" id="password-field" placeholder="Password.." required>
			</div>
			<div class="form-field d-flex align-items-center"><span toggle="#password-field2"
					class="fas fa-fw fa-lock field-icon toggle-password2"></span>
				<input type="password" name="password2" id="password-field2" placeholder="Retype Password.." required>
			</div>
			<div class="g-recaptcha"
				style="transform:scale(0.50);-webkit-transform:scale(0.85);transform-origin:0 0;-webkit-transform-origin:0 0;"
				data-sitekey="<?php echo $this->config->item('google_key') ?>">
			</div>
			<button class="btn mt-1" type="submit" id="regbtn">Register</button>
		</form>
		<div class="text-center fs-6">Already registered? <a href="<?php echo base_url() . 'login' ?>">Sign
				in</a>
		</div>
	</div>
	<?php
    if (isset($_GET['alert'])) {
       if ($_GET['alert'] == "registered") {
        echo "<div class='alert font-weight-bold text-center'><i class='icon fas fa-bell'></i> User berhasil di tambah</div>";
      } else if ($_GET['alert'] == "not_registered") {
        echo "<div class='alert font-weight-bold text-center'><i class='icon fas fa-exclamation-triangle'></i> User gagal di tambah!</div>";
      }
    }
    ?>
	</div>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
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
