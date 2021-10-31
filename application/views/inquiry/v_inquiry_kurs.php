<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Kurs Inquiry</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Kurs Inquiry</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<section class="content">
		<?php if ($this->session->flashdata('berhasil')) { ?>
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="info">&times;</button>
				<h4><i class="icon fa fa-check"></i><?= $this->session->flashdata('berhasil') ?>
			</div>
		<?php } ?>
		<?php if ($this->session->flashdata('gagal')) { ?>
			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="info">&times;</button>
				<h4><i class="icon fa fa-warning"></i><?= $this->session->flashdata('gagal') ?></h4>
			</div>
		<?php } ?>
		<div class="container-fluid">
			<div class="btn-group">
				<div class="col-md-6" style="padding: 0;">
					<a class="form-control btn btn-success" data-toggle="modal" data-target="#modal_add_kurs"><i class="fa fa-plus-square"></i>&nbsp; Tambah Data Kurs</a>
				</div>
				<div class="col-md-6" style="padding: 0;">
					<a class=" form-control btn btn-default" data-toggle="modal" data-target="#modal_import_kurs"><i class="fa fa-upload"></i>&nbsp; Import Data </a>
				</div>
				<div class="col-md-6" style="padding: 0;">
					<a href=" <?php echo base_url('inquiry/inquiry_kurs_export'); ?>" class="form-control btn btn-default"><i class="fa fa-download"></i> Export Data </a>
				</div>
			</div>
			<br />
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example5" class="table table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">No</th>
										<th>Currency</th>
										<th>Amount</th>
										<th width="15%" style="display:none">Action</th>
									</tr>
								</thead>
								<?php
								$no = $this->uri->segment('3') + 1;
								$query = $this->db->query("select * from kurs");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->currency; ?></td>
										<td><?php echo number_format($p->amount, 0, '.', '.'); ?></td>
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->id_kurs; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->id_kurs; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php }	?>
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
			<form class="form-horizontal" id="form-modal-tambah" method="post" action="<?php echo base_url('inquiry/inquiry_kurs_aksi') ?>">
				<div class="modal-body">
					<div class="form-group">
						<?php
						$cek = $this->db->select_max('id_kurs')->get('kurs')->row();
						?>
						<input type="hidden" name="id_kurs" class="form-control" value=<?php echo $cek->id_kurs + 1 ?>>
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
					<button class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
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
				<form class="form-horizontal" id="form-modal-tambah" method="post" action="<?php echo base_url('inquiry/inquiry_kurs_update') ?>">
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
						<button class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
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
			<form method="post" action="<?php echo base_url('inquiry/inquiry_kurs_import') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="file" name="excel" class="form-control" required>
					<?php echo form_error('excel'); ?>
					<small>* Extensi file xls atau xlsx</small><br />
					<small>* File yang di import akan me replace data yang sudah ada</small><br />
					<small>* Format file harus sesuai dengan file excel export</small>
				</div>
				<div class="modal-footer">
					<button type="submit" class="form-control btn btn-primary"><i class="fa fa-check"></i> Import Data</button>
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
				<form class="form-horizontal" method="post" action="<?php echo base_url('inquiry/inquiry_kurs_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="id_kurs" value="<?php echo $p->id_kurs; ?>">
						<p>Apakah Anda yakin mau memhapus Kurs <?php echo $p->currency; ?> ini?</p>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						<button class="btn btn-outline-light"><i class="fa fa-check"></i> Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL HAPUS-->