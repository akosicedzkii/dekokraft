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
      <div class="col-xs-12 text-center">
        <!-- title row -->
         <p class="font-weight-bold text-uppercase" style="margin-bottom:0px;letter-spacing: 3px;"><?php echo SITE_NAME;?></p>
         <p style="margin-bottom:0px;"><?php echo nl2br(COMPANY_ADDRESS);?></p>
         <p>*** JOB ORDER ***</p>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-9"></div>
      <div class="col-xs-3">
        <p style="margin-bottom:0px;">J.O.# </p>
        <p>Date :</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <dl class="row">
          <dt class="col-xs-2">TO :</dt>
          <dd class="col-xs-10"></dd>
        </dl>
      </div>
      <div class="col-xs-6">
        <dl class="row">
          <dt class="col-xs-5">Payment Terms:</dt>
          <dd class="col-xs-7"></dd>
        </dl>
      </div>
    </div>
    <p>Please supply and deliver undermentioned to DEKODRAFT, INC. on or before </p>

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed" style="font-size:10px;border-bottom: 1px solid black;border-top: 1px solid black;">
        <thead>
                <tr>
                <th>Stock #</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Tgt.</th>
                <th>Wgt</th>
                <th>Job</th>
                <th>U.Price</th>
                <th>Amount</th>
                </tr>
                </thead>
          <tbody>
          <tr style="border-top: 2px solid black;">
            <td colspan="2" class="text-center">TOTAL</td>
            <td></td>
            <td colspan="5"></td>
            <td></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- <div class="col-xs-6"> -->
        <div class="col-xs-12">
          <div class="col-xs-2">

          </div>
          <div class="col-xs-6">
            <p style="margin-bottom:0px;">Note: Resin - Materials, Moulds & Labor</p>
            <p>PRICES INCLUSIVE OF LABOR & MATLS.</p>
            <p style="margin-bottom:0px;">*** STAGGERED DELIVERY REQUIRED ***</p>
            <!-- <p style="margin-bottom:0px;">Note: Finishing & Materials</p>
            <p>NET OF SPRAY & HAND PAINT.</p>
            <p style="margin-bottom:0px;">*** UNIT PRICES ABOVE INCLUDE MATERIAL PRICE ***</p>
            <p style="margin-bottom:0px;">*** STAGGERED DELIVERY REQUIRED ***</p> -->
          </div>
        </div>
        <div class="col-xs-3">
          <p style="margin-bottom:0px;">PROFORMA INVOICE# </p>
        </div>
        <div class="col-xs-3">
          <p style="margin-bottom:0px;">M.O.# </p>
        </div>
      <!-- </div> -->
      <div class="col-xs-12">
        <p style="margin-bottom:0px;">RULES & REGULATIONS:</p>
        <p>Subcontractor may not offer subject items which are the exclusive designs and sole property of DEKOKRAFT, INC. to any other individual, COMPANY or establishment. Should the Subcontractor violate the foregoing condition, he shall be liable to penalty for estafa and breach of contract.</p>
        <ol style="padding-left: 15px;">
          <li>Subcontractor is required to submit atleast (2) resin control sample per LINE item on or before</li>
          <li>Approved control sample must have signature of approving officer & should accompany finish goods on 1st delivery for reference.</li>
          <li>Non-submission of control sample will be subject to 1% penalty based on J.O. value or P500 per item whichever higher.</li>
        </ol>
        <!-- <ol style="padding-left: 15px;">
          <li>Subcontractor is required to submit atleast (2) control sample per item w/in 3 working days of TR RECEIVED DATE.</li>
          <li>Approved control sample must have signature of approving officer & should accompany finish goods on 1st delivery for reference.</li>
          <li>Non-submission of control sample will be subject to 1% penalty based on J.O. value or P500 per item whichever higher.</li>
        </ol> -->
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <p>I hereby accept this J.O. subject to the foregoing terms and conditions which we have read and fully understood.</p>
        <div class="col-xs-6">
          <p class="text-center" style="margin-bottom:0px;">____________________</p>
          <p class="text-center" style="margin-top:0px;">( Firm )</p><br>
          <p class="text-center" style="margin-bottom:0px;">____________________</p>
          <p class="text-center">( Designation )</p>
        </div>
        <div class="col-xs-6">
          <p class="text-center" style="margin-bottom:0px;">____________________</p>
          <p class="text-center">( Signature )</p>
        </div>
      </div>
      <div class="col-xs-6">
        <br>
        <p class="text-center" style="margin-bottom:0px;">___________________________________</p>
        <p class="text-center">AUTHORIZED SIGNATURE AND DATE</p>
        <p style="margin-bottom:0px;">PENALTY FOR LATE DELIVERIES SHALL BE SHOULDERED 50% BY SUB-CON AND 50% BY COMPANY STAFF RESPONSIBLE FOR THE TRANSACTION BASED ON P.O. VALUE</p>
        <div class="" style="font-size:10px;">
          <div class="col-xs-3">
            <p style="margin-bottom:0px;">1-5 DAYS,</p>
            <p style="margin-bottom:0px;">6-10 DAYS,</p>
            <p style="margin-bottom:0px;">11 DAYS $ UP,</p>
          </div>
          <div class="col-xs-4">
            <p style="margin-bottom:0px;">1/4 OR 1% PER DAY,</p>
            <p style="margin-bottom:0px;">1/2 OR 1% PER DAY,</p>
            <p style="margin-bottom:0px;">1% PER DAY,</p>
          </div>
          <div class="col-xs-5">
            <p style="margin-bottom:0px;">W/2 DAYS GRACE PERIOD</p>
            <p style="margin-bottom:0px;">NO GRACE PERIOD</p>
            <p style="margin-bottom:0px;">NO GRACE PERIOD</p>
          </div>
          <p>( Straight Computation )</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <p>*** ***</p>
        <div class="col-xs-6">
          <p></p>
        </div>
        <div class="col-xs-6">
          <div class="col-xs-2">

          </div>
          <div class="col-xs-10">
            <p>App'd Ctrl Sample: _______________</p>
            <p>J.O. Recieved : __________________</p>
            <p>Resin Received : _________________</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Table row -->
    <div class="row">
      <p class="text-center">*** JOB ORDER LIST ***</p>
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed" style="font-size:10px;border-bottom: 1px solid black;border-top: 1px solid black;">
        <thead>
          <tr>
            <th>Stock #</th>
            <th>Color</th>
            <th>Description</th>
            <th>Qty.</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td colspan="3">TOTAL</td>
            <td></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <p class="text-center">*** SUB-BQ ( BILL OF QUANTITY ) ***</p>
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed" style="font-size:10px;border-bottom: 1px solid black;border-top: 1px solid black;">
        <thead>
          <tr>
            <th>Item Name</th>
            <th>Issuance Quantity</th>
            <th>Issued</th>
          </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->


</body></html>
