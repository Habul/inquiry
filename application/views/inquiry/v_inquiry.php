<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Inquiry</h1>
					<small>Inquiry yang sudah di jawab Purchase tidak di munculkan, di pindahkan ke menu <b>Arsip
							Inquiry</b></small>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Inquiry</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<?php if ($this->session->userdata('level') != "warehouse") {  ?>
							<?php if ($this->session->userdata('level') != "purchase") {  ?>
								<div class="card-header">
									<h4 class="card-title"><a class="form-control btn btn-success shadow" data-toggle="modal" data-target="#modal_add_inquiry">
											<i class="fa fa-plus"></i>&nbsp; Add Inquiry</a></h4>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="maximize">
											<i class="fas fa-expand"></i>
										</button>
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
									</div>
								</div>
							<?php }  ?>
						<?php }  ?>
						<div class="card-body">
							<table id="example6" class="table table-hover table-sm">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="5%">No</th>
										<th>Nama</th>
										<th>Tanggal</th>
										<th>Brand</th>
										<th>Description</th>
										<th>Qty</th>
										<th>Deadline</th>
										<th>Request</th>
										<?php if ($this->session->userdata('level') != "warehouse") { ?>
											<th width="13%">Actions</th>
										<?php }  ?>
									</tr>
								</thead>
								<?php
								foreach ($inquiry as $p) {
								?>
									<tr>
										<td style="text-align:center"><?php echo $p->inquiry_id; ?></td>
										<td><?php echo $p->sales; ?></td>
										<td><?php echo $p->tanggal; ?></td>
										<td><?php echo $p->brand; ?></td>
										<td><?php echo $p->desc; ?></td>
										<td style="text-align:center"><?php echo $p->qty; ?></td>
										<td><?php echo $p->deadline; ?></td>
										<td><?php echo $p->request; ?></td>
										<?php if ($this->session->userdata('level') != "warehouse") { ?>
											<td style="text-align:center">
												<?php if ($this->session->userdata('level') != "purchase") { ?>
													<a class="btn-sm btn-warning" data-toggle="modal" data-target="#modal_edit<?php echo $p->inquiry_id; ?>" title="Edit"><i class="fa fa-pencil-alt"></i></a>
												<?php }  ?>
												<?php if ($this->session->userdata('level') != "sales") { ?>
													<?php $encrypturl = urlencode($this->encrypt->encode($p->inquiry_id)) ?>
													<a href="<?php echo base_url() . 'inquiry/inquiry_update_prch/?id=' . $encrypturl; ?>" class="btn-sm btn-primary" title="Update inquiry"><i class="fa fa-edit"></i></a>
													<a class="btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $p->inquiry_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
											</td>
									</tr>
								<?php }  ?>
							<?php }  ?>
						<?php } ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<!-- modal add inquiry -->
<div class="modal fade" id="modal_add_inquiry" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Inquiry
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" onsubmit="addform.disabled = true; return true;" method="post" action="<?php echo base_url('inquiry/inquiry_aksi') ?>">
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="hidden" name="inquiry_id" readonly class="form-control" value="<?php echo $id_add->inquiry_id + 1; ?>">
							<input type="text" name="sales" readonly class="form-control" value="<?php echo $this->session->userdata('nama'); ?> ">
							<?php echo form_error('sales'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Request *</label>
						<div class="col-sm-10">
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
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Brand *</label>
						<div class="col-sm-10">
							<select class="form-control" name="brand" required>
								<option value="">- Pilih Brand -</option>
								<?php foreach ($master as $row) : ?>
									<option value="<?php echo $row->brand; ?>"><?php echo $row->brand; ?></option>
								<?php endforeach; ?>
							</select>
							<?php echo form_error('brand'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Desc *</label>
						<div class="col-sm-10">
							<textarea name="desc" class="form-control" placeholder="Input Desc.." required></textarea>
							<?php echo form_error('desc'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Qty *</label>
						<div class="col-sm-10">
							<input type="number" name="qty" class="form-control" min="1" placeholder="Input qty..." required>
							<?php echo form_error('qty'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Deadline *</label>
						<div class="col-sm-10">
							<input type="date" name="deadline" class="form-control" value="2022-01-01" required>
							<?php echo form_error('deadline'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Keter *</label>
						<div class="col-sm-10">
							<textarea name="keter" class="form-control" placeholder="Input Keter .." required></textarea>
							<?php echo form_error('keter'); ?>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					<button class="btn btn-primary" id="addform"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end modal add inquiry -->

<!-- ============ MODAL EDIT SALES =============== -->
<?php foreach ($inquiry as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->inquiry_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit Inquiry
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('inquiry/inquiry_update_sales') ?>">
					<div class="modal-body">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">No Inquiry</label>
							<div class="col-sm-10">
								<input type="text" name="id" readonly class="form-control" value="<?php echo $p->inquiry_id; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input type="text" name="sales" readonly class="form-control" value="<?php echo $this->session->userdata('nama'); ?> ">
								<?php echo form_error('sales'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Brand</label>
							<div class="col-sm-10">
								<input type="text" name="brand" readonly class="form-control" value="<?php echo $p->brand; ?>">
								<?php echo form_error('brand'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Desc *</label>
							<div class="col-sm-10">
								<textarea name="desc" class="form-control" required><?php echo $p->desc; ?></textarea>
								<?php echo form_error('desc'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Qty *</label>
							<div class="col-sm-10">
								<input type="number" name="qty" class="form-control" min="1" value="<?php echo $p->qty; ?>" required>
								<?php echo form_error('qty'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Deadline *</label>
							<div class="col-sm-10">
								<input type="date" name="deadline" class="form-control" value="<?php echo $p->deadline; ?>" required>
								<?php echo form_error('deadline'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Keter *</label>
							<div class="col-sm-10">
								<textarea name="keter" class="form-control" required><?php echo $p->keter; ?></textarea>
								<?php echo form_error('keter'); ?>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<button class="btn btn-primary" id="editbtn"><i class="fa fa-check"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL EDIT SALES-->

<!--MODAL HAPUS-->
<?php foreach ($inquiry as $p) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $p->inquiry_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Inquiry
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('inquiry/inquiry_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="inquiry_id" value="<?php echo $p->inquiry_id; ?>">
						<p>Are you sure delete id <?php echo $p->inquiry_id; ?> ?</p>
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
<!--END MODAL HAPUS-->