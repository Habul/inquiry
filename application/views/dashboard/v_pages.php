<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Pages</h1>
					<small>Manajemen Halaman Website</small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Pages</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<section class="content">
		<div class="container-fluid">
			<a href="<?php echo base_url() . 'dashboard/pages_tambah'; ?>" class="btn btn-sm btn-primary">Buat halaman baru</a>
			<br />
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-header">
							<h3 class="card-title">Data Pages</h3>
						</div>
						<div class="card-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Judul Halaman</th>
										<th>URL Slug</th>
										<th width="15%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($halaman as $h) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $h->halaman_judul; ?></td>
											<td><?php echo base_url() . "page/" . $h->halaman_slug; ?></td>
											<td>
												<a target="_blank" href="<?php echo base_url() . "page/" . $h->halaman_slug; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> </a>
												<a href="<?php echo base_url() . 'dashboard/pages_edit/' . $h->halaman_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
												<a href="<?php echo base_url() . 'dashboard/pages_hapus/' . $h->halaman_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>