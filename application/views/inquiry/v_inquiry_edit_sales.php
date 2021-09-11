<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Edit Inquiry
			<small>Sales</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-body">
						<?php foreach($inquiry as $p){ ?>
							<form method="post" action="<?php echo base_url('dashboard/inquiry_update_sales') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>No Inquiry</label>
										<input type="text" name="id" readonly class="form-control" value="<?php echo $p->inquiry_id; ?>">
									</div>
									<div class="form-group">
									<label>Nama sales</label>
										<?php 
											$id_user = $this->session->userdata('id');
											$sales = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
										?>
									<input type="text" name="sales" readonly class="form-control" value="<?php echo $sales->pengguna_nama; ?> ">
									<?php echo form_error('sales'); ?>
									</div>
									<div class="form-group">
										<label>Tanggal</label>
										<?php 
										$now = $this->load->helper('date');
										$format = "%Y-%m-%d %H:%i:%s";
										?>
										<input type="datetime" name="tanggal" readonly class="form-control" value="<?php echo mdate($format); ?>">
										<?php echo form_error('tanggal'); ?>
									</div>
									<div class="form-group">
										<label>Brand Produk</label>
										<input type="text" name="brand" readonly class="form-control" value="<?php echo $p->brand; ?>">
										<?php echo form_error('brand'); ?>
									</div>
									<div class="form-group">
										<label>Deskripsi</label>
										<input type="text" name="desc" class="form-control" value="<?php echo $p->desc; ?>">
										<?php echo form_error('desc'); ?>
									</div>
									<div class="form-group">
										<label>Quantity</label>
										<input type="text" name="qty" class="form-control" value="<?php echo $p->qty; ?>">
										<?php echo form_error('qty'); ?>
									</div>
									<div class="form-group">
										<label>Deadline</label>
										<input type="date" name="deadline" class="form-control" value="<?php echo $p->deadline; ?>">
										<?php echo form_error('deadline'); ?>
									</div>
									<div class="form-group">
										<label>Keterangan</label>
										<input type='text' name="keter" class="form-control" value="<?php echo $p->keter; ?>">
										<?php echo form_error('keter'); ?>
									</div>
								</div>
								<div class="box-footer">
									<a href="<?php echo base_url().'dashboard/inquiry'; ?>" class="btn btn-default">Kembali</a>
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
