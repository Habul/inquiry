<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Inquiry
			<small>Inquiry Marketing - Purchasing</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<?php if ($this->session->userdata('level') != "sales") {	?>
							<div class="col-md-6" style="padding: 0;">
								<a href="<?php echo base_url('inquiry/inquiry_export'); ?>" class="form-control btn btn-success"><i class="glyphicon glyphicon glyphicon-open-file"></i></i> Export To Excel </a>
							</div>
					</div>
				<?php }	?>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-hover">
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
								<th>Request</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<?php
						$no = $this->uri->segment('3') + 1;
						$query = $this->db->query("SELECT * FROM inquiry WHERE fu1 IS NOT NULL ORDER BY fu1 DESC ");
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
								<td><?php echo $p->request; ?></td>
								<td style="text-align:center">
								<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->inquiry_id;?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</a>
								</td>
							</tr>
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

<!-- ============ MODAL VIEW INQUIRY =============== -->
<?php foreach($inquiry as $p): ?>
<div class="modal fade" id="modal_edit<?php echo $p->inquiry_id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel" align="center">Detail Inquiry</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url('inquiry/inquiry_detail') ?>">
                <div class="modal-body">
				<div class="form-group">
                  <label class="col-sm-2 control-label">No Inquiry</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="id" readonly value="<?php echo $p->inquiry_id; ?> ">
                  </div>
                </div>				
        		<div class="form-group">
                  <label class="col-sm-2 control-label">Sales</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->sales; ?>" >
                  </div>
                </div>
        		<div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="datetime" class="form-control" readonly value="<?php echo $p->tanggal; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Brand</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->brand; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->desc; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->qty; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Deadline</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" readonly value="<?php echo $p->deadline; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Ket(Sales)</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" readonly ><?php echo $p->keter; ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Request</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->request; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Check</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" readonly value="<?php echo $p->cek; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Follow Up</label>
                  <div class="col-sm-10">
                    <input type="datetime" class="form-control" readonly value="<?php echo $p->fu1; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Ket(FU)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->ket_fu; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Reseller</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="Rp <?php echo number_format($p->reseller, 0, '.', '.'); ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">New Seller</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="Rp <?php echo number_format($p->new_seller, 0, '.', '.'); ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">User</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="Rp <?php echo number_format($p->user, 0, '.', '.'); ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Delivery</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->delivery; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Purchase</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->name_purch; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Ket(Purchase)</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" readonly rows="3" ><?php echo $p->ket_purch; ?></textarea>
                  </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Kembali</button>
                </div>
            </form>
            </div>
            </div>
        </div>
<?php endforeach;?>