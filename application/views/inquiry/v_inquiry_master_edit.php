<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Edit Master Inquiry
			<small>Purchasing</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-body">
						<?php foreach ($master as $p) { ?>
							<form method="post" action="<?php echo base_url('dashboard/inquiry_master_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Brand Produk</label>
										<input type="hidden" name="id" value="<?php echo $p->id_master; ?>">
										<input type="text" readonly name="brand" class="form-control" value="<?php echo $p->brand; ?>">
										<?php echo form_error('brand'); ?>
									</div>
									<div class="form-group">
										<label>D1</label>
										<input type="number" min="0.1" step="0.1" name="d1" class="form-control" value="<?php echo $p->d1; ?>">
										<?php echo form_error('d1'); ?>
									</div>
									<div class="form-group">
										<label>D2</label>
										<input type="number" min="0.1" step="0.1" name="d2" class="form-control" value="<?php echo $p->d2; ?>">
										<?php echo form_error('d2'); ?>
									</div>
									<div class="form-group">
										<label>User</label>
										<input type="number" min="0.1" step="0.1" name="user" class="form-control" value="<?php echo $p->user; ?>">
										<?php echo form_error('user'); ?>
									</div>
									<div class="form-group">
										<label>Distributor/Manufature</label>
										<input type="text" name="distributor" class="form-control" value="<?php echo $p->distributor; ?>">
										<?php echo form_error('distributor'); ?>
									</div>
								</div>
								<div class="box-footer">
									<a href="<?php echo base_url(). 'dashboard/inquiry_master'; ?>" class="btn btn-default">Kembali</a>
									<button type="submit" class="btn btn-info pull-right">Simpan</button>
								</div>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
