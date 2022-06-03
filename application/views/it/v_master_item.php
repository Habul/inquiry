<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Master Item</h1>
          <small>Approve Master item INTISERA<b>7Soft</b></small>
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
                <a class="btn btn-success shadow" data-toggle="modal" data-target="#modal_add">
                  <i class="fa fa-plus"></i>&nbsp; Create new item
                </a>
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
                    <th>Merk</th>
                    <th>Kelompok</th>
                    <th>Part Number</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Status</th>
                    <th width="8%">Actions</th>
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
                    <td class="text-center"><?= $p->nama ?></td>
                    <td class="text-center"><?= $p->satuan ?></td>
                    <td class="text-center">
                      <?php if ($p->approve == 1) : ?>
                        <span class="badge badge-success"><i class="fas fa-check-circle"></i> Approve</span>
                      <?php else : ?>
                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Reject</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a class="btn-sm btn-warning" data-toggle="modal" data-target="#modal_edit<?= $p->id; ?>" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                      <a class="btn-sm btn-danger" data-toggle="modal" data-target="#modal_del<?= $p->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php
                }  ?>
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
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="col-12 modal-title text-center">Create new license</h5>
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
              <label class="input-group-text pr-5">Merk&emsp;</label>
            </div>
            <input type="text" name="merk" class="form-control" placeholder="Input merk.." required>
          </div>
          <div class="form-group mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <label class="input-group-text">Kelompok&emsp;</label>
              </div>
              <input type="text" name="kelompok" class="form-control" placeholder="Input kelompok.." required>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <label class="input-group-text">Part Number</label>
              </div>
              <input type="text" name="part_number" class="form-control" placeholder="Input part number.." required>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <label class="input-group-text pr-5">Nama&nbsp;&nbsp;</label>
              </div>
              <input type="text" name="nama" class="form-control" placeholder="Input nama.." required>
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
                <label class="input-group-text pr-5">Type&emsp;</label>
              </div>
              <input type="text" name="type" class="form-control" placeholder="Input satuan..">
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
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="col-12 modal-title text-center">Edit license</h5>
        </div>
        <form onsubmit="editbtn.disabled = true; return true;" method="post" action="<?= base_url('master_item/edit') ?>">
          <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text pr-5">User</label>
              </div>
              <input type="text" name="user" class="form-control" value="<?= $p->user ?>" readonly required>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text">Merk</label>
              </div>
              <input type="text" name="merk" class="form-control" value="<?= $p->merk ?>" required>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text">Kelompok</label>
                </div>
                <input type="text" name="kelompok" class="form-control" value="<?= $p->kelompok ?>" required>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-5">Part Number</label>
                </div>
                <input type="text" name="part_number" class="form-control" value="<?= $p->part_number ?>">
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-5">Nama</label>
                </div>
                <input type="text" name="nama" class="form-control" value="<?= $p->nama ?>">
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text pr-5">Satuan</label>
                </div>
                <input type="text" name="satuan" class="form-control" value="<?= $p->satuan ?>">
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
          <h5 class="col-12 modal-title text-center">Delete license
          </h5>
        </div>
        <form onsubmit="delbtn.disabled = true; return true;" method="post" action="<?= base_url('master_item/delete') ?>">
          <div class="modal-body">
            <input type="hidden" name="id" value="<?= $p->id; ?>">
            <input type="hidden" name="nama" value="<?= $p->nama; ?>">
            <span>Are you sure delete <?= $p->nama; ?> ?</span>
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
<!--End Modals Edit & delete-->