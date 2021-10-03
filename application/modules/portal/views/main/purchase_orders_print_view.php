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
.bl{
  border-left: 1px solid black;
}
.br{
  border-right: 1px solid black;
}
</style>
<body onload="window.print();" style="font-size: 1.48rem;" class="l-h">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-3"></div>
      <div class="col-xs-6 text-center">
        <!-- title row -->
         <p class="font-weight-bold text-uppercase m-b" style="letter-spacing: 3px;"><?php echo SITE_NAME;?></p>
         <p class="m-b"><?php echo nl2br(COMPANY_ADDRESS);?></p>
         <p class="m-b">Tel Nos, <?php echo str_replace(array("\n", "\r")," / ",CONTACT_NUMBER); ?></p>
         <p>Fax Nos, <?php echo str_replace(array("\n", "\r")," / ",FAX_NUMBER); ?></p>
      </div>
      <div class="col-xs-3"></div>
      <!-- /.col -->
    </div>
    <br>
    <div class="row">
      <div class="col-xs-12 text-center">
        <h4 style="letter-spacing: 3px;"><strong>PURCHASE ORDER</strong></h4>
      </div>
      <div class="col-xs-6"></div>
      <div class="col-xs-6">
        <div class="row">
          <p class="text-center">PO NO. <?php echo $detail[0]->id; ?></p>
          <p style="text-indent: 25px;">This number must appear on all Invoices, Receipts and Correspondences.</p>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-xs-5">
        <dl class="row" style="display: flex;margin-bottom: 10px;">
            <dt class="col-xs-2 l-h">TO:</dt>
            <dd class="col-xs-10 l-h" style="flex-grow: 1;border-bottom: 1px solid black;"><?php echo $detail[0]->name; ?></dd>
        </dl><br>
        <dl class="row" style="display: flex;">
            <dt class="col-xs-2 l-h"></dt>
            <dd class="col-xs-10 l-h offset-xs-2" style="flex-grow: 1;border-bottom: 1px solid black;"></dd>
        </dl>
      </div>
      <div class="col-xs-1">

      </div>
      <div class="col-xs-6">
        <div class="row" style="display: flex;">
          <div class="">Date : </div>
          <div class="underline" style="flex-grow: 1;border-bottom: 1px solid black;"><?php echo date("F d, Y", strtotime($detail[0]->date_created)); ?></div>
        </div>
        <br>
        <div class="row" style="display: flex;">
            <?php
            $totalPrice=0;
            foreach ($p_o as $po_line) {
                //$totalPrice = $totalPrice + ($po_line->po_count * $po_line->product_price);
              switch ($detail[0]->job_type) {
                  case 'resin':
                    $payResin = $po_line->resinp == '' ? 0 : $po_line->resinp ;
                    $totalPrice = $totalPrice + ($po_line->po_count * $payResin);
                    break;
                  case 'finishing':
                    $payFinish = $po_line->finishp == '' ? 0 : $po_line->finishp ;
                    $totalPrice = $totalPrice + ($po_line->po_count * $payFinish);
                    break;
                  case 'hand paint':
                    $payHandp = $po_line->handp == '' ? 0 : $po_line->handp ;
                    $totalPrice = $totalPrice + ($po_line->po_count * $payHandp);
                    break;
                  case 'spray':
                    $paySpray = $po_line->spray == '' ? 0 : $po_line->spray ;
                    $totalPrice = $totalPrice + ($po_line->po_count * $paySpray);
                    break;
                  // default:
                  //     $payTerms = 'Full Payment Upon Completion of Delivery.';
                  //     break;
              }
            }
            $payTerms = $totalPrice < 10000 ? 'Full Payment Upon Completion of Delivery.' : '25% D/P Upon P.O. Issuance Balance upon completion of delivery.';
            ?>
            <div class="">Payment Terms : </div>
            <div class="underline" style="flex-grow: 1;border-bottom: 1px solid black;"> <?php echo $payTerms; ?></div>
        </div>

      </div>
    </div>
    <p>Your Quotation No. ___________________________________ Dated ____________________</p>
    <p>PLEASE SUPPLY AND DELIVER UNDERMENTIONED TO : _________________________________ ON or BEFORE <?php echo $detail[0]->deadline==''?'____________':date("M d, Y", strtotime($detail[0]->deadline)); ?></p>

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed" style="font-size:1.15rem;border-top: 4px double black;margin-bottom:10px;">
        <thead>
                <tr>
                <th class="tbl-pad bb br">Item No.</th>
                <th class="tbl-pad bb br">Stock Number</th>
                <th class="tbl-pad bb br">DESCRIPTION</th>
                <th class="tbl-pad bb br">Quantity</th>
                <th class="tbl-pad bb br">Unit</th>
                <th class="tbl-pad bb br">Unit Price</th>
                <th class="tbl-pad bb">Amount Pesos</th>
                </tr>
                </thead>
          <tbody>
            <?php
            $no=1;
            $total_quntity=0;
            $total_price=0;
              foreach ($p_o as $po_line) {
                $poPrice = 0;
                switch ($detail[0]->job_type) {
                  case 'resin':
                    $poPrice = $po_line->resinp == '' ? 0 : $po_line->resinp ;
                    break;
                  case 'finishing':
                    $poPrice = $po_line->finishp == '' ? 0 : $po_line->finishp ;
                    break;
                  case 'hand paint':
                    $poPrice = $po_line->handp == '' ? 0 : $po_line->handp ;
                    break;
                  case 'spray':
                    $poPrice = $po_line->spray == '' ? 0 : $po_line->spray ;
                    break;
                }
                $total_quntity=$total_quntity+$po_line->po_count;
                $total_price=$total_price+($po_line->po_count * $poPrice);
            ?>
            <tr>
              <td class="tbl-pad br"><?php echo $no++; ?></td>
              <td class="tbl-pad br"><?php echo $po_line->class.' '.$po_line->code.' '.$po_line->color; ?></td>
              <td class="tbl-pad br"><?php echo $po_line->description; ?></td>
              <td class="tbl-pad br"><?php echo number_format($po_line->po_count); ?></td>
              <td class="tbl-pad br">PCS</td>
              <td class="tbl-pad br"><?php echo number_format($poPrice,2); ?></td>
              <td class="tbl-pad"><?php echo number_format($po_line->po_count * $poPrice, 2); ?></td>
            </tr>
            <?php
              }
             ?>
             <tr>
               <td class="tbl-pad br"></td>
               <td class="tbl-pad br"></td>
               <td class="tbl-pad br"></td>
               <td class="tbl-pad br" style="border-top: 1px solid black;"><?php echo number_format($total_quntity); ?> pcs.</td>
               <td class="tbl-pad br"></td>
               <td class="tbl-pad br"></td>
               <td class="tbl-pad"></td>
             </tr>
             <tr>
               <td class="tbl-pad br"></td>
               <td class="tbl-pad br"></td>
               <td class="tbl-pad text-center br">
                 <p class="m-b">--------NOTHING FOLLOWS--------</p>
                 <p class="m-b">FOR: <?php echo $detail[0]->company_name; ?></p>
                 <p class="m-b">INV. NO. <?php echo $detail[0]->mo_id . '/' . $detail[0]->invoice_id; ?></p>
                 <p>FOR:(<?php echo $detail[0]->job_type; ?>)</p>
                 <p>ALL MATERIALS VS. CHARGED SLIP</p>
               </td>
               <td class="tbl-pad br"></td>
               <td class="tbl-pad br"></td>
               <td class="tbl-pad br"></td>
               <td class="tbl-pad"></td>
             </tr>
            <tr>
              <td colspan="3" class="tbl-pad" style="border-top: 1px solid black;"></td>
              <!-- <td class="tbl-pad" style="border-top: 1px solid black;"></td> -->
              <td colspan="3" class="tbl-pad" style="border-top: 1px solid black;">TOTAL AMOUNT</td>
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
