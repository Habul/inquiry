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
								<a href="<?php echo base_url('inquiry/buffer_export'); ?>" class="form-control btn btn-success"><i class="glyphicon glyphicon glyphicon-open-file"></i></i> Export To Excel </a>
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
									<th>Brand Produk</th>
									<th>Description</th>
									<th>Qty</th>
									<th>Keterangan</th>
									<th width="12%">Action</th>
							</tr>
						</thead>
						<?php
						$no = $this->uri->segment('3') + 1;
						$query = $this->db->query("SELECT * FROM `buffer` WHERE status='approve' order by fu");
						foreach ($query->result() as $p) {
						?>
							<tr>
                            <td><?php echo $no++; ?></td>
								<td><?php echo $p->sales; ?></td>
								<td><?php echo $p->tanggal; ?></td>
								<td><?php echo $p->brand; ?></td>
								<td><?php echo $p->deskripsi; ?></td>
								<td><?php echo $p->qty; ?></td>
								<td><?php echo $p->keter; ?></td>
								<td style="text-align:center">
								<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->id_buffer;?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</a>
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

<!-- ============ MODAL VIEW BUFFER =============== -->
<?php foreach($buffer as $p): ?>
<div class="modal fade" id="modal_edit<?php echo $p->id_buffer;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel" align="center">Detail Inquiry</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url('buffer/buffer_view') ?>">
                <div class="modal-body">
				<div class="form-group">
                  <label class="col-sm-2 control-label">No Inquiry</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->id_buffer; ?> ">
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
                    <input type="text" class="form-control" readonly value="<?php echo $p->deskripsi; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->qty; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Keter(Sales)</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" readonly><?php echo $p->keter; ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">status</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->status; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">PR No</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->pr_no; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Keter(WH)</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" readonly><?php echo $p->ket_wh; ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Warehouse</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->wh; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Follow Up</label>
                  <div class="col-sm-10">
                    <input type="datetime" class="form-control" readonly value="<?php echo $p->fu; ?>" >
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