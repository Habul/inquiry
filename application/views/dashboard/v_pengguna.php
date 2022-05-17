<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">User</h1>
					<small>user & user access</small>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">User</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-header">
							<h4 class="card-title"><a class="form-control btn btn-success shadow" data-toggle="modal" data-target="#modal_add">
									<i class="fa fa-plus"></i>&nbsp; Add user</a></h4>
							<div class="card-tools">
								<button type="button" class="btn btn-xs btn-icon btn-circle btn-warning" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon btn-circle btn-primary" data-card-widget="maximize">
									<i class="fas fa-expand"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon btn-circle btn-danger" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<table id="index2" class="table table-striped table-sm">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="5%">No</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Username</th>
										<th>Level</th>
										<th>Status</th>
										<th width="10%">Actions</th>
									</tr>
								</thead>
								<?php
								foreach ($pengguna as $p) {
								?>
									<tr>
										<td style="text-align:center"></td>
										<td><?php echo strtoupper($p->pengguna_nama) ?></td>
										<td><?php echo $p->pengguna_email; ?></td>
										<td><?php echo $p->pengguna_username; ?></td>
										<td><?php echo $p->pengguna_level; ?></td>
										<td style="text-align:center">
											<?php if ($p->pengguna_status == 1) : ?>
												<span class="badge badge-primary"><i class="fas fa-check-circle"></i> Aktif</span>
											<?php else : ?>
												<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Non-Aktif</span>
											<?php endif; ?>
										</td>
										<td style="text-align:center">
											<a class="btn-sm btn-warning" data-toggle="modal" data-target="#modal_edit<?php echo $p->pengguna_id; ?>" title="Edit"><i class="fa fa-pencil-alt"></i></a>
											<a class="btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $p->pengguna_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Bootstrap modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add User
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" method="post" onsubmit="addbtn.disabled = true; return true;" action="<?php echo base_url('dashboard/pengguna_aksi') ?>">
				<div class="card-body">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<span><i class="fas fa-user-tie"></i></span>
								</div>
							</div>
							<input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengguna .." required>
							<?php echo form_error('nama'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<span><i class="fas fa-envelope-square"></i></span>
								</div>
							</div>
							<input type="email" name="email" class="form-control" placeholder="Masukkan email pengguna .." required>
							<?php echo form_error('email'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<span><i class="fas fa-user"></i></span>
								</div>
							</div>
							<input type="text" name="username" class="form-control" placeholder="Masukkan username pengguna.." required>
							<?php echo form_error('username'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-append">
								<div class="input-group-text">
									<span toggle="#password-field" class="fa fa-fw fa-lock field-icon toggle-password"></span>
								</div>
							</div>
							<input id="password-field" type="password" class="form-control" name="password" placeholder="Masukan password.." required>
							<?php echo form_error('password'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<span><i class="fas fa-suitcase"></i></span>
								</div>
							</div>
							<select class="form-control" name="level" required>
								<option value="">- Pilih Divisi -</option>
								<option value="admin">Admin</option>
								<option value="purchase">Purchase</option>
								<option value="driver">Driver</option>
								<option value="ga">GA</option>
								<option value="guest">Guest</option>
							</select>
							<?php echo form_error('level'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<span><i class="fas fa-exclamation-circle"></i></span>
								</div>
							</div>
							<select class="form-control" name="status" required>
								<option value="">- Pilih Status -</option>
								<option value="1">Aktif</option>
								<option value="0">Non-Aktif</option>
							</select>
							<?php echo form_error('status'); ?>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					<button class="btn btn-primary" id="addbtn"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals Add-->

<!-- ============ MODAL EDIT DATA =============== -->
<?php foreach ($pengguna as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->pengguna_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit User
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/pengguna_update') ?>">
					<div class="card-body">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<span><i class="fas fa-user-tie"></i></span>
									</div>
								</div>
								<input type="hidden" name="id" value="<?php echo $p->pengguna_id; ?>">
								<input type="text" name="nama" class="form-control" value="<?php echo $p->pengguna_nama; ?>">
								<?php echo form_error('nama'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<span><i class="fas fa-envelope-square"></i></span>
									</div>
								</div>
								<input type="email" name="email" class="form-control" value="<?php echo $p->pengguna_email; ?>">
								<?php echo form_error('email'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<span><i class="fas fa-user"></i></span>
									</div>
								</div>
								<input type="text" name="username" class="form-control" value="<?php echo $p->pengguna_username; ?>">
								<?php echo form_error('username'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<span><i class="fa fa-lock"></i></span>
									</div>
								</div>
								<input type="password" class="form-control" name="password" placeholder="Masukan Password..">
								<?php echo form_error('password'); ?>
							</div>
							<small>Kosongkan jika tidak ingin mengubah password</small>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<span><i class="fas fa-suitcase"></i></span>
									</div>
								</div>
								<select class="form-control" name="level">
									<option value="">- Pilih Level -</option>
									<option <?php if ($p->pengguna_level == "admin") {
													echo "selected='selected'";
												} ?> value="admin">Admin</option>
									<option <?php if ($p->pengguna_level == "purchase") {
													echo "selected='selected'";
												} ?> value="purchase">Purchase</option>
									<option <?php if ($p->pengguna_level == "sales") {
													echo "selected='selected'";
												} ?> value="sales">Sales</option>
									<option <?php if ($p->pengguna_level == "driver") {
													echo "selected='selected'";
												} ?> value="driver">Driver</option>
									<option <?php if ($p->pengguna_level == "ga") {
													echo "selected='selected'";
												} ?> value="ga">Ga</option>
									<option <?php if ($p->pengguna_level == "guest") {
													echo "selected='selected'";
												} ?> value="guest">Guest</option>
								</select>
								<?php echo form_error('level'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<span><i class="fas fa-exclamation-circle"></i></span>
									</div>
								</div>
								<select class="form-control" name="status">
									<option value="">- Pilih Status -</option>
									<option <?php if ($p->pengguna_status == "1") {
													echo "selected='selected'";
												} ?> value="1">Aktif</option>
									<option <?php if ($p->pengguna_status == "0") {
													echo "selected='selected'";
												} ?> value="0">Non-Aktif</option>
								</select>
								<?php echo form_error('status'); ?>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<button class="btn btn-primary" id="editbtn"><i class="fa fa-check"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL EDIT DATA-->

<!--MODAL HAPUS DESC-->
<?php foreach ($pengguna as $u) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $u->pengguna_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete User
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/pengguna_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="id" value="<?php echo $u->pengguna_id; ?>">
						<p>Are you sure delete <?php echo $u->pengguna_nama; ?> ?</p>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						<button class="btn btn-outline-light" id="delbtn"><i class="fa fa-check"></i> Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>