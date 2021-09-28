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
						<h3><?php echo $total_inquiry ?></h3>

						<p>Jumlah Inquiry</p>
					</div>
					<div class="icon">
						<i class="ion ion-android-document"></i>
					</div>
					<a href="<?php echo base_url('inquiry/inquiry') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo $total_buffer ?></h3>

						<p>Jumlah Buffer</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="<?php echo base_url('buffer/buffer') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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

			<div class="col-lg-6 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<i class="fa fa-briefcase"></i>
						<h3 class="box-title">Statistik <small>Sales</small></h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<canvas id="pieChart1" style="height:250px"></canvas>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<i class="fa fa-briefcase"></i>
						<h3 class="box-title">Statistik <small>Brand</small></h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<canvas id="pieChart2" style="height:250px"></canvas>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/bower_components/chart.js/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script>
	//-------------
	//- PIE CHART 1 -
	//-------------
	// Get context with jQuery - using jQuery's .get() method.
	var pieChartCanvas = $('#pieChart1').get(0).getContext('2d')
	var pieChart = new Chart(pieChartCanvas)
	var PieData = <?php echo $data_sales; ?>;
	var pieOptions = {

		segmentShowStroke: true,
		segmentStrokeColor: '#fff',
		segmentStrokeWidth: 2,
		percentageInnerCutout: 50,
		animationSteps: 100,
		animationEasing: 'easeOutBounce',
		animateRotate: true,
		animateScale: false,
		responsive: true,
		maintainAspectRatio: true,
		legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
	}
	pieChart.Doughnut(PieData, pieOptions)
</script>
<script>
	//-------------
	//- PIE CHART 2 -
	//-------------
	var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
	var pieChart = new Chart(pieChartCanvas)
	var PieData = <?php echo $data_brand; ?>;
	var pieOptions = {
		segmentShowStroke: true,
		segmentStrokeColor: '#fff',
		segmentStrokeWidth: 2,
		percentageInnerCutout: 50,
		animationSteps: 100,
		animationEasing: 'easeOutBounce',
		animateRotate: true,
		animateScale: false,
		responsive: true,
		maintainAspectRatio: true,
		legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
	}
	pieChart.Doughnut(PieData, pieOptions)
</script>