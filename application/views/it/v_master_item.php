<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Master Item</h1>
					<small>Approve Master item INTISERA <b>7Soft</b></small>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Master Item</li>
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
						<div class="card-header">
							<h4 class="card-title">
								<?php if ($this->session->userdata('level') != "sales") :  ?>
								<a class="btn btn-success shadow-sm" title="Add item" onclick="add_item()">
									<i class="fa fa-plus"></i>&nbsp; Create new item
								</a>								
								<?php elseif ($this->session->userdata('level') != "engineering") : ?>
									<i class="fas fa-tools"></i>&nbsp; Master item
								<?php endif; ?>
								<a class="btn btn-default shadow-sm" title="Reload" onclick="reload_table()">
									<i class="fas fa-sync-alt"></i>&nbsp; Reload
								</a>
							</h4>
							<div class="card-tools">
								<button type="button" class="btn btn-xs btn-icon" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon" data-card-widget="maximize">
									<i class="fas fa-expand"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<table id="item" class="table table-striped table-sm">
								<thead class="thead-dark text-center">
									<tr>
										<th width="5%">No</th>
										<th>User</th>
										<th>Brand</th>
										<th>Category</th>
										<th>Part Number</th>
										<th>Assy Code</th>
										<th>Satuan</th>
										<th>Tipe</th>
										<?php if ($this->session->userdata('level') != "sales") :  ?>										
										<th width="9%"><i class="fas fa-cogs"></i></th>
										<?php endif; ?>
										<?php if ($this->session->userdata('level') != "engineering") :  ?>	
										<th width="6%">Approval</th>
										<?php endif; ?>
									</tr>
								</thead>
							</table>
						</div>
					</div>

					<div class="card card-secondary card-outline">
						<div class="card-header">
							<h4 class="card-title"><i class="fa fa-check-square"></i> Master item Approve</h4>
							<div class="card-tools">
								<button type="button" class="btn btn-xs btn-icon"
									data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon"
									data-card-widget="maximize">
									<i class="fas fa-expand"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon"
									data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<table id="item_it" class="table table-hover table-sm">
								<thead class="thead-light text-center">
									<tr>
										<th width="5%">No</th>
										<th>User</th>
										<th>Brand</th>
										<th>Category</th>
										<th>Part Number</th>
										<th>Assy Code</th>
										<th>Satuan</th>
										<th>Tipe</th>
										<th>Status</th>
										<th>Status IT</th>
										<?php if ($this->session->userdata('level') == "admin") :  ?>
										<th width="6%"><i class="fas fa-cogs"></i></th>
										<?php endif ?>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Bootstrap modal-->
<div class="modal fade" id="modal_form" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="col-12 modal-title text-center">Create new item</h5>
			</div>
				<form method="post" id="form">
					<input type="hidden" value="" name="id" />
					<div class="modal-body">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text pr-5">Brand&nbsp;</label>
							</div>
							<input type="text" name="merk" class="form-control" placeholder="Input brand..">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text pr-4">Category&nbsp;&nbsp;&nbsp;</label>
							</div>
							<input type="text" name="kelompok" class="form-control" placeholder="Input category..">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text pr-2">Part Number</label>
							</div>
							<input type="text" name="part_number" class="form-control" placeholder="Input part number..">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text pr-3">Assy Code&nbsp;&nbsp;&nbsp;</label>
							</div>
							<input type="text" name="nama" class="form-control" placeholder="Input assy code..">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text pr-4">Satuan&emsp;&nbsp;&nbsp;</label>
							</div>
							<input type="text" name="satuan" class="form-control" placeholder="Input satuan..">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group mb-0">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text pr-5">Tipe&emsp;</label>
							</div>
							<select name="type" class="form-control">
								<option value="">-Choose Tipe-</option>
								<option value="inventory">Inventory</option>
								<option value="non inventory">Non Inventory</option>
							</select>
							<span class="help-block"></span>
						</div>
					</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button class="btn btn-default" data-dismiss="modal">Close</button>
				<button class="btn btn-success" id="btnSave" onclick="save()">Save</button>
			</div>
			</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals-->

