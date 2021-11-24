<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Jenis Mobil</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Mobil</li>
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
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example8" class="table table-bordered  table-striped">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="3%">No</th>
										<th width="25%">Foto</th>
										<th>Merk</th>
										<th>No Plat</th>										
										<th width="13%">Action</th>
									</tr>
								</thead>
								<?php
								$no = 1;
								$query = $this->db->query("select * from type_vehicles where type='mobil'");
								foreach ($query->result() as $p) { ?> 
									<tr>
										<td style="text-align:center"><?php echo $no++; ?></td>
										<td style="text-align:center">
										<a href="<?php echo base_url() . 'gambar/veihcles/' . $p->foto; ?>" data-toggle="lightbox" data-title="<?php echo $p->merk ?>&nbsp;|&nbsp;<?php echo $p->plat; ?>">
                  						<img src="<?php echo base_url() . 'gambar/veihcles/' . $p->foto; ?>" class="img-fluid mb-2" alt="car"/></a></td>
										<td><?php echo $p->merk; ?></td>
										<td><?php echo $p->plat; ?></td>										
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->no_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-info btn-sm" title="View"><i class="fa fa-search"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>																											
									</tr>
									<?php } ?>
							</table>
						</div>
					</div>
					<div class="col-md-3" style="padding: 0;">
						<a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add">
							<i class="fa fa-plus-square"></i>&nbsp; Tambah data</a>
					</div><br />
				</div>
			</div>
	</section>
</div>