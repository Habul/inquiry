<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kurs Inquiry
			<small>Inquiry Marketing - Purchasing</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<div class="col-md-6" style="padding: 0;">
               				<a class="form-control btn btn-success" data-toggle="modal" data-target="#modal_add_kurs"><i
                        	class="glyphicon glyphicon-plus-sign"></i> Tambah Data Kurs</a>
						</div>
						<div class="col-md-3">
							<a href="<?php echo base_url('dashboard/inquiry_kurs_export'); ?>" class="form-control btn btn-default"><i
							class="glyphicon glyphicon glyphicon-floppy-open"></i> Export Data Excel</a>
						</div>
						<div class="col-md-3">
							<a href="<?php echo base_url('dashboard/inquiry_kurs_import'); ?>" class="form-control btn btn-default"><i
							class="glyphicon glyphicon glyphicon-floppy-save"></i> Import Data Excel</a>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="example2" class="table table table-bordered table-hover">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Currency</th>
									<th>Amount</th>
									<th width="15%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = $this->uri->segment('3') + 1;
								$query = $this->db->query("select * from kurs");
								foreach ($query->result() as $p){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->currency; ?></td>
										<td><?php echo number_format($p->amount, 0, '.', '.'); ?></td>
										<td style="text-align:center">
											<?php 
											echo anchor(site_url('dashboard/inquiry_kurs_edit/'.$p->id_kurs),'<i class="fa fa-edit"></i> &nbsp; Edt',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
											echo '  '; 
											echo anchor(site_url('dashboard/inquiry_kurs_hapus/'.$p->id_kurs),'<i class="fa fa-trash"></i>&nbsp; Del','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
											?>
										</td>
									</tr>
								</tbody>
						<?php }	?>
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
<!-- Bootstrap modal kurs -->
<div class="modal fade" id="modal_add_kurs" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel" align="center">Tambah Kurs</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url('dashboard/inquiry_kurs_aksi') ?>">
                <div class="modal-body">
						<div class="form-group">
									<?php 
									$id_kurs=$this->db->select('id_kurs')->order_by('id_kurs',"desc")->limit(1)->get('kurs')->row();
									?>
									<input type="hidden" name="id_kurs" class="form-control" value=<?php echo $id_kurs->id_kurs+1 ?> >
									<?php echo form_error('id_kurs'); ?>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Currency</label>
									<div class="col-xs-8">
									<input type="text" name="currency" class="form-control" placeholder="input currency..">
									<?php echo form_error('currency'); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Amount</label>
									<div class="col-xs-8">
									<input type="number" name="amount" class="form-control" placeholder="input amount...">
									<?php echo form_error('amount'); ?>
									</div>
								</div>
               			</div>
				<div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>
    </div>
</div>
 <!--End Modals kurs-->
