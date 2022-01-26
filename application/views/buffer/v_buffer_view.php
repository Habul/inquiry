<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">View Buffer</h1>
          <small>Buffer Marketing - Warehouse</small>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Buffer View</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-success card-outline">
          <div class="card-header">
            <h4 class="card-title"><i class="fa fa-database"></i> View Buffer</h4>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo base_url('buffer/buffer_view') ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                <i class="fas fa-sync-alt"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="index1" class="table table-bordered table-striped table-sm">
              <thead class="thead-dark" style="text-align:center">
                <tr>
                  <th width="6%">No</th>
                  <th>Nama</th>
                  <th>Tanggal</th>
                  <th>Brand</th>
                  <th>Description</th>
                  <th>Qty</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th>No PR</th>
                  <th width="5%">Action</th>
                </tr>
              </thead>
              <?php
              foreach ($buffer as $p) {
              ?>
                <tr>
                  <td style="text-align:center"><?php echo $p->id_buffer; ?></td>
                  <td><?php echo $p->sales; ?></td>
                  <td><?php echo $p->tanggal; ?></td>
                  <td><?php echo $p->brand; ?></td>
                  <td><?php echo $p->deskripsi; ?></td>
                  <td style="text-align:center"><?php echo $p->qty; ?></td>
                  <td><?php echo $p->keter; ?></td>
                  <td><?php echo strtoupper($p->status); ?></td>
                  <td><?php echo $p->pr_no; ?></td>
                  <td style="text-align:center">
                    <a class="btn-sm btn-primary" data-toggle="modal" data-target="#modal_view<?php echo $p->id_buffer; ?>" title="View Detail"><i class="fa fa-search"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </table>
            <?php if ($this->session->userdata('level') != "sales") {  ?>
              <div>
                <a href="<?php echo base_url('buffer/buffer_export'); ?>" class="btn btn-success" title="Export to Excel"><i class="fas fa-file-excel"></i></i> Excel</a>
              </div>
            <?php }  ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>
</div>

<!-- ============ MODAL VIEW BUFFER =============== -->
<?php foreach ($buffer as $p) : ?>
  <div class="modal fade" id="modal_view<?php echo $p->id_buffer; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="col-12 modal-title text-center">Detail Buffer
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <form class="form-horizontal" method="post" action="<?php echo base_url('buffer/buffer_view') ?>">
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">No Inquiry</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="<?php echo $p->id_buffer; ?> ">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Sales</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="<?php echo $p->sales; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tanggal</label>
              <div class="col-sm-10">
                <input type="datetime" class="form-control" readonly value="<?php echo $p->tanggal; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Brand</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="<?php echo $p->brand; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Deskripsi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="<?php echo $p->deskripsi; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Quantity</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="<?php echo $p->qty; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Keter(Sales)</label>
              <div class="col-sm-10">
                <textarea class="form-control" readonly><?php echo $p->keter; ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">status</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="<?php echo $p->status; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">PR No</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="<?php echo $p->pr_no; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Keter(WH)</label>
              <div class="col-sm-10">
                <textarea class="form-control" readonly><?php echo $p->ket_wh; ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Warehouse</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="<?php echo $p->wh; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Follow Up</label>
              <div class="col-sm-10">
                <input type="datetime" class="form-control" readonly value="<?php echo $p->fu; ?>">
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