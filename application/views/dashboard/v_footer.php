<a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
</a>

<footer class="main-footer text-sm">
	<strong>Copyright &copy; 2021 <a href="https://wa.me/6287771911287?text=Hallo%20">Habul</a></strong> . All rights reserved.
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
<!-- bs-custom-file-input -->
<script src="<?php echo base_url(); ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Ekko Lightbox -->
<script src="<?php echo base_url(); ?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
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
<!-- Filterizr-->
<script src="<?php echo base_url(); ?>assets/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script>
	$(document).ready(function() {
		$("#submitbtn").click(function() {
			$('#submitbtn').text('saving...');
			$("#submitbtn").attr("disabled", true);
			$('#addform').submit();
		});
	});
</script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
	$(function() {
		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
			event.preventDefault();
			$(this).ekkoLightbox({
				alwaysShowClose: true
			});
		});

		$('.filter-container').filterizr({
			gutterPixels: 3
		});
		$('.btn[data-filter]').on('click', function() {
			$('.btn[data-filter]').removeClass('active');
			$(this).addClass('active');
		});
	})
</script>
<script>
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": true,
			"searching": true
		})
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
			"responsive": true,
			"searching": true,
			"lengthChange": true,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
				[0, "desc"]
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
		$('#example8').DataTable({
			"paging": true,
			"responsive": true,
			"lengthChange": true,
			"autoWidth": false,
			"ordering": true
		});
		$('#example9').DataTable({
			"paging": true,
			"responsive": true,
			"lengthChange": true,
			"autoWidth": false,
			"order": [
				[1, "desc"]
			]
		});
		$('#example10').DataTable({
			"paging": true,
			"responsive": true,
			"lengthChange": true,
			"autoWidth": false,
			"order": [
				[1, "desc"]
			]
		});
		$('#example11').DataTable({
			"paging": true,
			"responsive": true,
			"lengthChange": true,
			"autoWidth": false,
			"order": [
				[7, "desc"]
			]
		});
	});
</script>
<script>
	var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
	var donutData = {
		labels: [<?php
					if (count($data_sales) > 0) {
						foreach ($data_sales as $data) {
							echo "'" . $data->sales . "',";
						}
					}
					?>],
		datasets: [{
			data: [<?php
					if (count($data_sales) > 0) {
						foreach ($data_sales as $data) {
							echo $data->jmlh . ", ";
						}
					}
					?>],
			backgroundColor: <?php echo $sales_color ?>,
		}]
	}
	var donutOptions = {
		maintainAspectRatio: false,
		responsive: true,
		legend: {
			display: true
		}
	}
	new Chart(donutChartCanvas, {
		type: 'doughnut',
		data: donutData,
		options: donutOptions
	})

	var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
	var pieData = {
		labels: [<?php
					if (count($data_brand) > 0) {
						foreach ($data_brand as $data) {
							echo "'" . $data->brand . "',";
						}
					}
					?>],
		datasets: [{
			data: [<?php
					if (count($data_brand) > 0) {
						foreach ($data_brand as $data) {
							echo $data->jmlh . ", ";
						}
					}
					?>],
			backgroundColor: <?php echo $brand_color ?>,
		}]
	}
	var pieOptions = {
		maintainAspectRatio: false,
		responsive: true,
		legend: {
			display: false
		}
	}
	new Chart(pieChartCanvas, {
		type: 'pie',
		data: pieData,
		options: pieOptions,

	})
</script>
<script>
	$(function() {
		$('#summernote').summernote()
	})
	$(function() {
		$('#summernoteedit').summernote()
	})
</script>
<!--script>
	$(function() {
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		$('.berhasil').click(function() {
			Toast.fire({
				icon: 'success',
				title: ' Add Data successfully'
			})
		});
		$('.gagal').click(function() {
			Toast.fire({
				icon: 'success',
				title: 'SJ successfully added'
			})
		});
	})
</script-->
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