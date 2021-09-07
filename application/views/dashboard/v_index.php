<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $jumlah_artikel ?></h3>

						<p>Jumlah Artikel</p>
					</div>
					<div class="icon">
						<i class="ion ion-android-list"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $jumlah_inquiry ?></h3>

						<p>Inquiry Belum Terjawab</p>
					</div>
					<div class="icon">
						<i class="ion ion-android-document"></i>
					</div>
					<a href="<?php echo base_url('dashboard/inquiry') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo $total_inquiry ?></h3>

						<p>Inquiry Sudah Terjawab</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="<?php echo base_url('dashboard/inquiry_view') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
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
			
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-body">
						<h3>Selamat Datang !</h3>
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<tr>
									<th width="%">Nama</th>
									<th width="1px">:</th>
									<td>
											<?php 
											$id_user = $this->session->userdata('id');
											$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
											?>
										<p><?php echo $user->pengguna_nama; ?></p>
									</td>
								</tr>
								<tr>
									<th width="20%">Username</th>
									<th width="1px">:</th>
									<td><?php echo $this->session->userdata('username') ?></td>
								</tr>
								<tr>
									<th width="20%">Divisi</th>
									<th width="1px">:</th>
									<td><?php echo $this->session->userdata('level') ?></td>
								</tr>
								<tr>
									<th width="20%">Status</th>
									<th width="1px">:</th>
									<td>Aktif</td>
								</tr>
								<tr>
									<th width="20%"></th>
									<th width="1px"></th>
									<td></td>
								</tr>
								<tr>
									<th width="20%"></th>
									<th width="1px"></th>
									<td></td>
								</tr>
								<tr>
									<th width="20%"></th>
									<th width="1px"></th>
									<td></td>
								</tr>
							</table>
						</div>
					</div>
				</div>

			</div>
			 <!--div class="col-md-6">
    			<div class="box box-primary">
     			<div class="box-header with-border">
       			<h3 class="box-title">Statistik <small>Sales</small></h3>
     			<div class="box-body">
        	<canvas id="data-inquiry" style="height:250px"></canvas>
		</div>
	</div>
</div>
</div!-->
</div>
</section>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
  <script>
  //data inquiry
  var pieChartCanvas = $("#data-inquiry").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = <?php echo $data_inquiry; ?>;

  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    percentageInnerCutout: 50,
    animationSteps: 100,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

  pieChart.Doughnut(PieData, pieOptions);
  </script>
