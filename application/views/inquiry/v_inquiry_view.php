<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">View Inquiry</h1>
          <small>Inquiry Sales & Purchase</small>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">inquiry view</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="container-fluid">
    <section class="content">

      <div class="card card-primary card-outline">
        <div class="card-header">
          <h4 class="card-title"><i class="fa fa-search"></i> Filter Inquiry</h4>
        </div>
        <form action="" method="POST">
          <div class="card-body">
            <div class="row">
              <div class="col form-group">
                <label for="inputMulaiTanggal" class="font-weight-bold">Mulai Tanggal :</label>
                <input type="date" id="inputMulaiTanggal" name="mulai_tanggal" class="form-control" name="mulai_tanggal" value="<?php echo date('Y-m-d', strtotime($mulai_tanggal)); ?>" required>
              </div>
              <div class="col form-group">
                <label for="inputSampaiTanggal" class="font-weight-bold">Sampai Tanggal :</label>
                <input type="date" id="inputSampaiTanggal" name="sampai_tanggal" class="form-control" name="sampai_tanggal" value="<?php echo date('Y-m-d', strtotime($sampai_tanggal)); ?>" required>
              </div>
            </div>
            <button type="submit" class="col btn btn-primary sm-3">Tampilkan</button>
          </div>
        </form>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h4 class="card-title"><i class="fa fa-book"></i> View Inquiry</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="example3" class="table table-bordered table-striped table-sm">
                <thead class="thead-dark" style="text-align:center">
                  <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Brand</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Deadline</th>
                    <th>Request</th>
                    <th width="5%">Action</th>
                  </tr>
                </thead>
                <?php
                foreach ($view_inquiry as $p) {
                ?>
                  <tr>
                    <td style="text-align:center"><?php echo $p->inquiry_id; ?></td>
                    <td><?php echo $p->sales; ?></td>
                    <td><?php echo $p->tanggal; ?></td>
                    <td><?php echo $p->brand; ?></td>
                    <td><?php echo $p->desc; ?></td>
                    <td style="text-align:center"><?php echo $p->qty; ?></td>
                    <td><?php echo $p->deadline; ?></td>
                    <td><?php echo $p->request; ?></td>
                    <td style="text-align:center">
                      <a class="btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit<?php echo $p->inquiry_id; ?>" title="View Detail"><i class="fa fa-eye"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </table>
            </div>
          </div>
          <div>
            <a href="<?php echo base_url('inquiry/inquiry_export'); ?>" class="btn btn-success"><i class="fas fa-file-excel"></i> Export to excel</a>
          </div></br />
        </div>
      </div>
  </div>
  </section>
</div>

<!-- ============ MODAL VIEW INQUIRY =============== -->
<?php foreach ($inquiry as $p) : ?>
  <div class="modal fade" id="modal_edit<?php echo $p->inquiry_id; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="col-12 modal-title text-center">Detail Buffer
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <form class="form-horizontal" method="post" action="<?php echo base_url('inquiry/inquiry_detail') ?>">
          <div class="modal-body">
            <div class="form-group">
              <label class="control-label col-xs-3">No Inquiry</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" name="id" readonly value="<?php echo $p->inquiry_id; ?> ">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Sales</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->sales; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Tanggal</label>
              <div class="col-xs-9">
                <input type="datetime" class="form-control" readonly value="<?php echo $p->tanggal; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Brand</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->brand; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Deskripsi</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->desc; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Quantity</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->qty; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Deadline</label>
              <div class="col-xs-9">
                <input type="date" class="form-control" readonly value="<?php echo $p->deadline; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Ket(Sales)</label>
              <div class="col-xs-9">
                <textarea type="text" class="form-control" readonly><?php echo $p->keter; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Request</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->request; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Check</label>
              <div class="col-xs-9">
                <input type="number" class="form-control" readonly value="<?php echo $p->cek; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Follow Up</label>
              <div class="col-xs-9">
                <input type="datetime" class="form-control" readonly value="<?php echo $p->fu1; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Ket(FU)</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->ket_fu; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Reseller</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="Rp <?php echo number_format($p->reseller, 0, '.', '.'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">New Seller</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="Rp <?php echo number_format($p->new_seller, 0, '.', '.'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">User</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="Rp <?php echo number_format($p->user, 0, '.', '.'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Delivery</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->delivery; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Purchase</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->name_purch; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Ket(Purchase)</label>
              <div class="col-xs-9">
                <textarea type="text" class="form-control" readonly><?php echo $p->ket_purch; ?></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>