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
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Surat Jalan DF</li>
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
						<div class="card-header">
							<h4 class="card-title"><i class="fa fa-edit"></i> Surat Jalan DF</h4>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo base_url('sj/sj_df') ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
									<i class="fas fa-sync-alt"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="maximize">
									<i class="fas fa-expand"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>								
							</div>
						</div>
						<div class="card-body">
							<table id="example6" class="table table-bordered table-striped">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="7%">Do No</th>
										<th width="10%">Do Date</th>
										<th width="11%">Due Date</th>
										<th>Cust Name</th>
										<th width="18%">Address</th>
										<th>City</th>
										<th>Phone</th>
										<th width="13%">Action</th>
									</tr>
								</thead>
								<?php
								$query = $this->db->query("select * from sj_user_df");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><?php echo str_replace("-", "/", $p->no_delivery); ?></td>
										<td><?php echo $p->date_delivery; ?></td>
										<td><?php echo $p->due_date; ?></td>
										<td><?php echo $p->cust_name; ?></td>
										<td><?php echo $p->address; ?></td>
										<td><?php echo $p->city; ?></td>
										<td><?php echo preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($p->phone)), 2); ?></td>
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit_sj<?php echo $p->no_id; ?>" title="Edit SJ"><i class="fa fa-pencil-alt"></i></a>
											<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_print<?php echo $p->no_id; ?>" title="Add Desc, Detail & Print"><i class="fa fa-search"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" id="modal_add_sj" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Surat Jalan
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal"  onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('sj/sj_aksi_df') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">Delivery Order No*</label>
						<div class="col-xs-9">
							<?php
							$cek = $this->db->select_max('no_id')->get('sj_user_df')->row();
							?>
							<input type="text" name="no_delivery" readonly class="form-control" value="<?php echo 'IT/SJ/', date('Y/m/'), $cek->no_id+1; ?>">
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
							$this->load->helper('date');
							$format = "%Y-%m-%d %H:%i:%s";
							?>
							<input type="hidden" name="addtime" readonly class="form-control" value="<?php echo mdate($format); ?>">
							<input type="date" name="due_date" class="form-control" required>
							<?php echo form_error('due_date'); ?>
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
							<textarea name="address" class="form-control" maxlength="150" placeholder="Input Address.." required></textarea>
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
					<button class="btn btn-primary" id="addbtn"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end modal add Sj -->

<!-- Modal Edit Sj -->
<?php foreach ($sj_user_df as $p) : ?>
	<div class="modal fade" id="modal_edit_sj<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Add Surat Jalan
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('sj/sj_edit_df') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Delivery Order No *</label>
							<div class="col-xs-9">
								<input type="hidden" name="no_id" class="form-control" value="<?php echo $p->no_id; ?>">
								<input type="text" name="no_delivery" class="form-control" readonly value="<?php echo str_replace("-", "/", $p->no_delivery); ?>">
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
							<label class="control-label col-xs-3">Cust Name *</label>
							<div class="col-xs-9">
								<input type="text" name="cust_name" class="form-control" value="<?php echo $p->cust_name; ?>" required>
								<?php echo form_error('cust_name'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Address *</label>
							<div class="col-xs-9">
								<textarea name="address" class="form-control" maxlength="150" required><?php echo $p->address; ?></textarea>
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
						<button class="btn btn-primary" id="editbtn"><i class="fa fa-check"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!-- end modal Edit Sj -->

<!-- modal Print Desc SJ -->
<?php foreach ($sj_user_df as $p) : ?>
	<div class="modal fade" id="modal_print<?php echo $p->no_id ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Surat Jalan (No Do : <?php echo str_replace("-", "/", $p->no_delivery); ?>)
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<div class="modal-body">
					<div class="row no-print">
						<div class="col-12 table-responsive-sm">
							<div class="btn-group float-right">
								<button class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
								<button class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
								<a class="dropdown-item" href="<?php echo base_url() . 'sj/sj_print_df/' . $p->no_id; ?>" rel="noopener" target="_blank" title="Print Dutaflow"><i class="fas fa-print"></i> Dutaflow</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo base_url() . 'sj/sj_print_inti/' . $p->no_id; ?>" rel="noopener" target="_blank" title="Print Intisera"><i class="fas fa-print"></i> Intisera</a>
								</div>
							</div>
							<a data-toggle="modal" data-target="#modal_add_desc<?php echo $p->no_id; ?>" class="btn btn-success float-left"><i class="fas fa-plus-square"></i>&nbsp; Add</a>
						</div>
					</div>
					<br />
					<table class="table table-bordered table-striped">
						<thead style="text-align:center">
							<tr>
								<th width="5%">No</th>
								<th style="min-width:250px;">Description</th>
								<th width="7%">Qty</th>
								<th width="9%">Action</th>
							</tr>
						</thead>
						<?php
						$no = 1;
						$cek = $this->db->query("SELECT sj_df.no_id AS no_id, sj_df.id_join AS id_join, sj_df.descript AS descript, sj_df.qty AS qty FROM sj_df INNER JOIN sj_user_df ON sj_df.id_join=sj_user_df.no_id WHERE sj_user_df.no_id=$p->no_id");
						foreach ($cek->result() as $u) {
						?>
							<tr>
								<td style="text-align:center"><?php echo $no++; ?></td>
								<td><?php echo $u->descript; ?></td>
								<td style="text-align:center"><?php echo $u->qty; ?></td>
								<td style="text-align:center">
									<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit_desc<?php echo $u->no_id; ?>" title="Edit Desc SJ"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_del_desc<?php echo $u->no_id; ?>" title="Delete Desc SJ"><i class="fa fa-trash"></i></a>
								</td>
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

<!-- modal add Desc SJ -->
<?php foreach ($sj_user_df as $p) : ?>
	<div class="modal fade" id="modal_add_desc<?php echo $p->no_id ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Surat Jalan (No Do : <?php echo str_replace("-", "/", $p->no_delivery); ?>)
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="adddesc.disabled = true; return true;" method="post" action="<?php echo base_url('sj/sj_update_df') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Description *</label>
							<div class="col-xs-9">
								<input type="hidden" name="id" readonly class="form-control" value="<?php echo $p->no_id; ?>">
								<textarea name="descript" class="form-control" maxlength="200" placeholder="Input Desc.." required></textarea>
								<?php echo form_error('descript'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Qty *</label>
							<div class="col-xs-9">
								<input type="number" name="qty" class="form-control" min="1" placeholder="Input Qty.." required>
								<?php echo form_error('qty'); ?>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<button class="btn btn-primary" id="adddesc"><i class="fa fa-check"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!-- end modal add Desc SJ -->


<!-- modal Edit Desc SJ -->
<?php foreach ($sj_dfh as $u) : ?>
	<div class="modal fade" id="modal_edit_desc<?php echo $u->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit Desc Surat Jalan
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editdesc.disabled = true; return true;" method="post" action="<?php echo base_url('sj/sj_update_edit_df') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Description *</label>
							<div class="col-xs-9">
								<input type="hidden" name="no_id" class="form-control" value="<?php echo $u->no_id; ?>">
								<textarea name="descript" class="form-control" maxlength="100" required><?php echo $u->descript; ?></textarea>
								<?php echo form_error('descript'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Qty *</label>
							<div class="col-xs-9">
								<input type="number" name="qty" class="form-control" min="1" value=<?php echo $u->qty; ?> required>
								<?php echo form_error('qty'); ?>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<button class="btn btn-primary" id="editdesc"><i class="fa fa-check"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!-- end modal Edit Desc SJ -->

<!--MODAL HAPUS ALL-->
<?php foreach ($sj_user_df as $p) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Surat Jalan
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="deldesc.disabled = true; return true;" method="post" action="<?php echo base_url('sj/sj_hapus_df') ?>">
					<div class="modal-body">
						<input type="hidden" name="no_id" value="<?php echo $p->no_id; ?>">
						<p>Are you sure delete Do <?php echo str_replace("-", "/", $p->no_delivery); ?> ?</p>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						<button class="btn btn-outline-light" id="deldesc"><i class="fa fa-check"></i> Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>

<!--MODAL HAPUS DESC-->
<?php foreach ($sj_dfh as $u) : ?>
	<div class="modal fade" id="modal_del_desc<?php echo $u->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Desc SJ
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="delform.disabled = true; return true;" method="post" action="<?php echo base_url('sj/sj_desc_hapus_df') ?>">
					<div class="modal-body">
						<input type="hidden" name="no_id" value="<?php echo $u->no_id; ?>">
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