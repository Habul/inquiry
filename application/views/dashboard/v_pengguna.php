<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">User</h1>
					<small>user & user access</small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">User</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<section class="content">
		<div class="container-fluid">
			<?php if ($this->session->flashdata('berhasil')) { ?>
				<div class="alert alert-success alert-dismissible">
					<button class="close" data-dismiss="alert" aria-hidden="true" id="info">&times;</button>
					<h4><i class="icon fa fa-check"></i><?= $this->session->flashdata('berhasil') ?>
				</div>
			<?php } ?>
			<?php if ($this->session->flashdata('gagal')) { ?>
				<div class="alert alert-warning alert-dismissible">
					<button class="close" data-dismiss="alert" aria-hidden="true" id="info">&times;</button>
					<h4><i class="icon fa fa-warning"></i><?= $this->session->flashdata('gagal') ?></h4>
				</div>
			<?php } ?>		
			<div class="col-md-3" style="padding: 0;">
				<a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add">
					<i class="fa fa-plus-square"></i>&nbsp; Add user</a>
			</div>
			<br />
			<div class="row">				
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example4" class="table table-bordered table-striped table-sm">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="5%">No</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Username</th>
										<th>Level</th>
										<th>Status</th>
										<th width="10%">Action</i></th>
									</tr>
								</thead>
								<?php
								$no = 1;
								foreach ($pengguna as $p) {
								?>
									<tr>
										<td style="text-align:center"><?php echo $no++; ?></td>
										<td><?php echo $p->pengguna_nama; ?></td>
										<td><?php echo $p->pengguna_email; ?></td>
										<td><?php echo $p->pengguna_username; ?></td>
										<td><?php echo $p->pengguna_level; ?></td>
										<td style="text-align:center">
											<?php
											if ($p->pengguna_status == 1) {
												echo "Aktif";
											} else {
												echo "Non Aktif";
											}
											?>
										</td>
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->pengguna_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->pengguna_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
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
			<form class="form-horizontal" method="post" id="addform" action="<?php echo base_url('dashboard/pengguna_aksi') ?>">
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
								<option value="driver">Driver</option>
								<option value="ga">GA</option>
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
				<div class="modal-footer justify-content-between">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					<button class="btn btn-primary" id="submitbtn"><i class="fa fa-check"></i> Save</button>
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
								<label>Nama</label>
								<input type="hidden" name="id" value="<?php echo $p->pengguna_id; ?>">
								<input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengguna .." value="<?php echo $p->pengguna_nama; ?>">
								<?php echo form_error('nama'); ?>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control" placeholder="Masukkan email pengguna .." value="<?php echo $p->pengguna_email; ?>">
								<?php echo form_error('email'); ?>
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" class="form-control" placeholder="Masukkan username pengguna.." value="<?php echo $p->pengguna_username; ?>">
								<?php echo form_error('username'); ?>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control" placeholder="Masukkan password pengguna..">
								<?php echo form_error('password'); ?>
								<small>Kosongkan jika tidak ingin mengubah password</small>
							</div>
							<div class="form-group">
								<label>Divisi</label>
								<select class="form-control" name="level">
									<option value="">- Pilih Level -</option>
									<option <?php if ($p->pengguna_level == "admin") { echo "selected='selected'"; } ?> value="admin">Admin</option>
									<option <?php if ($p->pengguna_level == "purchase") { echo "selected='selected'"; } ?> value="purchase">Purchase</option>
									<option <?php if ($p->pengguna_level == "sales") { echo "selected='selected'"; } ?> value="sales">Sales</option>
									<option <?php if ($p->pengguna_level == "driver") { echo "selected='selected'"; } ?> value="sales">Driver</option>
									<option <?php if ($p->pengguna_level == "ga") { echo "selected='selected'"; } ?> value="sales">Ga</option>
								</select>
								<?php echo form_error('level'); ?>
							</div>
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" name="status">
									<option value="">- Pilih Status -</option>
									<option <?php if ($p->pengguna_status == "1") {	echo "selected='selected'";	} ?> value="1">Aktif</option>
									<option <?php if ($p->pengguna_status == "0") {	echo "selected='selected'";	} ?> value="0">Non-Aktif</option>
								</select>
								<?php echo form_error('status'); ?>
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