<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Kurs</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Kurs</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<?php if ($this->session->flashdata('berhasil')) { ?>
				<div class="alert alert-success alert-dismissible fade show" id="info" role="alert">
					<button type=" button" class="close" data-dismiss="alert">&times;</button>
					<i class="icon fa fa-check"></i>&nbsp;<?= $this->session->flashdata('berhasil') ?>
				</div>
			<?php } ?>
			<?php if ($this->session->flashdata('gagal')) { ?>
				<div class="alert alert-warning alert-dismissible fade show" id="info" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<i class="icon fa fa-warning"></i>&nbsp;<?= $this->session->flashdata('gagal') ?>
				</div>
			<?php } ?>
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-header">
							<h4 class="card-title">
								<a class="btn btn-success shadow" data-toggle="modal" data-target="#modal_add_kurs"><i class="fa fa-plus"></i> Add Kurs</a>
								<a class=" btn btn-default shadow" data-toggle="modal" data-target="#modal_import_kurs"><i class="fas fa-file-import"></i> Import</a>
								<a href=" <?php echo base_url('inquiry/inquiry_kurs_export'); ?>" class="btn btn-default shadow"><i class="fas fa-file-export"></i> Export</a>
							</h4>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="maximize">
									<i class="fas fa-expand"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<table id="index2" class="table table-bordered table-striped table-sm">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="5%">No</th>
										<th>Currency</th>
										<th>Amount</th>
										<th width="15%">Action</th>
									</tr>
								</thead>
								<?php
								foreach ($kurs as $p) {
								?>
									<tr>
										<td style="text-align:center"></td>
										<td><?php echo $p->currency; ?></td>
										<td><?php echo number_format($p->amount, 0, '.', '.'); ?></td>
										<td style="text-align:center">
											<a class="btn-sm btn-warning" data-toggle="modal" data-target="#modal_edit<?php echo $p->id_kurs; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $p->id_kurs; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php }  ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Bootstrap modal kurs -->
<div class="modal fade" id="modal_add_kurs" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Kurs
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form onsubmit="addform.disabled = true; return true;" method="post" action="<?php echo base_url('inquiry/inquiry_kurs_aksi') ?>">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="id_kurs" class="form-control" value=<?php echo $id_add->id_kurs + 1 ?>>
						<?php echo form_error('id_kurs'); ?>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Currency *</label>
						<div class="col-xs-9">
							<input type="text" name="currency" class="form-control" placeholder="Input currency.." required>
							<?php echo form_error('currency'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Amount *</label>
						<div class="col-xs-9">
							<input type="number" name="amount" class="form-control" min="1" placeholder="Input amount..." required>
							<?php echo form_error('amount'); ?>
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
<!--End Modals kurs-->

<!-- ============ MODAL EDIT KURS =============== -->
<?php foreach ($kurs as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->id_kurs; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit Kurs
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editform.disabled = true; return true;" method="post" action="<?php echo base_url('inquiry/inquiry_kurs_update') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Brand Produk *</label>
							<div class="col-xs-9">
								<input type="hidden" name="id" value="<?php echo $p->id_kurs; ?>">
								<input type="text" readonly name="currency" class="form-control" value="<?php echo $p->currency; ?>" required>
								<?php echo form_error('currency'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Amount *</label>
							<div class="col-xs-9">
								<input type="number" name="amount" class="form-control" value="<?php echo $p->amount; ?>" required>
								<?php echo form_error('amount'); ?>
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
<!--END MODAL EDIT KURS-->

<!--add MODAL import-->
<div class="modal fade" id="modal_import_kurs" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Import Kurs
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form method="post" onsubmit="importform.disabled = true; return true;" action="<?php echo base_url('inquiry/inquiry_kurs_import') ?>" enctype="multipart/form-data">
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
					<button type="submit" class="form-control btn btn-primary" id="importform"><i class="fa fa-check"></i> Import
						Data</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL import KURS-->

<!--MODAL HAPUS-->
<?php foreach ($kurs as $p) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $p->id_kurs; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Kurs
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="delform.disabled = true; return true;" method="post" action="<?php echo base_url('inquiry/inquiry_kurs_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="id_kurs" value="<?php echo $p->id_kurs; ?>">
						<p>Are you sure delete <?php echo $p->currency ?> ?</p>
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