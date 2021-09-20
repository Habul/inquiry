<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Inquiry
			<small>Tambah Inquiry</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-body">
						<form method="post" action="<?php echo base_url('dashboard/inquiry_aksi') ?>">
							<div class="box-body">
								<div class="form-group">							
									<label>No Inquiry</label>
										<?php 
											$inquiry_id=$this->db->select('inquiry_id')->order_by('inquiry_id',"desc")->limit(1)->get('inquiry')->row();
										?>
									<input type="text" name="inquiry_id" readonly class="form-control" value=<?php echo $inquiry_id->inquiry_id+1 ?> >
									<?php echo form_error('inquiry_id'); ?>
								</div>
								<div class="form-group">
									<label>Nama Sales</label>
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
									<label>Request</label>
									<select class="form-control" name="request">
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
								<div class="form-group">
									<label>Brand Produk</label>
									<select class="form-control" name="brand">
										<option value="">- Pilih Brand -</option>
										<?php foreach($master as $row):?>
				    					<option value="<?php echo $row->brand;?>"><?php echo $row->brand;?></option>
				    					<?php endforeach;?>
									</select>
									<?php echo form_error('brand'); ?>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<input type="text" name="desc" class="form-control" placeholder="input Desc..">
									<?php echo form_error('desc'); ?>
								</div>
									<div class="form-group">
									<label>Quantity</label>
									<input type="number" name="qty" class="form-control" placeholder="input qty...">
									<?php echo form_error('qty'); ?>
								</div>
								<div class="form-group">
									<label>Deadline</label>
									<input type="date" name="deadline" class="form-control" placeholder="input deadline ..">
									<?php echo form_error('deadline'); ?>
								</div>
								<div class="form-group">
									<label>Note</label>
									<textarea name="keter" class="form-control" rows="3" placeholder="input  .."></textarea>
									<?php echo form_error('keter'); ?>
								</div>
								
							</div>
							<div class="box-footer">
								<a href="<?php echo base_url().'dashboard/inquiry'; ?>" class="btn btn-default">Kembali</a>
								<input type="submit" class="btn btn-info pull-right" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
