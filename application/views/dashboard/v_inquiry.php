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
				<a href="<?php echo base_url().'dashboard/inquiry_tambah'; ?>" class="btn btn-sm btn-primary">Buat Inquiry baru</a>
				<?php }	?>
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">List Inquiry</h3>						
					</div>
					<div class="box-body">
						<table class="table table-bordered">
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
									<?php if($this->session->userdata('level') != "sales"){	?>
									<th width="10%">Action</th>
								</tr>
								<?php }	?>
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
										<?php if($this->session->userdata('level') != "sales"){	?>
										<td style="text-align:center" width="140px">
											<?php 
											echo anchor(site_url('dashboard/inquiry_edit/'.$p->inquiry_id),'<i class="fa fa-edit"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
											echo '  '; 
											echo anchor(site_url('dashboard/inquiry_hapus/'.$p->inquiry_id),'<i class="fa fa-trash"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
											?>
										</td>
									</tr>
										<?php }	?>
								<?php } ?>
							</tbody>
						</table>
						<div class="box-footer clearfix">
							<ul class="pagination pagination-sm no-margin pull-right">
								<li><?php echo $this->pagination->create_links()?></li>
							</ul>
				    </div>
					</div>
					
			</div>
		</div>
	</div>
	</section>
</div>
