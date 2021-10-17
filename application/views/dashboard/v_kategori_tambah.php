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
			<div class="row">
				<div class="col-md-6">
					<div class="card card-success">
						<div class="card-header">
							<h3 class="card-title">Tambah Kategori</h3>
						</div>
						<form method="post" action="<?php echo base_url('dashboard/kategori_aksi') ?>">
							<div class="card-body">
								<div class="form-group">
									<label>Nama Kategori</label>
									<input type="text" name="kategori" class="form-control" placeholder="Masukkan nama kategori ..">
									<?php echo form_error('kategori'); ?>
								</div>
							</div>

							<div class="card-footer">
								<button type="submit" class="btn btn-info">Simpan</button>
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>