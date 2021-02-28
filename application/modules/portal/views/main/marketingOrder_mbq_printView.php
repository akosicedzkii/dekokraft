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
.m-b{
  margin-bottom: 0px;
}
.tbl-pad{
  padding: 1px !important;
}
.bb{
  border-bottom: 1px solid black !important;
}
</style>
<body onload="window.print();" style="font-size: 1.4rem;line-height: 1;">
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
                <p class="m-b">CLIENT: <?php echo $customer_address->company_name; ?> </p>
                <p>Inv # <?php echo $invoice->id; ?>  MO# <?php echo $mo->id; ?> Date: <?php echo date("y.m.d"); ?></p>
         </center>

            <div class="row">
                <center><h4 style="letter-spacing: 3px;">*** MASTER BILL OF QUANTITY ***</h4></center>
            </div>
        <!-- </div> -->
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-sm-12 table-responsive">
        <table class="table table-condensed" style="font-size:1.2rem;">
          <thead>
            <tr>
              <th class="text-center tbl-pad"><div class="bb" style="width:90%">Item Name</div></th>
              <th class="text-center tbl-pad"><div class="bb" style="width:90%">U. Cost</div></th>
              <th class="text-center tbl-pad"><div class="bb" style="width:90%">Amount</div></th>
              <th class="text-center tbl-pad"><div class="bb" style="width:90%">QTY. 2-B Purchase</div></th>
              <th class="text-center tbl-pad" style="width:25%"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            // $job_typ=$job_orders->job_type=='resin'?array('M','R'):array('FA','FB','FC');
            $materialArray = array();
            $tempMaterialArray = array();
            foreach ($materials as $material) {
              foreach ($material as $value) {
                $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                $cost = $value["cost"]==''? 0:str_replace(',','',$value["cost"]);
                $mat_types = $value["tipe"];
                $mat_type = isset($mat_types) ? $mat_types : '';
                if ($value["material_name"] != '') {
                  if (isset($materialArray[$value["material_name"]])) {
                      $materialArray[$value["material_name"]] += $qty;
                  } else {
                      $materialArray[$value["material_name"]] = $qty;
                      $thisArray = array('material_name'=>$value["material_name"],
                                          'product_variant_id'=>$value["product_variant_id"],
                                          'tipe'=>$mat_type,
                                          'jp'=>$value["jp"],
                                          'qty'=>$value["qty"],
                                          'unit'=>$value["unit"],
                                          'cost'=>$cost,
                                          'unit'=>$value["unit"]);
                      array_push($tempMaterialArray,$thisArray);
                  }
                }
              }
            }
            $job_typ = array('FA','FB','FC');
            $totalMat = 0;
            $totalColor = 0;
            $polyArray = array();
            foreach ($invoice_lines as $line) {
              if ($line->in_poly_size != '') {
                $in_poly_cont = $line->in_poly_cont!=''?$line->in_poly_cont:0;
                $quantity = $line->quantity!=''?$line->quantity:0;
                if (isset($polyArray[$line->in_poly_size])) {
                    $polyArray[$line->in_poly_size] += ($in_poly_cont*$line->quantity);
                } else {
                    $polyArray[$line->in_poly_size] = $in_poly_cont;
                }
              }
            }
            echo '<tr>
                  <td class="tbl-pad" colspan="5">Material Type: Materials</td>
                </tr>';
            for ($i=0; $i < count($job_typ); $i++) {
                $x=0;
                      // foreach ($tempMaterialArray as $material) {
                        $totalAmountMat = 0;
                          foreach ($tempMaterialArray as $values => $value) {
                              // if ($line->product_id==$value["product_variant_id"]) {
                                if ($value["tipe"] == "material") {
                                  if ($job_typ[$i]==$value["jp"]) {
                                      if ($x==0) { ?>
                                        <tr>
                                          <td class="tbl-pad" colspan="5">** Job Process: <?php echo $job_typ[$i]; ?></td>
                                        </tr>
                                  <?php $x++; }
                                  $value["qty"] = $materialArray[$value["material_name"]];
                                  $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                                  $qtyValue = 0;
                                      switch ($value["unit"]) {
                                        case 'GM':
                                          if($qty>=1000){
                                            $qtyValue = str_replace(',','',number_format($qty / 1000,3));
                                            $unit = 'KG';
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'GM';
                                          }
                                          break;
                                        case 'ML':
                                          if($qty>=1000){
                                            $qtyValue = str_replace(',','',number_format($qty / 1000,3));
                                            $unit = 'LI';
                                          }else{
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'ML';
                                          }
                                          break;
                                        case 'IN':
                                          if($qty>=36){
                                            $qtyValue = str_replace(',','',number_format($qty / 36,3));
                                            $unit = 'ROLL';
                                          }else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'IN';
                                          }
                                          break;
                                        case 'PC':
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = 'PC';
                                          break;
                                        case 'GAL':
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = 'GAL';
                                          break;
                                        case 'LI.':
                                          if($qty>=3.785){
                                            $qtyValue = str_replace(',','',number_format($qty / 3.785,3));
                                            $unit = 'GAL';
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'LI.';
                                          }
                                          break;
                                        case 'RL':
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = 'RL';
                                          break;
                                        default:
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = $value["unit"];
                                          break;
                                      }
                                      $cost = $value["cost"]==''? 0:str_replace(',','',$value["cost"]);
                                      $amount = number_format($cost * $qtyValue,2);
                                      $totalAmountMat += ($cost * $qtyValue);
                                      // var_dump($value['product_variant_id'].'='.$value['material_name'].'='.$value['jp'].'<br>');

                                      // var_dump($materialArray);
                                      //var_dump($tempMaterialArray);
                                      ?>
                                    <tr>
                                      <td class="tbl-pad"><?php echo $value["material_name"]; ?></td>
                                      <td class="tbl-pad text-right"><?php echo $cost; ?></td>
                                      <td class="tbl-pad text-right"><div style="width:90%"><?php echo $amount; ?></div></td>
                                      <td class="tbl-pad text-center"><div style="width:90%"><?php echo $qtyValue.' '.$unit; ?></div></td>
                                      <td class="tbl-pad text-center"><div class="bb" style="width:90%">&nbsp;</div></td>
                                    </tr>
            <?php
                                  }
                                  }
                                // }
                              // }
                            if ($values === array_key_last($tempMaterialArray) && $x>0){
                              echo '<tr><td class="tbl-pad" colspan="5">** Subtotal **</td></tr>';
                              echo '<tr><td class="tbl-pad" colspan="2"></td>
                                    <td class="tbl-pad text-right"><div style="width:90%">'.number_format($totalAmountMat,2).'</div></td></tr>';
                              $totalMat = $totalMat + $totalAmountMat;
                          }
                      }
                  // }
              // }
            //}
          }
            echo '<tr><td class="tbl-pad" colspan="5">** Total Materials **</td></tr>';
            echo '<tr><td class="tbl-pad" colspan="2"></td>
                  <td class="tbl-pad text-right"><div style="width:90%">'.number_format($totalMat,2).'</div></td></tr>';

            // this is for color composition
            echo '<tr>
                    <td class="tbl-pad" colspan="5">Material Type: Color Composition</td>
                  </tr>';
              // foreach ($invoice_lines as $line) {

                  for ($i=0; $i < count($job_typ); $i++) {
                      $x=0;
                      // foreach ($tempMaterialArray as $material) {
                        $totalAmount = 0;
                          foreach ($tempMaterialArray as $values => $value) {
                              // if ($line->product_id==$value["product_variant_id"]) {
                                if ($value['tipe'] == 'color') {
                                  if ($job_typ[$i]==$value["jp"]) {
                                      if ($x==0) { ?>
                                        <tr>
                                          <td class="tbl-pad" colspan="5">** Job Process: <?php echo $job_typ[$i]; ?></td>
                                        </tr>
                                  <?php $x++; }
                                  $value["qty"] = $materialArray[$value["material_name"]];
                                  $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                                  $qtyValue = 0;
                                      switch ($value["unit"]) {
                                        case 'GM':
                                          if($qty>=1000){
                                            $qtyValue = str_replace(',','',number_format($qty / 1000,3));
                                            $unit = 'KG';
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'GM';
                                          }
                                          break;
                                        case 'ML':
                                          if($qty>=1000){
                                            $qtyValue = str_replace(',','',number_format($qty / 1000,3));
                                            $unit = 'LI';
                                          }else{
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'ML';
                                          }
                                          break;
                                        case 'IN':
                                          if($qty>=36){
                                            $qtyValue = str_replace(',','',number_format($qty / 36,3));
                                            $unit = 'ROLL';
                                          }else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'IN';
                                          }
                                          break;
                                        case 'PC':
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = 'PC';
                                          break;
                                        case 'GAL':
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = 'GAL';
                                          break;
                                        case 'LI.':
                                          if($qty>=3.785){
                                            $qtyValue = str_replace(',','',number_format($qty / 3.785,3));
                                            $unit = 'GAL';
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'LI.';
                                          }
                                          break;
                                        case 'RL':
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = 'RL';
                                          break;
                                        default:
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = $value["unit"];
                                          break;
                                      }
                                      $cost = $value["cost"]==''? 0:str_replace(',','',$value["cost"]);
                                      $amount = number_format($cost * $qtyValue,2);
                                      $totalAmount = $totalAmount+($cost * $qtyValue);
                                      // var_dump($value['product_variant_id'].'='.$value['material_name'].'='.$value['jp'].'<br>');?>
                                    <tr>
                                      <td class="tbl-pad"><?php echo $value["material_name"]; ?></td>
                                      <td class="tbl-pad text-right"><?php echo $cost; ?></td>
                                      <td class="tbl-pad text-right"><div style="width:90%"><?php echo $amount; ?></div></td>
                                      <td class="tbl-pad text-center"><div style="width:90%"><?php echo $qtyValue.' '.$unit; ?></div></td>
                                      <td class="tbl-pad text-center"><div class="bb" style="width:90%">&nbsp;</div></td>
                                    </tr>
            <?php
                                  }
                                }

                              if ($values === array_key_last($tempMaterialArray) && $x>0){
                                echo '<tr><td class="tbl-pad" colspan="5">** Subtotal **</td></tr>';
                                echo '<tr><td class="tbl-pad" colspan="2"></td>
                                      <td class="tbl-pad text-right"><div style="width:90%">'.number_format($totalAmount,2).'</div></td></tr>';
                                $totalColor = $totalColor + $totalAmount;
                              }
                              }
                          // }
                      }
                  // }
              // }
            // }
              echo '<tr><td class="tbl-pad" colspan="5">** Total Color Composition **</td></tr>';
              echo '<tr><td class="tbl-pad" colspan="2"></td>
                    <td class="tbl-pad text-right"><div style="width:90%">'.number_format($totalColor,2).'</div></td></tr>';
             ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-sm-12 table-responsive">
          <table class="table table-condensed" style="font-size:1.2rem;width:50%;margin-left: auto;margin-right: auto;">
            <thead>
              <tr>
                <th class="text-center tbl-pad"><div class="bb" style="width:90%">Polly Inner</div></th>
                <th class="text-center tbl-pad"><div class="bb" style="width:90%">PCS</div></th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($polyArray as $key => $value) {
                  echo '<tr>
                    <th class="text-center tbl-pad"><div style="width:90%">'.$key.'</div></th>
                    <th class="text-center tbl-pad"><div style="width:90%">'.$value.'</div></th>
                  </tr>';
                }
               ?>
            </tbody>
          </table>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->


</body></html>
