<!DOCTYPE html>
<style media="print">
  @page {
    size: 9.5in 5.5in;
    size: landscape;
  }

  body {
    margin: 0px;
    /* the margin on the content before printing */
  }
</style>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intisera | Surat Jalan Print</title>
  <link rel='icon' href="<?php echo base_url(); ?>gambar/website/Untitled-1-02.png" type="image/gif">
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&display=fallback" rel="stylesheet" media="print">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
</head>

<body>
  <div class="wrapper">
    <section class="invoice">
      <div class="row">
        <div class="col-12 table-responsive-sm">
          <table class="table table-borderless table-sm">
            <tr>
              <td><img src="<?php echo base_url(); ?>gambar/website/Logo-011.png" style="width:239px;height:54px;"></td>
              <td width="30%"></td>
              <td style="text-align:center"><br />
                <h3><b>SURAT JALAN</b></h3>
              </td>
            </tr>
            </tr>
            <tr>
              <td width="30%">
                Rukan Green Garden, Blok Z 2 No 66-69 Jl Raya panjang,
                Jakarta Barat 11520</td>
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
            <?php foreach ($sj_user_df as $u) : ?>
              <tr>
                <td width="10%">Delivery No</td>
                <td> : </td>
                <td><?php echo str_replace("-", "/", $u->no_delivery); ?></td>
                <td width="25%"></td>
                <td rowspan="2">Address</td>
                <td rowspan="2"> : </td>
                <td rowspan="2" width="30%"><?php echo $u->address; ?></td>
              </tr>
              <tr>
                <td width="10%">Delivery Date</td>
                <td> : </td>
                <td><?php echo $u->date_delivery; ?></td>
                <td width="25%"></td>
              </tr>
              <tr>
                <td width="10%">Due Date</td>
                <td> : </td>
                <td><?php echo $u->due_date; ?></td>
                <td width="25%"></td>
                <td>City</td>
                <td> : </td>
                <td><?php echo $u->city; ?></td>
              </tr>
              <tr>
                <td width="10%">Cust Name</td>
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
              <tr style="border: 2px solid black">
                <td colspan="2" style="text-align:center"><b>Total<b></td>
                <td style="text-align:center"><b><?php echo $total_qty; ?><b></td>
              </tr>
              </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-12 table-responsive-sm">
          <table class="table table-borderless table-sm">
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

<script>
  window.addEventListener("load", window.print());
</script>