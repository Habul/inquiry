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
							<table id="example1" class="table table-bordered">
								<?php
								$query = $this->db->query("select * from type_vehicles where type='mobil'");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><img width="30%" class="img-responsive" src="<?php echo base_url() . '/gambar/veihcles/' . $p->foto; ?>"><br /><?php echo $p->type; ?> <br /> <?php echo $p->merk; ?> <br /> <?php echo $p->plat; ?> </td>
										<td><img width="30%" class="img-responsive" src="<?php echo base_url() . '/gambar/veihcles/' . $p->foto; ?>"><br /><?php echo $p->type; ?> <br /> <?php echo $p->merk; ?> <br /> <?php echo $p->plat; ?> </td>
										<td><img width="30%" class="img-responsive" src="<?php echo base_url() . '/gambar/veihcles/' . $p->foto; ?>"><br /><?php echo $p->type; ?> <br /> <?php echo $p->merk; ?> <br /> <?php echo $p->plat; ?> </td>
									</tr>

								<?php }	?>
							</table>
						</div>
					</div>
					<div class="col-md-3" style="padding: 0;">
						<a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add">
							<i class="fa fa-plus-square"></i>&nbsp; Add</a>
					</div>
				</div>
			</div>
	</section>
</div>