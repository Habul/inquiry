<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Update Order & Tracking Delivery</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('tracking/data_order') ?>">Tracking</a></li>
            <li class="breadcrumb-item active">Update Order & Tracking</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-edit"></i> Update Tracking</h3>
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
            <div class="card-body">
              <?php foreach ($tracking as $u) : ?>
                <form method="post" onsubmit="updbtn.disabled = true; return true;" method="post" action="<?php echo base_url('tracking/update') ?>">
                  <div class="form-group">
                    <label>Plan Kirim *</label>
                    <?php
                    $now = $this->load->helper('date');
                    $format = "%Y-%m-%d %H:%i:%s";
                    ?>
                    <input type="hidden" name="no_id" class="form-control" value="<?php echo $u->no_id; ?>">
                    <input type="hidden" name="updtime" class="form-control" value="<?php echo mdate($format); ?>">
                    <input type="date" name="plan_kirim" class="form-control" value=<?php echo $u->plan_kirim ?> required>
                    <?php echo form_error('plan_kirim'); ?>
                  </div>
                  <div class="form-group">
                    <label>Nama Driver *</label>
                    <select class="form-control" name="nama_driver" required>
                      <option value="">- Pilih Driver -</option>
                      <?php foreach ($driver as $row) : ?>
                        <option value="<?= $row->pengguna_nama; ?>" <?= $row->pengguna_nama == $u->nama_driver ? "selected" : null ?>><?= $row->pengguna_nama; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('nama_driver'); ?>
                  </div>
                  <div class="form-group">
                    <label>Pic Penerima *</label>
                    <input type="text" name="pic_penerima_brg" class="form-control" value="<?php echo $u->pic_penerima_brg ?>" placeholder="Input pic.." required>
                    <?php echo form_error('pic_penerima_brg'); ?>
                  </div>
                  <div class="form-group">
                    <label>Status Kirim *</label>
                    <input type="text" name="status_kirim" class="form-control" value="<?php echo $u->status_kirim ?>" placeholder="Input status kirim.." required>
                    <?php echo form_error('status_kirim'); ?>
                  </div>
                  <div class="form-group">
                    <label>Keterangan Kirim *</label>
                    <textarea name="keter_kirim" class="form-control" placeholder="Input keterangan.."><?php echo $u->keter_kirim ?></textarea>
                    <?php echo form_error('keter_kirim'); ?>
                  </div>
                  <div class="card-footer justify-content-between">
                    <button type="submit" id="updbtn" class="btn btn-info float-right"><i class="fa fa-check"></i> Save</button>
                    <a href="<?php echo base_url('tracking/data_order') ?>" class="btn btn-default"><i class="fa fa-share"></i> Back</a>
                  </div>
                </form>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-paper-plane"></i> Order</h3>
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
            <div class="card-body">
              <form>
                <div class="form-group row"">
                    <label class=" col-sm-2 col-form-label">Pemesan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $u->nama_pemesan ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Group</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $u->group ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No Bbk</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $u->no_bbk ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Customer</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $u->nama_cust ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" readonly><?php echo $u->alamat_cust ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Penerima</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $u->pic_penerima ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No Hp</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $u->no_penerima ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Barang</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $u->barang ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Jumlah</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" readonly value="<?php echo $u->jumlah ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $u->status_brg ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" readonly value="<?php echo $u->tanggal_kirim ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tujuan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly value="<?php echo $u->tujuan ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Note</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" readonly> <?php echo $u->note ?></textarea>
                  </div>
                </div>
              </form>
            <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>