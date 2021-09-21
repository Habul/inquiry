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
					<?php if($this->session->userdata('level') != "sales"){	?>
					<div class="col-md-3">
						<a href="<?php echo base_url('dashboard/inquiry_export'); ?>" class="form-control btn btn-default"><i
                         class="glyphicon glyphicon glyphicon-floppy-open"></i> Export To Excel </a>
          				</div>
					</div>
					<?php }	?>
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
								$query = $this->db->query("SELECT * FROM inquiry WHERE fu1 IS NOT NULL ORDER BY fu1 DESC ");
								foreach ($query->result() as $p){ 
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
											<?php
											echo anchor(site_url('dashboard/inquiry_detail/'.$p->inquiry_id),'<i class="fa fa-eye"></i>&nbsp;Detail',array('title'=>'detail','class'=>'btn btn-primary btn-sm')); 
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
