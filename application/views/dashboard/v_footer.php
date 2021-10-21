<footer class="main-footer">
	<strong>Copyright &copy; 2021 <a href="https://wa.me/6287771911287">Habul</a></strong> . All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>IT</b> - Intinusa Sejahtera International
	</div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>

</div>

<!-- /.control-sidebar -->
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="<?php echo base_url(); ?>assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="<?php echo base_url(); ?>assets/plugins/dropzone/min/dropzone.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script>
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"lengthChange": true,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"order": [
				[2, "desc"]
			],
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
		$('#example3').DataTable({
			"paging": true,
			"responsive": true,
			"lengthChange": true,
			"autoWidth": false,
			"order": [
				[2, "desc"]
			]
		});
		$("#example4").DataTable({
			"responsive": false,
			"searching": false,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["csv", "excel", "pdf", "print"]
		}).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
		$('#example5').DataTable({
			"paging": true,
			"responsive": true,
			"lengthChange": true,
			"autoWidth": false,
			"ordering": true
		});
		$('#example6').DataTable({
			"paging": true,
			"responsive": true,
			"lengthChange": true,
			"autoWidth": false,
			"order": [
				[3, "desc"]
			]
		});
		$('#example7').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true, 
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
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
<script>
	$(function() {
		// Summernote
		$('#summernote').summernote()
	})
</script>
<script>
	$(function() {
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});

		$('.inquiryok').click(function() {
			Toast.fire({
				icon: 'success',
				title: 'Inquiry successfully added'
			})
		});

		$('.sjok').click(function() {
			Toast.fire({
				icon: 'success',
				title: 'SJ successfully added'
			})
		});
	})
</script>
<script>
	$(function() {
		//Initialize Select2 Elements
		$('.select2').select2()

		//Initialize Select2 Elements
		$('.select2bs4').select2({
			theme: 'bootstrap4'
		})

		//Datemask dd/mm/yyyy
		$('#datemask').inputmask('dd/mm/yyyy', {
			'placeholder': 'dd/mm/yyyy'
		})
		//Datemask2 mm/dd/yyyy
		$('#datemask2').inputmask('mm/dd/yyyy', {
			'placeholder': 'mm/dd/yyyy'
		})
		//Money Euro
		$('[data-mask]').inputmask()

		//Date picker
		$('#reservationdate').datetimepicker({
			format: 'L'
		});
	})
</script>
</body>

</html>