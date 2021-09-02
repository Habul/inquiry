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
				<a href="<?php echo base_url().'dashboard/inquiry'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				<br/>
				<br/>
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Inquiry</h3>
					</div>
					<div class="box-body">
						<?php foreach($inquiry as $p){ ?>
							<form method="post" action="<?php echo base_url('dashboard/inquiry_update') ?>">
								<div class="box-body">
									<input type="hidden" name="id" value="<?php echo $p->inquiry_id; ?>">
									<div class="form-group">
										<input type="hidden" name="id" value="<?php echo $p->pengguna_id; ?>">
										No Inquiry &nbsp;:&nbsp;<b><?php echo $p->inquiry_id; ?></b><br>
										Nama Sales &nbsp;:&nbsp;<b><?php echo $p->sales; ?></b><br>
										Brand &nbsp;:&nbsp;<b><?php echo $p->brand; ?></b><br>
										Desc &nbsp;:&nbsp;<b><?php echo $p->desc; ?></b><br>
										Qty &nbsp;:&nbsp;<b><?php echo $p->qty; ?></b><br>
										Deadline &nbsp;:&nbsp;<b><?php echo $p->deadline; ?></b><br>
										Keterangan &nbsp;:&nbsp;<b><?php echo $p->keter; ?></b><br>
										Request &nbsp;:&nbsp;<b><?php echo $p->request; ?></b><br>
									</div>
									<div class="form-group">
										<label>Check</label>
										<input type="text" name="cek" class="form-control" value="<?php echo $p->cek; ?>">
										<?php echo form_error('cek'); ?>
									</div>
									<div class="form-group">
										<label>Follow Up1</label>
										<input type="date" name="fu1" class="form-control" value="<?php echo $p->fu1; ?>">
										<?php echo form_error('fu1'); ?>
									</div>
									<div class="form-group">
										<label>Follow Up2</label>
										<input type="date" name="fu2" class="form-control" value="<?php echo $p->fu2; ?>">
										<?php echo form_error('fu2'); ?>
									</div>
									<div class="form-group">
										<label>Follow Up3</label>
										<input type="date" name="fu3" class="form-control" value="<?php echo $p->fu3; ?>">
										<?php echo form_error('fu3'); ?>
									</div>
									<div class="form-group">
										<label>Keterangan Fu</label>
										<input type="text" name="ket_fu" class="form-control" value="<?php echo $p->ket_fu; ?>">
										<?php echo form_error('ket_fu'); ?>
									</div>
									<div class="form-group">
										<label>Cogs</label>
										<input type="text" name="cogs" class="form-control" value="<?php echo $p->cogs; ?>" placeholder="Isi Cogs..">
										<?php echo form_error('cogs'); ?>
									</div>
									<div class="form-group">
										<label>Kurs</label>
										<input type="text" name="kurs" class="form-control" value="<?php echo $p->kurs; ?>" placeholder="Isi Kurs..">
										<?php echo form_error('kurs'); ?>
									</div>
									<div class="form-group">
										<label>Cogs IDR</label>
										<input type="text" name="cogs_idr" class="form-control" value="<?php echo $p->cogs_idr; ?>" placeholder="Cogs Idr..">
										<?php echo form_error('cogs_idr'); ?>
									</div>
									<div class="form-group">
										<label>Reseller</label>
										<input type="text" name="reseller" class="form-control"  value="<?php echo $p->reseller; ?>" placeholder="Rp..">
										<?php echo form_error('reseller'); ?>
									</div>
									<div class="form-group">
										<label>New Seller</label>
										<input type="text" name="new_seller" class="form-control"  value="<?php echo $p->new_seller; ?>" placeholder="Rp..">
										<?php echo form_error('new_seller'); ?>
									</div>
									<div class="form-group">
										<label>User</label>
										<input type="text" name="user" class="form-control"  value="<?php echo $p->user; ?>" placeholder="Rp..">
										<?php echo form_error('user'); ?>
									</div>
									<div class="form-group">
										<label>Delivery</label>
										<input type="text" name="delivery" class="form-control"  value="<?php echo $p->delivery; ?>" placeholder="delivery...">
										<?php echo form_error('delivery'); ?>
									</div>
									<div class="form-group">
										<label>Ket Purchase</label>
										<input type="text" name="ket_purch" class="form-control"  value="<?php echo $p->ket_purch; ?>" placeholder="Keterangan...">
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
