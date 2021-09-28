<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Master Inquiry
			<small>Inquiry Marketing - Purchasing</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<div class="col-md-6" style="padding: 0;">
							<a class="form-control btn btn-success" data-toggle="modal" data-target="#modal_add_master"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data Master</a>
						</div>
						<div class="col-md-3">
							<a href="<?php echo base_url('inquiry/inquiry_master_export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-open-file"></i> Export Data Excel</a>
						</div>
						<div class="col-md-3">
						<a class="form-control btn btn-default" data-toggle="modal" data-target="#modal_import_master"><i class="glyphicon glyphicon glyphicon-save-file"></i> Import Data Excel</a>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table table-bordered table-hover">
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
										<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->id_master; ?>"><i class="fa fa-pencil"></i> Edit</a>
										<?php
										echo anchor(site_url('inquiry/inquiry_master_hapus/' . $p->id_master), '<i class="fa fa-trash"></i>&nbsp;Del', 'title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
										?>
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
						<label class="control-label col-xs-3">Brand Produk</label>
						<div class="col-xs-8">
							<input type="text" name="brand" class="form-control" placeholder="input brand..">
							<?php echo form_error('brand'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">D1</label>
						<div class="col-xs-8">
							<input type="number" min="0.01" step="0.01" name="d1" class="form-control" placeholder="input d1...">
							<?php echo form_error('d1'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">D2</label>
						<div class="col-xs-8">
							<input type="number" min="0.01" step="0.01" name="d2" class="form-control" placeholder="input d2 ..">
							<?php echo form_error('d2'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">User</label>
						<div class="col-xs-8">
							<input type="number" min="0.01" step="0.01" name="user" class="form-control" placeholder="input user ..">
							<?php echo form_error('user'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Keterangan</label>
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
							<label class="control-label col-xs-3">D1</label>
							<div class="col-xs-9">
								<input type="number" min="0.1" step="0.1" name="d1" class="form-control" value="<?php echo $p->d1; ?>">
								<?php echo form_error('d1'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">D2</label>
							<div class="col-xs-9">
								<input type="number" min="0.1" step="0.1" name="d2" class="form-control" value="<?php echo $p->d2; ?>">
								<?php echo form_error('d2'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">User</label>
							<div class="col-xs-9">
								<input type="number" min="0.1" step="0.1" name="user" class="form-control" value="<?php echo $p->user; ?>">
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
			<form class="form-horizontal" method="post" action="<?php echo base_url('inquiry/inquiry_kurs_import') ?>">
			<div class="modal-body">
				<div class="form-group">
				<div class="col-xs-12">	
					<input type="file" class="form-control" name="excel">
					<small>&nbsp; * Extensi file xls atau xlsx</small><br/>
					<small>&nbsp; * File yang di import akan me replace data yang sudah ada</small><br/>
				</div>
			</div>
			</div>
				<div class="modal-footer">
					<button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Import Data</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL import KURS-->