<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Master Inquiry
			<small>Tambah Master</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/inquiry_master'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				<br/>
				<br/>
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Master Inquiry</h3>
					</div>
					<div class="box-body">
						<form method="post" action="<?php echo base_url('dashboard/inquiry_master_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Brand Produk</label>
									<input type="text" name="brand" class="form-control" placeholder="input brand..">
									<?php echo form_error('brand'); ?>
								</div>
									<div class="form-group">
									<label>D1</label>
									<input type="number"  min="0.1" step="0.1"  name="d1" class="form-control" placeholder="input d1...">
									<?php echo form_error('d1'); ?>
								</div>
								<div class="form-group">
									<label>D2</label>
									<input type="number" min="0.1" step="0.1" name="d2" class="form-control" placeholder="input d2 ..">
									<?php echo form_error('d2'); ?>
								</div>
								<div class="form-group">
									<label>User</label>
									<input type="number" min="0.1" step="0.1" name="user" class="form-control" placeholder="input user ..">
									<?php echo form_error('user'); ?>
								</div>
								<div class="form-group">
									<label>Manufacture/Distributor</label>
									<input type='text' name="distributor" class="form-control" placeholder="input .."></input>
									<?php echo form_error('distributor'); ?>
								</div>
								
							</div>
							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
