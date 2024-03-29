<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Order & Tracking Delivery</h1>
          <small>Pilih Finish di menu delivery Now atau di delivery yesterday,jika pengiriman sudah selesai/sudah sampai
            ,untuk di pindah ke menu <b>arship delivery</b></small>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Tracking</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

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
        <div class="col-12 table-responsive-sm">
          <a class="btn btn-success float-left" data-toggle="modal" data-target="#modal_add">
            <i class="fa fa-plus"></i>&nbsp; Add Order Delivery</a>
          <div class="btn-group float-right">
            <button class="btn btn-primary"><i class="fas fa-search"></i> View Delivery</button>
            <button class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" data-toggle="modal" data-target="#modal_view_driver">
                <i class="fa fa-search"></i>&nbsp; Delivery Now</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" data-toggle="modal" data-target="#modal_view_yesterday">
                <i class="fa fa-exclamation"></i>&nbsp; Delivery Yesterday</a>
            </div>
          </div>
        </div>
        <br />
        <br />
        <div class="col-md-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h4 class="card-title"><i class="fa fa-paper-plane"></i> Order & Tracking Delivery</h4>
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
              <table id="example11" class="table table-bordered table-striped">
                <thead class="thead-dark" style="text-align:center">
                  <tr>
                    <th>Nama</th>
                    <th>Group</th>
                    <th>Customer</th>
                    <th>Alamat</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Waktu</th>
                    <th>Tanggal</th>
                    <th>Tujuan</th>
                    <th>Note</th>
                    <th width="13%">Action</th>
                  </tr>
                </thead>
                <?php
                $query = $this->db->where('action!=', 'FINISH')->get('tracking');
                foreach ($query->result() as $p) {
                ?>
                  <tr>
                    <td><?php echo $p->nama_pemesan; ?></td>
                    <td><?php echo $p->group; ?></td>
                    <td><?php echo $p->nama_cust; ?></td>
                    <td><?php echo $p->alamat_cust; ?></td>
                    <td><?php echo $p->barang; ?></td>
                    <td><?php echo $p->jumlah; ?></td>
                    <td><?php echo $p->waktu; ?></td>
                    <td><?php echo $p->tanggal_kirim; ?></td>
                    <td><?php echo $p->tujuan; ?></td>
                    <td><?php echo $p->note; ?></td>
                    <td style="text-align:center">
                      <?php $encrypturl = urlencode($this->encrypt->encode($p->no_id)) ?>
                      <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $p->no_id; ?>" title="Edit Delivery"><i class="fa fa-pencil-alt"></i></a>
                      <a href="<?php echo base_url() . 'tracking/view/?id=' . $encrypturl; ?>" class="btn btn-primary btn-sm" title="Update delivery"> <i class="fa fa-edit"></i> </a>
                      <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $p->no_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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

<!-- Bootstrap modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="col-12 modal-title text-center">Add Order Delivery
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </h4>
      </div>
      <form class="form-horizontal" onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('tracking/data_aksi') ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pemesan</label>
            <div class="col-sm-10">
              <input type="hidden" name="addtime" class="form-control" value="<?php echo mdate("%Y-%m-%d %H:%i:%s"); ?>">
              <input type="text" name="nama_pemesan" class="form-control" value="<?php echo $this->session->userdata('nama') ?>" readonly required>
              <?php echo form_error('nama_pemesan'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Group</label>
            <div class="col-sm-10">
              <select class="form-control" name="group" required>
                <option value="">- Pilih Group -</option>
                <?php foreach ($unit_bisnis as $row) : ?>
                  <option value="<?php echo $row->singkat; ?>"><?php echo $row->singkat; ?></option>
                <?php endforeach; ?>
              </select>
              <?php echo form_error('group'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">No BBk</label>
            <div class="col-sm-10">
              <input type="text" name="no_bbk" class="form-control" placeholder="Input No bbk.." required>
              <?php echo form_error('no_bbk'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Customer</label>
            <div class="col-sm-10">
              <input type="text" name="nama_cust" class="form-control" placeholder="Input Nama Cust.." required>
              <?php echo form_error('nama_cust'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <textarea name="alamat_cust" class="form-control" placeholder="Input Alamat Cust.." required></textarea>
              <?php echo form_error('alamat_cust'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Penerima</label>
            <div class="col-sm-10">
              <input type="text" name="pic_penerima" class="form-control" placeholder="Input Pic Penerima.." required>
              <?php echo form_error('pic_penerima'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">No Hp</label>
            <div class="col-sm-10">
              <input type="number" name="no_penerima" class="form-control" placeholder="Input No hp Penerima.." required>
              <?php echo form_error('no_penerima'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Barang</label>
            <div class="col-sm-10">
              <input type="text" name="barang" class="form-control" placeholder="Input Nama Barang.." required>
              <?php echo form_error('barang'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="number" name="jumlah" min="1" class="form-control" placeholder="Input Jumlah Barang.." required>
              <?php echo form_error('jumlah'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="status_brg" required>
                <option value="">- Pilih -</option>
                <option value="ORI">ORI</option>
                <option value="MODIF">MODIF</option>
                <option value="SERVIS">SERVIS</option>
                <option value="RETUR">RETUR</option>
                <option value="TEST">TEST</option>
                <option value="TITIPAN">TITIPAN</option>
              </select>
              <?php echo form_error('status_brg'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Waktu</label>
            <div class="col-sm-10">
              <input type="time" name="waktu" class="form-control" required>
              <?php echo form_error('waktu'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
              <input type="date" name="tanggal_kirim" class="form-control" required>
              <?php echo form_error('tanggal_kirim'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tujuan</label>
            <div class="col-sm-10">
              <select class="form-control" name="tujuan" required>
                <option value="">- Pilih -</option>
                <option value="BARANG BARU PESANAN CUSTOMER">BARANG BARU PESANAN CUSTOMER</option>
                <option value="BARANG PENGANTI RETUR">BARANG PENGANTI RETUR</option>
                <option value="BARANG UNTUK SERVIS">BARANG UNTUK SERVIS</option>
                <option value="BARANG DI KEMBALIKAN KE STOCK GUDANG">BARANG DI KEMBALIKAN KE STOCK GUDANG</option>
                <option value="DLL">DLL</option>
              </select>
              <?php echo form_error('tujuan'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Note</label>
            <div class="col-sm-10">
              <textarea type="text" name="note" class="form-control" placeholder="Input Catatan.." required></textarea>
              <?php echo form_error('note'); ?>
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

<!-- ============ MODAL EDIT =============== -->
<?php foreach ($tracking as $p) : ?>
  <div class="modal fade" id="modal_edit<?php echo $p->no_id; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="col-12 modal-title text-center">Edit Order Delivery
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <form class="form-horizontal" onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('tracking/edit') ?>">
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Pemesan</label>
              <div class="col-sm-10">
                <input type="hidden" name="no_id" class="form-control" value="<?php echo $p->no_id; ?>">
                <input type="hidden" name="addtime" readonly class="form-control" value="<?php echo mdate("%Y-%m-%d %H:%i:%s"); ?>">
                <input type="text" name="nama_pemesan" class="form-control" value="<?php echo $p->nama_pemesan ?>" readonly>
                <?php echo form_error('nama_pemesan'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Group</label>
              <div class="col-sm-10">
                <select class="form-control" name="group">
                  <option value="">- Pilih Group -</option>
                  <option <?php if ($p->group == "DFH") {
                            echo "selected='selected'";
                          } ?> value="DFH">DFH</option>
                  <option <?php if ($p->group == "IDE") {
                            echo "selected='selected'";
                          } ?> value="IDE">IDE</option>
                  <option <?php if ($p->group == "CBI") {
                            echo "selected='selected'";
                          } ?> value="CBI">CBI</option>
                  <option <?php if ($p->group == "ISI") {
                            echo "selected='selected'";
                          } ?> value="ISI">ISI</option>
                  <option <?php if ($p->group == "ARC") {
                            echo "selected='selected'";
                          } ?> value="ARC">ARC</option>
                  <option <?php if ($p->group == "UPS") {
                            echo "selected='selected'";
                          } ?> value="UPS">UPS</option>
                  <option <?php if ($p->group == "TFP") {
                            echo "selected='selected'";
                          } ?> value="TFP">TFP</option>
                  <option <?php if ($p->group == "BBI") {
                            echo "selected='selected'";
                          } ?> value="BBI">BBI</option>
                  <option <?php if ($p->group == "JIA") {
                            echo "selected='selected'";
                          } ?> value="JIA">JIA</option>
                  <option <?php if ($p->group == "NHC") {
                            echo "selected='selected'";
                          } ?> value="NHC">NHC</option>
                </select>
                <?php echo form_error('group'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">No BBk</label>
              <div class="col-sm-10">
                <input type="text" name="no_bbk" class="form-control" value="<?php echo $p->no_bbk ?>" required>
                <?php echo form_error('no_bbk'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Customer</label>
              <div class="col-sm-10">
                <input type="text" name="nama_cust" class="form-control" value="<?php echo $p->nama_cust ?>" required>
                <?php echo form_error('nama_cust'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <textarea name="alamat_cust" class="form-control" required><?php echo $p->alamat_cust ?></textarea>
                <?php echo form_error('alamat_cust'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Penerima</label>
              <div class="col-sm-10">
                <input type="text" name="pic_penerima" class="form-control" value="<?php echo $p->pic_penerima ?>" required>
                <?php echo form_error('pic_penerima'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">No Hp</label>
              <div class="col-sm-10">
                <input type="number" name="no_penerima" class="form-control" value="<?php echo $p->no_penerima ?>" required>
                <?php echo form_error('no_penerima'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Barang</label>
              <div class="col-sm-10">
                <input type="text" name="barang" class="form-control" value="<?php echo $p->barang ?>" required>
                <?php echo form_error('barang'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Jumlah</label>
              <div class="col-sm-10">
                <input type="number" name="jumlah" min="1" class="form-control" value="<?php echo $p->jumlah ?>" required>
                <?php echo form_error('jumlah'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="status_brg" required>
                  <option value="">- Pilih -</option>
                  <option <?php if ($p->status_brg == "ORI") {
                            echo "selected='selected'";
                          } ?> value="ORI">ORI</option>
                  <option <?php if ($p->status_brg == "MODIF") {
                            echo "selected='selected'";
                          } ?> value="MODIF">MODIF</option>
                  <option <?php if ($p->status_brg == "SERVIS") {
                            echo "selected='selected'";
                          } ?> value="SERVIS">SERVIS</option>
                  <option <?php if ($p->status_brg == "RETUR") {
                            echo "selected='selected'";
                          } ?> value="RETUR">RETUR</option>
                  <option <?php if ($p->status_brg == "TITIPAN") {
                            echo "selected='selected'";
                          } ?> value="TITIPAN">TITIPAN</option>
                </select>
                <?php echo form_error('status_brg'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Waktu</label>
              <div class="col-sm-10">
                <input type="time" name="waktu" class="form-control" value="<?php echo $p->waktu ?>" required>
                <?php echo form_error('waktu'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tanggal</label>
              <div class="col-sm-10">
                <input type="date" name="tanggal_kirim" class="form-control" value="<?php echo $p->tanggal_kirim ?>" required>
                <?php echo form_error('tanggal_kirim'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tujuan</label>
              <div class="col-sm-10">
                <select class="form-control" name="tujuan" required>
                  <option value="">- Pilih -</option>
                  <option <?php if ($p->tujuan == "BARANG BARU PESANAN CUSTOMER") {
                            echo "selected='selected'";
                          } ?> value="BARANG BARU PESANAN CUSTOMER">BARANG BARU PESANAN CUSTOMER</option>
                  <option <?php if ($p->tujuan == "BARANG PENGANTI RETUR") {
                            echo "selected='selected'";
                          } ?> value="BARANG PENGANTI RETUR">BARANG PENGANTI RETUR</option>
                  <option <?php if ($p->tujuan == "BARANG UNTUK SERVIS") {
                            echo "selected='selected'";
                          } ?> value="BARANG UNTUK SERVIS">BARANG UNTUK SERVIS</option>
                  <option <?php if ($p->tujuan == "BARANG DI KEMBALIKAN KE STOCK GUDANG") {
                            echo "selected='selected'";
                          } ?> value="BARANG DI KEMBALIKAN KE STOCK GUDANG">BARANG DI KEMBALIKAN KE STOCK GUDANG</option>
                  <option <?php if ($p->tujuan == "DLL") {
                            echo "selected='selected'";
                          } ?> value="DLL">DLL</option>
                </select>
                <?php echo form_error('tujuan'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Note</label>
              <div class="col-sm-10">
                <textarea type="text" name="note" class="form-control" required><?php echo $p->note ?></textarea>
                <?php echo form_error('note'); ?>
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
<!--END MODAL EDIT -->

<!--MODAL HAPUS -->
<?php foreach ($tracking as $u) : ?>
  <div class="modal fade" id="modal_hapus<?php echo $u->no_id; ?>" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="col-12 modal-title text-center">Delete Order Delivery
            <button class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h4>
        </div>
        <form class="form-horizontal" onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('tracking/delete') ?>">
          <div class="modal-body">
            <input type="hidden" name="no_id" value="<?php echo $u->no_id; ?>">
            <p>Are you sure delete <?php echo $u->barang; ?> ?</p>
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

<div class="modal fade" id="modal_view_driver" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="col-12 modal-title text-center">List Delivery Now
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped table-sm">
          <thead style="text-align:center">
            <tr>
              <th width="5%">No</th>
              <th style="min-width:150px;">Nama Driver</th>
              <th width="15%">No Bbk</th>
              <th width="30%">Customer</th>
              <th width="14%">Action</th>
            </tr>
          </thead>
          <?php
          $no = 1;
          $cek = $this->db->query("SELECT * FROM tracking WHERE plan_kirim=DATE(NOW()) AND action='START'");
          foreach ($cek->result() as $u) {
          ?>
            <tr>
              <td style="text-align:center"><?php echo $no++; ?></td>
              <td><?php echo $u->nama_driver; ?></td>
              <td style="text-align:center"><?php echo $u->no_bbk; ?></td>
              <td><?php echo $u->nama_cust; ?></td>
              <td><select class="form-control" name="tujuan">
                  <option value="">- Pilih -</option>
                  <option <?php if ($u->action == "START") {
                            echo "selected='selected'";
                          } ?> value="START">START</option>
                  <option <?php if ($u->action == "FINISH") {
                            echo "selected='selected'";
                          } ?> value="FINISH">FINISH</option>
                </select>
              </td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <button class="btn btn-primary" action="<?php echo base_url('tracking/update_deli_yes') ?>"><i class="fa fa-check"></i> Update</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_view_yesterday" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="col-12 modal-title text-center">List Delivery Yesterday
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped table-sm">
          <thead style="text-align:center">
            <tr>
              <th width="5%">No</th>
              <th style="min-width:150px;">Nama Driver</th>
              <th width="15%">No Bbk</th>
              <th width="30%">Customer</th>
              <th width="14%">Action</th>
            </tr>
          </thead>
          <?php
          $no = 1;
          $cek = $this->db->query("SELECT * FROM tracking WHERE plan_kirim<DATE(NOW()) AND action='START'");
          foreach ($cek->result() as $u) {
          ?>
            <tr>
              <td style="text-align:center"><?php echo $no++; ?></td>
              <td><?php echo $u->nama_driver; ?></td>
              <td style="text-align:center"><?php echo $u->no_bbk; ?></td>
              <td><?php echo $u->nama_cust; ?></td>
              <td><select class="form-control" name="tujuan">
                  <option value="">- Pilih -</option>
                  <option <?php if ($u->action == "START") {
                            echo "selected='selected'";
                          } ?> value="START">START</option>
                  <option <?php if ($u->action == "FINISH") {
                            echo "selected='selected'";
                          } ?> value="FINISH">FINISH</option>
                </select>
              </td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <button class="btn btn-primary" action="<?php echo base_url('tracking/update_deli_yes') ?>"><i class=" fa fa-check"></i> Update</button>
      </div>
    </div>
  </div>
</div>