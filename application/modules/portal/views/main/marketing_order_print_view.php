<!DOCTYPE html>
<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo "MARKETING ORDER:#".$mo->id;?></title>
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
<body onload="window.print();" style="font-size: 1.48rem;line-height: 1;">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <!-- <div class="page-header"> -->
           <!-- <i class="fa fa-globe"></i>-->
           <center>
                <p class="text-uppercase m-b"><strong><?php echo SITE_NAME;?></strong></p>
                <p><?php echo nl2br(COMPANY_ADDRESS);?></p>
         </center>
           <input type="hidden" value="<?php echo $invoice->id;?>" id="id">
           <div class="row">
                <!-- <table class="pull-right">
                <tr><td><small style="font-size:14px;"> M.O. # <?php echo $mo->id;?></b>&emsp;</small><td></tr>

                <tr><td><small  style="font-size:14px;">Authorized Signature: <u>______________</u></small><td></tr>
                </table> -->
                <div class="col-xs-6">

                </div>
                <div class="col-xs-6">
                  <div class="pull-right">
                    <p class="m-b">M.O. # <?php echo $mo->id;?></p>
                    <p>Authorized Signature: <u>______________</u></p>
                  </div>
                </div>
           </div>

            <div class="row">
                <center><h5 style="letter-spacing: 3px;">MARKETING ORDER</h5></center>
            </div>

            <div class="row">
              <div class="col-xs-6">
                <p><b>DATE: <?php echo date("d F Y", strtotime($invoice->invoice_date));?><b></p>
              </div>
              <div class="col-xs-6">
                <p class="pull-right"><b>Inv. #<?php echo $invoice->id;?><b></p>
              </div>
            </div>
        <!-- </div> -->
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <dl class="row">
          <dt class="col-xs-2">TO:</dt>
          <dd class="col-xs-10"><?php echo $customer_address->company_name;?></dd>
          <dt class="col-xs-2"></dt>
          <dd class="col-xs-10"><?php echo $customer_address->customer_address;?></dd>
          <dt class="col-xs-2">ATTN:</dt>
          <dd class="col-xs-10"><?php echo $invoice->attn;?></dd>
        </dl>
      </div>
      <div class="col-sm-4 invoice-col">
        <?php
          $res='';
          $spry='';
          $fnsh='';
          if($with=='1'){
          foreach ($jopo as $list) {
            switch ($list->job_type) {
              case 'resin':
                $res=date("m/d/y", strtotime($list->deadline));
                break;
              case 'spray':
                $spry=date("m/d/y", strtotime($list->deadline));
                break;
              case 'finishing':
                $fnsh=date("m/d/y", strtotime($list->deadline));
                break;
              // default:
              //   // code...
              //   break;
            }
          }
        }
         ?>
        <p class="m-b">Resin: <?php echo ($res=='')?'_______________':'JO#'.$list->id.' ('.$res.')'; ?></p>
        <p class="m-b">Spray: <?php echo ($spry=='')?'_______________':'JO#'.$list->id.' ('.$spry.')'; ?></p>
        <p>Finish: <?php echo ($fnsh=='')?'_______________':'JO#'.$list->id.' ('.$fnsh.')'; ?></p>
      </div>
      <div class="col-sm-4 invoice-col">

      </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed" style="font-size:1.07rem;border-bottom: 1px solid black;border-top: 1px solid black;margin-bottom:10px">
        <thead>
                <tr>
                <th class="text-center tbl-pad">Item</th>
                <th class="text-center tbl-pad">Stock #</th>
                <th class="text-center tbl-pad">Article #</th>
                <th class="text-center tbl-pad">Packing<br>IN/MSTR</th>
                <th class="text-center tbl-pad">CBM</th>
                <th class="text-center tbl-pad">COLOR</th>
                <th class="text-center tbl-pad">QTY</th>
                <th class="text-center tbl-pad">DESCRIPTION</th>
                <th class="text-center tbl-pad">INNER<br>BOX</th>
                <th class="text-center tbl-pad">MASTER<br>BOX</th>
                <th class="text-center tbl-pad">U. PRICE</th>
                <th class="text-center tbl-pad">TOTAL</th>
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
          ?>
          <tr>
            <td class="text-center tbl-pad"><?php echo  $count; ?></td>
            <td class="text-center tbl-pad"><?php echo  $line->class."-".$line->code."-".$line->color_abb; ?></td>
            <td class="tbl-pad"><?php echo  $line->article; ?></td>
            <td class="text-center tbl-pad"><?php echo  $line->in_." / ".$line->mstr; ?></td>
            <td class="text-center tbl-pad"><?php echo  number_format($res_mstr,4); ?></td>
            <td class="text-center tbl-pad"><?php echo  $line->color; ?></td>
            <td class="text-center tbl-pad"><?php echo  $line->quantity; ?></td>
            <td class="text-center tbl-pad"><?php echo  $line->description; ?></td>
            <td class="text-center tbl-pad"><?php echo  $line->inner_carton; ?></td>
            <td class="text-center tbl-pad"><?php echo  $line->master_carton; ?></td>
            <td class="text-center tbl-pad"><?php echo  $line->product_price; ?></td>
            <td class="text-center tbl-pad"><?php echo  number_format((float)($line->quantity * $line->product_price), 2, '.', '') ; ?></td>
            <!-- <td><?php echo  number_format((float)$line->discount, 2, '.', ''); ?></td>
            <td><?php echo  number_format((float)(($line->quantity * $line->product_price) - (($line->quantity * $line->product_price)*($line->discount/100))), 2, '.', ''); ?></td> -->
          </tr>
          <?php $count++;
          }?>
          <tr>
            <td colspan="2" class="tbl-pad" style="border-top: 1px solid black;">TOTAL</td>
            <td colspan="4" class="tbl-pad" style="border-top: 1px solid black;"></td>
            <td style="border-top: 1px solid black;" class="text-center tbl-pad"><?php echo number_format($total_quntity); ?></td>
            <td colspan="5" class="tbl-pad" style="border-top: 1px solid black;"></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row" style="display:flex;">
        <div class="col-xs-3">
          <p>Other Instructions:<br> <?php echo $invoice->shipping_instruction;?></p>
        </div>
        <div class="col-xs-3" style="border-left: 1px dashed black;border-right: 1px dashed black;">
          <p>Packing Instruction:<br> <?php echo $invoice->packing_instruction;?></p>
          <p>Markings:<br> <?php echo $invoice->markings;?></p>
          <p>Label Instructions:<br> <?php echo $invoice->label_instructions;?></p>
        </div>
        <div class="col-xs-3" style="border-right: 1px dashed black;">
          <p>Remarks:<br> <?php echo $invoice->remarks;?></p>
        </div>
        <div class="col-xs-3">
          <p>Delivery Time:<br> <?php echo date("F d,Y", strtotime($invoice->delivery_time));?></p>
          <p>Payment Terms:<br> <?php echo (isset($payment_terms->code))?$payment_terms->code:'';?></p>
        </div>
    </div>
    <hr style="border-top: 1px dashed black;margin:5px 0 5px 0;">
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
