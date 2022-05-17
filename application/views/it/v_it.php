<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Data Penting</h1>
					<small>Pindahan file TXT dan IMG di 217</small>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Data Penting</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-header">
							<h6 class="card-title"><a class="form-control btn btn-success col-15 shadow" data-toggle="modal" data-target="#modal_add">
									<i class="fa fa-plus"></i>&nbsp; Add Data</a></h6>
							<div class="card-tools">
								<button type="button" class="btn btn-xs btn-icon btn-circle btn-warning" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon btn-circle btn-primary" data-card-widget="maximize">
									<i class="fas fa-expand"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon btn-circle btn-danger" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<table id="index1" class="table table-hover table-sm">
								<thead class="thead-dark text-center">
									<tr>
										<th width="3%">No</th>
										<th width="50%">Title</th>
										<th width="10%">Addtime</th>
										<th width="8%">Actions</th>
									</tr>
								</thead>
								<?php foreach ($penting as $p) { ?>
									<tr>
										<td class="text-center"></td>
										<td><?php echo htmlentities(strtoupper($p->judul)) ?></td>
										<td class="text-center"><?php echo $p->addtime; ?></td>
										<td class="align-middle text-center">
											<a class="btn-sm btn-warning" data-toggle="modal" data-target="#modal_edit<?php echo $p->no_id; ?>" title="Edit"><i class="fa fa-pencil-alt"></i></a>
											<a class="btn-sm btn-info" data-toggle="modal" data-target="#modal_view<?php echo $p->no_id; ?>" title="View"><i class="fa fa-search"></i></a>
											<a class="btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>

<!-- Bootstrap modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="col-12 modal-title text-center">Add Data
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h5>
			</div>
			<form onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('it/data_aksi') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">Title *</label>
						<div class="col-xs-9">
							<input type="hidden" name="no_id" readonly class="form-control" value="<?php echo $id_add->no_id + 1; ?> ">
							<input type="text" name="judul" class="form-control form-control-sm form-control-border" placeholder="Input Judul.." required>
							<?php echo set_value('judul'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Description *</label>
						<div class="col-xs-9">
							<textarea class="form-control form-control-sm" name="isi" rows="10" placeholder="Input Isi.." required><?php echo set_value('isi'); ?></textarea>
						</div>
					</div>
					<div class="form-group mb-0">
						<label class="control-label col-xs-3">Attach</label>
						<img class="img-priview img-fluid col-sm-5 mb-1 mt-1">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="image" name="file" onchange="priviewImage()">
							<label class="custom-file-label" for="image">Choose file</label>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					<button class="btn btn-primary" id="addbtn"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals Add-->

<!-- ============ MODAL EDIT DATA =============== -->
<?php foreach ($penting as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Edit Data
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('it/data_edit') ?>" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Title</label>
							<div class="col-xs-9">
								<input type="hidden" name="no_id" readonly class="form-control" value="<?php echo $p->no_id; ?>">
								<input type="text" name="judul" class="form-control form-control-sm form-control-border" readonly value="<?php echo $p->judul; ?>" required>
								<?php echo form_error('judul'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Description *</label>
							<div class="col-xs-9">
								<?php echo form_error('isi'); ?>
								<textarea class="form-control form-control-sm" name="isi" rows="10"><?php echo $p->isi; ?></textarea>
							</div>
						</div>
						<div class="form-group mb-0">
							<label class="control-label col-xs-3">Attach</label><br />
							<a href="<?php echo base_url() . 'gambar/datait/' . $p->file; ?>" target="_blank">
								<img src="<?php echo base_url() . 'gambar/datait/' . $p->file; ?>" class="img-priview img-fluid col-sm-5 mb-1 mt-1" width="35%" onerror="this.style.display='none'" /></a>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile" name="file">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
						<div class="form-group mb-0">
							<?php if ($p->file != '') : ?>
								<a href="<?php echo base_url() . 'gambar/datait/' . $p->file; ?>" download title="Download Attachment" alt="">
									<img src="<?php echo base_url() . 'gambar/datait/paperclip-solid.svg' ?>" width="2%" onerror="this.style.display='none'" /></a>
							<?php endif; ?>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<button class="btn btn-primary" id="editbtn"><i class="fa fa-check"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL EDIT DATA-->

<!-- ============ MODAL View DATA =============== -->
<?php foreach ($penting as $p) : ?>
	<div class="modal fade" id="modal_view<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center"><?php echo $p->judul; ?>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="col-xs-9">
							<input type="hidden" name="no_id" readonly class="form-control" value="<?php echo $p->no_id; ?>">
							<textarea class="form-control form-control-sm form-control-border" readonly rows="13" name="isi"><?php echo $p->isi; ?></textarea>
						</div>
					</div>
					<div class="form-group mb-0">
						<div class="col-xs-9">
							<a href="<?php echo base_url() . 'gambar/datait/' . $p->file; ?>" target="_blank">
								<img src="<?php echo base_url() . 'gambar/datait/' . $p->file; ?>" width="50%" class="img-thumbnail" onerror="this.style.display='none'" /></a>
						</div>
					</div>
					<div class="form-group mb-0">
						<div class="col-xs-9">
							<?php if ($p->file != '') : ?>
								<a href="<?php echo base_url() . 'gambar/datait/' . $p->file; ?>" download title="Download Attachment" alt="#">
									<img src="<?php echo base_url() . 'gambar/datait/paperclip-solid.svg' ?>" width="2%" onerror="this.style.display='none'" /></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-center">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL EDIT DATA-->

<!--MODAL HAPUS DESC-->
<?php foreach ($penting as $u) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $u->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Delete Data
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('it/data_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="no_id" value="<?php echo $u->no_id; ?>">
						<span>Are you sure delete <?php echo $u->judul; ?> ?</span>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						<button class="btn btn-outline-light" id="delbtn"><i class="fa fa-check"></i> Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>


<script>
	function priviewImage() {
		const image = document.querySelector('#image');
		const imgPreview = document.querySelector('.img-priview');

		imgPreview.style.display = 'block';

		const oFReader = new FileReader();
		oFReader.readAsDataURL(image.files[0]);

		oFReader.onload = function(oFREvent) {
			imgPreview.src = oFREvent.target.result;
		}
	}
</script>