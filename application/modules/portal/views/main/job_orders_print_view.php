<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo "JOB ORDER:#".$job_orders->id;?></title>
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
  @page {
      margin-top: 0;
      margin-bottom: 0;
  }
  body {
      padding-top: 10px;
      padding-bottom: 10px ;
      font-family: "Times New Roman", Times, serif;
  }
}
.tbl-pad{
  padding:1px !important;
}
.m-b{
  margin-bottom:0px;
}
.l-h{
  line-height: 1 !important;
}
.bb{
  border-bottom: 1px solid black !important;
}
</style>
<body onload="window.print();" style="font-size: 1.48rem;" class="l-h">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12 text-center">
        <!-- title row -->
         <p class="font-weight-bold text-uppercase m-b" style="letter-spacing: 3px;"><?php echo SITE_NAME;?></p>
         <p class="m-b"><?php echo nl2br(COMPANY_ADDRESS);?></p>
         <p>*** JOB ORDER ***</p>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-9"></div>
      <div class="col-xs-3">
        <p class="m-b">J.O.# <?php echo $job_orders->id; ?></p>
        <p>Date : <?php echo date("d F Y", strtotime($job_orders->date_created));?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <dl class="row">
          <dt class="col-xs-1 l-h">TO:</dt>
          <dd class="col-xs-11 l-h"><?php echo $job_orders->code; ?></dd>
          <dt class="col-xs-1 l-h"></dt>
          <dd class="col-xs-11 offset-xs-1 l-h"><?php echo $job_orders->name; ?></dd>
          <dt class="col-xs-1 l-h"></dt>
          <dd class="col-xs-11 offset-xs-1 l-h"><?php echo $job_orders->address; ?></dd>
          <dt class="col-xs-1 l-h"></dt>
          <dd class="col-xs-11 offset-xs-1 l-h"><?php echo $job_orders->subcon_details; ?></dd>
        </dl>
      </div>
      <div class="col-xs-6">
        <?php
        $totalPrice=0;
          foreach ($invoice_lines as $line) {
              // $totalPrice = $totalPrice + ($line->jo_count* $line->product_price);
              switch ($line->jo_type) {
                      case 'resin':
                        $joResin = $line->resin_unit_price == '' ? 0 : floatval($line->resin_unit_price);
                        $totalPrice = $totalPrice + ($line->jo_count* $joResin);
                        break;
                      case 'finishing':
                        $joFinish = $line->finishing_unit_price == '' ? 0 : floatval($line->finishing_unit_price);
                        $totalPrice = $totalPrice + ($line->jo_count* $joFinish);
                        break;
                    }
          }
         ?>
        <dl class="row">
          <dt class="col-xs-4 text-right">Payment Terms:</dt>
          <dd class="col-xs-8" style="padding-left:0px;"><?php echo $totalPrice<10000?'Full Payment Upon Completion of Delivery.':'25% D/P Upon J.O. Issuance Balance upon completion of delivery.'; ?></dd>
        </dl>
      </div>
    </div>
    <p>Please supply and deliver undermentioned to DEKOKRAFT, INC. on or before <?php echo date("d F Y", strtotime($job_orders->deadline)); ?></p>

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed" style="font-size:1.14rem;border-top: 4px double black;">
        <thead>
                <tr>
                <th class="tbl-pad bb">Stock #</th>
                <th class="tbl-pad bb">Color</th>
                <th class="tbl-pad bb text-right">Quantity</th>
                <th class="tbl-pad bb text-center">Description</th>
                <th class="tbl-pad bb">Tgt. Wgt</th>
                <!-- <th class="tbl-pad">Wgt</th> -->
                <th class="tbl-pad bb">Job</th>
                <th class="tbl-pad bb text-right">U.Price</th>
                <th class="tbl-pad bb text-right">Amount</th>
                </tr>
                </thead>
          <tbody>
          <tr>
            <?php
            $total_price=0;
            $total_quantity=0;
              foreach ($invoice_lines as $line) {
                  switch ($line->jo_type) {
                          case 'resin':
                            $jobType = 1;
                            $jobPrice = $line->resin_unit_price == '' ? 0 : floatval($line->resin_unit_price);
                            $color_abb = '';
                            break;

                          case 'finishing':
                            $jobType = 4;
                            $jobPrice = $line->finishing_unit_price == '' ? 0 : floatval($line->finishing_unit_price);
                            $color_abb = $line->color_abb;
                            break;

                          default:
                            $jobType = '';
                            $jobPrice = 0;
                            $color_abb = '';
                            break;
                        }
                  $total_price = $total_price + ($line->jo_count * $jobPrice);
                  $total_quantity=$total_quantity + $line->jo_count;
                  ?>
                <tr>
                  <td class="tbl-pad"><?php echo  $line->class. "-" . $line->code."-".$color_abb; ?></td>
                  <td class="tbl-pad"><?php echo  $job_orders->job_type=='resin'?'':$line->color; ?></td>
                  <td class="tbl-pad text-right"><?php echo  number_format($line->jo_count); ?> pcs. &nbsp;</td>
                  <td class="tbl-pad"><?php echo  $line->description; ?></td>
                  <td class="tbl-pad"><?php echo $line->net_weight; ?></td>
                  <td class="tbl-pad">[<?php echo $jobType; ?> ]</td>
                  <td class="tbl-pad text-right"><?php echo  number_format($jobPrice, 2); ?></td>
                  <td class="tbl-pad text-right"><?php echo  number_format((float)($line->jo_count * $jobPrice), 2) ; ?></td>
                </tr>
            <?php
              }
             ?>
            <td colspan="2" class="text-center tbl-pad">TOTAL</td>
            <td class="tbl-pad text-right"><?php echo number_format($total_quantity); ?> pcs. &nbsp;</td>
            <td colspan="4" class="tbl-pad"></td>
            <td class="tbl-pad text-right" style="border-top:1px solid black;border-bottom:1px solid black;"><div class="" style="border-bottom:1px solid black;">P <?php echo number_format($total_price, 2); ?></div></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-6" style="font-size: 10px;">
          <?php if ($job_orders->job_type=='resin') { ?>
          <p class="m-b"><b>Note: Resin - Materials, Moulds & Labor</b></p>
          <p>PRICES INCLUSIVE OF LABOR & MATLS.</p>
          <p class="m-b">*** STAGGERED DELIVERY REQUIRED ***</p>
        <?php } else { ?>
          <p class="m-b"><b>Note: Finishing & Materials</b></p>
          <p>NET OF SPRAY & HAND PAINT.</p>
          <p class="m-b">*** UNIT PRICES ABOVE INCLUDE MATERIAL PRICE ***</p>
          <p class="m-b">*** STAGGERED DELIVERY REQUIRED ***</p>
        <?php } ?>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <br><br><br><br><br><br><br><br><br><br>
    <div class="row">
      <!-- <div class="col-xs-6"> -->
        <div class="col-xs-4">
          <p class="m-b">PROFORMA INVOICE# <?php echo $job_orders->invoice_id; ?></p>
        </div>
        <div class="col-xs-3">
          <p class="m-b">M.O.# <?php echo $job_orders->mo_id; ?></p>
        </div>
      <!-- </div> -->
      <div class="col-xs-12">
        <p class="m-b">RULES & REGULATIONS:</p>
        <p class="m-b">Subcontractor may not offer subject items which are the exclusive designs and sole property of DEKOKRAFT, INC. to any other individual.</p>
        <p>COMPANY or establishment, Should the Subcontractor violate the foregoing condition, he shall be liable to penalty for estafa and breach of contract.</p>
        <?php if ($job_orders->job_type=='resin') {
          $dated=date_create(date("F d, Y", strtotime($job_orders->deadline)));
          date_sub($dated,date_interval_create_from_date_string("10 days"));
          $final_date=date_format($dated,"F d, Y");
         ?>
        <ol style="padding-left: 15px;">
          <li>Subcontractor is required to submit atleast (2) resin control sample per LINE item on or before <?php echo $final_date; ?></li>
          <li>Approved control sample must have signature of approving officer & should accompany finish goods on 1st delivery for reference.</li>
          <li>Non-submission of control sample will be subject to 1% penalty based on J.O. value or P500 per item whichever higher.</li>
        </ol>
      <?php } else { ?>
        <ol style="padding-left: 15px;">
          <li>Subcontractor is required to submit atleast (2) control sample per item w/in 3 working days of TR RECEIVED DATE.</li>
          <li>Approved control sample must have signature of approving officer & should accompany finish goods on 1st delivery for reference.</li>
          <li>Non-submission of control sample will be subject to 1% penalty based on J.O. value or P500 per item whichever higher.</li>
        </ol>
      <?php } ?>
      </div>
    </div>
    <div class="" style="border-top: 4px double black;"></div>
    <div class="row">
      <div class="col-xs-6">
        <p>I hereby accept this J.O. subject to the foregoing terms and conditions which we have read and fully understood.</p>
        <div class="col-xs-6">
          <p class="text-center m-b">_______________________</p>
          <p class="text-center m-b">( Firm )</p><br>
          <p class="text-center m-b">_________________________</p>
          <p class="text-center">( Designation )</p>
        </div>
        <div class="col-xs-6">
          <p class="text-center m-b">_______________________</p>
          <p class="text-center">( Signature )</p>
        </div>
      </div>
      <div class="col-xs-6">
        <br>
        <p class="text-center m-b">___________________________________</p>
        <p class="text-center">AUTHORIZED SIGNATURE AND DATE</p>
        <p class="m-b">PENALTY FOR LATE DELIVERIES SHALL BE SHOULDERED 50% BY SUB-CON AND 50% BY COMPANY STAFF RESPONSIBLE FOR THE TRANSACTION BASED ON P.O. VALUE</p>
        <div class="" style="font-size:10px;">
          <div class="col-xs-3">
            <p class="m-b">1-5 DAYS,</p>
            <p class="m-b">6-10 DAYS,</p>
            <p class="m-b">11 DAYS & UP,</p>
          </div>
          <div class="col-xs-4">
            <p class="m-b">1/4 OR 1% PER DAY,</p>
            <p class="m-b">1/2 OR 1% PER DAY,</p>
            <p class="m-b">1% PER DAY,</p>
          </div>
          <div class="col-xs-5">
            <p class="m-b">W/2 DAYS GRACE PERIOD</p>
            <p class="m-b">NO GRACE PERIOD</p>
            <p class="m-b">NO GRACE PERIOD</p>
          </div>
          <p>( Straight Computation )</p>
        </div>
      </div>
    </div>
    <div class="row">
      <?php //if ($job_orders->job_type=='resin') { ?>
        <?php if ($wClient == 'yes') { ?>
      <div class="col-xs-12">
        <p>*** <?php echo $job_orders->company_name; ?> ***</p>
        <div class="col-xs-7" style="font-size:1.15rem;">
          <div class="col-xs-3" style="font-size:1rem;">
            <p>1. 25% D/P</p>
            <p>2. 25% D/P Add'l</p>
            <p>3. Full Pay't</p>
            <p>4. Other Charges</p>
          </div>
          <div class="col-xs-4">
            <p>P____________</p>
            <p>P____________</p>
            <p>P____________</p>
            <p>P____________</p>
            <p>P____________</p>
            <p>P____________</p>
          </div>
          <div class="col-xs-5">
            <p>Check # _____________</p>
            <p>Check # _____________</p>
            <p>Check # _____________</p>
            <p>_____________________</p>
            <p>_____________________</p>
            <p>_____________________</p>
          </div>
          <div class="row">
            <p style="font-size:1.2rem;">*** J.O Saved ***</p>
          </div>
        </div>
        <div class="col-xs-5" style="font-size:1.2rem;">
          <div class="col-xs-2">
          </div>
          <div class="col-xs-10">
            <p>TR Date: _____________________</p>
            <p>App'd Ctrl Sample: _____________</p>
            <p>J.O. Recieved : ________________</p>
            <p><?php echo ($job_orders->job_type=='resin')?'Resin Received : _______________':'Finishing Received : _____________'; ?></p>
            <p>M.O. Received : _______________</p>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
    <br>
    <!-- Table row -->
    <!-- <div class="row">
      <p class="text-center">*** JOB ORDER LIST ***</p>
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed" style="font-size:12px;">
        <thead>
          <tr>
            <th class="tbl-pad bb">Stock #</th>
            <th class="tbl-pad bb">Color</th>
            <th class="tbl-pad bb">Description</th>
            <th class="tbl-pad bb">Qty.</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $total_quantity=0;
              foreach ($invoice_lines as $line) {
                  $total_quantity=$total_quantity + $line->jo_count; ?>
                <tr>
                  <td class="tbl-pad"><?php echo  $line->class. "-" . $line->code."-".$line->color_abb; ?></td>
                  <td class="tbl-pad"><?php echo  $line->color; ?></td>
                  <td class="tbl-pad"><?php echo  $line->description; ?></td>
                  <td class="tbl-pad"><?php echo  $line->jo_count; ?></td>
                </tr>
            <?php
              }
             ?>
          <tr>
            <td colspan="3" class="tbl-pad">*** TOTAL ***</td>
            <td class="tbl-pad"><?php echo number_format($total_quantity); ?></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div> -->
    <!-- /.row -->
    <!-- <br> -->
    <!-- Table row -->
    <!-- <div class="row">
      <p class="text-center">*** SUB-BQ ( BILL OF QUANTITY ) ***</p>
      <div class="col-xs-12 table-responsive">
        <table class="table table-condensed" style="font-size:12px;">
        <thead>
          <tr>
            <th class="bb text-center">Item Name</th>
            <th class="bb text-center">Issuance Quantity</th>
            <th class="bb text-center">Issued</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $job_typ=$job_orders->job_type=='resin'?array('M','R'):array('FA','FB','FC');
              foreach ($invoice_lines as $line) {
                  for ($i=0; $i < count($job_typ); $i++) {
                      $x=0;
                      foreach ($materials as $material) {
                          foreach ($material as $value) {
                              if ($line->product_id==$value["product_variant_id"]) {
                                  if ($job_typ[$i]==$value["jp"]) {
                                      if ($x==0) { ?>
                                      <tr>
                                        <td class="tbl-pad" colspan="3">** Job Process: <?php echo $job_typ[$i]; ?></td>
                                      </tr>
                                  <?php $x++; }
                                      // var_dump($value['product_variant_id'].'='.$value['material_name'].'='.$value['jp'].'<br>');?>
                                    <tr>
                                      <td class="tbl-pad"><?php echo $value["material_name"]; ?></td>
                                      <td class="tbl-pad text-center"><?php echo $value["qty"].' '.$value["unit"]; ?></td>
                                      <td class="tbl-pad text-center">______________________:______________________:______________________</td>
                                    </tr>
            <?php
                                  }
                              }
                          }
                      }
                  }
              }
             ?>
          </tbody>
        </table>
      </div>

    </div> -->
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->


</body></html>
