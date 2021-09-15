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
				<div class="box box-primary">
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
										<input type="number" name="cek" class="form-control" placeholder="Cek..">
										<?php echo form_error('cek'); ?>
									</div>
									<div class="form-group">
										<label>Keterangan Fu</label>
										<input type="text" name="ket_fu" class="form-control" placeholder="Keterangan Fu..">
										<smal>*Kosongkan jika tidak di perlukan</smal>
										<?php echo form_error('ket_fu'); ?>
									</div>
									<div class="form-group">
										<label>Kurs</label>
										<select class="form-control" id="kurs" name="kurs" onchange="changeTipe();" >
											<option value="">- Pilih Kurs -</option>
											<option value="1">AUD</option>
											<option value="2">EUR</option>
											<option value="3">GBP</option>
											<option value="4">IDR</option>
											<option value="5">JPY</option>
											<option value="6">MYR</option>
											<option value="7">SGD</option>
											<option value="8">USD</option>
											<option value="9">NZD</option>
										</select>
										<?php echo form_error('kurs'); ?>
									</div>
									<div class="form-group">
										<label>Cogs</label>
										<input type="number" id="cogs" min="0.001" step="0.001" name="cogs" class="form-control" onchange="changeTipe();" placeholder="Isi Cogs..">
										<?php echo form_error('cogs'); ?>
									</div>
									<div class="form-group">
										<label>Cogs IDR</label>
										<input type="number" readonly name="cogs_idr" class="form-control" placeholder="Cogs Idr..">
										<?php echo form_error('cogs_idr'); ?>
									</div>
									<div class="form-group">
										<label>Reseller</label>
										<input type="number" readonly name="reseller" class="form-control" placeholder="Rp..">
										<?php echo form_error('reseller'); ?>
									</div>
									<div class="form-group">
										<label>New Seller</label>
										<input type="number" readonly name="new_seller" class="form-control" placeholder="Rp..">
										<?php echo form_error('new_seller'); ?>
									</div>
									<div class="form-group">
										<label>User</label>
										<input type="number" readonly name="user" class="form-control" placeholder="Rp..">
										<?php echo form_error('user'); ?>
									</div>
									<div class="form-group">
										<label>Delivery</label>
										<input type="text" name="delivery" class="form-control" placeholder="Delivery..">
										<?php echo form_error('delivery'); ?>
									</div>
									<div class="form-group">
										<label>Ket Purchase</label>
										<textarea name="ket_purch" class="form-control" rows="3" placeholder="Keterangan..."></textarea>
										<?php echo form_error('ket_purch'); ?>
									</div>
								
								<div class="box-footer">
									<a href="<?php echo base_url() . 'dashboard/inquiry'; ?>" class="btn btn-default">Kembali</a>
									<input type="submit" class="btn btn-info pull-right" value="Simpan">
								</div>
								</div>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$('#category').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('dashboard/get_sub_kurs');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id_kurs+'>'+data[i].amount+'</option>';
                        }
                        $('#sub_category').html(html);
                    }
                });
                return false;
            }); 
		});
	</script>
</script>
