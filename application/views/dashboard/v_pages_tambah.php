<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Tambah Halaman Baru
		</h1>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card card-success">
						<div class="card-header">
							<h3 class="card-title">Tambah Halaman</h3>
						</div>
						<form method="post" action="<?php echo base_url('dashboard/pages_aksi') ?>">
							<div class="form-group">
								<label>Judul Halaman</label>
								<input type="text" name="judul" class="form-control" placeholder="Masukkan judul halaman.." value="<?php echo set_value('judul'); ?>">
								<?php echo form_error('judul'); ?>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label>Konten Halaman</label>
									<?php echo form_error('konten'); ?>
									<br />
									<textarea class="form-control" id="summernote" name="konten"> <?php echo set_value('konten'); ?> </textarea>
								</div>
							</div>
							<input type="submit" value="Publish" class="btn btn-success btn-block">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>