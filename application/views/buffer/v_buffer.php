<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Buffer</h1>
					<small>Data yang sudah di <b>APPROVE / FINISH</b> di pindahkan ke menu <b>VIEW BUFFER</b></small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Buffer</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<section class="content">
		<?php if ($this->session->flashdata('berhasil')) { ?>
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="info">&times;</button>
				<h4><i class="icon fa fa-check"></i><?= $this->session->flashdata('berhasil') ?></h4>
			</div>
		<?php } ?>
		<?php if ($this->session->flashdata('gagal')) { ?>
			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="info">&times;</button>
				<h4><i class="icon fa fa-warning"></i><?= $this->session->flashdata('gagal') ?></h4>
			</div>
		<?php } ?>
		<div class="container-fluid">
			<?php if ($this->session->userdata('level') != "purchase") {	?>
				<?php if ($this->session->userdata('level') != "warehouse") {	?>
					<div class="col-md-3" style="padding: 0;">
						<a class="form-control btn btn-success" data-toggle="modal" data-target="#modal_add_buffer">
							<i class="fa fa-plus-square"></i> Tambah buffer stock</a>
					</div>
					<br />
				<?php }	?>
			<?php }	?>
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-header">
							<h4 class="card-title"><i class="fa fa-database"></i> List Buffer</h4>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo base_url('buffer/buffer') ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
							<table id="example3" class="table table table-bordered table-hover">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="6%">No</th>
										<th>Nama</th>
										<th>Tanggal</th>
										<th>Brand Produk</th>
										<th>Description</th>
										<th>Qty</th>
										<th>Status</th>
										<?php if ($this->session->userdata('level') != "purchase") {	?>
											<th width="13%">Action</th>
										<?php }	?>
									</tr>
								</thead>
								<?php
								$query = $this->db->query("SELECT * FROM `buffer` WHERE status!='approve' AND status!='finish'");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td style="text-align:center"><?php echo $p->id_buffer; ?></td>
										<td><?php echo $p->sales; ?></td>
										<td><?php echo $p->tanggal; ?></td>
										<td><?php echo $p->brand; ?></td>
										<td><?php echo $p->deskripsi; ?></td>
										<td style="text-align:center"><?php echo $p->qty; ?></td>
										<td><?php echo strtoupper($p->status); ?></td>
										<?php if ($this->session->userdata('level') != "purchase") { ?>
											<td style="text-align:center">
												<?php if ($this->session->userdata('level') != "warehouse") { ?>
													<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_editsales<?php echo $p->id_buffer; ?>" title="Edit"><i class="fa fa-edit"></i></a>
												<?php }	?>
												<?php if ($this->session->userdata('level') != "sales") { ?>
													<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_wh<?php echo $p->id_buffer; ?>"><i class="fa fa-plus-square" title="Update"></i></a>
													<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->id_buffer; ?>"><i class="fa fa-trash" title="Delete"></i></a>
											</td>
									</tr>
								<?php }	?>
							<?php }	?>
						<?php } ?>
							</table>
						</div>
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
<!-- modal add buffer -->
<div class="modal fade" id="modal_add_buffer" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Tambah Buffer
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" id="addform" method="post" action="<?php echo base_url('buffer/buffer_aksi') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">Nama Sales</label>
						<div class="col-xs-9">
							<?php
							$cek = $this->db->select_max('id_buffer')->get('buffer')->row();
							?>
							<input type="hidden" name="id_buffer" readonly class="form-control" value="<?php echo $cek->id_buffer + 1; ?>">
							<input type="text" name="sales" readonly class="form-control" value="<?php echo $this->session->userdata('nama'); ?> ">
							<?php echo form_error('sales'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Tanggal</label>
						<div class="col-xs-9">
							<?php
							$now = $this->load->helper('date');
							$format = "%Y-%m-%d %H:%i:%s";
							?>
							<input type="datetime" name="tanggal" readonly class="form-control" value="<?php echo mdate($format); ?>">
							<?php echo form_error('tanggal'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Brand Produk *</label>
						<div class="col-xs-9">
							<select class="form-control" name="brand" required>
								<option value="">- Pilih Brand -</option>
								<?php foreach ($master as $row) : ?>
									<option value="<?php echo $row->brand; ?>"><?php echo $row->brand; ?></option>
								<?php endforeach; ?>
							</select>
							<?php echo form_error('brand'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Deskripsi *</label>
						<div class="col-xs-9">
							<textarea name="deskripsi" class="form-control" placeholder="Input Desc.." required></textarea>
							<?php echo form_error('deskripsi'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Quantity *</label>
						<div class="col-xs-9">
							<input type="number" name="qty" class="form-control" placeholder="Input qty..." required>
							<?php echo form_error('qty'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Keterangan *</label>
						<div class="col-xs-9">
							<textarea name="keter" class="form-control" placeholder="Input keter.." required></textarea>
							<?php echo form_error('keter'); ?>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					<button class="btn btn-primary" id="submitbtn"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end modal add buffer -->

<!-- ============ MODAL EDIT SALES =============== -->
<?php foreach ($buffer as $p) : ?>
	<div class="modal fade" id="modal_editsales<?php echo $p->id_buffer; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit Buffer
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editform.disabled = true; return true;" method="post" action="<?php echo base_url('buffer/buffer_edit') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Id Buffer</label>
							<div class="col-xs-9">
								<input type="text" name="id" readonly class="form-control" value="<?php echo $p->id_buffer; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Nama sales</label>
							<div class="col-xs-9">
								<input type="text" name="sales" readonly class="form-control" value="<?php echo  $this->session->userdata('nama'); ?> ">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tanggal</label>
							<div class="col-xs-9">
								<?php
								$now = $this->load->helper('date');
								$format = "%Y-%m-%d %H:%i:%s";
								?>
								<input type="datetime" name="tanggal" readonly class="form-control" value="<?php echo mdate($format); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Brand Produk</label>
							<div class="col-xs-9">
								<input type="text" name="brand" readonly class="form-control" value="<?php echo $p->brand; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Deskripsi *</label>
							<div class="col-xs-9">
								<textarea name="deskripsi" class="form-control" required><?php echo $p->deskripsi; ?></textarea>
								<?php echo form_error('deskripsi'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Quantity *</label>
							<div class="col-xs-9">
								<input type="number" name="qty" class="form-control" value="<?php echo $p->qty; ?>" required>
								<?php echo form_error('qty'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Keterangan *</label>
							<div class="col-xs-9">
								<textarea name="keter" class="form-control" required><?php echo $p->keter; ?></textarea>
								<?php echo form_error('keter'); ?>
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
<!--END MODAL EDIT SALES-->

<!-- ============ MODAL EDIT WH =============== -->
<?php foreach ($buffer as $p) : ?>
	<div class="modal fade" id="modal_edit_wh<?php echo $p->id_buffer; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Update Buffer
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editwhform.disabled = true; return true;" method="post" action="<?php echo base_url('buffer/buffer_update') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Id Buffer</label>
							<div class="col-xs-9">
								<input type="text" name="id" class="form-control" readonly value="<?php echo $p->id_buffer; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Sales</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" readonly value="<?php echo $p->sales; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tanggal</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" readonly value="<?php echo $p->tanggal; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Brand</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" readonly value="<?php echo $p->brand; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Desc Produk</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" readonly value="<?php echo $p->deskripsi; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Qty</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" readonly value="<?php echo $p->qty; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Keter(Sales)</label>
							<div class="col-xs-9">
								<textarea class="form-control" readonly><?php echo $p->keter; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Warehouse</label>
							<div class="col-xs-9">
								<input type="text" name="wh" readonly class="form-control" value="<?php echo  $this->session->userdata('nama'); ?> ">
								<?php echo form_error('wh'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Follow UP</label>
							<div class="col-xs-9">
								<?php
								$now = $this->load->helper('date');
								$format = "%Y-%m-%d %H:%i:%s";
								?>
								<input type="datetime" name="fu" readonly class="form-control" value="<?php echo mdate($format); ?>">
								<?php echo form_error('fu'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Status *</label>
							<div class="col-xs-9">
								<select class="form-control" name="status" required>
									<option value="">- Pilih Request -</option>
									<option <?php if ($p->status == "approve") {
												echo "selected='selected'";
											} ?> value="approve">APPROVE</option>
									<option <?php if ($p->status == "reject") {
												echo "selected='selected'";
											} ?> value="reject">REJECT</option>
									<option <?php if ($p->status == "on progress") {
												echo "selected='selected'";
											} ?> value="on progress">ON PROGRESS</option>
									<option <?php if ($p->status == "finish") {
												echo "selected='selected'";
											} ?> value="finish">FINISH</option>
								</select>
								<?php echo form_error('status'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">PR No *</label>
							<div class="col-xs-9">
								<input type="text" name="pr_no" class="form-control" placeholder="Input No PR.." value="<?php echo $p->pr_no; ?>" required>
								<?php echo form_error('pr_no'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Ket(warehouse)</label>
							<div class="col-xs-9">
								<textarea name="ket_wh" class="form-control" placeholder="Input Ket.."><?php echo $p->ket_wh; ?></textarea>
								<?php echo form_error('ket_wh'); ?>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<button class="btn btn-primary" id="editwhform"><i class="fa fa-check"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL EDIT WH-->

<!--MODAL HAPUS-->
<?php foreach ($buffer as $p) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $p->id_buffer; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Buffer
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="delform.disabled = true; return true;" method="post" action="<?php echo base_url('buffer/buffer_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="id_buffer" value="<?php echo $p->id_buffer; ?>">
						<p>Are you sure delete no <?php echo $p->id_buffer; ?> ?</p>
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