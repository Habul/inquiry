<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Data Penting IT</h1>
					<small>Pindahan file TXT yang di 217</small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Data Penting IT</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<section class="content">
		<?php if ($this->session->flashdata('berhasil')) { ?>
			<div class="alert alert-success alert-dismissible">
				<button class="close" data-dismiss="alert" aria-hidden="true" id="info">&times;</button>
				<h4><i class="icon fa fa-check"></i><?= $this->session->flashdata('berhasil') ?>
			</div>
		<?php } ?>
		<?php if ($this->session->flashdata('gagal')) { ?>
			<div class="alert alert-warning alert-dismissible">
				<button class="close" data-dismiss="alert" aria-hidden="true" id="info">&times;</button>
				<h4><i class="icon fa fa-warning"></i><?= $this->session->flashdata('gagal') ?></h4>
			</div>
		<?php } ?>
		<div class="container-fluid">
			<div class="col-md-3" style="padding: 0;">
				<a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add">
					<i class="fa fa-plus-square"></i>&nbsp; Add</a>
			</div>
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example8" class="table table-bordered table-hover table-sm">
								<thead style="text-align:center">
									<tr>
										<th width="2%">No</th>
										<th width="50%">Judul</th>
										<th width="12%">Addtime</th>
										<th width="10%">Action</th>
									</tr>
								</thead>
								<?php
								$no = 1;
								$query = $this->db->query("select * from datapenting_it");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td style="text-align:center"><?php echo $no++; ?></td>
										<td><?php echo $p->judul; ?></td>
										<td style="text-align:center"><?php echo $p->addtime; ?></td>
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->no_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_view<?php echo $p->no_id; ?>" title="View"><i class="fa fa-eye"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
	</section>
	<!-- /.col -->
</div>

<!-- Bootstrap modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Data
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url('it/data_aksi') ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">Judul *</label>
						<div class="col-xs-9">
							<?php
							$now = $this->load->helper('date');
							$format = "%Y-%m-%d %H:%i:%s";
							?>
							<input type="hidden" name="addtime" readonly class="form-control" value="<?php echo mdate($format); ?>">
							<input type="text" name="judul" class="form-control" placeholder="Input Judul.." required>
							<?php echo form_error('judul'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Isi *</label>
						<div class="col-xs-9">
							<textarea class="form-control" rows="7" name="isi" placeholder="Input Isi.." required><?php echo set_value('isi'); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Attach Image</label>
						<div class="col-xs-9">
							<input type="file" name="file">
							<?php echo form_error('file'); ?>
						</div>
						<small>* Max size 2 Mb</small><br />
						<small>* Max file name image 10 character</small><br />
						<small>* File type Jpg, Png & Gif</small>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					<button class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals kurs-->

<!-- ============ MODAL EDIT DATA =============== -->
<?php foreach ($penting as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit Data
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url('it/data_edit') ?>" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-xs-3">Judul</label>
							<div class="col-xs-9">
								<?php
								$now = $this->load->helper('date');
								$format = "%Y-%m-%d %H:%i:%s";
								?>
								<input type="hidden" name="addtime" readonly class="form-control" value="<?php echo mdate($format); ?>">
								<input type="hidden" name="no_id" readonly class="form-control" value="<?php echo $p->no_id; ?> ?>">
								<input type="text" name="judul" class="form-control" readonly value="<?php echo $p->judul; ?>" required>
								<?php echo form_error('judul'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Isi *</label>
							<div class="col-xs-9">
								<textarea class="form-control" rows="8" name="isi" required><?php echo $p->isi; ?> </textarea>
								<?php echo form_error('isi'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Attach Image</label>
							<div class="col-xs-9">
								<img src="<?php echo base_url() . 'gambar/datait/' . $p->file; ?>" class="img-thumbnail" onerror="this.style.display='none'" /><br /><br />
								<input type="file" name="file">
								<?php echo form_error('file'); ?>
							</div>
							<small>* Max size 2 Mb</small><br />
							<small>* Max file name image 10 character</small><br />
							<small>* File type Jpg, Png & Gif</small>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<button class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
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
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center"><?php echo $p->judul; ?>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal">
					<div class="modal-body">
						<div class="form-group">
							<div class="col-xs-9">
								<input type="hidden" name="no_id" readonly class="form-control" value="<?php echo $p->no_id; ?>">
								<textarea class="form-control" readonly rows="10" name="isi"><?php echo $p->isi; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-9">
								<a href="<?php echo base_url() . 'gambar/datait/' . $p->file; ?>" rel="noopener" target="_blank"><img src="<?php echo base_url() . 'gambar/datait/' . $p->file; ?>" class="img-thumbnail" onerror="this.style.display='none'" /></a>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-center">
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--END MODAL EDIT DATA-->

<!--MODAL HAPUS DESC-->
<?php foreach ($penting as $u) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $u->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Data
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url('it/data_hapus') ?>">
					<div class="modal-body">
						<input type="hidden" name="no_id" value="<?php echo $u->no_id; ?>">
						<p>Are you sure delete this ?</p>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						<button class="btn btn-outline-light"><i class="fa fa-check"></i> Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>