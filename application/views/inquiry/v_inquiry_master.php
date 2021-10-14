<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Master Inquiry</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Master Inquiry</li>
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
			<div class="col-sm-3" style="padding: 0;">
				<a class="form-control btn btn-success" data-toggle="modal" data-target="#modal_add_master"><i class="fa fa-plus-square"></i>&nbsp; Tambah Data Master</a>
			</div>
			<div class="col-sm-3">
				<a class="form-control btn btn-default" data-toggle="modal" data-target="#modal_import_master"><i class="glyphicon glyphicon glyphicon-save-file"></i> Import Data Excel</a>
			</div>
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Brand Produk</th>
										<th>D1</th>
										<th>D2</th>
										<th>User</th>
										<th>Manufacture/Distributor</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<?php
								$no = $this->uri->segment('3') + 1;
								$query = $this->db->query("select * from master");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->brand; ?></td>
										<td><?php echo $p->d1; ?></td>
										<td><?php echo $p->d2; ?></td>
										<td><?php echo $p->user; ?></td>
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
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>

<!-- Bootstrap modal Master -->
<div class="modal fade" id="modal_add_master" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel" align="center">Tambah Master</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url('inquiry/inquiry_master_aksi') ?>">
				<div class="modal-body">
					<div class="form-group">
						<?php
						$id_master = $this->db->select('id_master')->order_by('id_master', "desc")->limit(1)->get('master')->row();
						?>
						<input type="hidden" name="id_master" class="form-control" value=<?php echo $id_master->id_master + 1 ?>>
						<?php echo form_error('id_master'); ?>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Brand Produk *</label>
						<div class="col-xs-8">
							<input type="text" name="brand" class="form-control" placeholder="input brand.." required>
							<?php echo form_error('brand'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">D1 *</label>
						<div class="col-xs-8">
							<input type="number" min="0.01" step="0.01" name="d1" class="form-control" placeholder="input d1..." required>
							<?php echo form_error('d1'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">D2 *</label>
						<div class="col-xs-8">
							<input type="number" min="0.01" step="0.01" name="d2" class="form-control" placeholder="input d2 .." required>
							<?php echo form_error('d2'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">User *</label>
						<div class="col-xs-8">
							<input type="number" min="0.01" step="0.01" name="user" class="form-control" placeholder="input user .." required>
							<?php echo form_error('user'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Manufac/Distrib</label>
						<div class="col-xs-8">
							<input type='text' name="distributor" class="form-control" placeholder="input .."></input>
							<?php echo form_error('distributor'); ?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default pull-left" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Kembali</button>
					<button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals Master-->

<!-- ============ MODAL EDIT MASTER =============== -->
<?php foreach ($master as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->id_master; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h3 class="modal-title" id="myModalLabel" align="center">Edit Master</h3>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url('inquiry/inquiry_master_update') ?>">
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
					<div class="modal-footer">
						<button class="btn btn-default pull-left" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Kembali</button>
						<button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL EDIT MASTER-->

<!--add MODAL import-->
<div class="modal fade" id="modal_import_master" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel" align="center">Import Master</h3>
			</div>
			<form method="post" action="<?php echo base_url('inquiry/inquiry_master_import') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="file" name="excel" class="form-control" required>
					<small>* Extensi file xls atau xlsx</small><br />
					<small>* File yang di import akan me replace data yang sudah ada</small><br />
					<small>* Format file harus sesuai dengan file excel export</small>
				</div>
				<div class="modal-footer">
					<button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Import Data</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL import MASTER-->

<!--MODAL HAPUS-->
<?php foreach ($master as $p) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $p->id_master; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
					<h3 class="modal-title" id="myModalLabel" align="center">Hapus Master</h3>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url('inquiry/inquiry_master_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="id_master" value="<?php echo $p->id_master; ?>">
						<div class="alert alert-success">
							<p>Apakah Anda yakin mau memhapus Master ini?</p>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default pull-left" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
						<button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i>&nbsp; Ya</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL HAPUS-->