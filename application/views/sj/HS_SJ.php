<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intisera | Surat Jalan Print</title>
  <link rel='icon' href="<?php echo base_url(); ?>gambar/website/Untitled-1-02.png" type="image/gif">
  <style>
    .row {
      margin-right: -15px;
      margin-left: -15px;
    }

    .col-xs-1,
    .col-sm-1,
    .col-md-1,
    .col-lg-1,
    .col-xs-2,
    .col-sm-2,
    .col-md-2,
    .col-lg-2,
    .col-xs-3,
    .col-sm-3,
    .col-md-3,
    .col-lg-3,
    .col-xs-4,
    .col-sm-4,
    .col-md-4,
    .col-lg-4,
    .col-xs-5,
    .col-sm-5,
    .col-md-5,
    .col-lg-5,
    .col-xs-6,
    .col-sm-6,
    .col-md-6,
    .col-lg-6,
    .col-xs-7,
    .col-sm-7,
    .col-md-7,
    .col-lg-7,
    .col-xs-8,
    .col-sm-8,
    .col-md-8,
    .col-lg-8,
    .col-xs-9,
    .col-sm-9,
    .col-md-9,
    .col-lg-9,
    .col-xs-10,
    .col-sm-10,
    .col-md-10,
    .col-lg-10,
    .col-xs-11,
    .col-sm-11,
    .col-md-11,
    .col-lg-11,
    .col-xs-12,
    .col-sm-12,
    .col-md-12,
    .col-lg-12 {
      position: relative;
      min-height: 1px;
      padding-right: 15px;
      padding-left: 15px;
    }

    .col-lg-12 {
      width: 100%;
    }

    .text-center {
      text-align: center;
    }

    body {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 12px;
      line-height: 1.42857143;
      color: #333;
      background-color: #fff;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <section>
      <div class="row">
        <div class="col-12 table-responsive-sm">
          <table class="table table-borderless table-sm">
            <tr>
              <td><img src="<?php echo base_url(); ?>gambar/website/Logo-02.png" style="width:400px;height:75px;"></td>
              <td width="30%"></td>
              <td style="text-align:center"><br /><br />
                <h3><b>SURAT JALAN</b></h3>
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
                  <b>( DELIVERY ORDER )</b>
                </h3>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-12 table-responsive-sm">
          <table class="table table-borderless table-sm">
            <?php foreach ($sj_user as $u) : ?>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td width="30%"></td>
                <td>Cust Name</td>
                <td> : </td>
                <td><?php echo $u->cust_name; ?></td>
              </tr>
              <tr>
                <td width="30%">Delivery Order No</td>
                <td> : </td>
                <td><?php echo $u->no_delivery; ?></td>
                <td width="30%"></td>
                <td rowspan="2">Address</td>
                <td rowspan="2"> : </td>
                <td rowspan="2" width="30%"><?php echo $u->address; ?></td>
              </tr>
              <tr>
                <td width="30%">Delivery Order Date</td>
                <td> : </td>
                <td><?php echo $u->date_delivery; ?></td>
                <td width="30%"></td>
              </tr>
              <tr>
                <td width="30%">Due Date</td>
                <td> : </td>
                <td><?php echo $u->due_date; ?></td>
                <td width="30%"></td>
                <td>City</td>
                <td> : </td>
                <td><?php echo $u->city; ?></td>
              </tr>
              <tr>
                <td width="30%">P.O No.</td>
                <td> : </td>
                <td><?php echo $u->no_po; ?></td>
                <td width="30%"></td>
                <td>Phone</td>
                <td> : </td>
                <td><?php echo preg_replace('/\d{3}/', '$0-', str_replace('.', 'null', trim($u->phone)), 1); ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-12 table-responsive-sm">
          <table class="table table-bordered table-sm" style="border: 2px solid black">
            <thead style="border: 2px solid black">
              <tr style="text-align:center">
                <th><b>No</b></th>
                <th width="80%"><b>Description</b></th>
                <th><b>Qty</b></th>
              </tr>
            </thead>
            <?php
            $no = 1;
            foreach ($sj_hs as $h) :  ?>
              <tbody>
                <tr>
                  <td style="text-align:center"><?php echo $no++; ?></td>
                  <td><?php echo $h->descript; ?></td>
                  <td style="text-align:center"><?php echo $h->qty; ?></td>
                </tr>
              </tbody>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-12 table-responsive-sm">
          <table class="table table-borderless table-sm">
            <tr style="text-align:center">
              <td><b>Received By.</b></td>
              <td><b>Delivered By.</b></td>
              <td><b>Warehouse By.</b></td>
              <td><b>Sign By.</b></td>
            </tr>
            <?php
            $no = 1; ?>
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
          </table>
        </div>
      </div>
    </section>
  </div>
</body>

</html>