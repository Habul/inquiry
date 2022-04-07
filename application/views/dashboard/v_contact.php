<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Contacts</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Contact</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="card-body pb-0">
			<?php if ($this->session->flashdata('berhasil')) { ?>
			<div class="alert alert-success alert-dismissible fade show" id="info" role="alert">
				<button type=" button" class="close" data-dismiss="alert">&times;</button>
				<i class="icon fa fa-check"></i>&nbsp;<?= $this->session->flashdata('berhasil') ?>
			</div>
			<?php } ?>
			<?php if ($this->session->flashdata('gagal')) { ?>
			<div class="alert alert-warning alert-dismissible fade show" id="info" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<i class="icon fa fa-warning"></i>&nbsp;<?= $this->session->flashdata('gagal') ?>
			</div>
			<?php } ?>
			<div class="row">
				<?php foreach ($it as $row) { ?>
				<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
					<div class="card bg-light d-flex flex-fill">
						<div class="card-header text-muted border-bottom-0">
							<?php echo strtoupper($row->posisi) ?>
						</div>
						<div class="card-body pt-0">
							<div class="row">
								<div class="col-7">
									<h2 class="lead"><b><?php echo $row->nama; ?></b></h2>
									<p class="text-muted text-sm"><b>About: </b> <?php echo $row->about; ?> </p>
									<ul class="ml-4 mb-0 fa-ul text-muted">
										<li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
											Address:
											<?php echo $row->alamat; ?> </li>
										<li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone :
											<?php echo $row->no_hp; ?> </li>
									</ul>
								</div>
								<div class="col-5 text-center">
									<img src="<?php echo base_url() . 'gambar/contact/' . $row->foto; ?>" alt="user-avatar"
										class="img-circle img-fluid">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<a href="https://wa.me/62<?php echo substr($row->no_hp,1) ?>?text=Hallo%20kakak%20"
								class="btn btn-sm bg-teal float-right shadow" rel="noopener" target="_blank">
								<i class="fab fa-whatsapp"></i></a>
							<?php if ($this->session->userdata('level') == "admin") { ?>
							<a class="btn btn-sm bg-info" data-toggle="modal"
								data-target="#modal_edit<?php echo $row->id_user; ?>" title="Edit"><i
									class="fa fa-pencil-alt"></i></a>
							<a class="btn btn-sm bg-danger" data-toggle="modal"
								data-target="#modal_hapus<?php echo $row->id_user; ?>" title="Delete"><i
									class="fa fa-trash"></i></a>
							<?php }  ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php if ($this->session->userdata('level') == "admin") { ?>
			<div class="col-md-3 shadow" style="padding: 0;">
				<a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add">
					<i class="fa fa-plus"></i>&nbsp; Add</a>
			</div>
			<?php }  ?><br />
		</div>

	</section>
</div>

<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Contact
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form onsubmit="addbtn.disabled = true; return true;" method="post"
				action="<?php echo base_url('dashboard/contact_add') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon fas fa-user-tie"></i></span>
							</div>
							<input type="hidden" name="id" class="form-control" value="<?php echo $id_add->id_user + 1 ?>">
							<input type="text" name="nama" class="form-control" placeholder="Input nama" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon fas fa-briefcase"></i></span>
							</div>
							<input type="text" name="posisi" class="form-control" placeholder="Input posisi" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon fas fa-phone"></i></span>
							</div>
							<input type="number" name="no_hp" class="form-control" placeholder="input number" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon fas fa-comment-dots"></i></span>
							</div>
							<input type="text" name="about" class="form-control" placeholder="Input about" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon fas fa-home"></i></span>
							</div>
							<textarea type="text" name="alamat" class="form-control" placeholder="Input alamat"
								required></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="customFile" name="foto">
							<label class="custom-file-label" for="customFile">Upload Image</label>
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

<?php foreach ($it as $row) : ?>
<div class="modal fade" id="modal_edit<?php echo $row->id_user; ?>" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Edit Contact
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form onsubmit="editbtn.disabled = true; return true;" method="post"
				action="<?php echo base_url('dashboard/contact_edit') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon fas fa-user-tie"></i></span>
							</div>
							<input type="hidden" name="id" class="form-control" value="<?php echo $row->id_user; ?>">
							<input type="text" name="nama" class="form-control" value="<?php echo $row->nama; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon fas fa-briefcase"></i></span>
							</div>
							<input type="text" name="posisi" class="form-control" value="<?php echo $row->posisi; ?>" required>
						</div>
					</div>
					<div class=" form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon fas fa-phone"></i></span>
							</div>
							<input type="number" name="no_hp" class="form-control" value="<?php echo $row->no_hp; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon fas fa-comment-dots"></i></span>
							</div>
							<input type="text" name="about" class="form-control" value="<?php echo $row->about; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon fas fa-home"></i></span>
							</div>
							<textarea type="text" name="alamat" class="form-control"
								required><?php echo $row->alamat; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<img src="<?php echo base_url() . 'gambar/contact/' . $row->foto; ?>" class="img-fluid mb-2"
							width="30%" onerror="this.style.display='none'" />
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="customFile" name="foto">
							<label class="custom-file-label" for="customFile">Upload Image</label>
						</div>
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

<?php foreach ($it as $u) : ?>
<div class="modal fade" id="modal_hapus<?php echo $u->id_user; ?>" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h5 class="col-12 modal-title text-center">Delete Data
					<button class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h5>
			</div>
			<form onsubmit="delbtn.disabled = true; return true;" method="post"
				action="<?php echo base_url('dashboard/contact_hapus') ?>">
				<div class="modal-body">
					<input type="hidden" name="id" value="<?php echo $u->id_user; ?>">
					<p>Are you sure delete <?php echo $u->nama; ?> ?</p>
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
