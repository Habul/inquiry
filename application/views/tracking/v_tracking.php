<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order & Tracking Delivery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Tracking</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

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
				<a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add_sj">
					<i class="fa fa-plus-square"></i>&nbsp; Add SJ</a>
			</div>
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<table id="example6" class="table table-bordered table-striped">
								<thead class="thead-dark" style="text-align:center">
									<tr>
										<th width="14%">Do No</th>
										<th>Do Date</th>
										<th>Due Date</th>
										<th>No Po</th>
										<th>Cust Name</th>
										<th width="18%">Address</th>
										<th>City</th>
										<th>Phone</th>
										<th width="13%">Action</th>
									</tr>
								</thead>
								<?php
								$query = $this->db->query("select * from tracking where updtime");
								foreach ($query->result() as $p) {
								?>
									<tr>
										<td><?php echo $p->no_delivery; ?></td>
										<td><?php echo $p->date_delivery; ?></td>
										<td><?php echo $p->due_date; ?></td>
										<td><?php echo $p->no_po; ?></td>
										<td><?php echo $p->cust_name; ?></td>
										<td><?php echo $p->address; ?></td>
										<td><?php echo $p->city; ?></td>
										<td><?php echo preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($p->phone)), 2); ?></td>
										<td style="text-align:center">
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit_sj<?php echo $p->no_po; ?>" title="Edit SJ"><i class="fa fa-edit"></i></a>
											<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_print<?php echo $p->no_po; ?>" title="Add Desc, Detail & Print"><i class="fa fa-search"></i></a>
											<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_po; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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
<!-- /.row -->