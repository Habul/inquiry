<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Update Order & Tracking Delivery</h1>
		  <small>Pastikan kurs dan master sudah di update</small>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('inquiry/inquiry') ?>">Inquiry</a></li>
            <li class="breadcrumb-item active">Update Inquiry</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-edit"></i> Update Inquiry Purchase</h3>
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
              <?php foreach ($inquiry as $p) : ?>
                <form onsubmit="updbtn.disabled = true; return true;" method="post" action="<?php echo base_url('inquiry/inquiry_update') ?>">					
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">No Inquiry</label>
							<div class="col-sm-10">
								<input type="text" name="id" class="form-control" readonly value="<?php echo $p->inquiry_id; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Sales</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" readonly value="<?php echo $p->sales; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Brand</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" readonly value="<?php echo $p->brand; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Desc Produk</label>
							<div class="col-sm-10">
								<textarea class="form-control" readonly><?php echo $p->desc; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Qty</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" readonly value="<?php echo $p->qty; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Deadline</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" readonly value="<?php echo $p->deadline; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Request</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" readonly value="<?php echo $p->request; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Ket(Sales)</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" readonly value="<?php echo $p->keter; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Purchase</label>
							<div class="col-sm-10">
								<input type="text" name="name_purch" readonly class="form-control" value="<?php echo $this->session->userdata('nama'); ?> ">
								<?php echo form_error('name_purch'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Follow UP</label>
							<div class="col-sm-10">
								<?php
								$now = $this->load->helper('date');
								$format = "%Y-%m-%d %H:%i:%s";
								?>
								<input type="datetime" name="fu1" readonly class="form-control" value="<?php echo mdate($format); ?>">
								<?php echo form_error('fu1'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Check *</label>
							<div class="col-sm-10">
								<input type="number" name="cek" class="form-control" min="1" placeholder="Cek.." required>
								<?php echo form_error('cek'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Ket Fu</label>
							<div class="col-sm-10">
								<input type="text" name="ket_fu" class="form-control" placeholder="Keterangan Fu..">
								<?php echo form_error('ket_fu'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Kurs *</label>
							<div class="col-sm-10">
								<select class="form-control" id="kurs" name="kurs" onchange="myKurs()" required>
									<option value="">- Pilih Kurs -</option>
									<?php foreach ($kurs as $row) : ?>
										<option value="<?php echo $row->id_kurs; ?>"><?php echo $row->currency; ?></option>
									<?php endforeach; ?>
								</select>
								<?php echo form_error('kurs'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Cogs *</label>
							<div class="col-sm-10">
								<input type="hidden" id="amount" class="form-control" id="amount">
								<input type="number" id="cogs" min="0.001" step="0.001" name="cogs" class="form-control" onchange="changeTipe();" placeholder="Isi Cogs.." required>
								<?php echo form_error('cogs'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Cogs IDR *</label>
							<div class="col-sm-10">
								<input type="number" id="cogs_idr" name="cogs_idr" class="form-control" placeholder="Isi Cogs IDR.." required>
								<?php echo form_error('cogs_idr'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Reseller *</label>
							<div class="col-sm-10">
								<input type="number" id="reseller" name="reseller" class="form-control" placeholder="Isi Rp Reseller.." required>
								<?php echo form_error('reseller'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">New Seller</label>
							<div class="col-sm-10">
								<input type="number" id="new_seller" name="new_seller" class="form-control" placeholder="Isi Rp New Seller.." required>
								<?php echo form_error('new_seller'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">User *</label>
							<div class="col-sm-10">
								<input type="number" id="user " name="user" class="form-control" placeholder="Isi Rp User.." required>
								<?php echo form_error('user'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Delivery *</label>
							<div class="col-sm-10">
								<input type="text" name="delivery" class="form-control" placeholder="Delivery.." required>
								<?php echo form_error('delivery'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Ket Purchase</label>
							<div class="col-sm-10">
								<textarea name="ket_purch" class="form-control" placeholder="Keterangan..."></textarea>
								<?php echo form_error('ket_purch'); ?>
							</div>
						</div>					
					<div class="card-footer justify-content-between">
						<a href="<?php echo base_url('inquiry/inquiry') ?>" class="btn btn-default"><i class="fa fa-share"></i> Back</a>
						<button class="btn btn-primary float-right" id="updbtn"><i class="fa fa-check"></i> Save</button>
					</div>
				</form>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-dollar-sign"></i> Kurs</h3>
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
			<table id="example5" class="table table-bordered table-hover table-sm">
				<thead class="thead-dark" style="text-align:center">
					<tr>
						<th>No</th>
						<th>Currency</th>
						<th>Amount</th>						
					</tr>
				</thead>
				<?php
				$no = 1;
				foreach ($kurs as $p) : ?>
					<tr style="text-align:center">
						<td><?php echo $no++ ?></td>
						<td><?php echo $p->currency; ?></td>
						<td><?php echo number_format($p->amount, 0, '.', '.'); ?></td>						
					</tr>
				<?php endforeach ?>
			</table>
            <?php endforeach; ?>
            </div>
          </div>
		  <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-chart-bar"></i> Master</h3>
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
			<table id="example12" class="table table-bordered table-hover table-sm">
				<thead class="thead-dark" style="text-align:center">
					<tr>
						<th width="5%">No</th>
						<th>Brand Produk</th>
						<th>D1</th>
						<th>D2</th>
						<th>User</th>
						<th>Manufacture/Distributor</th>					
					</tr>
				</thead>
				<?php
				$no = 1;
				foreach ($master as $p) : ?>
					<tr>
						<td style="text-align:center"><?php echo $no++; ?></td>
						<td><?php echo $p->brand; ?></td>
						<td style="text-align:center"><?php echo $p->d1; ?></td>
						<td style="text-align:center"><?php echo $p->d2; ?></td>
						<td style="text-align:center"><?php echo $p->user; ?></td>
						<td><?php echo $p->distributor; ?></td>
				</tr>				
				<?php endforeach ?>
			</table>           
            </div>
          </div>
        </div>
      </div>
  </section>
</div>