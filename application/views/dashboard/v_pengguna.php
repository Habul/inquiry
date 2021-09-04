<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pengguna
			<small>Pengguna Website</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/pengguna_tambah'; ?>" class="btn btn-sm btn-primary">Buat pengguna baru</a>

				<br/>
				<br/>

				<div class="box">
					<div class="box-header">
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Username</th>
									<th>Level</th>
									<th>Status</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($pengguna as $p){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->pengguna_nama; ?></td>
										<td><?php echo $p->pengguna_email; ?></td>
										<td><?php echo $p->pengguna_username; ?></td>
										<td><?php echo $p->pengguna_level; ?></td>
										<td>
											<?php 
											if($p->pengguna_status == 1){
												echo "Aktif";
											}else{
												echo "Non Aktif";
											}
											?>
										</td>
										<td>
											<?php 
											echo anchor(site_url('dashboard/pengguna_edit/'.$p->pengguna_id),'<i class="fa fa-edit"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
											echo '  '; 
											echo anchor(site_url('dashboard/pengguna_hapus/'.$p->pengguna_id),'<i class="fa fa-trash"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
											?>
										</td>
									</tr>
								<?php } ?>
								</tbody>
					<tfoot>
						<tr></tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
