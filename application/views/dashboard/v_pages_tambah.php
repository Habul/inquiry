<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Tambah Halaman Baru
		</h1>
	</section>
	<section class="content">
	<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
		<form method="post" action="<?php echo base_url('dashboard/pages_aksi') ?>">
			<div class="row">
				<div class="col-lg-12">
					<div class="box box-primary">
						<div class="box-body">
							<div class="box-body">
								<div class="form-group">
									<label>Judul Halaman</label>
									<input type="text" name="judul" class="form-control" placeholder="Masukkan judul halaman.." value="<?php echo set_value('judul'); ?>">
									<?php echo form_error('judul'); ?>
								</div>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label>Konten Halaman</label>
									<?php echo form_error('konten'); ?>
									<br/>
									<textarea class="form-control" id="summernote" name="konten"> <?php echo set_value('konten'); ?> </textarea>
								</div>
							</div>
							<input type="submit" value="Publish" class="btn btn-success btn-block">
						</div>
					</div>
				</div>				
			</div>
		</form>
	</section>

</div>