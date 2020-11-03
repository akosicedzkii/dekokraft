<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo "PURCHASE ORDER:#".$detail[0]->id;?></title>
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
<body onload="window.print();" style="font-size: 14px;" class="l-h">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12 text-center">
        <!-- title row -->
         <p class="font-weight-bold text-uppercase m-b" style="letter-spacing: 3px;"><?php echo SITE_NAME;?></p>
         <p class="m-b"><?php echo nl2br(COMPANY_ADDRESS);?></p>
      </div>
      <!-- /.col -->
    </div>
    <br>
    <div class="row">
      <div class="col-xs-12 text-center">
        <h4 style="letter-spacing: 3px;"><strong>PURCHASE ORDER</strong></h4>
      </div>
      <div class="col-xs-7"></div>
      <div class="col-xs-5">
        <div class="row">
          <p class="m-b"><?php  ?></p>
          <p style="text-indent: 25px;">This number must appear on all Invoices, Receipts and Correspondences.</p>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-xs-5">
        <!-- <div class="row col-xs-12" style="display: flex;">
          <div class="">TO :</div>
          <div class="" style="flex-grow: 1;border-bottom: 1px solid black;">sasa</div>
        </div>
        <br><br>
        <div class="row col-xs-12" style="display: flex;">
          <div class="">&nbsp;</div>
          <div class="" style="flex-grow: 1;border-bottom: 1px solid black;"></div>
        </div> -->
        <dl class="row" style="display: flex;margin-bottom: 10px;">
            <dt class="col-xs-2 l-h">TO:</dt>
            <dd class="col-xs-10 l-h" style="flex-grow: 1;border-bottom: 1px solid black;"><?php echo $detail[0]->name; ?></dd>
        </dl><br>
        <dl class="row" style="display: flex;">
            <dt class="col-xs-2 l-h"></dt>
            <dd class="col-xs-10 l-h offset-xs-2" style="flex-grow: 1;border-bottom: 1px solid black;"></dd>
        </dl>
      </div>
      <div class="col-xs-2">

      </div>
      <div class="col-xs-5">
        <div class="row" style="display: flex;">
          <div class="">Date : </div>
          <div class="underline" style="flex-grow: 1;border-bottom: 1px solid black;"></div>
        </div>
        <br>
        <div class="row" style="display: flex;">
            <div class="">Payment Terms : </div>
            <div class="underline" style="flex-grow: 1;border-bottom: 1px solid black;"></div>
        </div>

        <!-- <dl class="row">
          <dt class="col-xs-4 text-right">Date:</dt>
          <dd class="col-xs-8" style="padding-left:0px;">_</dd>
          <dt class="col-xs-4 text-right">Payment Terms:</dt>
          <dd class="col-xs-8" style="padding-left:0px;">D/P Upon J.O. Issuance Balance upon completion of delivery.</dd>
        </dl> -->
      </div>
    </div>
    <p>Your Quotation No. ___________________________________ Dated ____________________</p>
    <p>PLEASE SUPPLY AND DELIVER UNDERMENTIONED TO : __________________________________ ON or BEFORE _______________ <?php  ?></p>

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed" style="font-size:11px;border-top: 1px solid black;margin-bottom:10px;">
        <thead>
                <tr>
                <th class="tbl-pad bb">Item No.</th>
                <th class="tbl-pad bb">Stock Number</th>
                <th class="tbl-pad bb">DESCRIPTION</th>
                <th class="tbl-pad bb">Quantity</th>
                <th class="tbl-pad bb">Unit</th>
                <th class="tbl-pad bb">Unit Price</th>
                <th class="tbl-pad bb">Amount Pesos</th>
                </tr>
                </thead>
          <tbody>
            <?php
            $no=1;
            $total_quntity=0;
            $total_price=0;
              foreach ($p_o as $po_line) {
                $total_quntity=$total_quntity+$po_line->quantity;
                $total_price=$total_price+($po_line->quantity * $po_line->product_price);
            ?>
            <tr>
              <td class="tbl-pad"><?php echo $no++; ?></td>
              <td class="tbl-pad"><?php echo $po_line->class.' '.$po_line->code.' '.$po_line->color; ?></td>
              <td class="tbl-pad"><?php echo $po_line->description; ?></td>
              <td class="tbl-pad"><?php echo $po_line->quantity; ?></td>
              <td class="tbl-pad">PCS</td>
              <td class="tbl-pad"><?php echo $po_line->product_price; ?></td>
              <td class="tbl-pad"><?php echo number_format($po_line->quantity * $po_line->product_price, 2); ?></td>
            </tr>
            <?php
              }
             ?>
             <tr>
               <td colspan="3" class="tbl-pad"></td>
               <td class="tbl-pad" style="border-top: 1px solid black;"><?php echo $total_quntity; ?> pcs.</td>
               <td colspan="3" class="tbl-pad"></td>
             </tr>
            <tr>
              <td colspan="3" class="tbl-pad" style="border-top: 1px solid black;"></td>
              <td class="tbl-pad" style="border-top: 1px solid black;"></td>
              <td colspan="2" class="text-center tbl-pad" style="border-top: 1px solid black;">TOTAL AMOUNT</td>
              <td class="tbl-pad" style="border-top: 1px solid black;"><?php echo number_format($total_price,2); ?></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <p class="m-b">This P.O is good for ____________________ items only.</p>
      </div>
    </div>
    <hr style="border-top: 1px solid black;margin:5px 0 5px 0;">
    <div class="row" style="display:flex;">
      <div class="col-xs-6" style="border-right: 1px solid black;">
        <p style="text-indent: 25px;">I hereby accept this P.O. subject to the foregoing terms and conditions which we have read and fully understood.</p>
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
        <p class="m-b">Penalty Provision :</p>
        <p class="">based on p.o. value of 5 days 1/4 or 1% per day with 2 days grace period, 6-10 days 1/2 or 1% per day, no grace period, 11 days & up 1% per day, no grace period (based on straight computation.)</p>
        <p>______________________________ DEKOKRAFT, INC.</p>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->


</body></html>
