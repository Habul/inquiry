<?php foreach ($odo as $u) : ?>
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Detail Mobil</h1>					
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('driver/mobil') ?>">Mobil</a></li>
						<li class="breadcrumb-item active">Detail Mobil</li>
					</ol>
				</div>
			</div>
		</div>
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
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $u->merk; ?> | <?php echo $u->plat; ?></h4>                        
                    </div>  
						<div class="card-body">                        
							<table id="example8" class="table table-bordless table-striped">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="3%">No</th>
										<th>Nama</th>
										<th>Tanggal</th>
										<th>Odometer</th>										
										<th width="13%">Action</th>
									</tr>
								</thead>
								<?php
								$no = 1;
								$query = $this->db->query("SELECT a.no_id as no_id,a.join_id as join_id,a.nama as nama,a.tanggal as tanggal,a.odometer as odometer FROM driver a INNER JOIN type_vehicles b ON a.join_id=b.no_id WHERE a.join_id=$p->no_id");
								foreach ($query->result() as $p) { ?> 
									<tr style="text-align:center">
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->nama; ?></td>						
										<td><?php echo $p->tanggal; ?></td>
										<td><?php echo strtoupper($p->odometer) ?></td>									
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->no_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>																											
									</tr>
								<?php } ?>
							</table>
                            <?php endforeach; ?>
						</div>
					</div>
					<div class="col-md-3" style="padding: 0;">
						<a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add">
							<i class="fa fa-plus-square"></i>&nbsp; Tambah Kilometer</a>
					</div><br />
				</div>
			</div>
        </div>
	</section>
</div>
