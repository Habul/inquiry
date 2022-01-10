<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<?php foreach ($odo as $u) : ?>
						<h1 class="m-0"><?php echo strtoupper($u->merk) ?> | Plat No <?php echo strtoupper($u->plat) ?></h1>
						<small>Pastikan input history odometer dahulu, <b>sebelum menabahkan history service</b>
							<br>untuk reset sisa Km, pastikan yang di pilih history services adalah <b>Ganti Oli</b></small>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="<?php echo base_url('driver/truck') ?>">Truck</a></li>
						<li class="breadcrumb-item active">Detail Truck</li>
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
			<div class="row">
				<div class="col-md-6">
					<div class="card card-success">
						<div class="card-header">
							<h4 class="card-title"><i class="fa fa-tachometer-alt"></i> HISTORY ODOMETER</h4>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="maximize">
									<i class="fas fa-expand"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<table id="example9" class="table table-bordered table-hover table-sm">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th>Nama</th>
										<th>Tanggal</th>
										<th>Odometer</th>
										<th width="16%">Action</th>
									</tr>
								</thead>
								<?php
								$query = $this->db->query("SELECT * FROM driver WHERE join_id=$u->no_id;");
								foreach ($query->result() as $p) { ?>
									<tr style="text-align:center">
										<td><?php echo strtoupper($p->nama) ?></td>
										<td><?php echo $p->tanggal; ?></td>
										<td><?php echo number_format($p->odometer, 0, '.', '.'); ?>&nbsp;Km</td>
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->no_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
						<div class="card-body row">
							<div class="col-md-4">
								<button class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_add">
									<i class="fa fa-plus"></i> History odometer</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card card-info collapsed-card">
						<div class="card-header">
							<h4 class="card-title"><i class="fa fa-bell"></i> HISTORY SERVICES</h4>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="maximize">
									<i class="fas fa-expand"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-plus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<table id="example10" class="table table-bordered table-hover table-sm">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th>Jenis</th>
										<th>Tanggal</th>
										<th>Odometer</th>
										<th width="16%">Action</th>
									</tr>
								</thead>
								<?php
								$no = 1;
								$query = $this->db->query("SELECT * FROM history_vehicles WHERE join_id=$u->no_id;");
								foreach ($query->result() as $p) { ?>
									<tr>
										<td><?php echo strtoupper($p->jenis) ?></td>
										<td style="text-align:center"><?php echo $p->tanggal; ?></td>
										<td style="text-align:center"><?php echo number_format($p->odometer, 0, '.', '.'); ?>&nbsp;Km</td>
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#history_edit<?php echo $p->no_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#history_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
						<div class="card-body row">
							<div class="col-md-4">
								<button class="btn btn-info btn-block" data-toggle="modal" data-target="#add_history">
									<i class="fa fa-plus"></i> History service</button>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Bootstrap modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Odometer
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/truck_odo_add') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">Nama</label>
						<div class="col-xs-9">
							<?php foreach ($odo as $u) : ?>
								<input type="hidden" name="join_id" class="form-control" value="<?php echo $u->no_id; ?>">
							<?php endforeach; ?>
							<input type="text" name="nama" class="form-control" value="<?php echo $this->session->userdata('nama'); ?>" readonly>
							<?php echo form_error('nama'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Tanggal</label>
						<div class="col-xs-9">
							<?php
							$now = $this->load->helper('date');
							$format = "%Y-%m-%d";
							?>
							<input type="date" name="tanggal" readonly class="form-control" value="<?php echo mdate($format); ?>">
							<?php echo form_error('tanggal'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Odometer *</label>
						<div class="col-xs-9">
							<input type="number" name="odometer" min="1" class="form-control" placeholder="Input Odometer.." required>
							<?php echo set_value('odometer'); ?>
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

<!-- ============ MODAL EDIT truck =============== -->
<?php foreach ($driver as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit Odometer
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/truck_odo_edit') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Nama</label>
							<div class="col-xs-9">
								<input type="text" name="odometer" readonly class="form-control" value="<?php echo strtoupper($p->nama) ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Type</label>
							<div class="col-xs-9">
								<?php
								$now = $this->load->helper('date');
								$format = "%Y-%m-%d";
								?>
								<input type="hidden" name="no_id" class="form-control" value="<?php echo $p->no_id; ?>">
								<input type="hidden" name="join_id" class="form-control" value="<?php echo $p->join_id; ?>">
								<input type="date" name="tanggal" readonly class="form-control" value="<?php echo mdate($format); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Merk *</label>
							<div class="col-xs-9">
								<input type="text" name="odometer" class="form-control" value="<?php echo $p->odometer; ?>" required>
								<?php echo form_error('odometer'); ?>
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
<!--END MODAL EDIT truck-->

<!--MODAL HAPUS DESC-->
<?php foreach ($driver as $u) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $u->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Odometer
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/truck_odo_del') ?>">
					<div class="modal-body">
						<input type="hidden" name="join_id" value="<?php echo $u->join_id; ?>">
						<input type="hidden" name="no_id" value="<?php echo $u->no_id; ?>">
						<p>Are you sure delete, Odometer <?php echo $u->odometer; ?> ?</p>
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

<!--MODAL HISTORY SERVICES-->
<!-- Bootstrap modal add -->
<div class="modal fade" id="add_history" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add History Service
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/truck_history_add') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">Jenis *</label>
						<div class="col-xs-9">
							<?php foreach ($odo as $u) : ?>
								<input type="hidden" name="join_id" class="form-control" value="<?php echo $u->no_id; ?>">
								<select class="form-control" name="jenis" required>
									<option value="">- Pilih Request -</option>
									<option value="Ganti Oli">Ganti Oli</option>
									<option value="Ganti Kapas Rem">Ganti Kapas Rem</option>
								</select>
								<?php echo form_error('jenis'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Tanggal *</label>
						<div class="col-xs-9">
							<input type="date" name="tanggal" class="form-control" required>
							<?php echo form_error('tanggal'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Odometer </label>
						<div class="col-xs-9">
							<?php $cek = $this->db->select_max('odometer')->where('join_id', $u->no_id)->get('driver')->row(); ?>
						<?php endforeach; ?>
						<input type="number" name="odometer" min="1" class="form-control" value="<?php echo $cek->odometer ?>">
						<small>di ambil data terakhir dari inputan history odometer</small>
						<?php echo form_error('tanggal'); ?>
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

<!-- ============ MODAL EDIT truck =============== -->
<?php foreach ($history as $p) : ?>
	<div class="modal fade" id="history_edit<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit History Service
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/truck_history_edit') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Jenis *</label>
							<div class="col-xs-9">
								<input type="text" name="jenis" class="form-control" value="<?php echo $p->jenis; ?>" required>
								<?php echo form_error('jenis'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tanggal *</label>
							<div class="col-xs-9">
								<input type="hidden" name="no_id" class="form-control" value="<?php echo $p->no_id; ?>">
								<input type="hidden" name="join_id" class="form-control" value="<?php echo $p->join_id; ?>">
								<input type="date" name="tanggal" class="form-control" value="<?php echo $p->tanggal; ?>">
								<?php echo form_error('tanggal'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Odometer </label>
							<div class="col-xs-9">
								<input type="text" name="odometer" class="form-control" value="<?php echo $p->odometer; ?>">
								<?php echo form_error('odometer'); ?>
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
<!--END MODAL EDIT truck-->

<!--MODAL HAPUS DESC-->
<?php foreach ($history as $u) : ?>
	<div class="modal fade" id="history_hapus<?php echo $u->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete History Service
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/truck_history_del') ?>">
					<div class="modal-body">
						<input type="hidden" name="join_id" value="<?php echo $u->join_id; ?>">
						<input type="hidden" name="no_id" value="<?php echo $u->no_id; ?>">
						<p>Are you sure delete, <?php echo $u->jenis; ?> ?</p>
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