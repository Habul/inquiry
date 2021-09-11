<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Edit Kurs Inquiry
			<small>Purchasing</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-body">
						<?php foreach ($kurs as $p) { ?>
							<form method="post" action="<?php echo base_url('dashboard/inquiry_kurs_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Brand Produk</label>
										<input type="hidden" name="id" value="<?php echo $p->id_kurs; ?>">
										<input type="text" readonly name="currency" class="form-control" value="<?php echo $p->currency; ?>">
										<?php echo form_error('currency'); ?>
									</div>
									<div class="form-group">
										<label>Amount</label>
										<input type="number" name="amount" class="form-control" value="<?php echo $p->amount; ?>">
										<?php echo form_error('amount'); ?>
									</div>
								</div>
								<div class="box-footer">
									<a href="<?php echo base_url() . 'dashboard/inquiry_kurs'; ?>" class="btn btn-default">Kembali</a>
									<input type="submit" class="btn btn-info pull-right" value="Simpan">
								</div>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
