<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Jenis Truck</h1>
					<small><b>Jika Kolom Sisa Km = 0, Maka Oli Mesin harus di ganti</b><br />
						max pemakian sesudah ganti oli truck = 10.000 Km</small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Truck</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<section class="content">
		<div class="container-fluid">
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
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example8" class="table table-bordless table-striped">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="3%">No</th>
										<th width="20%">Foto</th>
										<th>Merk</th>
										<th>Plat No</th>
										<th>Sisa Km</th>
										<th width="13%">Action</th>
									</tr>
								</thead>
								<?php
								$no = 1;
								foreach ($truck as $p) { ?>
									<tr style="text-align:center">
										<td><?php echo $no++; ?></td>
										<td>
											<a href="<?php echo base_url() . 'gambar/vehicles/' . $p->foto; ?>" data-toggle="lightbox" data-title="<?php echo strtoupper($p->merk) ?>&nbsp; PLAT NO :&nbsp;<?php echo strtoupper($p->plat) ?>">
												<img src="<?php echo base_url() . 'gambar/vehicles/' . $p->foto; ?>" class="img-fluid mb-2" onerror="this.style.display='none'" /></a>
										</td>
										<td><?php echo strtoupper($p->merk) ?></td>
										<td><?php echo strtoupper($p->plat) ?></td>
										<?php
										$driver = $this->db->select_max('odometer')->where('join_id', $p->no_id)->get('driver')->row();
										$history = $this->db->select_max('odometer')->where('join_id', $p->no_id)->where('jenis', 'Ganti Oli')->get('history_vehicles')->row();
										$master = $this->db->select('max_km')->where('type', 'TRUCK')->get('master_vehicles')->row();
										$sum = $master->max_km - ($driver->odometer - $history->odometer);
										?>
										<td><?php echo number_format($sum, 0, '.', '.'); ?>&nbsp;Km</td>
										<td>
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->no_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a href="<?php echo base_url() . 'driver/truck_odo/' . $p->no_id; ?>" class="btn btn-primary btn-sm" title="View Detail"> <i class="fa fa-search"></i> </a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
					<div class="col-md-3" style="padding: 0;">
						<a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add">
							<i class="fa fa-plus-square"></i>&nbsp; Add trcuk</a>
					</div><br />
				</div>
			</div>
	</section>
</div>

<!-- Bootstrap modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add data truck
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/truck_add') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">Type *</label>
						<div class="col-xs-9">
							<?php
							$now = $this->load->helper('date');
							$format = "%Y-%m-%d %H:%i:%s";
							?>
							<input type="hidden" name="addtime" readonly class="form-control" value="<?php echo mdate($format); ?>">
							<input type="text" name="type" class="form-control" value="Truck" readonly required>
							<?php echo set_value('type'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Merk *</label>
						<div class="col-xs-9">
							<?php
							$cek = $this->db->select_max('no_id')->get('type_vehicles')->row();
							?>
							<input type="hidden" name="no_id" class="form-control" value="<?php echo $cek->no_id + 1; ?> ">
							<input type="text" name="merk" class="form-control" placeholder="Input Merk.." required>
							<?php echo set_value('merk'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Plat *</label>
						<div class="col-xs-9">
							<input type="text" name="plat" class="form-control" placeholder="Input Plat.." required>
							<?php echo set_value('plat'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Foto truck</label>
						<div class="col-xs-9">
							<input type="file" name="foto">
							<?php echo set_value('foto'); ?>
						</div>
						<small>* Max size 1 Mb</small><br />
						<small>* Max file name image 10 character</small><br />
						<small>* File type Jpg, Png & Gif</small>
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
<?php foreach ($truck as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit data truck
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/truck_edit') ?>" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Type</label>
							<div class="col-xs-9">
								<input type="hidden" name="no_id" class="form-control" value="<?php echo $p->no_id; ?>">
								<input type="text" name="type" readonly class="form-control" value="<?php echo $p->type; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Merk *</label>
							<div class="col-xs-9">
								<?php
								$now = $this->load->helper('date');
								$format = "%Y-%m-%d %H:%i:%s";
								?>
								<input type="hidden" name="addtime" readonly class="form-control" value="<?php echo mdate($format); ?>">
								<input type="text" name="merk" class="form-control" value="<?php echo $p->merk; ?>" required>
								<?php echo form_error('merk'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Plat *</label>
							<div class="col-xs-9">
								<input type="text" name="plat" class="form-control" value="<?php echo $p->plat; ?>" required>
								<?php echo form_error('plat'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Foto truck</label>
							<div class="col-xs-9">
								<img src="<?php echo base_url() . 'gambar/vehicles/' . $p->foto; ?>" class="img-fluid mb-2" onerror="this.style.display='none'" />
								<input type="file" name="foto">
								<?php echo form_error('foto'); ?>
							</div>
							<small>* Max size 1 Mb</small><br />
							<small>* Max file name image 10 character</small><br />
							<small>* File type Jpg, Png & Gif</small>
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
<?php foreach ($truck as $u) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $u->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete data truck
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/truck_del') ?>">
					<div class="modal-body">
						<input type="hidden" name="no_id" value="<?php echo $u->no_id; ?>">
						<p>Are you sure delete <?php echo $u->plat; ?> ?</p>
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