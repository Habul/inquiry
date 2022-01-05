<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
					</ol>
				</div>
			</div>
		</div>
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
					<div class="small-box bg-success shadow">
						<div class="inner">
							<h3><?php echo $tot_mobil ?></h3>
							<p>Jumlah Mobil</p>
						</div>
						<div class="icon">
							<i class="fas fa-car-side"></i>
						</div>
						<a href="<?php echo base_url('driver/mobil') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-6">
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
				<div class="col-lg-3 col-6">
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
				<div class="col-lg-3 col-6">
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

				<div class="col-lg-6 col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Charts </h3>
							<div class="card-tools">
								<ul class="nav nav-pills ml-auto">
									<li class="nav-item">
										<a class="nav-link active" href="#revenue-chart" data-toggle="tab">Sales</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#sales-chart" data-toggle="tab">Brand</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#area-chart" data-toggle="tab">Surat Jalan</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="card-body">
							<div class="tab-content p-0">
								<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
									<canvas id="donutChart" height="300" style="height: 300px;"></canvas>
								</div>
								<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
									<canvas id="pieChart" height="300" style="height: 300px;"></canvas>
								</div>
								<div class="chart tab-pane" id="area-chart" style="position: relative; height: 300px;">
									<canvas id="areaChart" height="300" style="height: 300px;"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 col-12">
					<div class="card bg-gradient-primary">
						<div class="card-header border-0">
							<h3 class="card-title"><i class="far fa-calendar-alt"></i> Calendar</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse">
									<i class="fas fa-minus"></i></button>
								<button type="button" class="btn btn-primary btn-sm" data-card-widget="remove">
									<i class="fas fa-times"></i></button>
							</div>
						</div>
						<div class="card-body pt-0">
							<div id="calendar" style="width: 100%"></div>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>