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
				<?php if($this->session->userdata('level') != "purchase"){	?>
				<?php echo anchor(site_url('dashboard/inquiry_tambah'), ' <i class="fa fa-file-text-o"></i> &nbsp; Buat Inquiry baru', 'class="btn btn-primary btn-sm"'); ?>
				<?php }	?>
				<br/>
				<br/>
				<div class="box">
					<div class="box-header">
						<center><h3 class="box-title">Inquiry yang sudah di jawab Purchase tidak di munculkan, di pindahkan ke menu <b>VIEW INQUIRY</b></h3></center>						
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
									<th width="10%">Action</th>
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
										<a href="<?php echo base_url().'dashboard/inquiry_edit_sales/'.$p->inquiry_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
										<?php }	?>
										<?php if($this->session->userdata('level') != "sales"){	?>
											<?php 
											echo anchor(site_url('dashboard/inquiry_edit/'.$p->inquiry_id),'<i class="fa fa-edit"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
											echo '  '; 
											echo anchor(site_url('dashboard/inquiry_hapus/'.$p->inquiry_id),'<i class="fa fa-trash"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
