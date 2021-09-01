<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Inquiry
			<small>Input Inquiry</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/inquiry_tambah'; ?>" class="btn btn-sm btn-primary">Buat Inquiry baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						
					</div>
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
						</span>												         
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
										<td>
											<a href="<?php echo base_url().'dashboard/inquiry_edit/'.$p->inquiry_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<a href="<?php echo base_url().'dashboard/inquiry_hapus/'.$p->inquiry_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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
