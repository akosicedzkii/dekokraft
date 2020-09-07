<!DOCTYPE html>
<html><head>
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
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
           <!-- <i class="fa fa-globe"></i>-->
           <center>
            <address style="font-size:14px;">
                <strong><?php echo SITE_NAME;?></strong><br>
                <?php echo nl2br(COMPANY_ADDRESS);?>
            </address>
         </center>
           <input type="hidden" value="<?php echo $invoice->id;?>" id="id">
           <div class="row">
                <table class="pull-right">
                <tr><td><small style="font-size:14px;"> M.O. # <?php echo $mo->id;?></b>&emsp;</small><td></tr>

                <tr><td><small  style="font-size:14px;">Authorized Signature: <u>______________</u></small><td></tr>
                </table>
           </div>

            <div class="row">
                <center><h4>MARKETING ORDER</h4></center>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <small><b>DATE: <?php echo date("d F Y", strtotime($invoice->invoice_date));?></small>
                <small class="pull-right"><b>Inv. #<?php echo $invoice->id;?><b></small>
              </div>
            </div>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <dl class="row">
          <dt class="col-xs-2">TO:</dt>
          <dd class="col-xs-10"><?php echo $customer_address->customer_address;?></dd>
          <dt class="col-xs-2">ATTN:</dt>
          <dd class="col-xs-10"><?php echo $customer_address->customer_name;?></dd>
        </dl>
      </div>
      <div class="col-sm-4 invoice-col">
        <p style="margin-bottom:0px;">Resin:</p>
        <p style="margin-bottom:0px;">Spray: _______________</p>
        <p>Finish: _______________</p>
      </div>
      <div class="col-sm-4 invoice-col">

      </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed" style="font-size:10px;border-bottom: 1px solid black;border-top: 1px solid black;">
        <thead>
                <tr>
                <th>Item</th>
                <th>Stock #</th>
                <th>Article #</th>
                <th>Packing<br>IN/MSTR</th>
                <th>CBM</th>
                <th>COLOR</th>
                <th>QTY</th>
                <th>DESCRIPTION</th>
                <th>INNER BOX</th>
                <th>MASTER BOX</th>
                <th>U. PRICE</th>
                <th>TOTAL</th>
                <!-- <th>DISCOUNT(%)</th>
                <th>DISCOUNTED PRICE</th> -->
                </tr>
                </thead>
          <tbody>
          <?php
            $total_price = 0;
            $total_discounted = 0;
            $count = 1;
            $total_quntity=0;
          ?>
          <?php foreach ($invoice_lines as $line) {
              $total_quntity=$total_quntity+$line->quantity;
              $total_price = $total_price + ($line->quantity* $line->product_price);
              $total_discounted = $total_discounted + (($line->quantity*$line->product_price)-($line->quantity*$line->product_price)*($line->discount/100)); ?>
          <tr>
            <td><?php echo  $count; ?></td>
            <td><?php echo  $line->class."-".$line->code."-".$line->color_abb; ?></td>
            <td><?php echo  "______"; ?></td>
            <td><?php echo  $line->master_carton." ".$line->master_carton; ?></td>
            <td><?php echo  $line->weight_of_box; ?></td>
            <td><?php echo  $line->color; ?></td>
            <td><?php echo  $line->quantity; ?></td>
            <td><?php echo  $line->description; ?></td>
            <td><?php echo  $line->inner_carton; ?></td>
            <td><?php echo  $line->master_carton; ?></td>
            <td><?php echo  $line->product_price; ?></td>
            <td><?php echo  number_format((float)($line->quantity * $line->product_price), 2, '.', '') ; ?></td>
            <!-- <td><?php echo  number_format((float)$line->discount, 2, '.', ''); ?></td>
            <td><?php echo  number_format((float)(($line->quantity * $line->product_price) - (($line->quantity * $line->product_price)*($line->discount/100))), 2, '.', ''); ?></td> -->
          </tr>
          <?php $count++;
          }?>
          <tr style="border-top: 2px solid black;">
            <td colspan="2">TOTAL</td>
            <td colspan="4"></td>
            <td><?php echo $total_quntity; ?></td>
            <td colspan="5"></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-xs-3">
          <p>Other Instructions: <?php echo $invoice->shipping_instruction;?></p>
        </div>
        <div class="col-xs-3">
          <p>Packing Instruction: <?php echo $invoice->packing_instruction;?></p>
          <p>Markings: <?php echo $invoice->markings;?></p>
          <p>Label Instructions: <?php echo $invoice->label_instructions;?></p>
        </div>
        <div class="col-xs-3">
          <p>Remarks: <?php echo $invoice->remarks;?></p>
        </div>
        <div class="col-xs-3">
          <p>Delivery Time: <?php echo date("F d,Y", strtotime($invoice->delivery_time));?></p>
          <p>Payment Terms: <?php echo $payment_terms->code;?></p>
        </div>
    </div>
    <hr style="border-top: 1px dashed black;margin:0 0 0 0;">
    <div class="row">
      <div class="col-xs-12">
        <p>All samples and products are of the exclusive ownership and use of DEKOKRAFT. INC., Unauthorized copying, distributing, selling, photocopying and use in any kind of form or demo, to represent other buyers, person, exhibitors, is strictly prohibited. The Company and its owners reserve the right to unilaterally rescind the contract or out-off the services of the client/s who violates the foregoing prohibition. The person/s who violates the prohibition shall be held liable and be penalized and/or be criminal charged of qualified theft, foregery of products, samples and documents and be held accountable as provided by law.</p>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->


</body></html>
