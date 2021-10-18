<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">View Buffer</h1>
          <small>Buffer Marketing - Warehouse</small>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Buffer View</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="container-fluid">
    <?php if ($this->session->userdata('level') != "sales") {  ?>
      <div class="col-md-3" style="padding: 0;">
        <a href="<?php echo base_url('buffer/buffer_export'); ?>" class="form-control btn btn-success"><i class="fa fa-download"></i></i> Export To Excel </a>
      </div>
    <?php }  ?>
    <br />
    <div class="row">
      <div class="col-md-12">
        <div class="card card-success card-outline">
          <div class="card-body">
            <table id="example3" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1%">NO</th>
                  <th>Nama</th>
                  <th>Tanggal</th>
                  <th>Brand Produk</th>
                  <th>Description</th>
                  <th>Qty</th>
                  <th>Keterangan</th>
                  <th width="12%">Action</th>
                </tr>
              </thead>
              <?php
              $no = $this->uri->segment('3') + 1;
              $query = $this->db->query("SELECT * FROM `buffer` WHERE status='approve' OR status='finish' order by fu");
              foreach ($query->result() as $p) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $p->sales; ?></td>
                  <td><?php echo $p->tanggal; ?></td>
                  <td><?php echo $p->brand; ?></td>
                  <td><?php echo $p->deskripsi; ?></td>
                  <td><?php echo $p->qty; ?></td>
                  <td><?php echo $p->keter; ?></td>
                  <td style="text-align:center">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->id_buffer; ?>" title="View Detail"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </div>
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

<!-- ============ MODAL VIEW BUFFER =============== -->
<?php foreach ($buffer as $p) : ?>
  <div class="modal fade" id="modal_edit<?php echo $p->id_buffer; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
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
            <div class="form-group">
              <label class="control-label col-xs-3">No Inquiry</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->id_buffer; ?> ">
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
                <input type="text" class="form-control" readonly value="<?php echo $p->deskripsi; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Quantity</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->qty; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Keter(Sales)</label>
              <div class="col-xs-9">
                <textarea class="form-control" readonly><?php echo $p->keter; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">status</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->status; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">PR No</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->pr_no; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Keter(WH)</label>
              <div class="col-xs-9">
                <textarea class="form-control" readonly><?php echo $p->ket_wh; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Warehouse</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" readonly value="<?php echo $p->wh; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Follow Up</label>
              <div class="col-xs-9">
                <input type="datetime" class="form-control" readonly value="<?php echo $p->fu; ?>">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Kembali</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>