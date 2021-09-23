<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kurs Inquiry
			<small>Inquiry Marketing - Purchasing</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<div class="col-md-6" style="padding: 0;">
               			<a href="<?php echo base_url('dashboard/inquiry_kurs_tambah'); ?>" class="form-control btn btn-success"><i
                        	class="glyphicon glyphicon-plus-sign"></i> Tambah Data Kurs</a>
						</div>
						<div class="col-md-3">
							<a href="<?php echo base_url('dashboard/inquiry_kurs_export'); ?>" class="form-control btn btn-default"><i
							class="glyphicon glyphicon glyphicon-floppy-open"></i> Export Data Excel</a>
						</div>
						<div class="col-md-3">
							<a href="<?php echo base_url('dashboard/inquiry_kurs_import'); ?>" class="form-control btn btn-default"><i
							class="glyphicon glyphicon glyphicon-floppy-save"></i> Import Data Excel</a>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example2" class="table table table-bordered table-hover">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Currency</th>
									<th>Amount</th>
									<th width="15%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = $this->uri->segment('3') + 1;
								$query = $this->db->query("select * from kurs");
								foreach ($query->result() as $p){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->currency; ?></td>
										<td><?php echo number_format($p->amount, 0, '.', '.'); ?></td>
										<td style="text-align:center">
											<?php 
											echo anchor(site_url('dashboard/inquiry_kurs_edit/'.$p->id_kurs),'<i class="fa fa-edit"></i> &nbsp; Edt',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
											echo '  '; 
											echo anchor(site_url('dashboard/inquiry_kurs_hapus/'.$p->id_kurs),'<i class="fa fa-trash"></i>&nbsp; Del','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
