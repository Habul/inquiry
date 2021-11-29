<div class="preloader flex-column justify-content-center align-items-center">
	<img class="animation__shake" src="<?php echo base_url(); ?>assets/dist/img/Untitled-1-02.png" alt="AdminLTELogo" height="60" width="60">
</div>

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-6">
					<div class="small-box bg-info shadow">
						<div class="inner">
							<h3><?php echo $jumlah_SJ ?></h3>
							<p>Jumlah Surat Jalan</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-list"></i>
						</div>
						<a href="<?php echo base_url('sj/sj_df') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<div class="small-box bg-green shadow">
						<div class="inner">
							<h3><?php echo $total_inquiry ?></h3>
							<p>Jumlah Inquiry</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-document"></i>
						</div>
						<a href="<?php echo base_url('inquiry/inquiry') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<div class="small-box bg-red shadow">
						<div class="inner">
							<h3><?php echo $total_buffer ?></h3>
							<p>Jumlah Buffer</p>
						</div>
						<div class="icon">
							<i class="ion ion-ios-briefcase-outline"></i>
						</div>
						<a href="<?php echo base_url('buffer/buffer') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<div class="small-box bg-yellow shadow">
						<div class="inner">
							<h3><?php echo $jumlah_pengguna ?></h3>
							<p>Jumlah Pengguna</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<!-- small card -->
					<div class="small-box bg-success shadow">
					<div class="inner">
						<h3><?php echo $tot_mobil ?></h3>
						<p>Jumlah Mobil</p>
					</div>
					<div class="icon">
						<i class="fas fa-car"></i>
					</div>
					<a href="<?php echo base_url('driver/mobil') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
					</a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small card -->
					<div class="small-box bg-info shadow">
					<div class="inner">
						<h3><?php echo $tot_motor ?></h3>
						<p>Jumlah Motor</p>
					</div>
					<div class="icon">
						<i class="fas fa-motorcycle"></i>
					</div>
					<a href="<?php echo base_url('driver/motor') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
					</a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small card -->
					<div class="small-box bg-warning shadow">
					<div class="inner">
						<h3><?php echo $tot_truck ?></h3>
						<p>Jumlah Truck</p>
					</div>
					<div class="icon">
						<i class="fas fa-truck"></i>
					</div>
					<a href="<?php echo base_url('driver/truck') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
					</a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small card -->
					<div class="small-box bg-danger shadow">
					<div class="inner">
						<h3><?php echo $tot_vehicles ?></h3>
						<p>Total Kendaraan</p>
					</div>
					<div class="icon">
						<i class="fas fa-key"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
					</a>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-md-6">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Statistik Brand</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
						</div>
					</div>
				</div>				

				<div class="col-md-6">
					<div class="card card-danger">
						<div class="card-header">
							<h3 class="card-title">Statistik Sales</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>