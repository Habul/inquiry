<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Arship Order & Tracking Delivery</h1>
                    <small>Berisikan Order dan Delivery yang sudah selesai</small>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-paper-plane"></i> Arship Order & Tracking Delivery</h4>
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
                                $no = 1;
                                foreach ($arship as $p) { ?>
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
                                            <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_view<?php echo $p->no_id; ?>" title="View detail"><i class="fa fa-search"></i></a>
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