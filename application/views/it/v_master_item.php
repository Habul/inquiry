<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Master Item</h1>
          <small>Approve Master item INTISERA <b>7Soft</b></small>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Master Item</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h4 class="card-title">
                <?php if ($this->session->userdata('level') != "sales") :  ?>
                  <a class="btn btn-success shadow" data-toggle="modal" data-target="#modal_add">
                    <i class="fa fa-plus"></i>&nbsp; Create new item
                  </a>
                <?php elseif ($this->session->userdata('enginering') != "engineering") : ?>
                  <i class="fas fa-tools"></i>&nbsp; Master item
                <?php endif; ?>
              </h4>
              <div class="card-tools">
                <button type="button" class="btn btn-xs btn-icon btn-circle btn-warning" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-xs btn-icon btn-circle btn-primary" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-xs btn-icon btn-circle btn-danger" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="index1" class="table table-striped table-sm">
                <thead class="thead-dark text-center">
                  <tr>
                    <th width="5%">No</th>
                    <th>User</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Part Number</th>
                    <th>Assy Code</th>
                    <th>Satuan</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th width="11%">Actions</th>
                  </tr>
                </thead>
                <?php
                foreach ($master as $p) {
                ?>
                  <tr>
                    <td class="text-center"></td>
                    <td class="text-center"><?= $p->user ?></td>
                    <td><?= strtoupper($p->merk) ?></td>
                    <td class="text-center"><?= $p->kelompok ?></td>
                    <td class="text-center"><?= strtoupper($p->part_number) ?></td>
                    <td class="text-center"><?= strtoupper($p->nama) ?></td>
                    <td class="text-center"><?= $p->satuan ?></td>
                    <td class="text-center"><?= strtoupper($p->type) ?></td>
                    <td class="align-middle text-center">
                      <?php if ($p->status == 1) : ?>
                        <span class="badge badge-success"><i class="fas fa-check-circle"></i> Approve</span>
                      <?php elseif ($p->status == 2) : ?>
                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Reject</span>
                      <?php else : ?>
                        <span> - </span>
                      <?php endif; ?>
                    </td>
                    <td class="align-middle text-center">
                      <?php if ($this->session->userdata('level') != "engineering") :  ?>
                        <a class="btn-sm btn-info" data-toggle="modal" data-target="#modal_update<?= $p->id; ?>" title="Update"><i class="fas fa-edit"></i></a>
                      <?php endif ?>
                      <?php if ($this->session->userdata('level') != "sales") :  ?>
                        <a class="btn-sm btn-warning" data-toggle="modal" data-target="#modal_edit<?= $p->id; ?>" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                        <a class="btn-sm btn-danger" data-toggle="modal" data-target="#modal_del<?= $p->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php
                }  ?>
              </table>
            </div>
          </div>

          <div class="card card-success card-outline">
            <div class="card-header">
              <h4 class="card-title"><i class="fa fa-check-square"></i> Master item Approve</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-xs btn-icon btn-circle btn-warning" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-xs btn-icon btn-circle btn-primary" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-xs btn-icon btn-circle btn-danger" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="index2" class="table table-hover table-sm">
                <thead class="thead-light text-center">
                  <tr>
                    <th width="5%">No</th>
                    <th>User</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Part Number</th>
                    <th>Assy Code</th>
                    <th>Satuan</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th>Status IT</th>
                    <?php if ($this->session->userdata('level') == "admin") :  ?>
                      <th width="3%">Actions</th>
                    <?php endif ?>
                  </tr>
                </thead>
                <?php
                foreach ($master_ok as $p) {
                ?>
                  <tr>
                    <td class="text-center"></td>
                    <td class="text-center"><?= $p->user ?></td>
                    <td><?= strtoupper($p->merk) ?></td>
                    <td class="text-center"><?= $p->kelompok ?></td>
                    <td class="text-center"><?= strtoupper($p->part_number) ?></td>
                    <td class="text-center"><?= strtoupper($p->nama) ?></td>
                    <td class="text-center"><?= $p->satuan ?></td>
                    <td class="text-center"><?= strtoupper($p->type) ?></td>
                    <td class="align-middle text-center">
                      <?php if ($p->status == 1) : ?>
                        <span class="badge badge-success"><i class="fas fa-check-circle"></i> Approve</span>
                      <?php elseif ($p->status == 2) : ?>
                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Reject</span>
                      <?php else : ?>
                        <span> - </span>
                      <?php endif; ?>
                    </td>
                    <td class="align-middle text-center">
                      <?php if ($p->status_it == 1) : ?>
                        <span class="badge badge-success"><i class="fas fa-check-circle"></i> Approve System</span>
                      <?php elseif ($p->status_it == 2) : ?>
                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Reject</span>
                      <?php else : ?>
                        <span> - </span>
                      <?php endif; ?>
                    </td>
                    <?php if ($this->session->userdata('level') == "admin") :  ?>
                      <td class="text-center">
                        <div class="form-check">
                          <input class="form-check-input position-static" type="checkbox" <?= check_access($role['id'], $m['id']);  ?> data-role="<?= $p->status_it;  ?>" data-menu="<?= $p->id; ?>">
                        </div>
                      </td>
                    <?php endif ?>
                  </tr>
                <?php  }  ?>
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
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="col-12 modal-title text-center">Create new item</h5>
      </div>
      <form onsubmit="addbtn.disabled = true; return true;" method="post" action="<?= base_url('master_item/add') ?>">
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text pr-5">User&emsp;</label>
            </div>
            <input type="text" name="user" class="form-control" value="<?= $this->session->userdata('nama') ?>" readonly required>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text pr-5">Brand&nbsp;</label>
            </div>
            <input type="text" name="merk" class="form-control" placeholder="Input brand.." required>
          </div>
          <div class="form-group mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <label class="input-group-text pr-4">Category&nbsp;&nbsp;&nbsp;</label>
              </div>
              <input type="text" name="kelompok" class="form-control" placeholder="Input category.." required>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <label class="input-group-text pr-2">Part Number</label>
              </div>
              <input type="text" name="part_number" class="form-control" placeholder="Input part number.." required>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <label class="input-group-text pr-3">Assy Code&nbsp;&nbsp;&nbsp;</label>
              </div>
              <input type="text" name="nama" class="form-control" placeholder="Input assy code.." required>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <label class="input-group-text pr-4">Satuan&emsp;&nbsp;&nbsp;</label>
              </div>
              <input type="text" name="satuan" class="form-control" placeholder="Input satuan..">
            </div>
          </div>
          <div class="form-group mb-0">
            <div class="input-group">
              <div class="input-group-prepend">
                <label class="input-group-text pr-5">Tipe&emsp;</label>
              </div>
              <select name="type" class="form-control">
                <option value="">-Choose Tipe-</option>
                <option value="inventory">Inventory</option>
                <option value="non inventory">Non Inventory</option>
              </select>
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
<!--End Modals Add-->

<!-- Bootstrap modal edit -->
<?php foreach ($master as $p) : ?>
  <div class="modal fade" id="modal_edit<?= $p->id ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="col-12 modal-title text-center">Edit item</h5>
        </div>
        <form onsubmit="editbtn.disabled = true; return true;" method="post" action="<?= base_url('master_item/edit') ?>">
          <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text pr-5">User&emsp;</label>
              </div>
              <input type="hidden" name="id" value="<?= $p->id ?>">
              <input type="text" name="user" class="form-control" value="<?= $p->user ?>" readonly required>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text pr-5">Brand&nbsp;</label>
              </div>
              <input type="text" name="merk" class="form-control" value="<?= $p->merk ?>" required>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-4">Category&nbsp;&nbsp;&nbsp;</label>
                </div>
                <input type="text" name="kelompok" class="form-control" value="<?= $p->kelompok ?>" required>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-2">Part Number</label>
                </div>
                <input type="text" name="part_number" class="form-control" value="<?= htmlentities($p->part_number) ?>" required>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-3">Assy Code&nbsp;&nbsp;&nbsp;</label>
                </div>
                <input type="text" name="nama" class="form-control" value="<?= $p->nama ?>" required>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-4">Satuan&emsp;&nbsp;&nbsp;</label>
                </div>
                <input type="text" name="satuan" class="form-control" value="<?= $p->satuan ?>">
              </div>
            </div>
            <div class="form-group mb-0">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-5">Tipe&emsp;</label>
                </div>
                <select class="form-control" name="type">
                  <option <?php if ($p->type == "iventory") {
                            echo "selected='selected'";
                          } ?> value="inventory">Inventory</option>
                  <option <?php if ($p->status == "non iventory") {
                            echo "selected='selected'";
                          } ?> value="non iventory">Non Inventory</option>
                </select>
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

  <div class="modal fade" id="modal_del<?= $p->id; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h5 class="col-12 modal-title text-center">Delete item
          </h5>
        </div>
        <form onsubmit="delbtn.disabled = true; return true;" method="post" action="<?= base_url('master_item/delete') ?>">
          <div class="modal-body">
            <input type="hidden" name="id" value="<?= $p->id; ?>">
            <input type="hidden" name="nama" value="<?= $p->nama; ?>">
            <span>Are you sure delete <?= $p->part_number; ?> ?</span>
          </div>
          <div class="modal-footer justify-content-between">
            <button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
            <button class="btn btn-outline-light" id="delbtn"><i class="fa fa-check"></i> Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_update<?= $p->id ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="col-12 modal-title text-center">Approve item</h5>
        </div>
        <form onsubmit="updbtn.disabled = true; return true;" method="post" action="<?= base_url('master_item/update') ?>">
          <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text pr-5">User&emsp;</label>
              </div>
              <input type="hidden" name="id" value="<?= $p->id ?>">
              <input type="text" name="user" class="form-control" value="<?= $p->user ?>" readonly>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text pr-5">Brand&nbsp;</label>
              </div>
              <input type="text" name="merk" class="form-control" value="<?= $p->merk ?>" readonly>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-4">Category&nbsp;&nbsp;&nbsp;</label>
                </div>
                <input type="text" name="kelompok" class="form-control" value="<?= $p->kelompok ?>" readonly>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-2">Part Number</label>
                </div>
                <input type="text" name="part_number" class="form-control" value="<?= $p->part_number ?>" readonly>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-3">Assy Code&nbsp;&nbsp;&nbsp;</label>
                </div>
                <input type="text" name="nama" class="form-control" value="<?= $p->nama ?>" readonly>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-4">Satuan&emsp;&nbsp;&nbsp;</label>
                </div>
                <input type="text" name="satuan" class="form-control" value="<?= $p->satuan ?>" readonly>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-5">Tipe&emsp;</label>
                </div>
                <input type="text" name="type" class="form-control" value="<?= $p->type ?>" readonly>
              </div>
            </div>
            <div class="form-group mb-0">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-4">Status&emsp;&emsp;</label>
                </div>
                <select class="form-control" name="status" required>
                  <option <?php if ($p->status == "0") {
                            echo "selected='selected'";
                          } ?> value="0">-Choose Select-</option>
                  <option <?php if ($p->status == "1") {
                            echo "selected='selected'";
                          } ?> value="1">Approve</option>
                  <option <?php if ($p->status == "2") {
                            echo "selected='selected'";
                          } ?> value="2">Reject</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            <button class="btn btn-primary" id="updbtn"><i class="fa fa-check"></i> Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<!--End Modals Edit & delete-->

<?php foreach ($master_ok as $p) : ?>
  <div class="modal fade" id="modal_update_it<?= $p->id ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="col-12 modal-title text-center">Approve Item IT</h5>
        </div>
        <form onsubmit="upditbtn.disabled = true; return true;" method="post" action="<?= base_url('master_item/update_it') ?>">
          <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text pr-5">User&emsp;</label>
              </div>
              <input type="hidden" name="id" value="<?= $p->id ?>">
              <input type="text" name="user" class="form-control" value="<?= $p->user ?>" readonly>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text pr-5">Brand&nbsp;</label>
              </div>
              <input type="text" name="merk" class="form-control" value="<?= $p->merk ?>" readonly>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-4">Category&nbsp;&nbsp;&nbsp;</label>
                </div>
                <input type="text" name="kelompok" class="form-control" value="<?= $p->kelompok ?>" readonly>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-2">Part Number</label>
                </div>
                <input type="text" name="part_number" class="form-control" value="<?= $p->part_number ?>" readonly>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-3">Assy Code&nbsp;&nbsp;&nbsp;</label>
                </div>
                <input type="text" name="nama" class="form-control" value="<?= $p->nama ?>" readonly>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-4">Satuan&emsp;&nbsp;&nbsp;</label>
                </div>
                <input type="text" name="satuan" class="form-control" value="<?= $p->satuan ?>" readonly>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-5">Tipe&emsp;</label>
                </div>
                <select class="form-control" name="type">
                  <option <?php if ($p->type == "iventory") {
                            echo "selected='selected'";
                          } ?> value="inventory">Inventory</option>
                  <option <?php if ($p->status == "non iventory") {
                            echo "selected='selected'";
                          } ?> value="non iventory">Non Inventory</option>
                </select>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-4">Status&emsp;&emsp;</label>
                </div>
                <select class="form-control" name="status" required>
                  <option <?php if ($p->status == "0") {
                            echo "selected='selected'";
                          } ?> value="0">-Choose Select-</option>
                  <option <?php if ($p->status == "1") {
                            echo "selected='selected'";
                          } ?> value="1">Approve</option>
                  <option <?php if ($p->status == "2") {
                            echo "selected='selected'";
                          } ?> value="2">Reject</option>
                </select>
              </div>
            </div>
            <div class="form-group mb-0">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-4">Status IT&emsp;</label>
                </div>
                <select class="form-control" name="status_it" required>
                  <option <?php if ($p->status_it == "0") {
                            echo "selected='selected'";
                          } ?> value="0">-Choose Select-</option>
                  <option <?php if ($p->status_it == "1") {
                            echo "selected='selected'";
                          } ?> value="1">Approve</option>
                  <option <?php if ($p->status_it == "2") {
                            echo "selected='selected'";
                          } ?> value="2">Reject</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            <button class="btn btn-primary" id="upditbtn"><i class="fa fa-check"></i> Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach ?>