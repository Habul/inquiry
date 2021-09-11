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
					<?php if($this->session->userdata('level') != "purchase"){	?>
					<div class="col-md-6" style="padding: 0;">
               			<a href="<?php echo base_url('dashboard/inquiry_tambah'); ?>" class="form-control btn btn-success" ><i
                        class="glyphicon glyphicon-plus-sign"></i> Tambah Data Inquiry</a>
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
										<?php if($this->session->userdata('level') != "purchase"){	?>
										<a href="<?php echo base_url().'dashboard/inquiry_edit_sales/'.$p->inquiry_id; ?>" class="btn btn-warning btn-sm" title="Edit Sales"><i class="fa fa-pencil"></i></a>
										<?php }	?>
										<?php if($this->session->userdata('level') != "sales"){	?>
											<?php 
											echo anchor(site_url('dashboard/inquiry_edit/'.$p->inquiry_id),'<i class="fa fa-edit"></i>&nbsp;Edt',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
											echo '  '; 
											echo anchor(site_url('dashboard/inquiry_hapus/'.$p->inquiry_id),'<i class="fa fa-trash"></i>&nbsp;Del','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
											?>
										</td>
									</tr>
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
