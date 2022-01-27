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
      <div class="row">
        <div>
          <table id="table_hide">
            <tr>
              <td><img src="<?php echo base_url(); ?>gambar/website/Logo-011.png" style="width:200px;height:45px;"></td>
              <td width="30%"></td>
              <td style="text-align:center">
                <h3><b>SURAT JALAN</b></h3>
                <h3><b>( DELIVERY ORDER )</b></h3>
              </td>
            </tr>
            <tr>
              <td width="35%">
                Rukan Green Garden, Blok Z 2 No 66-69 Jl Raya panjang,
                Jakarta Barat 11520</td>
              <td width="30%"></td>
              <td style="text-align:center">
              </td>
            </tr>
          </table>
        </div>
      </div>
      <br />
      <div class="row">
        <div>
          <table id="table_hide">
            <?php foreach ($sj_user_df as $u) : ?>
              <tr>
                <td width="15%">Delivery No</td>
                <td> : </td>
                <td><?php echo str_replace("-", "/", $u->no_delivery); ?></td>
                <td width="25%"></td>
                <td rowspan="2">Address</td>
                <td rowspan="2"> : </td>
                <td rowspan="2" width="30%"><?php echo $u->address; ?></td>
              </tr>
              <tr>
                <td width="15%">Delivery Date</td>
                <td> : </td>
                <td><?php echo $u->date_delivery; ?></td>
                <td width="25%"></td>
              </tr>
              <tr>
                <td width="15%">Due Date</td>
                <td> : </td>
                <td><?php echo $u->due_date; ?></td>
                <td width="25%"></td>
                <td>City</td>
                <td> : </td>
                <td><?php echo $u->city; ?></td>
              </tr>
              <tr>
                <td width="15%">Cust Name</td>
                <td> : </td>
                <td><?php echo $u->cust_name; ?></td>
                <td width="25%"></td>
                <td>Phone</td>
                <td> : </td>
                <td><?php echo preg_replace('/\d{3}/', '$0-', str_replace('.', 'null', trim($u->phone)), 1); ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
      <br />
      <div class="row">
        <div>
          <table id="table">
            <thead>
              <tr style="text-align:center">
                <th style="text-align:center"><b>No</b></th>
                <th style="text-align:center" width="80%"><b>Description</b></th>
                <th style="text-align:center"><b>Qty</b></th>
              </tr>
            </thead>
            <?php
            $no = 1;
            foreach ($sj_df as $h) :
              $sum_total[] = $h->qty;
              $total_qty = array_sum($sum_total); ?>
              <tbody>
                <tr>
                  <td style="text-align:center"><?php echo $no++; ?></td>
                  <td><?php echo $h->descript; ?></td>
                  <td style="text-align:center"><?php echo $h->qty; ?></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="2" style="text-align:center"><b>Total<b></td>
                <td style="text-align:center"><b><?php echo $total_qty; ?><b></td>
              </tr>
              </tbody>
          </table>
        </div>
      </div>
      <br />
      <div class="row">
        <div>
          <table id="table_hide">
            <tr style="text-align:center">
              <td><b>Received By.</b></td>
              <td><b>Delivered By.</b></td>
              <td><b>Sign By.</b></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr style="text-align:center">
              <td>.....................</td>
              <td>.....................</td>
              <td><?php echo $this->session->userdata('nama'); ?></td>
            </tr>
          </table>
        </div>
      </div>
    </section>
  </div>
</body>

</html>