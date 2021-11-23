<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Jenis Mobil</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Mobil</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example1" class="table table-borderless">
								<?php
								$query = $this->db->query("select * from type_vehicles where type='mobil'");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><?php echo $p->type; ?></td>
										<td><?php echo $p->merk; ?></td>
										<td><?php echo $p->plat; ?></td>
										<td><img width="50%" class="img-responsive" src="<?php echo base_url() . '/gambar/vehicles/' . $p->foto; ?>"></td>
									</tr>
								<?php }	?>
							</table>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</section>
	<!-- /.col -->
</div>
<!-- /.row -->