<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intisera | <?php echo $title; ?></title>
	<link rel='icon' href="<?php echo base_url(); ?>gambar/website/Untitled-1-02.png" type="image/gif">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ekko-lightbox/ekko-lightbox.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bs-stepper/css/bs-stepper.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dropzone/min/dropzone.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/docs.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/style_games.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
	<div class="wrapper">

		<nav class="main-header navbar navbar-expand navbar-light navbar-light">

			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="<?php echo base_url() . 'dashboard' ?>" <?= $this->uri->uri_string() == 'dashboard'
																							|| $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>Dashboard</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="<?php echo base_url() . 'dashboard/profil' ?>" <?= $this->uri->uri_string() == 'dashboard/profil'
																									|| $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>Profile</a>
				</li>
			</ul>

			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" data-widget="navbar-search" href="#" role="button">
						<i class="fas fa-search"></i>
					</a>
					<div class="navbar-search-block">
						<form class="form-inline">
							<div class="input-group input-group-sm">
								<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
								<div class="input-group-append">
									<button class="btn btn-navbar" type="submit">
										<i class="fas fa-search"></i>
									</button>
									<button class="btn btn-navbar" type="button" data-widget="navbar-search">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</li>

				<li class="nav-item dropdown">
					<?php if ($this->session->userdata('level') != "sales") {  ?>
						<?php if ($this->session->userdata('level') != "guest") {  ?>
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
		<?php } ?>
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
		<li class="nav-item">
			<div class="theme-switch-wrapper nav-link">
				<label class="theme-switch" for="checkbox">
					<input type="checkbox" id="checkbox" title="Dark Mode" />
					<span class="slider round"></span>
				</label>
			</div>
		</li>

		<li class="nav-item dropdown user-menu ">
			<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
				<img src="<?php echo base_url() . 'gambar/profile/' . $this->session->userdata('foto'); ?>" class="user-image img-circle elevation-2" alt="User Image">
				<span class="d-none d-md-inline"><?php echo $this->session->userdata('nama'); ?>&nbsp;<i class="fas fa-angle-down right"></i>
			</a>
			<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<li class="user-header">
					<img src="<?php echo base_url() . 'gambar/profile/' . $this->session->userdata('foto'); ?>" class="img-circle elevation-2" alt="User Image">
					<p>
						<?php echo $this->session->userdata('nama');  ?>
						<small><?php echo $this->session->userdata('level');  ?></small>
						<small id='hclock'><?php mdate('%Y-%m-%d %H:%i:%s') ?></small>
					</p>
				</li>
				<li class="user-footer">
					<a href="<?php echo base_url() . 'dashboard/profil' ?>" class="btn btn-default border-0" title="Profile"><i class="fas fa-user-tie"></i> Profile</a>
					<a data-toggle="modal" data-target="#logoutModal" class="btn btn-default float-right border-0" title="Sign out"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
				</li>
			</ul>
		</li>
			</ul>
		</nav>

		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<a href="#" class="brand-link">
				<img src="<?php echo base_url(); ?>gambar/website/Untitled-1-02.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-2">
				<span class="brand-text font-weight-green">INTISERA</span>
			</a>

			<div class="sidebar">
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?php echo base_url() . 'gambar/profile/' . $this->session->userdata('foto');  ?>" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="<?php echo base_url() . 'dashboard/profil' ?>" class="d-block"><?php echo $this->session->userdata('nama');  ?></a>
					</div>
				</div>

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

				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar nav-child-indent nav-compact flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?php echo base_url() . 'dashboard' ?>" <?= $this->uri->uri_string() == 'dashboard' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<?php if ($this->session->userdata('level') == "admin") { ?>
							<li class="nav-header">Administrator</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/pengguna' ?>" <?= $this->uri->uri_string() == 'dashboard/pengguna' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-users"></i>
									<p>User & User Access</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'it/data' ?>" <?= $this->uri->uri_string() == 'it/data' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-user-astronaut"></i>
									<?php $cek = $this->db->like('addtime', mdate('%Y-%m-%d'))->get('datapenting_it')->num_rows();  ?>
									<?php if ($cek != '') : ?>
										<span class="right badge badge-danger">New</span>
									<?php endif; ?>
									<p>Data Penting</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'sj/sj_df' ?>" <?= $this->uri->uri_string() == 'sj/sj_df' || $this->uri->segment(2) == 'sj_view_df' ||  $this->uri->segment(2) == 'sj_new' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-mail-bulk"></i>
									<?php $cek = $this->db->like('addtime', mdate('%Y-%m-%d'))->get('sj_user_df')->num_rows();  ?>
									<?php if ($cek != '') : ?>
										<span class="right badge badge-danger">New</span>
									<?php endif; ?>
									<p>Surat Jalan</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/workspace' ?>" <?= $this->uri->uri_string() == 'dashboard/workspace' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fas fa-columns"></i>
									<?php $cek = $this->db->like('addtime', mdate('%Y-%m-%d'))->get('workspace')->num_rows() ?>
									<?php if ($cek != '') : ?>
										<span class="right badge badge-danger">New</span>
									<?php endif; ?>
									<p>Workspace Board</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() . 'dashboard/license' ?>" <?= $this->uri->uri_string() == 'dashboard/license' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-fingerprint"></i>
									<?php $cek = $this->db->like('addtime', mdate('%Y-%m-%d'))->get('license')->num_rows() || $cek = $this->db->like('updtime', mdate('%Y-%m-%d'))->get('license')->num_rows() ?>
									<?php if ($cek != '') : ?>
										<span class="right badge badge-danger">New</span>
									<?php endif; ?>
									<p>License</p>
								</a>
							</li>
						<?php } ?>
						<?php if ($this->session->userdata('level') != "guest") {  ?>
							<?php if ($this->session->userdata('level') != "warehouse") { ?>
								<li class="nav-header">Users</li>
								<li class="nav-item">
									<a href="<?= base_url() . 'master_item/data' ?>" <?= $this->uri->uri_string() == 'master_item/data' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
										<i class="nav-icon fas fa-tools"></i>
										<?php $total = $this->db->where('status_it', '0')->where('status', '1')->get('master_item')->num_rows(); ?>
										<?php if ($total != 0) : ?>
											<span class="badge badge-info right"><?php echo $total; ?></span>
										<?php endif; ?>
										<p>Master Item</p>
									</a>
								</li>
								<li <?= $this->uri->uri_string() == 'inquiry/inquiry_master' ||
											$this->uri->uri_string() == 'inquiry/inquiry_kurs' ||
											$this->uri->segment(2) == 'inquiry' ||
											$this->uri->segment(2) == 'inquiry_update_prch' ||
											$this->uri->uri_string() == 'inquiry/inquiry_view' || $this->uri->uri_string() == '' ? 'class="nav-item menu-open"' : 'class="nav-item"' ?>>
									<a href="#" <?= $this->uri->uri_string() == 'inquiry/inquiry_master' ||
														$this->uri->uri_string() == 'inquiry/inquiry_kurs' ||
														$this->uri->segment(2) == 'inquiry' ||
														$this->uri->segment(2) == 'inquiry_update_prch' ||
														$this->uri->uri_string() == 'inquiry/inquiry_view' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
										<i class="nav-icon fas fa-book"></i>
										<?php $total = $this->db->where('fu1', NULL)->get('inquiry')->num_rows(); ?>
										<?php if ($total != 0) : ?>
											<span class="badge badge-info right"><?php echo $total; ?></span>
										<?php endif; ?>
										<p>Inquiry
											<i class="fas fa-angle-left right"></i>
										</p>
									</a>
									<ul class="nav nav-treeview">
										<?php if ($this->session->userdata('level') != "sales") { ?>
											<li class="nav-item">
												<a href="<?php echo base_url() . 'inquiry/inquiry_master' ?>" <?= $this->uri->uri_string() == 'inquiry/inquiry_master' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
													<i class="far fa-circle nav-icon"></i>
													<p>Master</p>
												</a>
											</li>
											<li class="nav-item">
												<a href="<?php echo base_url() . 'inquiry/inquiry_kurs' ?>" <?= $this->uri->uri_string() == 'inquiry/inquiry_kurs' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
													<i class="far fa-circle nav-icon"></i>
													<p>Kurs</p>
												</a>
											</li>
										<?php } ?>
										<li class="nav-item">
											<a href="<?php echo base_url() . 'inquiry/inquiry' ?>" <?= $this->uri->segment(2) == 'inquiry' || $this->uri->segment(2) == 'inquiry_update_prch' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
												<i class="far fa-circle nav-icon"></i>
												<?php if ($total != 0) : ?>
													<span class="badge badge-info right"><?php echo $total; ?></span>
												<?php endif; ?>
												<p>Inquiry</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url() . 'inquiry/inquiry_view' ?>" <?= $this->uri->uri_string() == 'inquiry/inquiry_view' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
												<i class="far fa-circle nav-icon"></i>
												<p>Arsip Inquiry</p>
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
										<?php $total = $this->db->where('fu', NULL)->get('buffer')->num_rows(); ?>
										<?php if ($total != 0) : ?>
											<span class="badge badge-info right"><?php echo $total; ?></span>
										<?php endif; ?>
										<p>Buffer
											<i class="fas fa-angle-left right"></i>
										</p>
									</a>
									<ul class="nav nav-treeview">
										<li class="nav-item">
											<a href="<?php echo base_url() . 'buffer/buffer' ?>" <?= $this->uri->uri_string() == 'buffer/buffer' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
												<i class="far fa-circle nav-icon"></i>
												<?php if ($total != 0) : ?>
													<span class="badge badge-info right"><?php echo $total; ?></span>
												<?php endif; ?>
												<p>Buffer</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url() . 'buffer/buffer_view' ?>" <?= $this->uri->uri_string() == 'buffer/buffer_view' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
												<i class="far fa-circle nav-icon"></i>
												<p>Arsip Buffer</p>
											</a>
										</li>
									</ul>
								</li>
							<?php } ?>
							<li <?= $this->uri->segment(2) == 'data_order' ||
										$this->uri->segment(2) == 'view' ||
										$this->uri->segment(2) == 'arsip' ||
										$this->uri->uri_string() == '' ? 'class="nav-item menu-open"' : 'class="nav-item"' ?>>
								<a href="#" <?= $this->uri->segment(2) == 'data_order' ||
													$this->uri->segment(2) == 'view' ||
													$this->uri->segment(2) == 'arsip' ||
													$this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-paper-plane"></i>
									<p>Order & Delivery
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?php echo base_url() . 'tracking/data_order' ?>" <?= $this->uri->segment(2) == 'data_order' || $this->uri->segment(2) == 'view' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="far fa-circle nav-icon"></i>
											<p>Order & Delivery</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'tracking/arsip' ?>" <?= $this->uri->segment(2) == 'arsip' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="far fa-circle nav-icon"></i>
											<p>Arsip Order & Delivery</p>
										</a>
									</li>
								</ul>
							</li>
							<li <?= $this->uri->segment(2) == 'mobil' ||
										$this->uri->segment(2) == 'mobil_odo' ||
										$this->uri->segment(2) == 'motor' ||
										$this->uri->segment(2) == 'motor_odo' ||
										$this->uri->segment(2) == 'truck' ||
										$this->uri->segment(2) == 'truck_odo' ||
										$this->uri->uri_string() == '' ? 'class="nav-item menu-open"' : 'class="nav-item"' ?>>
								<a href="#" <?= $this->uri->segment(2) == 'mobil' ||
													$this->uri->segment(2) == 'mobil_odo' ||
													$this->uri->segment(2) == 'motor' ||
													$this->uri->segment(2) == 'motor_odo' ||
													$this->uri->segment(2) == 'truck' ||
													$this->uri->segment(2) == 'truck_odo' ||
													$this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
									<i class="nav-icon fas fa-wrench"></i>
									<p>Tracking
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?php echo base_url() . 'driver/mobil' ?>" <?= $this->uri->segment(2) == 'mobil' ||
																													$this->uri->segment(2) == 'mobil_odo' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="fas fa-car-side nav-icon"></i>
											<p>Mobil</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'driver/motor' ?>" <?= $this->uri->segment(2) == 'motor' ||
																													$this->uri->segment(2) == 'motor_odo' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="fas fa-motorcycle nav-icon"></i>
											<p>Motor</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'driver/truck' ?>" <?= $this->uri->segment(2) == 'truck' ||
																													$this->uri->segment(2) == 'truck_odo' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
											<i class="fas fa-truck nav-icon"></i>
											<p>Truck</p>
										</a>
									</li>
								</ul>
							</li>
						<?php } ?>
						<li class="nav-item">
							<a href="<?php echo base_url() . 'dashboard/mini_games' ?>" <?= $this->uri->uri_string() == 'dashboard/mini_games' || $this->uri->uri_string() == 'dashboard/generate' || $this->uri->uri_string() == 'dashboard/generateQR' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
								<i class="nav-icon fas fa-hand-peace"></i></i>
								<p>Trick Or Treat</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url() . 'dashboard/contact' ?>" <?= $this->uri->uri_string() == 'dashboard/contact' || $this->uri->uri_string() == '' ? 'class="nav-link active"' : 'class="nav-link"' ?>>
								<i class="nav-icon fas fa-rss-square"></i>
								<p>Contact</p>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="modal" data-target="#logoutModal" class="nav-link">
								<i class="nav-icon fas fa-sign-out-alt"></i>
								<p>Sign out</p>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</aside>