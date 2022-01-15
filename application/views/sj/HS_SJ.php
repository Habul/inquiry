<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intisera | Surat Jalan Print</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/pdf.css">
</head>

<body>
  <div>
    <section>
      <div>
        <div>
          <table id="table_hide">
            <tr>
              <td><img src="<?php echo base_url(); ?>gambar/website/Logo-02.png" style="width:250px;height:50px;"></td>
              <td width="30%"></td>
              <td style="text-align:center">
                <h3><b>SURAT JALAN</b></h3>
                <h3><b>( DELIVERY ORDER )</b></h3>
              </td>
            </tr>
            <tr>
              <td width="30%">
                Komplek Pergudangan lio baru asri Blok C RT.7/RW.004 Batuceper, Kec Batuceper, Kota Tangerang, Banten 15121<br></td>
              <td width="30%"></td>
              <td></td>
            </tr>
          </table>
        </div>
      </div>

      <div>
        <div>
          <table id="table_hide">
            <?php foreach ($sj_user as $u) : ?>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td width="10%"></td>
                <td width="14%">Cust Name</td>
                <td> : </td>
                <td><?php echo $u->cust_name; ?></td>
              </tr>
              <tr>
                <td width="20%">Delivery Order No</td>
                <td> : </td>
                <td><?php echo $u->no_delivery; ?></td>
                <td width="10%"></td>
                <td rowspan="2">Address</td>
                <td rowspan="2"> : </td>
                <td rowspan="2" width="30%"><?php echo $u->address; ?></td>
              </tr>
              <tr>
                <td width="20%">Delivery Order Date</td>
                <td> : </td>
                <td><?php echo $u->date_delivery; ?></td>
                <td width="10%"></td>
              </tr>
              <tr>
                <td width="20%">Due Date</td>
                <td> : </td>
                <td><?php echo $u->due_date; ?></td>
                <td width="10%"></td>
                <td>City</td>
                <td> : </td>
                <td><?php echo $u->city; ?></td>
              </tr>
              <tr>
                <td width="20%">P.O No.</td>
                <td> : </td>
                <td><?php echo $u->no_po; ?></td>
                <td width="10%"></td>
                <td>Phone</td>
                <td> : </td>
                <td><?php echo preg_replace('/\d{3}/', '$0-', str_replace('.', 'null', trim($u->phone)), 1); ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
      <br />

      <div>
        <div>
          <table id="table">
            <thead>
              <tr style="text-align:center">
                <th style="text-align:center"><b>No</b></th>
                <th width="80%" style="text-align:center"><b>Description</b></th>
                <th style="text-align:center"><b>Qty</b></th>
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
      <br />
      <div>
        <div>
          <table id="table_hide">
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