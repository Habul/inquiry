<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Surat Jalan</h1>
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
							<table id="example3" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">No</th>
										<th>Do No</th>
										<th>Do Date</th>
										<th>Due Date</th>
										<th>No PO</th>
										<th>Cust Name</th>
										<th>Address</th>
										<th>City</th>
										<th>Phone</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<?php
								$no = $this->uri->segment('3') + 1;
								$query = $this->db->query("select * from sj_user order by addtime desc");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->no_delivery; ?></td>
										<td><?php echo $p->date_delivery; ?></td>
										<td><?php echo $p->due_date; ?></td>
										<td><?php echo $p->no_po; ?></td>
										<td><?php echo $p->cust_name; ?></td>
										<td><?php echo $p->address; ?></td>
										<td><?php echo $p->city; ?></td>
										<td><?php echo $p->phone; ?></td>
										<td style="text-align:center">
											<a href="<?php echo base_url() . 'sj/sj_isi/' . $p->no_po; ?>" class="btn btn-warning btn-sm" title="Add Desc SJ"><i class="fa fa-plus-square"></i> </a>
											<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_print<?php echo $p->no_po; ?>" title="Print"><i class="fa fa-print"></i></a>
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

<!-- modal add inquiry -->
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
						<label class="control-label col-xs-3">No Delivery Order</label>
						<div class="col-xs-9">
							<?php $sj_cek = $this->db->select('no_delivery')->order_by('no_delivery', "desc")->limit(1)->get('sj_user')->row();	?>
							<input type="text" name="no_delivery" readonly class="form-control" value="<?php echo $sj_cek->no_delivery + 1 ?>">
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
						<label class="control-label col-xs-3">No PO *</label>
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
							<textarea name="address" class="form-control" placeholder="input Address.." required></textarea>
							<?php echo form_error('address'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">City *</label>
						<div class="col-xs-9">
							<input type="text" name="city" class="form-control" placeholder="input City..." required>
							<?php echo form_error('city'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Phone *</label>
						<div class="col-xs-9">
							<input type="text" name="phone" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
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
<!-- end modal add inquiry -->

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