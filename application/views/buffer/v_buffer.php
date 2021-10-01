<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Buffer Stock
			<small>Data yang sudah di <b>APPROVE</b> di pindahkan ke menu <b>VIEW BUFFER</b></small>
		</h1>
	</section>
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
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<?php if ($this->session->userdata('level') != "purchase") {	?>					
						<?php if ($this->session->userdata('level') != "warehouse") {	?>
							<div class="col-md-6" style="padding: 0;">
								<a class="form-control btn btn-success" data-toggle="modal" data-target="#modal_add_buffer">
									<i class="glyphicon glyphicon-plus-sign"></i> Tambah buffer stock</a>
							</div>
						<?php }	?>
						<?php }	?>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					<div class="table-responsive-lg">
						<table id="example2" class="table table table-bordered table-hover">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Nama</th>
									<th>Tanggal</th>
									<th>Id Buffer</th>
									<th>Brand Produk</th>
									<th>Description</th>
									<th>Qty</th>
									<th>Status</th>
									<?php if ($this->session->userdata('level') != "purchase") {	?>	
									<th width="12%">Action</th>
									<?php }	?>
								</tr>
							</thead>
							<?php
							$no = $this->uri->segment('3') + 1;
							$query = $this->db->query("SELECT * FROM `buffer` WHERE status!='approve' ORDER BY tanggal DESC");
							foreach ($query->result() as $p) {
							?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $p->sales; ?></td>
									<td><?php echo $p->tanggal; ?></td>
									<td><?php echo $p->id_buffer; ?></td>
									<td><?php echo $p->brand; ?></td>
									<td><?php echo $p->deskripsi; ?></td>
									<td><?php echo $p->qty; ?></td>
									<td><?php echo $p->status; ?></td>
									<?php if ($this->session->userdata('level') != "purchase") { ?>
									<td style="text-align:center">
										<?php if ($this->session->userdata('level') != "warehouse") { ?>
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_editsales<?php echo $p->id_buffer; ?>"><i class="fa fa-pencil"></i> Edit</a>
										<?php }	?>
										<?php if ($this->session->userdata('level') != "sales") { ?>
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit_wh<?php echo $p->id_buffer; ?>"><i class="fa fa-edit"></i> Edit</a>
											<?php
											echo anchor(site_url('buffer/buffer_hapus/' . $p->id_buffer), '<i class="fa fa-trash"></i>&nbsp;Del', 'title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
											?>
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
<div class="modal fade" id="modal_add_buffer" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel" align="center">Tambah Buffer Stock</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url('buffer/buffer_aksi') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">Id Buffer</label>
						<div class="col-xs-9">
							<?php
							$cek = $this->db->select('id_buffer')->order_by('id_buffer', "desc")->limit(1)->get('buffer')->row();
							?>
							<input type="text" name="id_buffer" readonly class="form-control" value="<?php echo $cek->id_buffer + 1 ?>">
							<?php echo form_error('id_buffer'); ?>
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
						<label class="control-label col-xs-3">Brand Produk *</label>
						<div class="col-xs-9">
							<select class="form-control" name="brand">
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
							<textarea name="deskripsi" class="form-control" placeholder="input Desc.."></textarea>
							<?php echo form_error('deskripsi'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Quantity *</label>
						<div class="col-xs-9">
							<input type="number" name="qty" class="form-control" placeholder="input qty...">
							<?php echo form_error('qty'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Keterangan *</label>
						<div class="col-xs-9">
							<textarea name="keter" class="form-control" placeholder="input  .."></textarea>
							<?php echo form_error('keter'); ?>
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
<!-- end modal add buffer -->

<!-- ============ MODAL EDIT SALES =============== -->
<?php foreach ($buffer as $p) : ?>
	<div class="modal fade" id="modal_editsales<?php echo $p->id_buffer; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 class="modal-title" id="myModalLabel" align="center">Edit Buffer</h3>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url('buffer/buffer_edit') ?>">
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
								<?php
								$id_user = $this->session->userdata('id');
								$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
								?>
								<input type="text" name="sales" readonly class="form-control" value="<?php echo $user->pengguna_nama; ?> ">
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
								<textarea name="deskripsi" class="form-control"><?php echo $p->deskripsi; ?></textarea>
								<?php echo form_error('deskripsi'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Quantity *</label>
							<div class="col-xs-9">
								<input type="number" name="qty" class="form-control" value="<?php echo $p->qty; ?>">
								<?php echo form_error('qty'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Keterangan *</label>
							<div class="col-xs-9">
								<textarea name="keter" class="form-control"><?php echo $p->keter; ?></textarea>
								<?php echo form_error('keter'); ?>
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

<!-- ============ MODAL EDIT WH =============== -->
<?php foreach ($buffer as $p) : ?>
	<div class="modal fade" id="modal_edit_wh<?php echo $p->id_buffer; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h3 class="modal-title" id="myModalLabel" align="center">Edit Buffer (Warehouse)</h3>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url('buffer/buffer_update') ?>">
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
								<?php
								$id_user = $this->session->userdata('id');
								$cek = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
								?>
								<input type="text" name="wh" readonly class="form-control" value="<?php echo $cek->pengguna_nama; ?> ">
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
								<select class="form-control" name="status">
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
								<input type="text" name="pr_no" class="form-control" value="<?php echo $p->pr_no; ?>">
								<?php echo form_error('pr_no'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Ket(warehouse)</label>
							<div class="col-xs-9">
								<textarea name="ket_wh" class="form-control"><?php echo $p->ket_wh; ?></textarea>
								<?php echo form_error('ket_wh'); ?>
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
<!--END MODAL EDIT WH-->