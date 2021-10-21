<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Surat Jalan Print</title>

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
      <div class="col-12">
        <h2 class="page-header">
          <img src="<?php echo base_url(); ?>gambar/website/Logo-02.PNG">
          <u class="float-right">SURAT JALAN</u>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          Komplek Pergudangan lio baru asri Blok C RT.7/RW.004<br>
          Batuceper, Kec Batuceper, Kota Tangerang, Banten 15121<br>
        </address>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

      <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          Komplek Pergudangan lio baru asri Blok C RT.7/RW.004<br>
          Batuceper, Kec Batuceper, Kota Tangerang, Banten 15121<br>
        </address>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped ">
          <thead>
          <tr>
            <th>No</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Description</th>
          </tr>
          </thead>
          <?php
          $no = 1;
          foreach ($getSjhs as e) {  ?>
          <tbody>
          <tr>
            <td>$no++</td>
            <td>$e->descript;</td>
            <td>$e->qty;</td>
          </tr>
          </tbody>
        </table>
        <?php } ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
