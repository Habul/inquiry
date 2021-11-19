<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intisera | Home</title>
	<link rel='icon' href="<?php echo base_url(); ?>gambar/website/Untitled-1-02.png" type="image/gif">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Bootstrap Color Picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Bootstrap4 Duallistbox -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
	<!-- BS Stepper -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bs-stepper/css/bs-stepper.min.css">
	<!-- dropzonejs -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dropzone/min/dropzone.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="<?php echo base_url() . 'dashboard' ?>" class="nav-link">Home</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="<?php echo base_url() . 'dashboard/profil' ?>" class="nav-link">Profile</a>
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
								<i class="fas fa-book"></i> You have <?= $jml_inquiry; ?> Inquiry
							</a>
							<div class="dropdown-divider"></div>
							<a href="<?php echo base_url('buffer/buffer') ?>" class="dropdown-item">
								<i class="fas fa-database"></i> You have <?= $jml_buffer; ?> Buffer
							</a>
						</div>
				</li>
			<?php } ?>
			<li class="nav-item">
				<a class="nav-link" data-widget="fullscreen" href="#" role="button">
					<i class="fas fa-expand-arrows-alt"></i>
				</a>
			</li>

			<li class="nav-item dropdown user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<?php $id_user = $this->session->userdata('id');
					$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row(); ?>
					<img src="<?php echo base_url() . 'gambar/profile/' . $user->foto; ?>" class="user-image img-circle elevation-2" alt="User Image">
					<span class="d-none d-md-inline"><?php echo $user->pengguna_nama; ?></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<!-- User image -->
					<li class="user-header bg-dark">
						<img src="<?php echo base_url() . 'gambar/profile/' . $user->foto; ?>" class="img-circle elevation-2" alt="User Image">
						<p>
							<?php echo $user->pengguna_nama; ?>
							<small><?php echo $user->pengguna_level; ?></small>
						</p>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
						<a href="<?php echo base_url() . 'dashboard/profil' ?>" class="btn btn-default" title="Profile"><i class="fa fa-user"></i> </a>
						<a href="<?php echo base_url() . 'dashboard/keluar' ?>" class="btn btn-danger float-right" title="Sign out"><i class="fa fa-power-off"></i> </a>
					</li>

				</ul>
			</li>
			</ul>
		</nav>
		<!-- /.navbar -->
		<!-- Main Sidebar Container -->

		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="#" class="brand-link">
				<img src="<?php echo base_url(); ?>gambar/website/Untitled-1-02.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-green">INTISERA</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<?php $id_user = $this->session->userdata('id');
						$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row(); ?>
						<img src="<?php echo base_url() . 'gambar/profile/' . $user->foto; ?>" class="img-circle elevation-2" alt="User Image">
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
					<ul class="nav nav-pills nav-sidebar nav-child-indent nav-compact flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?php echo base_url() . 'dashboard' ?>" <?= $this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
								<i class="nav-icon fas fa-home"></i>
								<p>Home</p>
							</a>
						</li>
						<?php
						if ($this->session->userdata('level') == "admin") {
						?>
							<!--li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/kategori' ?>" <?= $this->uri->uri_string() == 'dashboard/kategori' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-th"></i>
									<p>Category</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/artikel' ?>" <?= $this->uri->uri_string() == 'dashboard/artikel' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-table"></i>
									<p>Article</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/pengaturan' ?>" <?= $this->uri->uri_string() == 'dashboard/pengaturan' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-cogs"></i>
									<p>Setting Website</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/pages' ?>" <?= $this->uri->uri_string() == 'dashboard/pages' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-tags"></i>
									<p>Pages</p>
								</a>
							</li--->
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/pengguna' ?>" <?= $this->uri->uri_string() == 'dashboard/pengguna' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-users"></i>
									<p>User & User Access</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'it/data' ?>" <?= $this->uri->uri_string() == 'it/data' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-server"></i>
									<p>Data Penting</p>
								</a>
							</li>
							<li <?= $this->uri->uri_string() == 'sj/sj' ||
									$this->uri->uri_string() == 'sj/sj_df' ||
									$this->uri->uri_string() == '' ? 'class="nav-item menu-open"' : 'class="nav-item"' ?>>
								<a href="#" <?= $this->uri->uri_string() == 'sj/sj' ||
												$this->uri->uri_string() == 'sj/sj_df' ||
												$this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-edit"></i>
									<p>Surat Jalan
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?php echo base_url() . 'sj/sj' ?>" <?= $this->uri->uri_string() == 'sj/sj' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="far fa-circle nav-icon"></i>
											<p>SJ Hs</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'sj/sj_df' ?>" <?= $this->uri->uri_string() == 'sj/sj_df' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="far fa-circle nav-icon"></i>
											<p>SJ Df</p>
										</a>
									</li>
								</ul>
							</li>
						<?php
						}
						?>
						<?php
						if ($this->session->userdata('level') != "warehouse") { ?>
							<li <?= $this->uri->uri_string() == 'inquiry/inquiry_master' ||
									$this->uri->uri_string() == 'inquiry/inquiry_kurs' ||
									$this->uri->uri_string() == 'inquiry/inquiry' ||
									$this->uri->uri_string() == 'inquiry/inquiry_view' || $this->uri->uri_string() == '' ? 'class="nav-item menu-open"' : 'class="nav-item"' ?>>
								<a href="#" <?= $this->uri->uri_string() == 'inquiry/inquiry_master' ||
												$this->uri->uri_string() == 'inquiry/inquiry_kurs' ||
												$this->uri->uri_string() == 'inquiry/inquiry' ||
												$this->uri->uri_string() == 'inquiry/inquiry_view' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-book"></i>
									<p>Inquiry
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<?php if ($this->session->userdata('level') != "sales") { ?>
										<li class="nav-item">
											<a href="<?php echo base_url() . 'inquiry/inquiry_master' ?>" <?= $this->uri->uri_string() == 'inquiry/inquiry_master' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
												<i class="far fa-circle nav-icon"></i>
												<p>Master Inquiry</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url() . 'inquiry/inquiry_kurs' ?>" <?= $this->uri->uri_string() == 'inquiry/inquiry_kurs' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
												<i class="far fa-circle nav-icon"></i>
												<p>Kurs Inquiry</p>
											</a>
										</li>
									<?php } ?>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'inquiry/inquiry' ?>" <?= $this->uri->uri_string() == 'inquiry/inquiry' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="far fa-circle nav-icon"></i>
											<p>Input Inquiry</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'inquiry/inquiry_view' ?>" <?= $this->uri->uri_string() == 'inquiry/inquiry_view' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="far fa-circle nav-icon"></i>
											<p>View Inquiry</p>
										</a>
									</li>
								</ul>
							</li>
						<?php } ?>
						<?php
						if ($this->session->userdata('level') != "purchase") { ?>
							<li <?= $this->uri->uri_string() == 'buffer/buffer' ||
									$this->uri->uri_string() == 'buffer/buffer_view' ||
									$this->uri->uri_string() == '' ? 'class="nav-item menu-open"' : 'class="nav-item"' ?>>
								<a href="#" <?= $this->uri->uri_string() == 'buffer/buffer' ||
												$this->uri->uri_string() == 'buffer/buffer_view' ||
												$this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-database"></i>
									<p>Buffer
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?php echo base_url() . 'buffer/buffer' ?>" <?= $this->uri->uri_string() == 'buffer/buffer' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="far fa-circle nav-icon"></i>
											<p>Input Buffer</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'buffer/buffer_view' ?>" <?= $this->uri->uri_string() == 'buffer/buffer_view' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="far fa-circle nav-icon"></i>
											<p>View Buffer</p>
										</a>
									</li>
								</ul>
							</li>
						<?php } ?>
						<li <?= $this->uri->uri_string() == 'tracking/data' ||
									$this->uri->uri_string() == 'tracking/view' ||
									$this->uri->uri_string() == '' ? 'class="nav-item menu-open"' : 'class="nav-item"' ?>>
								<a href="#" <?= $this->uri->uri_string() == 'tracking/data' ||
												$this->uri->uri_string() == 'tracking/view' ||
												$this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-truck"></i>
									<p>Tracking
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?php echo base_url() . 'tracking/data' ?>" <?= $this->uri->uri_string() == 'tracking/data' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="far fa-circle nav-icon"></i>
											<p>Input Tracking</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'tracking/view' ?>" <?= $this->uri->uri_string() == 'tracking/view' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="far fa-circle nav-icon"></i>
											<p>View Tracking</p>
										</a>
									</li>
								</ul>
							</li>
						<li class="nav-item">
							<a href="<?php echo base_url() . 'dashboard/contact' ?>" <?= $this->uri->uri_string() == 'dashboard/contact' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
								<i class="nav-icon fas fa-rss-square"></i>
								<p>Contact</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url() . 'dashboard/keluar' ?>" <?= $this->uri->uri_string() == 'dashboard/keluar' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
								<i class="nav-icon fas fa-power-off"></i>
								<p>Sign out</p>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</aside>