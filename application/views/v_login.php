<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Intisera | Sign In</title>
	<meta name="google-site-verification" content="XukADsKnLYYBm8vIp5j4KR4kLOcG-V7iP4DPqS7cSkM" />
	<link rel='icon' href="<?php echo base_url(); ?>gambar/website/Untitled-1-02.png" type="image/gif">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/login.css">
</head>

<body>
	<div class="wrapper">
		<div class="logo">
			<img src="<?php echo base_url() . 'gambar/website/Untitled-1-02.png' ?>">
		</div>
		<div class="text-center mt-4 name">INTISERA</div>
		<form class="p-3 mt-3" action="<?php echo base_url() . 'login/proses' ?>" onsubmit="logbtn.disabled = true; return true;" id="loginform" method="post">
			<div class="form-field d-flex align-items-center"><span class="fas fa-user"></span>
				<input type="text" name="username" placeholder="Username.." autofocus required>
			</div>
			<div class="form-field d-flex align-items-center"><span toggle="#password-field" class="fas fa-fw fa-lock field-icon toggle-password"></span>
				<input type="password" name="password" id="password-field" placeholder="Password.." required>
			</div>
			<button class="btn mt-3" type="submit" id="logbtn">Sign in</button>
		</form>
		<div class="text-center fs-6">Not registered?<a href="<?php echo base_url() . 'login/register' ?>"> Sign up</a>
		</div>
		<?php
		if (isset($_GET['alert'])) {
			if ($_GET['alert'] == "gagal") {
				echo "<div class='alert font-weight-bold text-center mt-2'><i class='icon fas fa-exclamation-triangle'></i> Login Gagal!</div>";
			} else if ($_GET['alert'] == "belum_login") {
				echo "<div class='alert font-weight-bold text-center mt-2'><i class='icon fas fa-ban'></i> Anda Harus Login Terlebih Dulu!</div>";
			} else if ($_GET['alert'] == "logout") {
				echo "<div class='alert font-weight-bold text-center mt-2'><i class='icon fas fa-bell'></i> Anda Telah Logout!</div>";
			} else if ($_GET['alert'] == "registered") {
				echo "<div class='alert font-weight-bold text-center mt-2'><i class='icon fas fa-bell'></i> User berhasil di tambah</div>";
			}
		}
		?>
	</div>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
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