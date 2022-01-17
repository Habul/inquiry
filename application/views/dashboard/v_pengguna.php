<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User</h1>
          <small>user & user access</small>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">User</li>
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
      <div class="col-md-3" style="padding: 0;">
        <a class=" form-control btn btn-success" data-toggle="modal" data-target="#modal_add">
          <i class="fa fa-plus-square"></i>&nbsp; Add user</a>
      </div>
      <br />
      <div class="row">
        <div class="col-md-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h4 class="card-title"><i class="fa fa-users"></i> User account</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo base_url('dashboard/pengguna') ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
              <table id="index2" class="table table-bordered table-striped table-sm">
                <thead class="thead-dark" style="text-align:center">
                  <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <?php
                foreach ($pengguna as $p) {
                ?>
                  <tr>
                    <td style="text-align:center"></td>
                    <td><?php echo strtoupper($p->pengguna_nama) ?></td>
                    <td><?php echo $p->pengguna_email; ?></td>
                    <td><?php echo $p->pengguna_username; ?></td>
                    <td><?php echo $p->pengguna_level; ?></td>
                    <td style="text-align:center">
                      <?php if ($p->pengguna_status == 1) : ?>
                        <span class="badge badge-primary">Aktif</span>
                      <?php else : ?>
                        <span class="badge badge-danger">Non-Aktif</span>
                      <?php endif; ?>
                    </td>
                    <td style="text-align:center">
                      <a class="btn-sm btn-warning" data-toggle="modal" data-target="#modal_edit<?php echo $p->pengguna_id; ?>" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                      <a class="btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $p->pengguna_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </table>
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
        <h4 class="col-12 modal-title text-center">Add User
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </h4>
      </div>
      <form class="form-horizontal" method="post" onsubmit="addbtn.disabled = true; return true;" action="<?php echo base_url('dashboard/pengguna_aksi') ?>">
        <div class="card-body">
          <div class="form-group">
            <label>Nama *</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengguna .." required>
            <?php echo form_error('nama'); ?>
          </div>
          <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email pengguna .." required>
            <?php echo form_error('email'); ?>
          </div>
          <div class="form-group">
            <label>Username *</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username pengguna.." required>
            <?php echo form_error('username'); ?>
          </div>
          <div class="form-group">
            <label>Password *</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password pengguna.." required>
            <?php echo form_error('password'); ?>
          </div>
          <div class="form-group">
            <label>Divisi *</label>
            <select class="form-control" name="level" required>
              <option value="">- Pilih Divisi -</option>
              <option value="admin">Admin</option>
              <option value="purchase">Purchase</option>
              <option value="driver">Driver</option>
              <option value="ga">GA</option>
            </select>
            <?php echo form_error('level'); ?>
          </div>
          <div class="form-group">
            <label>Status *</label>
            <select class="form-control" name="status" required>
              <option value="">- Pilih Status -</option>
              <option value="1">Aktif</option>
              <option value="0">Non-Aktif</option>
            </select>
            <?php echo form_error('status'); ?>
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

<!-- ============ MODAL EDIT DATA =============== -->
<?php foreach ($pengguna as $p) : ?>
  <div class="modal fade" id="modal_edit<?php echo $p->pengguna_id; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="col-12 modal-title text-center">Edit User
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <form class="form-horizontal" onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/pengguna_update') ?>">
          <div class="card-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="hidden" name="id" value="<?php echo $p->pengguna_id; ?>">
              <input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengguna .." value="<?php echo $p->pengguna_nama; ?>">
              <?php echo form_error('nama'); ?>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" placeholder="Masukkan email pengguna .." value="<?php echo $p->pengguna_email; ?>">
              <?php echo form_error('email'); ?>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" placeholder="Masukkan username pengguna.." value="<?php echo $p->pengguna_username; ?>">
              <?php echo form_error('username'); ?>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Masukkan password pengguna..">
              <?php echo form_error('password'); ?>
              <small>Kosongkan jika tidak ingin mengubah password</small>
            </div>
            <div class="form-group">
              <label>Divisi</label>
              <select class="form-control" name="level">
                <option value="">- Pilih Level -</option>
                <option <?php if ($p->pengguna_level == "admin") {
                          echo "selected='selected'";
                        } ?> value="admin">Admin</option>
                <option <?php if ($p->pengguna_level == "purchase") {
                          echo "selected='selected'";
                        } ?> value="purchase">Purchase</option>
                <option <?php if ($p->pengguna_level == "sales") {
                          echo "selected='selected'";
                        } ?> value="sales">Sales</option>
                <option <?php if ($p->pengguna_level == "driver") {
                          echo "selected='selected'";
                        } ?> value="sales">Driver</option>
                <option <?php if ($p->pengguna_level == "ga") {
                          echo "selected='selected'";
                        } ?> value="sales">Ga</option>
              </select>
              <?php echo form_error('level'); ?>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="form-control" name="status">
                <option value="">- Pilih Status -</option>
                <option <?php if ($p->pengguna_status == "1") {
                          echo "selected='selected'";
                        } ?> value="1">Aktif</option>
                <option <?php if ($p->pengguna_status == "0") {
                          echo "selected='selected'";
                        } ?> value="0">Non-Aktif</option>
              </select>
              <?php echo form_error('status'); ?>
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
<!--END MODAL EDIT DATA-->

<!--MODAL HAPUS DESC-->
<?php foreach ($pengguna as $u) : ?>
  <div class="modal fade" id="modal_hapus<?php echo $u->pengguna_id; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="col-12 modal-title text-center">Delete User
            <button class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <form class="form-horizontal" onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/pengguna_hapus') ?>">
          <div class="modal-body">
            <input type="hidden" name="id" value="<?php echo $u->pengguna_id; ?>">
            <p>Are you sure delete <?php echo $u->pengguna_nama; ?> ?</p>
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