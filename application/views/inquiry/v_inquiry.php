<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Inquiry
			<small>inquiry yang sudah di jawab Purchase tidak di munculkan, di pindahkan ke menu <b>VIEW INQUIRY</b></small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<?php if ($this->session->userdata('level') != "purchase") {	?>
							<div class="col-md-6" style="padding: 0;">
								<a class="form-control btn btn-success" data-toggle="modal" data-target="#modal_add_inquiry">
								<i class="glyphicon glyphicon-plus-sign"></i> Tambah Data Inquiry</a>
							</div>
						<?php }	?>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example2" class="table table table-bordered table-hover">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Nama</th>
									<th>Tanggal</th>
									<th>No Inquiry</th>
									<th>Brand Produk</th>
									<th>Description</th>
									<th>Qty</th>
									<th>Deadline</th>
									<th>Keterangan</th>
									<th>Request</th>
									<th width="12%">Action</th>
								</tr>
							</thead>
							<tbody>							
								<?php
								$no = $this->uri->segment('3') + 1;
								$query = $this->db->query("select * from inquiry where fu1 is NULL order by tanggal desc");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->sales; ?></td>
										<td><?php echo $p->tanggal; ?></td>
										<td><?php echo $p->inquiry_id; ?></td>
										<td><?php echo $p->brand; ?></td>
										<td><?php echo $p->desc; ?></td>
										<td><?php echo $p->qty; ?></td>
										<td><?php echo $p->deadline; ?></td>
										<td><?php echo $p->keter; ?></td>
										<td><?php echo $p->request; ?></td>
										<td style="text-align:center">
											<?php if ($this->session->userdata('level') != "purchase") {	?>
												<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->inquiry_id;?>"><i class="fa fa-pencil"></i></a>
											<?php }	?>
											<?php if ($this->session->userdata('level') != "sales") {	?>
												<?php
												echo anchor(site_url('dashboard/inquiry_edit/' . $p->inquiry_id), '<i class="fa fa-edit"></i>&nbsp;Edt', array('title' => 'edit', 'class' => 'btn btn-warning btn-sm'));
												echo '  ';
												echo anchor(site_url('dashboard/inquiry_hapus/' . $p->inquiry_id), '<i class="fa fa-trash"></i>&nbsp;Del', 'title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
												?>
										</td>
									</tr>
								</tbody>
								<?php }	?>
							<?php } ?>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>

<!-- modal add inquiry -->
<div class="modal fade" id="modal_add_inquiry" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel" align="center">Tambah Inquiry</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url('dashboard/inquiry_aksi') ?>">
                <div class="modal-body">
								<div class="form-group">							
									<label class="control-label col-xs-3">No Inquiry</label>
									<div class="col-xs-8">
										<?php 
											$inquiry_id=$this->db->select('inquiry_id')->order_by('inquiry_id',"desc")->limit(1)->get('inquiry')->row();
										?>
									<input type="text" name="inquiry_id" readonly class="form-control" value=<?php echo $inquiry_id->inquiry_id+1 ?> >
									<?php echo form_error('inquiry_id'); ?>
								</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Nama Sales</label>
									<div class="col-xs-8">
										<?php 
											$id_user = $this->session->userdata('id');
											$sales = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
										?>
									<input type="text" name="sales" readonly class="form-control" value="<?php echo $sales->pengguna_nama; ?> ">
									<?php echo form_error('sales'); ?>
								</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Tanggal</label>
									<div class="col-xs-8">
									<?php 
										$now = $this->load->helper('date');
										$format = "%Y-%m-%d %H:%i:%s";
									?>
									<input type="datetime" name="tanggal" readonly class="form-control" value="<?php echo mdate($format); ?>">
									<?php echo form_error('tanggal'); ?>
								</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Request</label>
									<div class="col-xs-8">
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
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Brand Produk</label>
									<div class="col-xs-8">
									<select class="form-control" name="brand">
										<option value="">- Pilih Brand -</option>
										<?php foreach($master as $row):?>
				    					<option value="<?php echo $row->brand;?>"><?php echo $row->brand;?></option>
				    					<?php endforeach;?>
									</select>
									<?php echo form_error('brand'); ?>
								</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Deskripsi</label>
									<div class="col-xs-8">
									<input type="text" name="desc" class="form-control" placeholder="input Desc..">
									<?php echo form_error('desc'); ?>
								</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Quantity</label>
									<div class="col-xs-8">
									<input type="number" name="qty" class="form-control" placeholder="input qty...">
									<?php echo form_error('qty'); ?>
								</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Deadline</label>
									<div class="col-xs-8">
									<input type="date" name="deadline" class="form-control" placeholder="input deadline ..">
									<?php echo form_error('deadline'); ?>
								</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Note</label>
									<div class="col-xs-8">
									<textarea name="keter" class="form-control" rows="3" placeholder="input  .."></textarea>
									<?php echo form_error('keter'); ?>
								</div>
								</div>
                </div>
				<div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>
    </div>
</div>
 <!-- end modal add inquiry -->

  <!-- ============ MODAL EDIT BARANG =============== -->
  <?php foreach($inquiry as $p){ ?>
    <div class="modal fade" id="modal_edit<?php echo $p->inquiry_id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Barang</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url('dashboard/inquiry_update_sales') ?>">
                <div class="modal-body">
									<div class="form-group">
									<label class="control-label col-xs-3">No Inquiry</label>
									<div class="col-xs-8">
										<input type="text" name="id" readonly class="form-control" value="<?php echo $p->inquiry_id; ?>">
									</div>
									</div>
									<div class="form-group">
									<label class="control-label col-xs-3">Nama sales</label>
									<div class="col-xs-8">								
										<?php 
											$id_user = $this->session->userdata('id');
											$sales = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
										?>
									<input type="text" name="sales" readonly class="form-control" value="<?php echo $sales->pengguna_nama; ?> ">
									<?php echo form_error('sales'); ?>
									</div>
										</div>
									<div class="form-group">
										<label class="control-label col-xs-3">Tanggal</label>
										<div class="col-xs-8">
										<?php 
										$now = $this->load->helper('date');
										$format = "%Y-%m-%d %H:%i:%s";
										?>
										<input type="datetime" name="tanggal" readonly class="form-control" value="<?php echo mdate($format); ?>">
										<?php echo form_error('tanggal'); ?>
									</div>
										</div>
									<div class="form-group">
										<label class="control-label col-xs-3">Brand Produk</label>
										<div class="col-xs-8">
										<input type="text" name="brand" readonly class="form-control" value="<?php echo $p->brand; ?>">
										<?php echo form_error('brand'); ?>
									</div>
										</div>
									<div class="form-group">
										<label class="control-label col-xs-3">Deskripsi</label>
										<div class="col-xs-8">
										<input type="text" name="desc" class="form-control" value="<?php echo $p->desc; ?>">
										<?php echo form_error('desc'); ?>
									</div>
										</div>
									<div class="form-group">
										<label class="control-label col-xs-3">Quantity</label>
										<div class="col-xs-8">
										<input type="text" name="qty" class="form-control" value="<?php echo $p->qty; ?>">
										<?php echo form_error('qty'); ?>
									</div>
										</div>
									<div class="form-group">
										<label class="control-label col-xs-3">Deadline</label>
										<div class="col-xs-8">
										<input type="date" name="deadline" class="form-control" value="<?php echo $p->deadline; ?>">
										<?php echo form_error('deadline'); ?>
									</div>
										</div>
									<div class="form-group">
										<label class="control-label col-xs-3">Keterangan</label>
										<div class="col-xs-8">
										<input type='text' name="keter" class="form-control" value="<?php echo $p->keter; ?>">
										<?php echo form_error('keter'); ?>
									</div>
										</div>
                   
                </div>
                <div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
					<button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </form>
			<?php } ?>
            </div>
            </div>
    </div>
    <!--END MODAL EDIT BARANG-->
