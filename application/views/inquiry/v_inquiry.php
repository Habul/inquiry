<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Inquiry</h1>
					<small>Inquiry yang sudah di jawab Purchase tidak di munculkan, di pindahkan ke menu <b>View Inquiry</b></small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Inquiry</li>
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
			<?php if ($this->session->userdata('level') != "warehouse") {	?>
				<?php if ($this->session->userdata('level') != "purchase") {	?>
					<div class="col-md-3" style="padding: 0;">
						<a class="form-control btn btn-success" data-toggle="modal" data-target="#modal_add_inquiry">
							<i class="fa fa-plus-square"></i>&nbsp; Tambah Inquiry</a>
					</div>
					</br>
				<?php }	?>
			<?php }	?>
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Nama</th>
										<th>Tanggal</th>
										<th>No Inquiry</th>
										<th>Brand Produk</th>
										<th>Description</th>
										<th>Qty</th>
										<th>Deadline</th>
										<th>Request</th>
										<?php if ($this->session->userdata('level') != "warehouse") { ?>
											<th width="12%">Action</th>
										<?php }	?>
									</tr>
								</thead>
								<?php
								$no = $this->uri->segment('3') + 1;
								$query = $this->db->query("select * from inquiry where fu1 is NULL order by tanggal desc");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->sales; ?></td>
										<td><?php echo $p->tanggal; ?></td>
										<td><?php echo $p->inquiry_id; ?></td>
										<td><?php echo $p->brand; ?></td>
										<td><?php echo $p->desc; ?></td>
										<td><?php echo $p->qty; ?></td>
										<td><?php echo $p->deadline; ?></td>
										<td><?php echo $p->request; ?></td>
										<?php if ($this->session->userdata('level') != "warehouse") { ?>
											<td style="text-align:center">
												<?php if ($this->session->userdata('level') != "purchase") { ?>
													<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->inquiry_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
												<?php }	?>
												<?php if ($this->session->userdata('level') != "sales") { ?>
													<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_purch<?php echo $p->inquiry_id; ?>" title="Update"><i class="fa fa-plus-square"></i></a>
													<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->inquiry_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
											</td>
									</tr>
								<?php }	?>
							<?php }	?>
						<?php } ?>
							</table>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</section>
	<!-- /.col -->
</div>
<!-- /.row -->


<!-- modal add inquiry -->
<div class="modal fade" id="modal_add_inquiry" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Inquiry
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" id="form-tambah-inquiry" method="post" action="<?php echo base_url('inquiry/inquiry_aksi') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">No Inquiry</label>
						<div class="col-xs-9">
							<?php
							$inquiry_id = $this->db->select('inquiry_id')->order_by('inquiry_id', "desc")->limit(1)->get('inquiry')->row();
							?>
							<input type="text" name="inquiry_id" readonly class="form-control" value="<?php echo $inquiry_id->inquiry_id + 1 ?>">
							<?php echo form_error('inquiry_id'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Nama Sales</label>
						<div class="col-xs-9">
							<?php
							$id_user = $this->session->userdata('id');
							$sales = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
							?>
							<input type="text" name="sales" readonly class="form-control" value="<?php echo $sales->pengguna_nama; ?> ">
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
						<label class="control-label col-xs-3">Request *</label>
						<div class="col-xs-9">
							<select class="form-control" name="request" required>
								<option value="">- Pilih Request -</option>
								<option value="PRICE+LT">PRICE+LT</option>
								<option value="PRICE">PRICE</option>
								<option value="LT">LT</option>
								<option value="STOCK">STOCK</option>
								<option value="PRICE+LT+STOCK">PRICE+LT+STOCK</option>
								<option value="COO">COO</option>
								<option value="CATALOGUE">CATALOGUE</option>
								<option value="DESIGN">DESIGN</option>
							</select>
							<?php echo form_error('request'); ?>
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
							<textarea name="desc" class="form-control" placeholder="input Desc.." required></textarea>
							<?php echo form_error('desc'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Quantity *</label>
						<div class="col-xs-9">
							<input type="number" name="qty" class="form-control" placeholder="input qty..." required>
							<?php echo form_error('qty'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Deadline *</label>
						<div class="col-xs-9">
							<input type="date" name="deadline" class="form-control" placeholder="input deadline .." required>
							<?php echo form_error('deadline'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Keterangan *</label>
						<div class="col-xs-9">
							<textarea name="keter" class="form-control" placeholder="input  .." required></textarea>
							<?php echo form_error('keter'); ?>
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
<?php foreach ($inquiry as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->inquiry_id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit Inquiry
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" id="form-edit-inquiry" method="post" action="<?php echo base_url('inquiry/inquiry_update_sales') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">No Inquiry</label>
							<div class="col-xs-9">
								<input type="text" name="id" readonly class="form-control" value="<?php echo $p->inquiry_id; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Nama sales</label>
							<div class="col-xs-9">
								<?php
								$id_user = $this->session->userdata('id');
								$sales = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
								?>
								<input type="text" name="sales" readonly class="form-control" value="<?php echo $sales->pengguna_nama; ?> ">
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
							<label class="control-label col-xs-3">Brand Produk</label>
							<div class="col-xs-9">
								<input type="text" name="brand" readonly class="form-control" value="<?php echo $p->brand; ?>">
								<?php echo form_error('brand'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Deskripsi *</label>
							<div class="col-xs-9">
								<textarea name="desc" class="form-control" required><?php echo $p->desc; ?></textarea>
								<?php echo form_error('desc'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Quantity *</label>
							<div class="col-xs-9">
								<input type="text" name="qty" class="form-control" value="<?php echo $p->qty; ?>" required>
								<?php echo form_error('qty'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Deadline *</label>
							<div class="col-xs-9">
								<input type="date" name="deadline" class="form-control" value="<?php echo $p->deadline; ?>" required>
								<?php echo form_error('deadline'); ?>
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
						<button class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL EDIT SALES-->

<!-- ============ MODAL EDIT PURC =============== -->
<?php foreach ($inquiry as $p) : ?>
	<div class="modal fade" id="modal_edit_purch<?php echo $p->inquiry_id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Update Inquiry
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" id="form-update-inquiry" method="post" action="<?php echo base_url('inquiry/inquiry_update') ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">No Inquiry</label>
							<div class="col-xs-9">
								<input type="text" name="id" class="form-control" readonly value="<?php echo $p->inquiry_id; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Sales</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" readonly value="<?php echo $p->sales; ?>">
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
								<textarea class="form-control" readonly><?php echo $p->desc; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Qty</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" readonly value="<?php echo $p->qty; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Deadline</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" readonly value="<?php echo $p->deadline; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Request</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" readonly value="<?php echo $p->request; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Keter(Sales)</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" readonly value="<?php echo $p->keter; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Purchase</label>
							<div class="col-xs-9">
								<?php
								$id_user = $this->session->userdata('id');
								$purchase = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
								?>
								<input type="text" name="name_purch" readonly class="form-control" value="<?php echo $purchase->pengguna_nama; ?> ">
								<?php echo form_error('name_purch'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Follow UP</label>
							<div class="col-xs-9">
								<?php
								$now = $this->load->helper('date');
								$format = "%Y-%m-%d %H:%i:%s";
								?>
								<input type="datetime" name="fu1" readonly class="form-control" value="<?php echo mdate($format); ?>">
								<?php echo form_error('fu1'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Check *</label>
							<div class="col-xs-9">
								<input type="number" name="cek" class="form-control" placeholder="Cek.." required>
								<?php echo form_error('cek'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Keterangan Fu</label>
							<div class="col-xs-9">
								<input type="text" name="ket_fu" class="form-control" placeholder="Keterangan Fu..">
								<?php echo form_error('ket_fu'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Kurs *</label>
							<div class="col-xs-9">
								<select class="form-control" id="kurs" name="kurs" onchange="changeTipe();" required>
									<option value="">- Pilih Kurs -</option>
									<?php foreach ($kurs as $row) : ?>
										<option value="<?php echo $row->id_kurs; ?>"><?php echo $row->currency; ?></option>
									<?php endforeach; ?>
								</select>
								<?php echo form_error('kurs'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Cogs *</label>
							<div class="col-xs-9">
								<input type="number" id="cogs" min="0.001" step="0.001" name="cogs" class="form-control" onchange="changeTipe();" placeholder="Isi Cogs.." required>
								<?php echo form_error('cogs'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Cogs IDR</label>
							<div class="col-xs-9">
								<input type="number" id="cogs_idr" name="cogs_idr" class="form-control">
								<?php echo form_error('cogs_idr'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Reseller</label>
							<div class="col-xs-9">
								<input type="number" id="reseller" name="reseller" class="form-control">
								<?php echo form_error('reseller'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">New Seller</label>
							<div class="col-xs-9">
								<input type="number" id="new_seller" name="new_seller" class="form-control">
								<?php echo form_error('new_seller'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">User</label>
							<div class="col-xs-9">
								<input type="number" id="user " name="user" class="form-control">
								<?php echo form_error('user'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Delivery *</label>
							<div class="col-xs-9">
								<input type="text" name="delivery" class="form-control" placeholder="Delivery.." required>
								<?php echo form_error('delivery'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Ket Purchase</label>
							<div class="col-xs-9">
								<textarea name="ket_purch" class="form-control" placeholder="Keterangan..." required></textarea>
								<?php echo form_error('ket_purch'); ?>
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
<!--END MODAL EDIT PURC-->


<!--MODAL HAPUS-->
<?php foreach ($inquiry as $p) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $p->inquiry_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Kurs
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url('inquiry/inquiry_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="inquiry_id" value="<?php echo $p->inquiry_id; ?>">
						<p>Apakah Anda yakin mau memhapus Inquiry ini?</p>
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