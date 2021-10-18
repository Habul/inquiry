<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Ganti Password</h1>
					<small>Ubah password anda</small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Ganti Password</li>
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
							<h3 class="card-title">Ganti Password</h3>
						</div>
						<div class="card-body">

						<?php 
						if(isset($_GET['alert'])){
							if($_GET['alert'] == "sukses"){
								echo "<div class='alert alert-success'>Password telah diubah!</div>";
							}else if($_GET['alert'] == "gagal"){
								echo "<div class='alert alert-danger'>Maaf, password lama yang anda masukkan salah!</div>";
							}
						}
						?>

						<form method="post" action="<?php echo base_url('dashboard/ganti_password_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Password Lama</label>
									<input type="password" name="password_lama" class="form-control" placeholder="Masukkan Password Lama Anda ..">
									<?php echo form_error('password_lama'); ?>
								</div>
								<hr>
								<div class="form-group">
									<label>Password Baru</label>
									<input type="password" name="password_baru" class="form-control" placeholder="Masukkan Password Baru ..">
									<?php echo form_error('password_baru'); ?>
								</div>
								<div class="form-group">
									<label>Konfirmasi Password Baru</label>
									<input type="password" name="konfirmasi_password" class="form-control" placeholder="Ulangi Password Baru ..">
									<?php echo form_error('konfirmasi_password'); ?>
								</div>
							</div>

							<div class="card-footer">
								<input type="submit" class="btn btn-primary" value="Ganti Password">
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>
	</div>
	</section>
</div>
