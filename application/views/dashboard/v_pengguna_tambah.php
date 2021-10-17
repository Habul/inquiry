<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Pengguna</h1>
					<small>Tambah Pengguna</small>
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
							<h3 class="card-title">Tambah Pengguna</h3>
						</div>
						<form method="post" action="<?php echo base_url('dashboard/pengguna_aksi') ?>">
							<div class="card-body">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengguna ..">
									<?php echo form_error('nama'); ?>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control" placeholder="Masukkan email pengguna ..">
									<?php echo form_error('email'); ?>
								</div>
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" placeholder="Masukkan username pengguna..">
									<?php echo form_error('username'); ?>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" placeholder="Masukkan password pengguna..">
									<?php echo form_error('password'); ?>
								</div>
								<div class="form-group">
									<label>Divisi</label>
									<select class="form-control" name="level">
										<option value="">- Pilih Divisi -</option>
										<option value="admin">Admin</option>
										<option value="purchase">Purchase</option>
										<option value="sales">Sales</option>
									</select>
									<?php echo form_error('level'); ?>
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status">
										<option value="">- Pilih Status -</option>
										<option value="1">Aktif</option>
										<option value="0">Non-Aktif</option>
									</select>
									<?php echo form_error('status'); ?>
								</div>
							</div>
							<div class="card-footer">
								<a href="<?php echo base_url() . 'dashboard/pengguna'; ?>" class="btn btn-default">Kembali</a>
								<input type="submit" class="btn btn-info float-right" value="Simpan">
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>