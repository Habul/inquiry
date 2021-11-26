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
						<li class="breadcrumb-item active">Detail</li>
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
					<?php foreach ($odo as $u) : ?>
                        <h4 class="card-title"><?php echo strtoupper($u->merk) ?> | <?php echo strtoupper($u->plat) ?></h4>                        
                    </div>  
						<div class="card-body">                        
							<table id="example3" class="table table-bordered table-hover table-sm">
								<thead class="thead-dark" style="text-align:center">
									<tr>										
										<th>Nama</th>
										<th>Tanggal</th>
										<th>Odometer</th>										
										<th width="10%">Action</th>
									</tr>
								</thead>
								<?php
								$no = 1;
								$query = $this->db->query("SELECT * FROM driver WHERE join_id=$u->no_id;");
								foreach ($query->result() as $p) { ?> 
									<tr style="text-align:center">										
										<td><?php echo strtoupper($p->nama) ?></td>						
										<td><?php echo $p->tanggal; ?></td>
										<td><?php echo strtoupper($p->odometer) ?></td>									
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->no_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
										</td>																											
									</tr>
								<?php } ?>
							</table>
                           
						</div>
					</div>
					<div class="card-body row">					
						<div class="col-md-3">
							<a class="btn btn-outline-primary btn-block" href="<?php echo base_url() . 'driver/mobil_history/' . $u->no_id; ?>"><i class="fa fa-bell"></i> History Service</a>						
						</div>
						<div class="col-md-3">
							<button class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_add">
								<i class="fa fa-plus-square"></i> Add Odometer</button>						
						</div>
					</div>
					<?php endforeach; ?>					
					<br />
				</div>
			</div>
        </div>
	</section>
</div>

<!-- Bootstrap modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="col-12 modal-title text-center">Add Odometer
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<form class="form-horizontal" id="addform" method="post" action="<?php echo base_url('driver/mobil_odo_add') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-xs-3">Nama</label>
						<div class="col-xs-9">
							<?php foreach ($odo as $u) : ?>	
							<input type="hidden" name="join_id" class="form-control" value="<?php echo $u->no_id; ?>">
							<?php endforeach; ?>													
							<input type="text" name="nama" class="form-control" value="<?php echo $this->session->userdata('nama'); ?>" readonly>
							<?php echo form_error('nama'); ?>
							
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Tanggal</label>
						<div class="col-xs-9">
							<?php
							$now = $this->load->helper('date');
							$format = "%Y-%m-%d";
							?>
							<input type="date" name="tanggal" readonly class="form-control" value="<?php echo mdate($format); ?>">
							<?php echo form_error('tanggal'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Odometer *</label>
						<div class="col-xs-9">
							<input type="number" name="odometer" min="1" class="form-control" placeholder="Input Odometer.." required>
							<?php echo set_value('odometer'); ?>
						</div>
					</div>					
				</div>
				<div class="modal-footer justify-content-between">
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					<button class="btn btn-primary" id="submitbtn"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals Add-->

<!-- ============ MODAL EDIT Mobil =============== -->
<?php foreach ($driver as $p) : ?>
	<div class="modal fade" id="modal_edit<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Edit Odometer
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/mobil_odo_edit') ?>"> 
					<div class="modal-body">
					<div class="form-group">
							<label class="control-label col-xs-3">Nama</label>
							<div class="col-xs-9">
								<input type="text" name="odometer" readonly class="form-control" value="<?php echo strtoupper($p->nama) ?>">								
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Type</label>
							<div class="col-xs-9">
							<?php
								$now = $this->load->helper('date');
								$format = "%Y-%m-%d";
								?>
								<input type="hidden" name="no_id" class="form-control" value="<?php echo $p->no_id; ?>">
								<input type="hidden" name="join_id" class="form-control" value="<?php echo $p->join_id; ?>">								
								<input type="date" name="tanggal" readonly class="form-control" value="<?php echo mdate($format); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Merk *</label>
							<div class="col-xs-9">
								<input type="text" name="odometer" class="form-control" value="<?php echo $p->odometer; ?>" required>
								<?php echo form_error('odometer'); ?>
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
<!--END MODAL EDIT MOBIL-->

<!--MODAL HAPUS DESC-->
<?php foreach ($driver as $u) : ?>
	<div class="modal fade" id="modal_hapus<?php echo $u->no_id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="col-12 modal-title text-center">Delete Odometer
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h4>
				</div>
				<form class="form-horizontal" onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/mobil_odo_del') ?>">
					<div class="modal-body">
						<input type="hidden" name="join_id" value="<?php echo $u->join_id; ?>">
						<input type="hidden" name="no_id" value="<?php echo $u->no_id; ?>">
						<p>Are you sure delete, Odometer <?php echo $u->odometer; ?> ?</p>
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