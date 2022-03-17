<div class="modal fade" id="logoutModal" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content bg-primary">
			<div class="modal-header">
				<h5 class="col-12 modal-title text-center">Ready to Leave?
					<button class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h5>
			</div>
			<div class="modal-body">Select "Sign Out" below if you are ready to end your current session.</div>
			<div class="modal-footer justify-content-between">
				<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				<a class="btn btn-outline-light" href="<?= base_url('dashboard/keluar'); ?>">Sign Out <i
						class="fas fa-sign-out-alt"></i></a>
			</div>
		</div>
	</div>
</div>

<footer class="main-footer text-sm">
	<strong>Copyright &copy; <?= date('Y'); ?><a href="https://github.com/Habul" rel="noopener" target="_blank">
			Habul</a></strong> . All rights
	reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>IT</b> - Intinusa Sejahtera International
	</div>
</footer>

<aside class="control-sidebar control-sidebar-dark"></aside>

</div>

<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
	$.widget.bridge('uibutton', $.ui.button)

</script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
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
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/dropzone/min/dropzone.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/filterizr/jquery.filterizr.min.js"></script>
<?php include './assets/plugins/ajax.php'; ?>
<script>
	$(document).ready(function () {
		$(".toggle-password").click(function () {
			$(this).toggleClass("fa-lock fa-lock-open");
			let input = $($(this).attr("toggle"));
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	});

</script>
<script>
	var toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
	var currentTheme = localStorage.getItem('theme');
	var mainHeader = document.querySelector('.main-header');

	if (currentTheme) {
		if (currentTheme === 'dark') {
			if (!document.body.classList.contains('dark-mode')) {
				document.body.classList.add("dark-mode");
			}
			if (mainHeader.classList.contains('navbar-light')) {
				mainHeader.classList.add('navbar-dark');
				mainHeader.classList.remove('navbar-light');
			}
			toggleSwitch.checked = true;
		}
	}

	function switchTheme(e) {
		if (e.target.checked) {
			if (!document.body.classList.contains('dark-mode')) {
				document.body.classList.add("dark-mode");
			}
			if (mainHeader.classList.contains('navbar-light')) {
				mainHeader.classList.add('navbar-dark');
				mainHeader.classList.remove('navbar-light');
			}
			localStorage.setItem('theme', 'dark');
		} else {
			if (document.body.classList.contains('dark-mode')) {
				document.body.classList.remove("dark-mode");
			}
			if (mainHeader.classList.contains('navbar-dark')) {
				mainHeader.classList.add('navbar-light');
				mainHeader.classList.remove('navbar-dark');
			}
			localStorage.setItem('theme', 'light');
		}
	}

	toggleSwitch.addEventListener('change', switchTheme, false);

</script>
<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#imgInp").change(function () {
		readURL(this);
	});

	$("#info").fadeTo(3000, 500).slideUp(500, function () {
		$("#info").slideUp(500);
	});

</script>
</body>

</html>
