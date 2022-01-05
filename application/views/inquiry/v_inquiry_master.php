<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Master</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Master</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<?php if ($this->session->flashdata('berhasil')) { ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<button type=" button" class="close" data-dismiss="alert">&times;</button>
					<i class="icon fa fa-check"></i>&nbsp;<?= $this->session->flashdata('berhasil') ?>
				</div>
			<?php } ?>
			<?php if ($this->session->flashdata('gagal')) { ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<i class="icon fa fa-warning"></i>&nbsp;<?= $this->session->flashdata('gagal') ?>
				</div>
			<?php } ?>
			<div class="btn-group">
				<div class="col-sm-6" style="padding: 0;">
					<a class="form-control btn btn-success" data-toggle="modal" data-target="#modal_add_master"><i class="fa fa-plus-square"></i>&nbsp; Tambah Data Master</a>
				</div>
				<div class="col-sm-6" style="padding: 0;">
					<a class="form-control btn btn-default" data-toggle="modal" data-target="#modal_import_master"><i class="fa fa-upload"></i>&nbsp; Import Data </a>
				</div>
				<div class="col-sm-6" style="padding: 0;">
					<a href="<?php echo base_url('inquiry/inquiry_master_export'); ?>" class="form-control btn btn-default"><i class="fa fa-download"></i> Export Data </a>
				</div>
			</div>
			<br />
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example5" class="table table-bordered table-striped table-sm">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="5%">No</th>
										<th>Brand Produk</th>
										<th>D1</th>
										<th>D2</th>
										<th>User</th>
										<th>Manufacture/Distributor</th>
										<th width="12%" style="display:none">Action</th>
									</tr>
								</thead>
								<?php
								$no = $this->uri->segment('3') + 1;
								$query = $this->db->query("select * from master");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td style="text-align:center"><?php echo $no++; ?></td>
										<td><?php echo $p->brand; ?></td>
										<td style="text-align:center"><?php echo $p->d1; ?></td>
										<td style="text-align:center"><?php echo $p->d2; ?></td>
										<td style="text-align:center"><?php echo $p->user; ?></td>
										<td><?php echo $p->distributor; ?></td>
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->id_master; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->id_master; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php }	?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Bootstrap modal Master -->
<div class="modal fade" id="modal_add_master" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Master
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" onsubmit="addform.disabled = true; return true;" method="post" action="<?php echo base_url('inquiry/inquiry_master_aksi') ?>">
				<div class="modal-body">
					<div class="form-group">
						<?php
						$cek = $this->db->select_max('id_master')->get('master')->row();
						?>
						<input type="hidden" name="id_master" class="form-control" value=<?php echo $cek->id_master + 1 ?>>
						<?php echo form_error('id_master'); ?>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Brand Produk *</label>
						<div class="col-xs-8">
							<input type="text" name="brand" class="form-control" placeholder="Input Brand.." required>
							<?php echo form_error('brand'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">D1 *</label>
						<div class="col-xs-8">
							<input type="number" min="0.01" step="0.01" name="d1" class="form-control" placeholder="Input d1..." required>
							<?php echo form_error('d1'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">D2 *</label>
						<div class="col-xs-8">
							<input type="number" min="0.01" step="0.01" name="d2" class="form-control" placeholder="Input d2 .." required>
							<?php echo form_error('d2'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">User *</label>
						<div class="col-xs-8">
							<input type="number" min="0.01" step="0.01" name="user" class="form-control" placeholder="Input user .." required>
							<?php echo form_error('user'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Manufac/Distrib</label>
						<div class="col-xs-8">
							<input type='text' name="distributor" class="form-control" placeholder="Input .."></input>
							<?php echo form_error('distributor'); ?>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					<button class="btn btn-primary" id="addform"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals Master-->

<!-- ============ MODAL EDIT MASTER =============== -->
<?php foreach ($master as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->id_master; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit Master
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editform.disabled = true; return true;" method="post" action="<?php echo base_url('inquiry/inquiry_master_update') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Brand Produk</label>
							<div class="col-xs-9">
								<input type="hidden" name="id" value="<?php echo $p->id_master; ?>">
								<input type="text" readonly name="brand" class="form-control" value="<?php echo $p->brand; ?>">
								<?php echo form_error('brand'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">D1 *</label>
							<div class="col-xs-9">
								<input type="number" min="0.1" step="0.1" name="d1" class="form-control" value="<?php echo $p->d1; ?>" required>
								<?php echo form_error('d1'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">D2 *</label>
							<div class="col-xs-9">
								<input type="number" min="0.1" step="0.1" name="d2" class="form-control" value="<?php echo $p->d2; ?>" required>
								<?php echo form_error('d2'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">User *</label>
							<div class="col-xs-9">
								<input type="number" min="0.1" step="0.1" name="user" class="form-control" value="<?php echo $p->user; ?>" required>
								<?php echo form_error('user'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Manufac/Distrib</label>
							<div class="col-xs-9">
								<input type="text" name="distributor" class="form-control" value="<?php echo $p->distributor; ?>">
								<?php echo form_error('distributor'); ?>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<button class="btn btn-primary" id="editform"><i class="fa fa-check"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL EDIT MASTER-->

<!--add MODAL import-->
<div class="modal fade" id="modal_import_master" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Import Master
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form method="post" onsubmit="importform.disabled = true; return true;" action="<?php echo base_url('inquiry/inquiry_master_import') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="customFile" name="excel">
						<?php echo set_value('excel'); ?>
						<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
					<small>* Extensi file xls atau xlsx</small><br />
					<small>* File yang di import akan me replace data yang sudah ada</small><br />
					<small>* Format file harus sesuai dengan file excel export</small>
				</div>
				<div class="modal-footer">
					<button type="submit" class="form-control btn btn-primary" id="importform"> <i class="fa fa-check"></i> Import Data</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL import MASTER-->

<!--MODAL HAPUS-->
<?php foreach ($master as $p) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $p->id_master; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Master
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="delform.disabled = true; return true;" method="post" action="<?php echo base_url('inquiry/inquiry_master_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="id_master" value="<?php echo $p->id_master; ?>">
						<p>Are you sure delete this ?</p>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						<button class="btn btn-outline-light" id="delform"><i class="fa fa-check"></i> Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL HAPUS-->