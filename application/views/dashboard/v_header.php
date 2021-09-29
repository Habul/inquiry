<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Intisera | Dashboard</title>
	<link rel='icon' href="<?php echo base_url(); ?>assets/logo/PNG-LOGO.gif" type="image/gif">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<script src="<?php echo base_url(); ?>assets/libs/modernizr.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!--script src="<?php echo base_url(); ?>assets/js/ajax.js"></script!-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="<?php echo base_url() . 'dashboard' ?>" class="logo">
				<span class="logo-mini"><b>IG</b></span>
				<span class="logo-lg"><b>Intisera </b>Group</span>
			</a>

			<nav class="navbar navbar-static-top">

				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<?php if ($this->session->userdata('level') != "sales") {	?>
							<?php
							$this->load->model('m_data');
							$jml_null = $this->m_data->total_rows(); ?>
							<!-- Notifications: style can be found in dropdown.less -->
							<li class="dropdown notifications-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-bell-o"></i>
									<span class="label label-warning"><?= $jml_null; ?></span>
								</a>
								<ul class="dropdown-menu">
									<li class="header">You have notifications</li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											<li>
												<a href="<?php echo base_url('dashboard/inquiry') ?>">
													<i class="fa fa-warning text-yellow"></i>
													You have <?= $jml_null; ?> Inquiry
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						<?php } ?>
						<!-- Tasks: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<?php $id_user = $this->session->userdata('id');
							$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row(); ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url() . '/gambar/profile/' . $user->foto; ?>" class="user-image" alt="User Image">
								<span class="hidden-xs"><b><?php echo $this->session->userdata('username') ?></b></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="<?php echo base_url() . '/gambar/profile/' . $user->foto; ?>" class="img-circle" alt="User Image">
									<p>
										<?php echo $this->session->userdata('username') ?>
										<small><?php echo $this->session->userdata('level') ?></small>
									</p>
								</li>
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url() . 'dashboard/profil' ?>" class="btn btn-default btn-flat">Profil</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url() . 'dashboard/keluar' ?>" class="btn btn-default btn-flat">Keluar</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<?php $id_user = $this->session->userdata('id');
						$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row(); ?>
						<img src="<?php echo base_url() . '/gambar/profile/' . $user->foto; ?>" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<?php
						$id_user = $this->session->userdata('id');
						$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
						?>
						<p><?php echo $user->pengguna_nama; ?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>

				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">LIST MENU</li>
					<li>
						<a href="<?php echo base_url() . 'dashboard' ?>">
							<i class="fa fa-dashboard"></i>
							<span>DASHBOARD</span>
						</a>
					</li>
					<?php
					if ($this->session->userdata('level') == "admin") {
					?>
						<li>
							<a href="<?php echo base_url() . 'dashboard/kategori' ?>">
								<i class="fa fa-th"></i>
								<span>KATEGORI</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url() . 'dashboard/artikel' ?>">
								<i class="fa fa-pencil"></i>
								<span>ARTIKEL</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url() . 'dashboard/pages' ?>">
								<i class="fa fa-files-o"></i>
								<span>PAGES</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url() . 'dashboard/pengguna' ?>">
								<i class="fa fa-users"></i>
								<span>PENGGUNA & HAK AKSES</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url() . 'dashboard/pengaturan' ?>">
								<i class="fa fa-edit"></i>
								<span>PENGATURAN WEBSITE</span>
							</a>
						</li>
					<?php
					}
					?>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-book"></i>
							<span>INQUIRY</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<?php
							if ($this->session->userdata('level') != "sales") { ?>
								<li><a href="<?php echo base_url() . 'inquiry/inquiry_master' ?>">
										<i class="fa fa-file-text"></i>
										<span>MASTER INQUIRY </span></a>
								</li>
								<li><a href="<?php echo base_url() . 'inquiry/inquiry_kurs' ?>">
										<i class="fa fa-money"></i>
										<span>KURS INQUIRY</span></a>
								</li>
							<?php
							} ?>
							<li><a href="<?php echo base_url() . 'inquiry/inquiry' ?>">
									<i class="fa fa-sticky-note-o"></i>
									<span>INPUT INQUIRY</span></a>
							</li>
							<li><a href="<?php echo base_url() . 'inquiry/inquiry_view' ?>">
									<i class="fa fa-sticky-note"></i>
									<span>VIEW INQUIRY</span></a>
							</li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-database"></i>
							<span>BUFFER</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url() . 'buffer/buffer' ?>">
									<i class="fa fa-file-o"></i>
									<span>INPUT BUFFER</span></a>
							</li>
							<li><a href="<?php echo base_url() . 'buffer/buffer_view' ?>">
									<i class="fa fa-file"></i>
									<span>VIEW BUFFER</span></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url() . 'dashboard/ganti_password' ?>">
							<i class="fa fa-lock"></i>
							<span>GANTI PASSWORD</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url() . 'dashboard/keluar' ?>">
							<i class="fa fa-share"></i>
							<span>KELUAR</span>
						</a>
					</li>
				</ul>
			</section>
		</aside>