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
				<?php if($this->session->userdata('level') != "sales"){	?>
				<?php echo anchor(site_url('dashboard/inquiry_export'), ' <i class="fa fa-file-excel-o"></i> Export to Excel', 'class="btn btn-primary btn-sm"'); ?>
				<?php }	?>
				<br/>
				<br/>
				
				<div class="box">
					<div class="box-header">
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
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
									<th width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = $this->uri->segment('3') + 1;
								foreach($inquiry as $p){ 
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
										<td style="text-align:center" width="140px">
											<?php
											echo anchor(site_url('dashboard/inquiry_view/'.$p->inquiry_id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-primary btn-sm')); 
                    						?></td>
									</tr>
								<?php } ?>
						</tbody>
					<tfoot>
						<tr></tr>
                </tfoot>
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
