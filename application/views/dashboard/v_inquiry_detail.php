<div class="content-wrapper">
	<section class="content">
	<div class="box box-info">
    <div class="box-header with-border">
    	<h3 class="box-title">Detail Inquiry</h3>
	</div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
				<?php foreach($inquiry as $p){ ?>
                <div class="form-group">
                  <label class="col-sm-2 control-label">No Inquiry</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="id" readonly value="<?php echo $p->inquiry_id; ?> ">
                  </div>
                </div>				
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Sales</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->sales; ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="datetime" class="form-control" readonly value="<?php echo $p->tanggal; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Brand Produk</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->brand; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->desc; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->qty; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Deadline</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" readonly value="<?php echo $p->deadline; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->keter; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Request</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->request; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Check</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" readonly value="<?php echo $p->cek; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Follow Up</label>
                  <div class="col-sm-10">
                    <input type="datetime" class="form-control" readonly value="<?php echo $p->fu1; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan FU</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->ket_fu; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Reseller</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" readonly value="<?php echo $p->reseller; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">New Seller</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" readonly value="<?php echo $p->new_seller; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">User</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" readonly value="<?php echo $p->user; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Delivery</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->delivery; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Keter Purchase</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $p->ket_purch; ?>" >
                  </div>
                </div>

        </div>
		<div class="box-footer">
                <a href="<?php echo base_url().'dashboard/inquiry_view'; ?>" class="btn btn-primary">Kembali</a>
    	</div>
    	<!-- /.box-footer -->
        </form>
	<?php } ?>
</div>
<!-- /.box-body -->
	</section>
</div>
