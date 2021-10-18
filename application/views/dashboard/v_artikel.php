<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Artikel</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Artikel</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<section class="content">
		<div class="container-fluid">
			<a href="<?php echo base_url() . 'dashboard/artikel_tambah'; ?>" class="btn btn-sm btn-primary">Buat artikel baru</a>
			<br />
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-header">
							<h3 class="card-title">Data Artikel</h3>
						</div>
						<div class="card-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Tanggal</th>
										<th>Artikel</th>
										<th>Author</th>
										<th>Kategori</th>
										<th width="10%">Gambar</th>
										<th>Status</th>
										<th width="15%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($artikel as $a) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo date('d/m/Y H:i', strtotime($a->artikel_tanggal)); ?></td>
											<td>
												<?php echo $a->artikel_judul; ?>
												<br />
												<small class="text-muted">
													<?php echo base_url() . "" . $a->artikel_slug; ?>
												</small>
											</td>
											<td><?php echo $a->pengguna_nama; ?></td>
											<td><?php echo $a->kategori_nama; ?></td>
											<td><img width="100%" class="img-responsive" src="<?php echo base_url() . '/gambar/artikel/' . $a->artikel_sampul; ?>"></td>
											<td>
												<?php
												if ($a->artikel_status == "publish") {
													echo "<span class='label label-success'>Publish</span>";
												} else {
													echo "<span class='label label-danger'>Draft</span>";
												}
												?>
											</td>
											<td>
												<a target="_blank" href="<?php echo base_url() . $a->artikel_slug; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> </a>
												<?php
												// cek apakah penggun yang login adalah penulis
												if ($this->session->userdata('level') == "penulis") {
													// jika penulis, maka cek apakah penulis artikel ini adalah si pengguna atau bukan
													if ($this->session->userdata('id') == $a->artikel_author) {
												?>
														<a href="<?php echo base_url() . 'dashboard/artikel_edit/' . $a->artikel_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
														<?php
														echo anchor(site_url('dashboard/artikel_hapus/' . $a->artikel_id), '<i class="fa fa-trash"></i>', 'title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
														?>
													<?php
													}
												} else {
													// jika yang login adalah admin
													?>
													<a href="<?php echo base_url() . 'dashboard/artikel_edit/' . $a->artikel_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
													<?php
													echo anchor(site_url('dashboard/artikel_hapus/' . $a->artikel_id), '<i class="fa fa-trash"></i>', 'title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
													?>
												<?php
												}
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