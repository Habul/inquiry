<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Pengguna</h1>
					<small>Pengguna Website</small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Pengguna</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<section class="content">
		<div class="container-fluid">
			<div class="col-md-3" style="padding: 0;">
				<a href="<?php echo base_url('dashboard/pengguna_tambah'); ?>" class="form-control btn btn-success"><i class="fa fa-plus-square"></i>&nbsp; Tambah Pengguna</a>
			</div>
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped table-sm">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="5%">No</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Username</th>
										<th>Level</th>
										<th>Status</th>
										<th width="10%">Action</i></th>
									</tr>
								</thead>
								<?php
								$no = 1;
								foreach ($pengguna as $p) {
								?>
									<tr>
										<td style="text-align:center"><?php echo $no++; ?></td>
										<td><?php echo $p->pengguna_nama; ?></td>
										<td><?php echo $p->pengguna_email; ?></td>
										<td><?php echo $p->pengguna_username; ?></td>
										<td><?php echo $p->pengguna_level; ?></td>
										<td>
											<?php
											if ($p->pengguna_status == 1) {
												echo "Aktif";
											} else {
												echo "Non Aktif";
											}
											?>
										</td>
										<td style="text-align:center">
											<?php
											echo anchor(site_url('dashboard/pengguna_edit/' . $p->pengguna_id), '<i class="fa fa-edit"></i>', array('title' => 'edit', 'class' => 'btn btn-warning btn-sm'));
											echo '  ';
											echo anchor(site_url('dashboard/pengguna_hapus/' . $p->pengguna_id), '<i class="fa fa-trash"></i>', 'title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
											?>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>