<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Add Desc</h1>
				</div><!-- /.col -->
				<!-- /.col -->
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
		<div class="col-md-3">		
			<a class="form-control btn btn-success" data-toggle="modal" data-target="#modal_add_desc">
				<i class="fa fa-plus-square"></i>&nbsp; Add Desc</a>
		</div>
		<br />
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example2" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>No Po</th>
										<th>Description</th>
										<th>Qty</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<?php
								$nomor=1;
								$no = $this->uri->segment('3');
								$query = $this->db->query("SELECT sj_hs.no_po,sj_hs.descript,sj_hs.qty FROM sj_hs LEFT JOIN sj_user ON sj_hs.no_po=sj_user.no_po");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo $p->no_po; ?></td>										
										<td><?php echo $p->descript; ?></td>
										<td><?php echo $p->qty; ?></td>
										<td style="text-align:center">
											<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->no_po; ?>"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_po; ?>"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
	</section>
	<!-- /.col -->
</div>
<!-- /.row -->

<!-- modal add sj -->
<div class="modal fade" id="modal_add_desc" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Surat Jalan Desc
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" id="form-tambah-inquiry" method="post" action="<?php echo base_url('sj/sj_update') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">No Po</label>
						<div class="col-xs-9">							
							<input type="text" name="no_po" readonly class="form-control" value="<?php echo $p->no_po ?>">
							<?php echo form_error('no_po'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Description *</label>
						<div class="col-xs-9">
							<textarea name="descript" class="form-control" placeholder="Input Desc.." required></textarea>
							<?php echo form_error('descript'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Qty *</label>
						<div class="col-xs-9">
							<input type="number" name="qty" class="form-control" placeholder="Input Qty.." required>
							<?php echo form_error('qty'); ?>
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
<!-- end modal add inquiry -->


<!-- ============ MODAL EDIT SALES =============== -->
<?php foreach ($sj_hs as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->no_po; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Edit Surat Jalan Desc
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
				<form class="form-horizontal" id="form-edit-inquiry" method="post" action="<?php echo base_url('sj/sj_edit') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">No Po</label>
							<div class="col-xs-9">
								<input type="text" name="id" readonly class="form-control" value="<?php echo $p->no_po; ?>">
							</div>
						</div>
						<div class="form-group">
						<label class="control-label col-xs-3">Description *</label>
						<div class="col-xs-9">
							<textarea name="descript" class="form-control" required><?php echo $p->descript; ?></textarea>
							<?php echo form_error('descript'); ?>
						</div>
						</div>
						<div class="form-group">
						<label class="control-label col-xs-3">Qty *</label>
						<div class="col-xs-9">
							<input type="number" name="qty" class="form-control" value="<?php echo $p->qty; ?>" required>
							<?php echo form_error('qty'); ?>
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
<!--END MODAL EDIT SALES-->


<!--MODAL HAPUS-->
<?php foreach ($sj_hs as $p) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $p->no_po; ?>">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Surat Jalan
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url('sj/sj_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="no_po" value="<?php echo $p->no_po; ?>">
						<p text-center>Are you sure delete this ?</p>
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