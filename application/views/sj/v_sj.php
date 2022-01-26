<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Surat Jalan</h1>
          <small>Pastikan Desc SJ sudah terinput, sebelum <b>View & Print</b></small>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Surat Jalan HS</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <?php if ($this->session->flashdata('berhasil')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type=" button" class="close" data-dismiss="alert">&times;</button>
          <i class="icon fa fa-check"></i>&nbsp;<?= $this->session->flashdata('berhasil') ?>
        </div>
      <?php } ?>
      <?php if ($this->session->flashdata('gagal')) { ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <i class="icon fa fa-warning"></i>&nbsp;<?= $this->session->flashdata('gagal') ?>
        </div>
      <?php } ?>
      <div class="col-md-3 shadow" style="padding: 0;">
        <a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add_sj">
          <i class="fa fa-plus"></i>&nbsp; Add SJ</a>
      </div>
      <br />
      <div class="row">
        <div class="col-md-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h4 class="card-title"><i class="fa fa-edit"></i> Surat Jalan HS</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo base_url('sj/sj') ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
              <table id="example6" class="table table-borderless table-striped">
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
                foreach ($sj_user as $p) {
                ?>
                  <tr>
                    <td><?php echo $p->no_delivery; ?></td>
                    <td><?php echo $p->date_delivery; ?></td>
                    <td><?php echo $p->due_date; ?></td>
                    <td><?php echo $p->no_po; ?></td>
                    <td><?php echo $p->cust_name; ?></td>
                    <td><?php echo $p->address; ?></td>
                    <td><?php echo $p->city; ?></td>
                    <td><?php echo preg_replace('/\d{3}/', '$0-', str_replace('.', 'null', trim($p->phone)), 1); ?></td>
                    <td style="text-align:center">
                      <?php $encrypturl = urlencode($this->encrypt->encode($p->no_po)) ?>
                      <a class="btn-sm btn-warning" data-toggle="modal" data-target="#modal_edit_sj<?php echo $p->no_po; ?>" title="Edit SJ"><i class="fa fa-pencil-alt"></i></a>
                      <a href="<?php echo base_url() . 'sj/sj_view/?sj=' . $encrypturl; ?>" class="btn-sm btn-primary" title="Add Desc, Detail & Print""><i class=" fa fa-search"></i></a>
                      <a class="btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_po; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>


<!-- modal add Sj -->
<div class="modal fade" id="modal_add_sj" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="col-12 modal-title text-center">Add Surat Jalan
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </h4>
      </div>
      <form class="form-horizontal" onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('sj/sj_aksi') ?>">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-xs-3">No Delivery Order *</label>
            <div class="col-xs-9">
              <input type="text" name="no_delivery" class="form-control" maxlength="20" placeholder="Input No Delivery order..." required>
              <?php echo form_error('no_delivery'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3">Date Delivery *</label>
            <div class="col-xs-9">
              <input type="date" name="date_delivery" class="form-control" required>
              <?php echo form_error('date_delivery'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3">Due Date *</label>
            <div class="col-xs-9">
              <input type="date" name="due_date" class="form-control" required>
              <?php echo form_error('due_date'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3">No Po *</label>
            <div class="col-xs-9">
              <input type="number" name="no_po" class="form-control" min="1" placeholder="Input No Po..." required>
              <?php echo form_error('no_po'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3">Cust Name *</label>
            <div class="col-xs-9">
              <input type="text" name="cust_name" class="form-control" placeholder="Input Cust Name..." required>
              <?php echo form_error('cust_name'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3">Address *</label>
            <div class="col-xs-9">
              <textarea name="address" class="form-control" maxlength="150" placeholder="Input Address.." required></textarea>
              <?php echo form_error('address'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3">City *</label>
            <div class="col-xs-9">
              <input type="text" name="city" class="form-control" placeholder="Input City..." required>
              <?php echo form_error('city'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3">Phone *</label>
            <div class="col-xs-9">
              <input type="number" name="phone" class="form-control" placeholder="Input No Phone.." data-mask data-mask required>
              <?php echo form_error('phone'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          <button class="btn btn-primary" id="addbtn"><i class="fa fa-check"></i> Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal add Sj -->

<!-- Modal Edit Sj -->
<?php foreach ($sj_user as $p) : ?>
  <div class="modal fade" id="modal_edit_sj<?php echo $p->no_po; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="col-12 modal-title text-center">Add Surat Jalan
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <form class="form-horizontal" onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('sj/sj_edit') ?>">
          <div class="modal-body">
            <div class="form-group">
              <label class="control-label col-xs-3">No Delivery Order *</label>
              <div class="col-xs-9">
                <input type="text" name="no_delivery" class="form-control" maxlength="20" value="<?php echo $p->no_delivery; ?>" required>
                <?php echo form_error('no_delivery'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Date Delivery *</label>
              <div class="col-xs-9">
                <input type="date" name="date_delivery" class="form-control" value="<?php echo $p->date_delivery; ?>" required>
                <?php echo form_error('date_delivery'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Due Date *</label>
              <div class="col-xs-9">
                <input type="date" name="due_date" class="form-control" value="<?php echo $p->due_date; ?>" required>
                <?php echo form_error('due_date'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">No Po *</label>
              <div class="col-xs-9">
                <input type="number" name="no_po" class="form-control" min="1" value="<?php echo $p->no_po; ?>" required>
                <?php echo form_error('no_po'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Cust Name *</label>
              <div class="col-xs-9">
                <input type="text" name="cust_name" class="form-control" value="<?php echo $p->cust_name; ?>" required>
                <?php echo form_error('cust_name'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Address *</label>
              <div class="col-xs-9">
                <textarea name="address" class="form-control" maxlength="150" required><?php echo $p->address; ?></textarea>
                <?php echo form_error('address'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">City *</label>
              <div class="col-xs-9">
                <input type="text" name="city" class="form-control" value="<?php echo $p->city; ?>" required>
                <?php echo form_error('city'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Phone *</label>
              <div class="col-xs-9">
                <input type="text" name="phone" class="form-control" value="<?php echo $p->phone; ?>" required>
                <?php echo form_error('phone'); ?>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            <button class="btn btn-primary" id="editbtn"><i class="fa fa-check"></i> Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<!-- end modal Edit Sj -->

<!--MODAL HAPUS ALL-->
<?php foreach ($sj_user as $p) : ?>
  <div class="modal fade" id="modal_hapus<?php echo $p->no_po; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="col-12 modal-title text-center">Delete Surat Jalan
            <button class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <form class="form-horizontal" onsubmit="delform.disabled = true; return true;" method="post" action="<?php echo base_url('sj/sj_hapus') ?>">
          <div class="modal-body">
            <input type="hidden" name="no_po" value="<?php echo $p->no_po; ?>">
            <p>Are you sure delete no po <?php echo $p->no_po; ?> ?</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
            <button class="btn btn-outline-light" id="delform"><i class="fa fa-check"></i> Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>