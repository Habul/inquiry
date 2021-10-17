<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Pengaturan</h1>
					<small>Update Pengaturan Website</small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Pengaturan</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card card-success">
						<div class="card-header">
							<h3 class="card-title">Update Pengaturan Website</h3>
						</div>
						<?php
						if (isset($_GET['alert'])) {
							if ($_GET['alert'] == "sukses") {
								echo "<div class='alert alert-success'>Pengaturan telah diupdate!</div>";
							}
						}
						?>
						<?php foreach ($pengaturan as $p) { ?>
							<form method="post" action="<?php echo base_url('dashboard/pengaturan_update') ?>" enctype="multipart/form-data">
								<div class="card-body">
									<div class="form-group">
										<label>Nama Website</label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama website.." value="<?php echo $p->nama; ?>">
										<?php echo form_error('nama'); ?>
									</div>

									<div class="form-group">
										<label>Deskripsi Website</label>
										<input type="text" name="deskripsi" class="form-control" placeholder="Masukkan deskripsi .." value="<?php echo $p->deskripsi; ?>">
										<?php echo form_error('deskripsi'); ?>
									</div>

									<hr>

									<div class="form-group">
										<label>Logo Website</label>
										<input type="file" name="logo">
										<small>Kosongkan jika tidak ingin mengubah logo</small>
									</div>

									<hr>

									<div class="form-group">
										<label>Link Facebook</label>
										<input type="text" name="link_facebook" class="form-control" placeholder="Masukkan link facebook .." value="<?php echo $p->link_facebook; ?>">
										<?php echo form_error('link_facebook'); ?>
									</div>

									<div class="form-group">
										<label>Link Twitter</label>
										<input type="text" name="link_twitter" class="form-control" placeholder="Masukkan link_twitter .." value="<?php echo $p->link_twitter; ?>">
										<?php echo form_error('link_twitter'); ?>
									</div>

									<div class="form-group">
										<label>Link Instagram</label>
										<input type="text" name="link_instagram" class="form-control" placeholder="Masukkan link_instagram .." value="<?php echo $p->link_instagram; ?>">
										<?php echo form_error('link_instagram'); ?>
									</div>

									<div class="form-group">
										<label>Link Github</label>
										<input type="text" name="link_github" class="form-control" placeholder="Masukkan link_github .." value="<?php echo $p->link_github; ?>">
										<?php echo form_error('link_github'); ?>
									</div>
								</div>

								<div class="card-footer">
									<input type="submit" class="btn btn-info float-right" value="Simpan">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>