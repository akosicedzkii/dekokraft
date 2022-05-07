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
              <th class="text-right tbl-pad"><div class="bb" style="width:90%">U. Cost</div></th>
              <th class="text-right tbl-pad"><div class="bb" style="width:90%">Amount</div></th>
              <th class="text-right tbl-pad"><div class="bb" style="width:90%">QTY. 2-B Purchase</div></th>
              <th class="text-center tbl-pad" style="width:25%"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            // $job_typ=$job_orders->job_type=='resin'?array('M','R'):array('FA','FB','FC');
            $materialArray = array();
            $tempMaterialArray = array();
            foreach ($materials as $material) {
              $qty=0;
              foreach ($material as $value) {
                //$qty = $value["qty"]==''? 0:trim(str_replace(',','',$value["qty"]));
                $qty = $value["qty"]==''? 0:preg_replace('/[^0-9.]+/', '', $value["qty"]);
                $qty = trim($qty,'.');
                $cost = $value["cost"]==''? 0:str_replace(',','',$value["cost"]);
                foreach ($invoice_lines as $line) {
                  if ($line->product_id==$value["product_variant_id"]) {
                    //$line->quantity = $line->quantity==''? 0:str_replace(',','',$line->quantity);
                    $line->quantity = $line->quantity==''? 0:preg_replace('/[^0-9.]+/', '', $line->quantity);
                    $line->quantity = trim($line->quantity,'.');
                    if($line->quantity!=''){
                      if($line->id==$value["invoice_id"]){
                        $qty *= $line->quantity;
                        //$cost *= $line->quantity;
                      }
                    }
                  }
                }
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
                                          'convert_unit'=>$value['conversion_unit'],
                                          'convert_type'=>$value['conversion_type'],
                                          'convert_value'=>$value['conversion_value']);
                      array_push($tempMaterialArray,$thisArray);
                  }
                }
              }
            }
            foreach ($colorMaterials as $colorMaterial) {
              $qty = 0;
              foreach ($colorMaterial as $thisMaterial) {
                $qty = $thisMaterial["qty"]==''? 0:str_replace(',','',$thisMaterial["qty"]);
                $colorQty = $thisMaterial["ppm_count"]==''? 0:str_replace(',','',$thisMaterial["ppm_count"]);
                $moQty = $thisMaterial["quantity"]==''? 0:str_replace(',','',$thisMaterial["quantity"]);
                $cost = $thisMaterial["cost"]==''? 0:str_replace(',','',$thisMaterial["cost"]);
                $fixQ = $colorQty == 0 ? 0 : $qty/(1000/$colorQty) ;
                $totalQty = 1 * $fixQ * $moQty;
                //$totalQty = $qty * $colorQty * $moQty;
                //$totalCost = $cost * $colorQty * $moQty;
                $totalCost = $cost;
                $mat_types = $thisMaterial["tipe"];
                $mat_type = isset($mat_types) ? $mat_types : '';
                if ($thisMaterial["material_name"] != '') {
                  if (isset($materialArray[$thisMaterial["material_name"]])) {
                      $materialArray[$thisMaterial["material_name"]] += $totalQty;
                  } else {
                      $materialArray[$thisMaterial["material_name"]] = $totalQty;
                      $thisArray = array('material_name'=>$thisMaterial["material_name"],
                                          'product_variant_id'=>$thisMaterial["product_variant_id"],
                                          'tipe'=>$mat_type,
                                          'jp'=>$thisMaterial["jp"],
                                          'qty'=>$thisMaterial["qty"],
                                          'unit'=>$thisMaterial["unit"],
                                          'cost'=>$totalCost,
                                          'convert_unit'=>$thisMaterial['conversion_unit'],
                                          'convert_type'=>$thisMaterial['conversion_type'],
                                          'convert_value'=>$thisMaterial['conversion_value']);
                      array_push($tempMaterialArray,$thisArray);
                  }
                }
              }
            }
            $job_typ = array('FA','FB','FC');
            $totalMat = 0;
            $totalColor = 0;
            $polyArray = array();
            $mstrPolyArray = array();
            foreach ($invoice_lines as $line) {
              if ($line->in_poly_size != '') {
                $in_poly_cont = $line->in_poly_cont!=''?$line->in_poly_cont:0;
                $quantity = $line->quantity!=''?$line->quantity:0;
                if (isset($polyArray[$line->in_poly_size])) {
                    $polyArray[$line->in_poly_size] += ($in_poly_cont*$quantity);
                } else {
                    $polyArray[$line->in_poly_size] = ($in_poly_cont*$quantity);
                }
              }
              if ($line->mstr_poly_size != '') {
                $mstr_poly_cont = $line->mstr_poly_cont!=''?$line->mstr_poly_cont:0;
                $quantity = $line->quantity!=''?$line->quantity:0;
                if (isset($mstrPolyArray[$line->mstr_poly_size])) {
                    $mstrPolyArray[$line->mstr_poly_size] += ($mstr_poly_cont*$quantity);
                } else {
                    $mstrPolyArray[$line->mstr_poly_size] = ($mstr_poly_cont*$quantity);
                }
              }
            }
            asort($tempMaterialArray);
            // echo '<tr>
            //       <td class="tbl-pad" colspan="5">Material Type: Materials</td>
            //     </tr>';
            $html1 = '';
            $html2 = '';
            for ($i=0; $i < count($job_typ); $i++) {
                $x=0;
                $xy=0;
                      // foreach ($tempMaterialArray as $material) {
                        $totalAmountMat = 0;
                        $totalAmount = 0;
                        $partialCost = 0;
                          foreach ($tempMaterialArray as $values => $value) {
                              // if ($line->product_id==$value["product_variant_id"]) {
                                if ($value["tipe"] == "material") {
                                  if ($job_typ[$i]==$value["jp"]) {
                                      if ($x==0) {
                                        $html1 .='<tr>
                                                    <td class="tbl-pad" colspan="5">** Job Process: '.$job_typ[$i].'</td>
                                                  </tr>';
                                        $x++;
                                      }
                                  $value["qty"] = $materialArray[$value["material_name"]];
                                  $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                                  $qtyValue = 0;
                                  $partialCost = $value["cost"]==''? 0:str_replace(',','',$value["cost"]);
                                  // $unit = '';
                                  if($qty>=$value["convert_value"] && $value["convert_value"]!=0 && $value["convert_value"]!=""){
                                    $qtyValue = str_replace(',','',number_format($qty / $value["convert_value"],3));
                                    $unit = $value["convert_unit"];
                                    $partialCost *= $value["convert_value"];
                                  } else {
                                    $qtyValue = str_replace(',','',number_format($qty,3));
                                    $unit = $value["unit"];
                                  }
                                  
                                      $cost = $partialCost;
                                      $amount = number_format($cost * $qtyValue,2);
                                      $totalAmountMat += ($cost * $qtyValue);
                                      // var_dump($value['product_variant_id'].'='.$value['material_name'].'='.$value['jp'].'<br>');

                                      // var_dump($materialArray);
                                      //var_dump($tempMaterialArray);

                                    $html1 .= '<tr>
                                      <td class="tbl-pad">'.$value["material_name"].'</td>
                                      <td class="tbl-pad text-right">'.number_format($cost,2).'</td>
                                      <td class="tbl-pad text-right"><div style="width:90%">'.$amount.'</div></td>
                                      <td class="tbl-pad text-right"><div style="width:90%">'.$qtyValue.' '.$unit.'</div></td>
                                      <td class="tbl-pad text-center"><div class="bb" style="width:90%">&nbsp;</div></td>
                                    </tr>';

                                  }
                                  }
                                // }
                              // }
                            if ($values === array_key_last($tempMaterialArray) && $x>0){
                                $html1 .='<tr><td class="tbl-pad" colspan="5">** Subtotal **</td></tr>';
                                $html1 .= '<tr><td class="tbl-pad" colspan="2"></td>
                                    <td class="tbl-pad text-right"><div style="width:90%">'.number_format($totalAmountMat,2).'</div></td></tr>';
                              $totalMat = $totalMat + $totalAmountMat;
                          }

                          if ($value["tipe"] == "color") {
                            if ($job_typ[$i]==$value["jp"]) {
                                if ($xy==0) {
                                  $html2 .='<tr>
                                    <td class="tbl-pad" colspan="5">** Job Process: '.$job_typ[$i].'</td>
                                  </tr>';
                                  $xy++;
                                }
                            $value["qty"] = $materialArray[$value["material_name"]];
                            $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                            $qtyValue = 0;
                            $partialCost = $value["cost"]==''? 0:str_replace(',','',$value["cost"]);
                            // $unit = '';
                            if($qty>=$value["convert_value"] && $value["convert_value"]!=0 && $value["convert_value"]!=""){
                              $qtyValue = str_replace(',','',number_format($qty / $value["convert_value"],3));
                              $unit = $value["convert_unit"];
                              $partialCost *= $value["convert_value"];
                            } else {
                              $qtyValue = str_replace(',','',number_format($qty,3));
                              $unit = $value["unit"];
                            }
                            
                                $cost = $partialCost;
                                $amount = number_format($cost * $qtyValue,2);
                                $totalAmount += ($cost * $qtyValue);
                                // var_dump($value['product_variant_id'].'='.$value['material_name'].'='.$value['jp'].'<br>');

                                // var_dump($materialArray);
                                //var_dump($tempMaterialArray);

                              $html2 .='<tr>
                                          <td class="tbl-pad">'.$value["material_name"].'</td>
                                          <td class="tbl-pad text-right">'.number_format($cost,2).'</td>
                                          <td class="tbl-pad text-right"><div style="width:90%">'.$amount.'</div></td>
                                          <td class="tbl-pad text-right"><div style="width:90%">'.$qtyValue.' '.$unit.'</div></td>
                                          <td class="tbl-pad text-center"><div class="bb" style="width:90%">&nbsp;</div></td>
                                        </tr>';

                            }
                            }
                          // }
                        // }
                      if ($values === array_key_last($tempMaterialArray) && $xy>0){
                        $html2 .='<tr><td class="tbl-pad" colspan="5">** Subtotal **</td></tr>';
                        $html2 .='<tr><td class="tbl-pad" colspan="2"></td>
                              <td class="tbl-pad text-right"><div style="width:90%">'.number_format($totalAmount,2).'</div></td></tr>';
                        $totalColor = $totalColor + $totalAmount;
                    }
                      }
                  // }
              // }
            //}
          }
            echo $html1;
            echo '<tr><td class="tbl-pad" colspan="5">** Total Materials **</td></tr>';
            echo '<tr><td class="tbl-pad" colspan="2"></td>
                  <td class="tbl-pad text-right"><div style="width:90%">'.number_format($totalMat,2).'</div></td></tr>';

            // this is for color composition
            // echo '<tr>
            //         <td class="tbl-pad" colspan="5">Material Type: Color Composition</td>
            //       </tr>';
              // foreach ($invoice_lines as $line) {


                  // }
              // }
            // }
            echo $html2;
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
                <th class="text-center tbl-pad" width="75%"><div class="bb" style="width:90%">Polly Inner</div></th>
                <th class="text-center tbl-pad" width="25%"><div class="bb" style="width:90%">PCS</div></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $polyTotal = 0;
              $bubbleTotal = 0;
              ksort($polyArray);
                foreach ($polyArray as $key => $value) {
                  if (strpos($key, 'POLYBAG') !== FALSE) {
                    $polyTotal += $value;
                  } elseif (strpos($key, 'BUBBLE BAG') !== FALSE) {
                    $bubbleTotal += $value;
                  }

                  echo '<tr>
                    <td class="text-center tbl-pad"><div style="width:90%">'.$key.'</div></td>
                    <td class="text-center tbl-pad"><div style="width:90%">'.$value.'</div></td>
                  </tr>';
                }
               ?>
               <tr>
                 <td class="text-center tbl-pad"><div style="width:90%" class="text-left"><b>TOTAL BUBBLE BAG</b></div></td>
                 <td class="text-center tbl-pad"><div style="width:90%"><b><?php echo $bubbleTotal; ?></b></div></td>
               </tr>
               <tr>
                 <td class="text-center tbl-pad"><div style="width:90%" class="text-left"><b>TOTAL POLYBAG</b></div></td>
                 <td class="text-center tbl-pad"><div style="width:90%"><b><?php echo $polyTotal; ?></b></div></td>
               </tr>
            </tbody>
          </table>
          <table class="table table-condensed" style="font-size:1.2rem;width:50%;margin-left: auto;margin-right: auto;">
            <thead>
              <tr>
                <th class="text-center tbl-pad" width="75%"><div class="bb" style="width:90%">Polly Master</div></th>
                <th class="text-center tbl-pad" width="25%"><div class="bb" style="width:90%">PCS</div></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $mstrPolyTotal = 0;
              $mstrBubbleTotal = 0;
              ksort($mstrPolyArray);
                foreach ($mstrPolyArray as $key => $value) {
                  if (strpos($key, 'POLYBAG') !== FALSE) {
                    $mstrPolyTotal += $value;
                  } elseif (strpos($key, 'BUBBLE BAG') !== FALSE) {
                    $mstrBubbleTotal += $value;
                  }

                  echo '<tr>
                    <td class="text-center tbl-pad"><div style="width:90%">'.$key.'</div></td>
                    <td class="text-center tbl-pad"><div style="width:90%">'.$value.'</div></td>
                  </tr>';
                }
               ?>
               <tr>
                 <td class="text-center tbl-pad"><div style="width:90%" class="text-left"><b>TOTAL BUBBLE BAG</b></div></td>
                 <td class="text-center tbl-pad"><div style="width:90%"><b><?php echo $mstrBubbleTotal; ?></b></div></td>
               </tr>
               <tr>
                 <td class="text-center tbl-pad"><div style="width:90%" class="text-left"><b>TOTAL POLYBAG</b></div></td>
                 <td class="text-center tbl-pad"><div style="width:90%"><b><?php echo $mstrPolyTotal; ?></b></div></td>
               </tr>
            </tbody>
          </table>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->


</body></html>
