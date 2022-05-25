<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">License</h1>
					<small>License user <b>7Soft</b></small>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">License</li>
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
							<h4 class="card-title">
								<a class="btn btn-success shadow" data-toggle="modal" data-target="#modal_add">
									<i class="fa fa-plus"></i>&nbsp; Create new license
								</a>
								<a class="btn btn-warning shadow" data-toggle="modal" data-target="#modal_import">
									<i class="fas fa-file-import"></i>&nbsp; Import license
								</a>
							</h4>
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
								<thead class="thead-dark text-center">
									<tr>
										<th width="5%">No</th>
										<th>User</th>
										<th width="10%">Unit</th>
										<th>User login</th>
										<th width="17%">SN</th>
										<th width="15%">Key</th>
										<th>Status</th>
										<th width="8%">Actions</th>
									</tr>
								</thead>
								<?php
								foreach ($license as $p) {
								?>
									<tr>
										<td class="text-center"></td>
										<td><?= strtoupper($p->user) ?></td>
										<td class="text-center"><?= $p->unit ?></td>
										<td class="text-center"><?= strtoupper($p->user_log) ?></td>
										<td class="text-center"><?= $p->sn ?></td>
										<td class="text-center"><?= $p->key ?></td>
										<td class="text-center">
											<?php if ($p->status == 1) : ?>
												<span class="badge badge-primary"><i class="fas fa-check-circle"></i> Aktif</span>
											<?php else : ?>
												<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Non-Aktif</span>
											<?php endif; ?>
										</td>
										<td>
											<a class="btn-sm btn-warning" data-toggle="modal" data-target="#modal_edit<?= $p->id; ?>" title="Edit"><i class="fa fa-pencil-alt"></i></a>
											<a class="btn-sm btn-danger" data-toggle="modal" data-target="#modal_del<?= $p->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php
								}  ?>
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
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="col-12 modal-title text-center">Create new license</h5>
			</div>
			<form onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/license_add') ?>">
				<div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text pr-5">User</label>
						</div>
						<input type="text" name="user" class="form-control" placeholder="Input user.." required>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text">User login</label>
						</div>
						<input type="text" name="user_log" class="form-control" placeholder="Input user login.." required>
					</div>
					<div class="form-group mb-3">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text pr-5">Unit</label>
							</div>
							<input type="text" name="unit" class="form-control" placeholder="Input unit bisnis.." required>
						</div>
					</div>
					<div class="form-group mb-3">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text pr-5">SN&nbsp;&nbsp;&nbsp;</label>
							</div>
							<input type="text" name="sn" class="form-control" placeholder="Serial number..">
						</div>
					</div>
					<div class="form-group mb-0">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text pr-5">Key&nbsp;</label>
							</div>
							<input type="text" name="key" class="form-control" placeholder="Key..">
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

<!-- Bootstrap modal edit -->
<?php foreach ($license as $p) : ?>
	<div class="modal fade" id="modal_edit<?= $p->id ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Edit license</h5>
				</div>
				<form onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/license_edit') ?>">
					<div class="modal-body">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text pr-5">User</label>
							</div>
							<input type="hidden" name="id" class="form-control" value="<?= $p->id ?>">
							<input type="text" name="user" class="form-control" value="<?= $p->user ?>" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text">User login</label>
							</div>
							<input type="text" name="user_log" class="form-control" value="<?= $p->user_log ?>" required>
						</div>
						<div class="form-group mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text pr-5">Unit</label>
								</div>
								<input type="text" name="unit" class="form-control" value="<?= $p->unit ?>" required>
							</div>
						</div>
						<div class="form-group mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text pr-5">SN&nbsp;&nbsp;&nbsp;</label>
								</div>
								<input type="text" name="sn" class="form-control" value="<?= $p->sn ?>">
							</div>
						</div>
						<div class="form-group mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text pr-5">Key&nbsp;</label>
								</div>
								<input type="text" name="key" class="form-control" value="<?= $p->key ?>">
							</div>
						</div>
						<div class="form-group mb-0">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text pr-4">Status&emsp;</label>
								</div>
								<select class="form-control" name="status">
									<option <?php if ($p->status == "1") {
													echo "selected='selected'";
												} ?> value="1">Aktif</option>
									<option <?php if ($p->status == "0") {
													echo "selected='selected'";
												} ?> value="0">Tidak aktif</option>
								</select>
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
	<div class="modal fade" id="modal_del<?= $p->id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Delete license
					</h5>
				</div>
				<form onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/license_del') ?>">
					<div class="modal-body">
						<input type="hidden" name="id" value="<?= $p->id; ?>">
						<input type="hidden" name="user" value="<?= $p->user; ?>">
						<span>Are you sure delete <?= $p->user; ?> ?</span>
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
<!--End Modals Edit & delete-->

<!--add MODAL import-->
<div class="modal fade" id="modal_import" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Import license
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form method="post" onsubmit="importform.disabled = true; return true;" action="<?php echo base_url('dashboard/license_import') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="customFile" name="excel">
						<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
					<small>* Extensi file xls atau xlsx</small><br />
					<small><b>* File yang di import akan me replace data yang sudah ada</b></small><br />
					<small>* Format file harus sesuai dengan file excel export</small>
				</div>
				<div class="modal-footer">
					<button type="submit" class="form-control btn btn-primary" id="importform"> <i class="fa fa-check"></i> Import
						Data</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL import MASTER-->