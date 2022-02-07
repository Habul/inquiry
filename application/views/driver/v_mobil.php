<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Jenis Mobil</h1>
          <small><b>Jika Kolom Sisa Km = 0, Maka Oli Mesin harus di ganti</b><br />
            max pemakian sesudah ganti oli mobil = 10.000 Km</small>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Mobil</li>
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
      <div class="row">
        <div class="col-md-12">
          <div class="card card-success card-outline">
            <div class="card-body">
              <table id="example8" class="table table-bordless table-striped">
                <thead class="thead-dark" style="text-align:center">
                  <tr>
                    <th width="3%">No</th>
                    <th width="25%">Foto</th>
                    <th>Sisa Km</th>
                    <th width="15%">Action</th>
                  </tr>
                </thead>
                <?php
                $no = 1;
                foreach ($mobil as $p) { ?>
                  <tr style="text-align:center">
                    <td><?php echo $no++; ?></td>
                    <td>
                      <picture>
                        <a href="<?php echo base_url() . 'gambar/vehicles/' . $p->foto; ?>" data-toggle="lightbox" data-title="<?php echo strtoupper($p->merk) ?>&nbsp; PLAT NO :&nbsp;<?php echo strtoupper($p->plat) ?>">
                          <img src="<?php echo base_url() . 'gambar/vehicles/' . $p->foto; ?>" class="img-fluid mb-2" onerror="this.style.display='none'" /></a>
                        <figcaption><?php echo strtoupper($p->merk) ?>&nbsp;<?php echo strtoupper($p->plat) ?></figcaption>
                      </picture>
                    </td>
                    <?php
                    $driver = $this->db->select_max('odometer')->where('join_id', $p->no_id)->get('driver')->row();
                    $history = $this->db->select_max('odometer')->where('join_id', $p->no_id)->where('jenis', 'Ganti Oli')->get('history_vehicles')->row();
                    $master = $this->db->select('max_km')->where('type', 'MOBIL')->get('master_vehicles')->row();
                    $sum = $master->max_km - ($driver->odometer - $history->odometer);
                    ?>
                    <td>
                      <h6><b><?php echo number_format($sum, 0, '.', '.'); ?>&nbsp;Km</b></h6>
                    </td>
                    <td>
                      <?php $encrypturl = urlencode($this->encrypt->encode($p->no_id)) ?>
                      <a class="btn btn-warning" data-toggle="modal" data-target="#modal_edit<?php echo $p->no_id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="<?php echo base_url() . 'driver/mobil_odo/?id=' . $encrypturl; ?>" class="btn btn-primary" title="View Detail"><i class="fa fa-search"></i></a>
                      <a class="btn btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </table><br />
              <div class="col-md-3 shadow" style="padding: 0;">
                <a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add">
                  <i class="fa fa-plus-square"></i>&nbsp; Add car</a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>

<!-- Bootstrap modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="col-12 modal-title text-center">Add Data Mobil
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </h4>
      </div>
      <form onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/mobil_add') ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Type *</label>
            <div class="col-sm-10">
              <input type="text" name="type" class="form-control" value="Mobil" readonly required>
              <?php echo set_value('type'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Merk *</label>
            <div class="col-sm-10">
              <input type="hidden" name="no_id" class="form-control" value="<?php echo $id_add->no_id + 1; ?> ">
              <input type="text" name="merk" class="form-control" placeholder="Input Merk.." required>
              <?php echo set_value('merk'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Plat *</label>
            <div class="col-sm-10">
              <input type="text" name="plat" class="form-control" placeholder="Input Plat.." required>
              <?php echo set_value('plat'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3">Attach Image</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile" name="foto">
              <?php echo set_value('foto'); ?>
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <small>* Max size 2 Mb</small><br />
            <small>* Max file name image 10 character</small><br />
            <small>* File type Jpg, Png & Gif</small>
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
<!--End Modals Add-->

<!-- ============ MODAL EDIT Mobil =============== -->
<?php foreach ($mobil as $p) : ?>
  <div class="modal fade" id="modal_edit<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="col-12 modal-title text-center">Edit Data Mobil
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <form onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/mobil_edit') ?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Type</label>
              <div class="col-sm-10">
                <input type="hidden" name="no_id" class="form-control" value="<?php echo $p->no_id; ?>">
                <input type="text" name="type" readonly class="form-control" value="<?php echo $p->type; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Merk *</label>
              <div class="col-sm-10">
                <input type="text" name="merk" class="form-control" value="<?php echo $p->merk; ?>" required>
                <?php echo form_error('merk'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Plat *</label>
              <div class="col-sm-10">
                <input type="text" name="plat" class="form-control" value="<?php echo $p->plat; ?>" required>
                <?php echo form_error('plat'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-3">Attach Image</label><br />
              <img src="<?php echo base_url() . 'gambar/vehicles/' . $p->foto; ?>" class="img-fluid mb-2" onerror="this.style.display='none'" />
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="foto">
                <?php echo form_error('foto'); ?>
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
              <small>* Max size 2 Mb</small><br />
              <small>* Max file name image 10 character</small><br />
              <small>* File type Jpg, Png & Gif</small>
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
<!--END MODAL EDIT MOBIL-->

<!--MODAL HAPUS DESC-->
<?php foreach ($mobil as $u) : ?>
  <div class="modal fade" id="modal_hapus<?php echo $u->no_id; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="col-12 modal-title text-center">Delete Data Mobil
            <button class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <form onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('driver/mobil_del') ?>">
          <div class="modal-body">
            <input type="hidden" name="no_id" value="<?php echo $u->no_id; ?>">
            <p>Are you sure delete <?php echo $u->plat; ?> ?</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
            <button class="btn btn-outline-light" id="delbtn"><i class="fa fa-check"></i> Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>