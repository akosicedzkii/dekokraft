<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo "JOB ORDER:#".$job_orders->job_type;?></title>
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
<body onload="window.print();" style="font-size: 14px;" class="l-h">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-3">
        <p class="m-b">PROFORMA INVOICE# <?php echo $job_orders->invoice_id; ?></p>
      </div>
      <div class="col-xs-3">
        <p class="m-b">J.O.# <?php echo $job_orders->id; ?></p>
      </div>
      <div class="col-xs-3">
        <p class="m-b">M.O.# <?php echo $job_orders->mo_id; ?></p>
      </div>

    </div>
    <br>
    <div class="row">
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
                  <td class="tbl-pad text-left"><?php echo  $line->class. "-" . $line->code."-".$line->color_abb; ?></td>
                  <td class="tbl-pad text-left"><?php echo  $line->color; ?></td>
                  <td class="tbl-pad text-left"><?php echo  $line->description; ?></td>
                  <td class="tbl-pad text-left"><?php echo  $line->jo_count; ?></td>
                </tr>
            <?php
              }
             ?>
          <tr>
            <td colspan="3" class="tbl-pad">*** TOTAL ***</td>
            <td class="tbl-pad text-left"><?php echo number_format($total_quantity); ?></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <br>
    <!-- Table row -->
    <div class="row">
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
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->


</body></html>
