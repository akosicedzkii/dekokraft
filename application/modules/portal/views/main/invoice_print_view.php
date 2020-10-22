<!DOCTYPE html>
<html lang="en"><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo "INVOINCE:#".$invoice->id;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<script src="chrome-extension://mooikfkahbdckldjjndioackbalphokd/assets/prompt.js"></script></head>
<style type="text/css">
@media print {
  * { overflow: visible !important; }
  body {
    height: auto;
  }
}
.m-b{
  margin-bottom: 0px;
}
.tbl-pad{
  padding: 1px !important;
}
</style>
<body onload="window.print();" style="font-size: 10px;line-height: 1;">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12 text-center">
           <p class="text-uppercase m-b"><?php echo SITE_NAME;?></p>
           <p><?php echo nl2br(COMPANY_ADDRESS);?></p>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row">
      <h4 class="text-center text-uppercase" style="letter-spacing: 3px;"><strong><?php echo $invoice->invoice_type;?> INVOICE</strong></h4>
      <div class="col-sm-5 invoice-col">
        <p class="font-weight-bold m-b"><b>ID.#</b></p>
        <p class="m-b"><b>IQ.#<?php echo $invoice->iq;?></b></p>
        <p class="m-b"><b>DATE:</b> <?php echo date("d F Y", strtotime($invoice->invoice_date));?></p>
        <dl class="row">
          <dt class="col-xs-2">TO:</dt>
          <dd class="col-xs-10"><?php echo $customer_address->customer_address;?></dd>
          <dt class="col-xs-2">ATTN:</dt>
          <dd class="col-xs-10"><?php echo $invoice->attn;?></dd>
        </dl>
      </div>
      <div class="col-sm-2 invoice-col">

      </div>
      <div class="col-sm-5 invoice-col">
        <b>ORDER</b>
        <p class="m-b"><b>M.O.#</b> <?php echo ($mo==null)?"":$mo->id;?></p>
        <p class="m-b"><b>Inv.#</b> <?php echo $invoice->id;?></p>
        <p><b>Remarks:</b> <?php echo $invoice->invoice_remarks;?></p>
      </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed" style="font-size:8px;border-bottom: 1px solid black;border-top: 1px solid black;margin-bottom:10px">
        <thead>
          <tr>
            <th colspan="3" class="text-center tbl-pad"></th>
            <th class="text-center tbl-pad">PACKING</th>
            <th colspan="4" class="text-center tbl-pad"></th>
            <th colspan="2" class="text-center tbl-pad">(STD FOB-MNL US$)</th>
          </tr>
          <tr>
            <th class="text-center tbl-pad">ITEM</th>
            <th class="text-center tbl-pad">STOCK #</th>
            <th class="text-center tbl-pad">ARTICLE#</th>
            <th class="text-center tbl-pad">IN/MSTR</th>
            <th class="text-center tbl-pad">CBM.</th>
            <th class="text-center tbl-pad">COLOR</th>
            <th class="text-center tbl-pad">QTY</th>
            <th class="text-center tbl-pad">DESCRIPTION</th>
            <th class="text-center tbl-pad">U. PRICE</th>
            <th class="text-center tbl-pad">TOTAL</th>
          </tr>
          </thead>
          <tbody>
          <?php
            $total_price = 0;
            $total_discounted = 0;
            $item_no=1;
            $total_quntity=0;
            $est_cbm=0;
          ?>
          <?php foreach ($invoice_lines as $line) {
              $total_quntity=$total_quntity+$line->quantity;
              $total_price = $total_price + ($line->quantity* $line->product_price);
              $total_discounted = $total_discounted + (($line->quantity*$line->product_price)-($line->quantity*$line->product_price)*($line->discount/100));

              $res_mstr=0;
              $mstr_data=trim(strtolower($line->master_carton));
              $slice_mstr=explode('x',$mstr_data);
              if(count($slice_mstr)>0){
                foreach ($slice_mstr as $value) {
                  $res_mstr=($res_mstr<1)?$res_mstr+floatval(trim($value)):$res_mstr*floatval(trim($value));
                }
                $res_mstr=$res_mstr/61023;
              }
              $est_cbm=$est_cbm+floatval($res_mstr);
          ?>
          <tr class="text-center">
            <td class="tbl-pad"><?php echo  $item_no++; ?>.</td>
            <td class="tbl-pad"><?php echo  $line->class. "-" . $line->code."-".$line->color_abb; ?></td>
            <td class="tbl-pad"><?php echo  $line->article; ?></td>
            <td class="tbl-pad"><?php echo  $line->in_."/".$line->mstr; ?></td>
            <td class="tbl-pad"><?php echo  number_format($res_mstr,4); ?></td>
            <td class="tbl-pad"><?php echo  $line->color; ?></td>
            <td class="tbl-pad"><?php echo  $line->quantity; ?></td>
            <td class="tbl-pad"><?php echo  $line->description; ?></td>
            <td class="tbl-pad"><?php echo  $line->product_price; ?></td>
            <td class="tbl-pad"><?php echo  number_format((float)($line->quantity * $line->product_price), 2, '.', '') ; ?></td>
            <!-- <td><?php echo  number_format((float)(($line->quantity * $line->product_price) - (($line->quantity * $line->product_price)*($line->discount/100))), 2, '.', ''); ?></td> -->
          </tr>
          <?php
          }?>
            <tr>
              <td colspan="2" class="tbl-pad" style="border-top: 1px solid black;">TOTAL</td>
              <td style="border-top: 1px solid black;" class="text-center tbl-pad">EST. CTN:</td>
              <td style="border-top: 1px solid black;" class="text-center tbl-pad">/</td>
              <td colspan="2" style="border-top: 1px solid black;" class="text-left tbl-pad">EST CBM= <?php echo number_format($est_cbm,4); ?></td>
              <td style="border-top: 1px solid black;" class="text-center tbl-pad"><?php echo number_format($total_quntity); ?></td>
              <td colspan="3" class="tbl-pad" style="border-top: 1px solid black;"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- /.row -->
    <div class="row" style="display:flex;">
      <div class="col-xs-3">

      </div>
      <div class="col-xs-3">

      </div>
      <div class="col-xs-3" style="border-left: 1px dashed black;border-right: 1px dashed black;">
        <p>Packing Instruction: <?php echo $invoice->packing_instruction;?></p>
        <p>Markings: <?php echo $invoice->markings;?></p>
        <p>Label Instructions: <?php echo $invoice->label_instructions;?></p>
      </div>
      <div class="col-xs-3">
        <p>Remarks: <?php echo $invoice->remarks;?></p>
        <p>PDF Due:</p>
      </div>
    </div>
    <hr style="border-top: 1px dashed black;margin:5px 0 5px 0;">
    <div class="row">
      <div class="col-xs-12">
        <p>All samples and products are of the exclusive ownership and use of DEKOKRAFT. INC., Unauthorized copying, distributing, selling, photocopying and use in any kind of form or demo, to represent other buyers, person, exhibitors, is strictly prohibited. The Company and its owners reserve the right to unilaterally rescind the contract or out-off the services of the client/s who violates the foregoing prohibition. The person/s who violates the prohibition shall be held liable and be penalized and/or be criminal charged of qualified theft, foregery of products, samples and documents and be held accountable as provided by law.</p>
      </div>
    </div>
    <hr style="border-top: 1px dashed black;margin:0 0 0 0;">
    <div class="row">
      <div class="col-xs-12">
        <br>
        <p class="m-b">Delivery Time: <?php echo date("F d,Y", strtotime($invoice->delivery_time));?></p>
        <p>Shipping Instruction: <?php echo $invoice->shipping_instruction;?></p>
        <p class="m-b">Authorized Signature:</p>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->


</body></html>
