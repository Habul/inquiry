<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Kategori</h1>
					<small>Kategori Artikel</small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Kategori</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<section class="content">
		<div class="container-fluid">
			<a href="<?php echo base_url() . 'dashboard/kategori_tambah'; ?>" class="btn btn-sm btn-primary">Buat Kategori baru</a>
			<br />
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-header">
							<h3 class="card-title">Data Kategori</h3>
						</div>
						<div class="card-body">
							<table id="example2" class="table table table-bordered table-hover">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Kategori</th>
										<th>Slug</th>
										<th width="10%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($kategori as $k) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $k->kategori_nama; ?></td>
											<td><?php echo $k->kategori_slug; ?></td>
											<td>
												<a href="<?php echo base_url() . 'dashboard/kategori_edit/' . $k->kategori_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
												<?php
												echo anchor(site_url('dashboard/kategori_hapus/' . $p->kategori_id), '<i class="fa fa-trash"></i>', 'title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
												?>
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