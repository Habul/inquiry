<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">View Inquiry</h1>
          <small>Inquiry Sales & Purchase</small>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">inquiry view</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h4 class="card-title"><i class="fa fa-book"></i> Arsip Inquiry</h4>
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
              <table id="filter1" class="table table-bordered table-striped table-sm">
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
                    <td><?php echo date('d/m/Y', strtotime($p->deadline)); ?></td>
                    <td><?php echo $p->request; ?></td>
                    <td style="text-align:center">
                      <a class="btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit<?php echo $p->inquiry_id; ?>" title="View Detail"><i class="fa fa-search"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </table>
              <div>
                <a href="<?php echo base_url('inquiry/inquiry_export'); ?>" class="btn btn-warning col-sm-1" title="Export to Excel"><i class="fas fa-file-excel"></i> Excel</a>
                <a href="<?php echo base_url('inquiry/inquiry_export_word'); ?>" class="btn btn-secondary col-sm-1" title="Export to Word"><i class="fas fa-file-word"></i> Word</a>
                <a href="<?php echo base_url('inquiry/inquiry_export_csv'); ?>" class="btn btn-primary col-sm-1" title="Export to Csv"><i class="fas fa-file-csv"></i> Csv</a>
              </div>
            </div>
          </div>
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
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">No Inquiry</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" name="id" readonly value="<?php echo $p->inquiry_id; ?> ">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Sales</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="<?php echo $p->sales; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tanggal</label>
              <div class="col-sm-10">
                <input type="datetime" class="form-control form-control-sm" readonly value="<?php echo $p->tanggal; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Brand</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="<?php echo $p->brand; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Deskripsi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="<?php echo $p->desc; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Quantity</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="<?php echo $p->qty; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Deadline</label>
              <div class="col-sm-10">
                <input type="date" class="form-control form-control-sm" readonly value="<?php echo $p->deadline; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Ket(Sales)</label>
              <div class="col-sm-10">
                <textarea type="text" class="form-control form-control-sm" readonly><?php echo $p->keter; ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Request</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="<?php echo $p->request; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Check</label>
              <div class="col-sm-10">
                <input type="number" class="form-control form-control-sm" readonly value="<?php echo $p->cek; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Follow Up</label>
              <div class="col-sm-10">
                <input type="datetime" class="form-control form-control-sm" readonly value="<?php echo $p->fu1; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Ket(Fu)</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="<?php echo $p->ket_fu; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Reseller</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="Rp <?php echo number_format($p->reseller, 0, '.', '.'); ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Seller</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="Rp <?php echo number_format($p->new_seller, 0, '.', '.'); ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">User</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="Rp <?php echo number_format($p->user, 0, '.', '.'); ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Delivery</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="<?php echo $p->delivery; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Purchase</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" readonly value="<?php echo $p->name_purch; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Ket(Prch)</label>
              <div class="col-sm-10">
                <textarea type="text" class="form-control form-control-sm" readonly><?php echo $p->ket_purch; ?></textarea>
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