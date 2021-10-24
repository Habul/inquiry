<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
</head>

<body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12 table-responsive-sm">
          <table class="table table-borderless table-sm">
            <tr>
              <td><img src="<?php echo base_url(); ?>gambar/website/Logo-02.PNG" style="width:400px;height:75px;"></td>
              <td width="30%"></td>
              <td style="text-align:center"><br /><br />
                <h3>SURAT JALAN</h3>
              </td>
            </tr>
            </tr>
            <tr>
              <td width="30%">
                Komplek Pergudangan lio baru asri Blok C RT.7/RW.004<br>
                Batuceper, Kec Batuceper, Kota Tangerang, Banten 15121<br></td>
              <td width="30%"></td>
              <td style="text-align:center">
                <h3>
                  ( DELIVERY ORDER )</h3>
              </td>
            </tr>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->

      <div class="row">
        <div class="col-12 table-responsive-sm">
          <table class="table table-borderless table-sm">
            <?php foreach ($sj_user as $u) : ?>
              <tr>
                <td>Delivery Order No</td>
                <td> : </td>
                <td><?php echo $u->no_delivery; ?></td>
                <td width="30%"></td>
                <td>Cust Name</td>
                <td> : </td>
                <td><?php echo $u->cust_name; ?></td>
              </tr>
              <tr>
                <td>Delivery Order Date</td>
                <td> : </td>
                <td><?php echo $u->date_delivery; ?></td>
                <td width="30%"></td>
                <td>Address</td>
                <td> : </td>
                <td><?php echo $u->address; ?></td>
              </tr>
              <tr>
                <td>Due Date</td>
                <td> : </td>
                <td><?php echo $u->due_date; ?></td>
                <td width="30%"></td>
                <td>City</td>
                <td> : </td>
                <td><?php echo $u->city; ?></td>
              </tr>
              <tr>
                <td>P.O. No.</td>
                <td> : </td>
                <td><?php echo $u->no_po ?></td>
                <td width="30%"></td>
                <td>Phone</td>
                <td> : </td>
                <td><?php echo $u->phone; ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.col -->
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive-sm">
          <table class="table table-bordered table-sm">
            <thead>
              <tr style="text-align:center">
                <th>No</th>
                <th width="80%">Description</th>
                <th>Qty</th>
              </tr>
            </thead>
            <?php
            $no = 1; ?>
            <?php foreach ($sj_hs as $h) : ?>
              <tbody>
                <tr>
                  <td style="text-align:center"><?php echo $no++; ?></td>
                  <td><?php echo $h->descript; ?></td>
                  <td style="text-align:center"><?php echo $h->qty; ?></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td style="text-align:center">&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align:center">&nbsp;</td>
              </tr>
              <tr>
                <td style="text-align:center">&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align:center">&nbsp;</td>
              </tr>
              <tr>
                <td style="text-align:center">&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align:center">&nbsp;</td>
              </tr>
              <tr>
                <td style="text-align:center">&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align:center">&nbsp;</td>
              </tr>
              <tr>
                <td style="text-align:center">&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align:center">&nbsp;</td>
              </tr>
              </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-12 table-responsive-sm">
          <table class="table table-borderless table-sm">
            <thead>
              <tr style="text-align:center">
                <th>Received By.</th>
                <th>Delivered By.</th>
                <th>Warehouse By.</th>
                <th>Sign By.</th>
              </tr>
            </thead>
            <?php
            $no = 1; ?>
            <tbody>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr style="text-align:center">
                <td>.....................</td>
                <td>.....................</td>
                <td>.....................</td>
                <td>.....................</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
  <!-- Page specific script -->
</body>

</html>

<script>
  window.addEventListener("load", window.print());
</script>