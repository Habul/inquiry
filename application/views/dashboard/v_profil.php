<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Profile</h1>
					<small>Update Profile Pengguna</small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Profile</li>
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
							<h3 class="card-title">Update Profile</h3>
						</div>
						<?php
						if (isset($_GET['alert'])) {
							if ($_GET['alert'] == "sukses") {
								echo "<div class='alert alert-success'>Profil telah diupdate!</div>";
							}
						}
						?>
						<?php foreach ($profil as $p) { ?>
							<form method="post" action="<?php echo base_url('dashboard/profil_update') ?>" enctype="multipart/form-data">
								<div class="card-body">
									<div class="form-group">
										<label>Nama</label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama .." value="<?php echo $p->pengguna_nama; ?>">
										<?php echo form_error('nama'); ?>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" class="form-control" placeholder="Masukkan email .." value="<?php echo $p->pengguna_email; ?>">
										<?php echo form_error('email'); ?>
									</div>
									<div class="form-group">
										<label>Foto</label>
										<input type="file" name="foto" class="form-control">
										<small>* Max size 1 Mb</small><br />
										<small>* Max file name image 10 character</small><br />
										<small>* File type Jpg, Png & Gif</small>
										<?php echo form_error('foto'); ?>
									</div>
								</div>
								<div class="card-footer">
									<input type="submit" class="btn btn-info float-right" value="Update">
								</div>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>