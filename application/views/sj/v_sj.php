<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Surat Jalan</h1>
					<small>Pastikan Desc SJ sudah terinput, sebelum <b>View & Print</b></small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Surat Jalan</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<section class="content">
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
		<div class="container-fluid">
			<div class="col-md-3" style="padding: 0;">
				<a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add_sj">
					<i class="fa fa-plus-square"></i>&nbsp; Add SJ</a>
			</div>
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example6" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="14%">Do No</th>
										<th>Do Date</th>
										<th>Due Date</th>
										<th>No Po</th>
										<th>Cust Name</th>
										<th>Address</th>
										<th>City</th>
										<th>Phone</th>
										<th width="16%">Action</th>
									</tr>
								</thead>
								<?php
								$query = $this->db->query("select * from sj_user");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><?php echo $p->no_delivery; ?></td>
										<td><?php echo $p->date_delivery; ?></td>
										<td><?php echo $p->due_date; ?></td>
										<td><?php echo $p->no_po; ?></td>
										<td><?php echo $p->cust_name; ?></td>
										<td><?php echo $p->address; ?></td>
										<td><?php echo $p->city; ?></td>
										<td><?php echo preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($p->phone)), 2); ?></td>
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_add_desc<?php echo $p->no_po; ?>" title="Add Desc SJ"><i class="fa fa-plus-square"></i></a>
											<a class="btn btn-dark btn-sm" data-toggle="modal" data-target="#modal_edit_sj<?php echo $p->no_po; ?>" title="Edit SJ"><i class="fa fa-edit"></i></a>
											<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_print<?php echo $p->no_po; ?>" title="Detail & Print"><i class="fa fa-print"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_po; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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

<!-- modal add Sj -->
<div class="modal fade" id="modal_add_sj">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Surat Jalan
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" id="form-tambah-inquiry" method="post" action="<?php echo base_url('sj/sj_aksi') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">No Delivery Order *</label>
						<div class="col-xs-9">
							<input type="text" name="no_delivery" class="form-control" placeholder="Input No Delivery order..." required>
							<?php echo form_error('no_delivery'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Date Delivery *</label>
						<div class="col-xs-9">
							<input type="date" name="date_delivery" class="form-control" required>
							<?php echo form_error('date_delivery'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Due Date *</label>
						<div class="col-xs-9">
							<?php
							$now = $this->load->helper('date');
							$format = "%Y-%m-%d %H:%i:%s";
							?>
							<input type="hidden" name="addtime" readonly class="form-control" value="<?php echo mdate($format); ?>">
							<input type="date" name="due_date" class="form-control" required>
							<?php echo form_error('due_date'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">No Po *</label>
						<div class="col-xs-9">
							<input type="number" name="no_po" class="form-control" placeholder="Input No Po..." required>
							<?php echo form_error('no_po'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Cust Name *</label>
						<div class="col-xs-9">
							<input type="text" name="cust_name" class="form-control" placeholder="Input Cust Name..." required>
							<?php echo form_error('cust_name'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Address *</label>
						<div class="col-xs-9">
							<textarea name="address" class="form-control" placeholder="Input Address.." required></textarea>
							<?php echo form_error('address'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">City *</label>
						<div class="col-xs-9">
							<input type="text" name="city" class="form-control" placeholder="Input City..." required>
							<?php echo form_error('city'); ?>
						</div>
					</div> 	
					<div class="form-group">
						<label class="control-label col-xs-3">Phone *</label>
						<div class="col-xs-9">
							<input type="number" name="phone" class="form-control" placeholder="Input No Phone.." data-mask data-mask required>
							<?php echo form_error('phone'); ?>
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
<!-- end modal add Sj -->

<!-- Modal Edit Sj -->
<?php foreach ($sj_user as $p) : ?>
<div class="modal fade" id="modal_edit_sj<?php echo $p->no_po; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Surat Jalan
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url('sj/sj_edit') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">No Delivery Order *</label>
						<div class="col-xs-9">
							<input type="text" name="no_delivery" class="form-control" value="<?php echo $p->no_delivery; ?>" required>
							<?php echo form_error('no_delivery'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Date Delivery *</label>
						<div class="col-xs-9">
							<input type="date" name="date_delivery" class="form-control" value="<?php echo $p->date_delivery; ?>" required>
							<?php echo form_error('date_delivery'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Due Date *</label>
						<div class="col-xs-9">
							<?php
							$now = $this->load->helper('date');
							$format = "%Y-%m-%d %H:%i:%s";
							?>
							<input type="hidden" name="addtime2" readonly class="form-control" value="<?php echo mdate($format); ?>">
							<input type="date" name="due_date" class="form-control" value="<?php echo $p->due_date; ?>" required>
							<?php echo form_error('due_date'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">No Po *</label>
						<div class="col-xs-9">
							<input type="number" name="no_po" class="form-control" value="<?php echo $p->no_po; ?>" required>
							<?php echo form_error('no_po'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Cust Name *</label>
						<div class="col-xs-9">
							<input type="text" name="cust_name" class="form-control" value="<?php echo $p->cust_name; ?>" required>
							<?php echo form_error('cust_name'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Address *</label>
						<div class="col-xs-9">
							<textarea name="address" class="form-control" required><?php echo $p->address; ?></textarea>
							<?php echo form_error('address'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">City *</label>
						<div class="col-xs-9">
							<input type="text" name="city" class="form-control" value="<?php echo $p->city; ?>" required>
							<?php echo form_error('city'); ?>
						</div>
					</div> 	
					<div class="form-group">
						<label class="control-label col-xs-3">Phone *</label>
						<div class="col-xs-9">
							<input type="text" name="phone" class="form-control" value="<?php echo $p->phone; ?>" required>
							<?php echo form_error('phone'); ?>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					<button class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>
<!-- end modal Edit Sj -->

<!-- modal add Desc SJ -->
<?php foreach ($sj_user as $p) : ?>
	<div class="modal fade" id="modal_add_desc<?php echo $p->no_po ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Surat Jalan (No Po : <?php echo $p->no_po; ?>)
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url('sj/sj_update') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Description *</label>
							<div class="col-xs-9">
								<input type="hidden" name="id" readonly class="form-control" value="<?php echo $p->no_po; ?>">
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
<?php endforeach; ?>
<!-- end modal add Desc SJ -->

<!-- modal Print Desc SJ -->
<?php foreach ($sj_user as $p) : ?>
	<div class="modal fade" id="modal_print<?php echo $p->no_po ?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Surat Jalan (No Po : <?php echo $p->no_po; ?>)
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<div class="modal-body">
					<div class="row no-print">
						<div class="col-12">
							<a href="<?php echo base_url() . 'sj/sj_print/' . $p->no_po; ?>" rel="noopener" target="_blank" class="btn btn-primary float-right"><i class="fas fa-print"></i> Print</a>
							<a data-toggle="modal" data-target="#modal_edit_desc<?php echo $p->no_po; ?>" class="btn btn-warning float-left"><i class="fas fa-edit"></i> Edit</a>
						</div>
					</div>
					<br />
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Description</th>
								<th>Qty</th>
							</tr>
						</thead>
						<?php
						$no = 1;
						$cek = $this->db->query("SELECT sj_hs.no_po as no_po,sj_hs.descript as descript,sj_hs.qty as qty FROM sj_hs INNER JOIN sj_user ON sj_hs.no_po=sj_user.no_po WHERE sj_user.no_po=$p->no_po");
						foreach ($cek->result() as $u) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td style="min-width:250px;"><?php echo $u->descript; ?></td>
								<td><?php echo $u->qty; ?></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
				<div class="modal-footer justify-content-center">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!-- end modal Print Desc SJ -->

<!--MODAL HAPUS-->
<?php foreach ($sj_user as $p) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $p->no_po; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
						<p>Are you sure delete this ?</p>
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