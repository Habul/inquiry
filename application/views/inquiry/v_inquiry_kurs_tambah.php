<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kurs Inquiry
			<small>Tambah Kurs</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/inquiry_kurs'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				<br/>
				<br/>
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Kurs Inquiry</h3>
					</div>
					<div class="box-body">
						<form method="post" action="<?php echo base_url('dashboard/inquiry_kurs_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<?php 
									$id_kurs=$this->db->select('id_kurs')->order_by('id_kurs',"desc")->limit(1)->get('kurs')->row();
									?>
									<input type="hidden" name="id_kurs" class="form-control" value=<?php echo $id_kurs->id_kurs+1 ?> >
									<?php echo form_error('id_kurs'); ?>
								</div>
								<div class="form-group">
									<label>Currency</label>
									<input type="text" name="currency" class="form-control" placeholder="input currency..">
									<?php echo form_error('currency'); ?>
								</div>
								<div class="form-group">
									<label>Amount</label>
									<input type="number" name="amount" class="form-control" placeholder="input amount...">
									<?php echo form_error('amount'); ?>
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
