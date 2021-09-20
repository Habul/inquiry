<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Master Inquiry
			<small>Inquiry Marketing - Purchasing</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
					<div class="col-md-6" style="padding: 0;">
               			<a href="<?php echo base_url('dashboard/inquiry_master_tambah'); ?>" class="form-control btn btn-success" ><i
                        class="glyphicon glyphicon-plus-sign"></i> Tambah Data Master</a>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table table-bordered table-hover">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Brand Produk</th>
									<th>D1</th>
									<th>D2</th>
									<th>User</th>
									<th>Manufacture/Distributor</th>
									<th width="12%">Action</th>
								</tr>
								
							</thead>
							<tbody>
								<?php
								$no = $this->uri->segment('3') + 1;
								$query = $this->db->query("select * from master");
								foreach ($query->result() as $p){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->brand; ?></td>
										<td><?php echo $p->d1; ?></td>
										<td><?php echo $p->d2; ?></td>
										<td><?php echo $p->user; ?></td>
										<td><?php echo $p->distributor; ?></td>
										<td style="text-align:center">
											<?php 
											echo anchor(site_url('dashboard/inquiry_master_edit/'.$p->id_master),'<i class="fa fa-edit"></i>&nbsp;Edt',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
											echo '  '; 
											echo anchor(site_url('dashboard/inquiry_master_hapus/'.$p->id_master),'<i class="fa fa-trash"></i>&nbsp;Del','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
											?>
										</td>
									</tr>
						<?php }	?>
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
