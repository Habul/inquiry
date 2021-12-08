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
              <li class="breadcrumb-item"><a href="<?php echo base_url('tracking/data') ?>">Tracking</a></li>
              <li class="breadcrumb-item active">Add Order & Tracking</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
    <div class="container-fluid">
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
			<br />
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit"></i> Add Order & Tracking</h3>
            <div class="card-tools">								
								<button type="button" class="btn btn-tool" data-card-widget="maximize">
									<i class="fas fa-expand"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
          </div>
          <?php foreach ($tracking as $u) : ?>
          <div class="card-body">

            <?php endforeach; ?>
          </div>        
        </div>
    </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>