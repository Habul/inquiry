<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Intisera | Dashboard</title>
	<link rel='icon' href="<?php echo base_url(); ?>assets/logo/PNG-LOGO.gif" type="image/gif">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="<?php echo base_url() . 'dashboard' ?>" class="nav-link">Home</a>
				</li>
			</ul>

			<ul class="navbar-nav ml-auto">
				<!-- Notifications Dropdown Menu -->
				<li class="nav-item dropdown">
					<?php if ($this->session->userdata('level') != "sales") {	?>
						<?php
						$this->load->model('m_data');
						$jml_inquiry = $this->m_data->total_inquiry();
						$jml_buffer = $this->m_data->total_buffer();
						$total = $jml_inquiry + $jml_buffer;  ?>
						<a class="nav-link" data-toggle="dropdown" href="#">
							<i class="far fa-bell"></i>
							<span class="badge badge-warning navbar-badge"><?= $total; ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<span class="dropdown-item dropdown-header">You have notifications</span>
							<div class="dropdown-divider"></div>
							<a href="<?php echo base_url('inquiry/inquiry') ?>" class="dropdown-item">
								<i class="fas fa-file mr-2"></i> You have <?= $jml_inquiry; ?> Inquiry
							</a>
							<div class="dropdown-divider"></div>
							<a href="<?php echo base_url('buffer/buffer') ?>" class="dropdown-item">
								<i class="fas fa-file mr-2"></i> You have <?= $jml_buffer; ?> Buffer
							</a>
						</div>
				</li>
			<?php } ?>
			<li class="nav-item">
				<a class="nav-link" data-widget="fullscreen" href="#" role="button">
					<i class="fas fa-expand-arrows-alt"></i>
				</a>
			</li>
			</ul>
		</nav>
		<!-- /.navbar -->
		<!-- Main Sidebar Container -->

		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="#" class="brand-link">
				<img src="<?php echo base_url(); ?>assets/logo/PNG-LOGO.gif" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">INTISERA</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<?php $id_user = $this->session->userdata('id');
						$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row(); ?>
						<img src="<?php echo base_url() . '/gambar/profile/' . $user->foto; ?>" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="<?php echo base_url() . 'dashboard/profil' ?>" class="d-block"><?php echo $user->pengguna_nama; ?></a>
					</div>
				</div>

				<!-- SidebarSearch Form -->
				<div class="form-inline">
					<div class="input-group" data-widget="sidebar-search">
						<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
						<div class="input-group-append">
							<button class="btn btn-sidebar">
								<i class="fas fa-search fa-fw"></i>
							</button>
						</div>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?php echo base_url() . 'dashboard' ?>" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<?php
						if ($this->session->userdata('level') == "admin") {
						?>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/kategori' ?>" class="nav-link">
									<i class="nav-icon fas fa-th"></i>
									<p>Kategori</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/artikel' ?>" class="nav-link">
									<i class="nav-icon fas fa-copy"></i>
									<p>Artikel</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/pages' ?>" class="nav-link">
									<i class="nav-icon fas fa-copy"></i>
									<p>Pages</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/pengguna' ?>" class="nav-link">
									<i class="nav-icon fas fa-copy"></i>
									<p>Pengguna & Hak Akses</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/pengaturan' ?>" class="nav-link">
									<i class="nav-icon fas fa-copy"></i>
									<p>Pengaturan Website</p>
								</a>
							</li>
						<?php
						}
						?>
						<?php
						if ($this->session->userdata('level') != "warehouse") { ?>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Inquiry
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<?php
								if ($this->session->userdata('level') != "sales") { ?>
									<ul class="nav nav-treeview">
										<li class="nav-item">
											<a href="<?php echo base_url() . 'inquiry/inquiry_master' ?>" class="nav-link active">
												<i class="far fa-circle nav-icon"></i>
												<p>Master Inquiry</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url() . 'inquiry/inquiry_kurs' ?>" class="nav-link">
												<i class="far fa-circle nav-icon"></i>
												<p>Kurs Inquiry</p>
											</a>
										</li>
									<?php } ?>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'inquiry/inquiry' ?>" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>Input Inquiry</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'inquiry/inquiry_view' ?>" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>View Inquiry</p>
										</a>
									</li>
									</ul>
							</li>
						<?php } ?>
						<?php
						if ($this->session->userdata('level') != "purchase") { ?>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Buffer
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?php echo base_url() . 'buffer/buffer' ?>" class="nav-link active">
											<i class="far fa-circle nav-icon"></i>
											<p>Input Buffer</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'buffer/buffer_view' ?>" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>View Buffer</p>
										</a>
									</li>
								<?php } ?>
								</ul>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/ganti_password' ?>" class="nav-link">
									<i class="nav-icon fas fa-copy"></i>
									<p>Ganti Password</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/keluar' ?>" class="nav-link">
									<i class="nav-icon fas fa-share"></i>
									<p>Keluar</p>
								</a>
							</li>
			</div>
		</aside>