<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Edit Inquiry
			<small>Purchasing</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url() . 'dashboard/inquiry'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				<br />
				<br />
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Edit Inquiry</h3>
					</div>
					<div class="box-body">
						<?php foreach ($inquiry as $p) { ?>
							<form method="post" action="<?php echo base_url('dashboard/inquiry_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<input type="hidden" name="id" value="<?php echo $p->inquiry_id; ?>">
										No &nbsp;:&nbsp;<b><?php echo $p->inquiry_id; ?></b><br>
										Nama &nbsp;:&nbsp;<b><?php echo $p->sales; ?></b><br>
										Brand &nbsp;:&nbsp;<b><?php echo $p->brand; ?></b><br>
										Descript &nbsp;:&nbsp;<b><?php echo $p->desc; ?></b><br>
										Quantity &nbsp;:&nbsp;<b><?php echo $p->qty; ?></b><br>
										Deadline &nbsp;:&nbsp;<b><?php echo $p->deadline; ?></b><br>
										Request &nbsp;:&nbsp;<b><?php echo $p->request; ?></b><br>
										Keterangan &nbsp;:&nbsp;<b><?php echo $p->keter; ?></b><br>
										Tanggal Buat &nbsp;:&nbsp;<b><?php echo $p->tanggal; ?></b><br>
									</div>
									<div class="form-group">
										<label>Nama Purchase</label>
										<?php
										$id_user = $this->session->userdata('id');
										$purchase = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
										?>
										<input type="text" name="name_purch" readonly class="form-control" value="<?php echo $purchase->pengguna_nama; ?> ">
										<?php echo form_error('name_purch'); ?>
									</div>
									<div class="form-group">
										<label>Follow UP</label>
										<?php
										$now = $this->load->helper('date');
										$format = "%Y-%m-%d %H:%i:%s";
										?>
										<input type="datetime" name="fu1" readonly class="form-control" value="<?php echo mdate($format); ?>">
										<?php echo form_error('fu1'); ?>
									</div>
									<div class="form-group">
										<label>Check</label>
										<input type="number" name="cek" class="form-control" value="<?php echo $p->cek; ?>" placeholder="Cek..">
										<?php echo form_error('cek'); ?>
									</div>

									<div class="form-group">
										<label>Keterangan Fu</label>
										<input type="text" name="ket_fu" class="form-control" value="<?php echo $p->ket_fu; ?>" placeholder="Keterangan Fu..">
										<?php echo form_error('ket_fu'); ?>
									</div>
									<div class="form-group">
										<label>Cogs</label>
										<input type="number" min="0.001" step="0.001" name="cogs" class="form-control" value="<?php echo $p->cogs; ?>" placeholder="Isi Cogs..">
										<?php echo form_error('cogs'); ?>
									</div>
									<div class="form-group">
										<label>Kurs</label>
										<input type="text" name="kurs" class="form-control" value="<?php echo $p->kurs; ?>" placeholder="Eur,Jpy,Sgd,Usd">
										<?php echo form_error('kurs'); ?>
									</div>
									<div class="form-group">
										<label>Cogs IDR</label>
										<input type="text" name="cogs_idr" class="form-control" value="<?php echo $p->cogs_idr; ?>" placeholder="Cogs Idr..">
										<?php echo form_error('cogs_idr'); ?>
									</div>
									<div class="form-group">
										<label>Reseller</label>
										<input type="number" name="reseller" class="form-control" value="<?php echo $p->reseller; ?>" placeholder="Rp..">
										<?php echo form_error('reseller'); ?>
									</div>
									<div class="form-group">
										<label>New Seller</label>
										<input type="number" name="new_seller" class="form-control" value="<?php echo $p->new_seller; ?>" placeholder="Rp..">
										<?php echo form_error('new_seller'); ?>
									</div>
									<div class="form-group">
										<label>User</label>
										<input type="number" name="user" class="form-control" value="<?php echo $p->user; ?>" placeholder="Rp..">
										<?php echo form_error('user'); ?>
									</div>
									<div class="form-group">
										<label>Delivery</label>
										<input type="text" name="delivery" class="form-control" value="<?php echo $p->delivery; ?>" placeholder="Delivery..">
										<?php echo form_error('delivery'); ?>
									</div>
									<div class="form-group">
										<label>Ket Purchase</label>
										<textarea name="ket_purch" class="form-control" rows="3" value="<?php echo $p->ket_purch; ?>" placeholder="Keterangan..."></textarea>
										<?php echo form_error('ket_purch'); ?>
									</div>
								</div>
								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Simpan">
								</div>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
