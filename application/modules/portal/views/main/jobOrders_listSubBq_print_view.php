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
    <div class="row text-center">
      <h4><b><?php echo $job_orders->customer_name; ?></b></h4>
    </div>
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
                  <td class="tbl-pad text-right"><?php echo  number_format($line->jo_count); ?></td>
                </tr>
            <?php
              }
             ?>
          <tr>
            <td colspan="3" class="tbl-pad">*** TOTAL ***</td>
            <td class="tbl-pad text-right"><?php echo number_format($total_quantity); ?></td>
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
            $materialArray = array();
            $tempMaterialArray = array();
            foreach ($materials as $material) {
              $qty=0;
              foreach ($material as $value) {
                //$qty = $value["qty"]==''? 0:floatval(str_replace(',','',trim($value["qty"])));
                $qty = $value["qty"]==''? 0:preg_replace('/[^0-9.]+/', '', $value["qty"]);
                //$jo_count = $value["jo_count"]==''? 0:str_replace(',','',trim($value["jo_count"]));
                $jo_count = $value["jo_count"]==''? 0:preg_replace('/[^0-9.]+/', '', $value["jo_count"]);
                //$cost = $value["cost"]==''? 0:str_replace(',','',$value["cost"]);
                // foreach ($invoice_lines as $line) {
                //   if ($line->product_id==$value["product_variant_id"]) {
                //     if($line->quantity!=''){
                //       if($line->id==$value["invoice_id"]){
                //         $qty *= $line->quantity;
                //         //$cost *= $line->quantity;
                //       }
                //     }
                //   }
                // }
                $qty *= $jo_count;
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
                                          // 'cost'=>$cost
                                          );
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
                //$moQty = $thisMaterial["quantity"]==''? 0:str_replace(',','',$thisMaterial["quantity"]);
                // $cost = $thisMaterial["cost"]==''? 0:str_replace(',','',$thisMaterial["cost"]);
                $fixQ = $colorQty == 0 ? 0 : $qty/(1000/$colorQty) ;
                $jo_count = $value["jo_count"]==''? 0:str_replace(',','',$value["jo_count"]);
                $totalQty = 1 * $fixQ * $jo_count;
                //$totalQty = $qty * $colorQty * $moQty;
                //$totalCost = $cost * $colorQty * $moQty;
                //$totalCost = $cost;
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
                                          // 'cost'=>$totalCost
                                          );
                      array_push($tempMaterialArray,$thisArray);
                  }
                }
              }
            }

            asort($tempMaterialArray);
            $job_typ=$job_orders->job_type=='resin'?array('M','R'):array('FA','FB','FC');
              //foreach ($invoice_lines as $line) {
                  for ($i=0; $i < count($job_typ); $i++) {
                      $x=0;
                      //foreach ($materials as $material) {
                          foreach ($tempMaterialArray as $value) {
                              //if ($line->product_id==$value["product_variant_id"]) {
                              if ($value["tipe"] == "material") {
                                  if ($job_typ[$i]==$value["jp"]) {
                                      if ($x==0) { ?>
                                      <tr>
                                        <td class="tbl-pad" colspan="3">** Job Process: <?php echo $job_typ[$i]; ?></td>
                                      </tr>
                                  <?php $x++; }
                                      // var_dump($value['product_variant_id'].'='.$value['material_name'].'='.$value['jp'].'<br>');
                                      $value["qty"] = $materialArray[$value["material_name"]];
                                      $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                                      $converted = $job_orders->job_type=='resin'?resinConvert($value["unit"], $value["material_name"], $qty):convertMe($value["unit"], $value["material_name"], $qty);
                                      $qtyValue = $converted['qtyValue'];
                                      $unit = $converted['unit'];
                                      ?>
                                    <tr>
                                      <td class="tbl-pad"><?php echo $value["material_name"]; ?></td>
                                      <td class="tbl-pad text-right"><?php echo number_format($qtyValue,3).' '.$unit; ?></td>
                                      <td class="tbl-pad text-center">______________________:______________________:______________________</td>
                                    </tr>
            <?php
                                  }
                              }
                          }
                      //}
                  }
              //}
              $jobType=$job_orders->job_type=='resin'?array():array('FA','FB');
              for ($i=0; $i < count($jobType); $i++) {
                  $x=0;
                  //foreach ($materials as $material) {
                      foreach ($tempMaterialArray as $value) {
                          //if ($line->product_id==$value["product_variant_id"]) {
                          if ($value["tipe"] == "color") {
                              if ($jobType[$i]==$value["jp"]) {
                                  if ($x==0) { ?>
                                  <tr>
                                    <td class="tbl-pad" colspan="3">** Job Process: <?php echo $jobType[$i]; ?></td>
                                  </tr>
                              <?php $x++; }
                                  // var_dump($value['product_variant_id'].'='.$value['material_name'].'='.$value['jp'].'<br>');
                                  $value["qty"] = $materialArray[$value["material_name"]];
                                  $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                                  $converted = $job_orders->job_type=='resin'?resinConvert($value["unit"], $value["material_name"], $qty):convertMe($value["unit"], $value["material_name"], $qty);
                                  $qtyValue = $converted['qtyValue'];
                                  $unit = $converted['unit'];
                                  ?>
                                <tr>
                                  <td class="tbl-pad"><?php echo $value["material_name"]; ?></td>
                                  <td class="tbl-pad text-right"><?php echo number_format($qtyValue,3).' '.$unit; ?></td>
                                  <td class="tbl-pad text-center">______________________:______________________:______________________</td>
                                </tr>
        <?php
                              }
                          }
                      }
                  //}
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
<?php
function resinConvert($thisValue, $thisMat, $qty){
  $unit = '';
  $qtyValue = 0;
  $converts = array();
  switch ($thisValue) {
    case 'GM':
      if ($qty>=1000){
        if(strpos($thisMat, 'RESIN') !== FALSE && $qty>=30000){
            $qtyValue = str_replace(',','',number_format($qty / 30000,3));
            $unit = 'BOX';
        } elseif (strpos($thisMat, 'PLASTER OF PARIS') !== FALSE && $qty>=25000) {
          $qtyValue = str_replace(',','',number_format($qty / 25000,3));
          $unit = 'SACK';
        } else {
          $qtyValue = str_replace(',','',number_format($qty / 1000,3));
          $unit = 'KG';
        }
      } else {
        $qtyValue = str_replace(',','',number_format($qty,3));
        $unit = 'GM';
      }
      break;
    case 'ML':
      if ($qty>=1000){
        if($qty>=4000){
          $qtyValue = str_replace(',','',number_format($qty / 4000,3));
          $unit = 'GAL';
        } else {
          $qtyValue = str_replace(',','',number_format($qty / 1000,3));
          $unit = 'LI';
        }
      } else {
        $qtyValue = str_replace(',','',number_format($qty,3));
        $unit = 'ML';
      }
      break;
    case 'KG':
      if(strpos($thisMat, 'PLASTER OF PARIS') !== FALSE){
        if ($qty>=25){
          $qtyValue = str_replace(',','',number_format($qty / 25,3));
          $unit = 'SACK';
        } else {
          $qtyValue = str_replace(',','',number_format($qty,3));
          $unit = 'KG';
        }
      } else {
        $qtyValue = str_replace(',','',number_format($qty,3));
        $unit = 'KG';
      }
      break;
    case 'PC':
      $qtyValue = str_replace(',','',number_format($qty,3));
      $unit = 'PC';
      break;
    case 'IN':
      $qtyValue = str_replace(',','',number_format($qty,3));
      $unit = 'IN';
      break;
    default:
      $qtyValue = str_replace(',','',number_format($qty,3));
      $unit = $thisValue;
      break;
  }

  $converts['unit'] = $unit;
  $converts['qtyValue'] = $qtyValue;
  return $converts;
}

function convertMe($thisValue, $thisMat, $qty) {
  $unit = '';
  $qtyValue = 0;
  $converts = array();
  $partialCost=0;
  switch ($thisValue) {
    case 'GM':
      if(strpos($thisMat, 'DURA') !== FALSE){
        if($qty>=2){
          $qtyValue = str_replace(',','',number_format($qty / 2,3));
          $unit = 'PCS';
          $partialCost *= 2;
        } else {
          $qtyValue = str_replace(',','',number_format($qty,3));
          $unit = 'GM';
        }
      } elseif($qty>=1000){
        $qtyValue = str_replace(',','',number_format($qty / 1000,3));
        $unit = 'KG';
        $partialCost *= 1000;
      } else {
        $qtyValue = str_replace(',','',number_format($qty,3));
        $unit = 'GM';
      }
      break;
    case 'ML':
      if($qty>=1000){
        $qtyValue = str_replace(',','',number_format($qty / 1000,3));
        if($qtyValue>=4){
          $partialCost *= 1000;
          $qtyValue = str_replace(',','',number_format($qtyValue / 4,3));
          $unit = 'GAL';
          $partialCost *= 4;
        } else {
          $unit = 'LI';
          $partialCost *= 1000;
        }
      }else{
        $qtyValue = str_replace(',','',number_format($qty,3));
        $unit = 'ML';
      }
      break;
    case 'IN':
        if(strpos($thisMat, 'GOLD LEAF') !== FALSE){
          if($qty>=1800) {
            $qtyValue = str_replace(',','',number_format($qty / 1800,3));
            $unit = 'ROLL';
            $partialCost *= 1800;
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'IN';
          }
        } elseif (strpos($thisMat, 'GLUE STICK') !== FALSE) {
          if($qty>=9) {
            $qtyValue = str_replace(',','',number_format($qty / 9,3));
            $unit = 'PC';
            $partialCost *= 9;
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'IN';
          }
        } elseif ($qty>=1100) {
          $qtyValue = str_replace(',','',number_format($qty / 1100,3));
          $unit = 'ROLL';
          $partialCost *= 1100;
        } else {
          $qtyValue = str_replace(',','',number_format($qty,3));
          $unit = 'IN';
        }
      break;
    case 'PC':
      if(strpos($thisMat, 'LONG FEATHER WHITE-BALAKANG') !== FALSE) {
        if($qty>=500) {
          $qtyValue = str_replace(',','',number_format($qty / 500,3));
          $unit = 'YARDS';
          $partialCost *= 500;
        } else {
          $qtyValue = str_replace(',','',number_format($qty,3));
          $unit = 'PC';
        }
      } elseif (strpos($thisMat, 'GOLD CORD') !== FALSE) {
        if($qty>=1100) {
          $qtyValue = str_replace(',','',number_format($qty / 1100,3));
          $unit = 'ROLL';
          $partialCost *= 1100;
        } else {
          $qtyValue = str_replace(',','',number_format($qty,3));
          $unit = 'PC';
        }
      } elseif (strpos($thisMat, 'FELT PAPER') !== FALSE) {
        preg_match_all('!\d+\.*\d*!', $thisMat, $matches);
        if (strpos($thisMat, 'CONETREE W/ POT BASE') !== FALSE) {
          if (strpos($thisMat, '5.5"') !== FALSE && in_array('5.5',$matches[0])) {
            if($qty>=280) {
              $qtyValue = str_replace(',','',number_format($qty / 280,3));
              $unit = 'SHEET';
              $partialCost *= 280;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '6.5"') !== FALSE && in_array('6.5',$matches[0])) {
            if($qty>=280) {
              $qtyValue = str_replace(',','',number_format($qty / 280,3));
              $unit = 'SHEET';
              $partialCost *= 280;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=234) {
              $qtyValue = str_replace(',','',number_format($qty / 234,3));
              $unit = 'SHEET';
              $partialCost *= 234;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '9"') !== FALSE && in_array('9',$matches[0])) {
            if($qty>=108) {
              $qtyValue = str_replace(',','',number_format($qty / 108,3));
              $unit = 'SHEET';
              $partialCost *= 108;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=88) {
              $qtyValue = str_replace(',','',number_format($qty / 88,3));
              $unit = 'SHEET';
              $partialCost *= 88;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '17"') !== FALSE && in_array('17',$matches[0])) {
            if($qty>=70) {
              $qtyValue = str_replace(',','',number_format($qty / 70,3));
              $unit = 'SHEET';
              $partialCost *= 70;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'NEO CONETREE W/ POT BASE') !== FALSE) {
          if (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=280) {
              $qtyValue = str_replace(',','',number_format($qty / 280,3));
              $unit = 'SHEET';
              $partialCost *= 280;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '9"') !== FALSE && in_array('9',$matches[0])) {
            if($qty>=180) {
              $qtyValue = str_replace(',','',number_format($qty / 180,3));
              $unit = 'SHEET';
              $partialCost *= 180;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=80) {
              $qtyValue = str_replace(',','',number_format($qty / 80,3));
              $unit = 'SHEET';
              $partialCost *= 80;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '17"') !== FALSE && in_array('17',$matches[0])) {
            if($qty>=63) {
              $qtyValue = str_replace(',','',number_format($qty / 63,3));
              $unit = 'SHEET';
              $partialCost *= 63;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'CONETREE W/ R. BALL BASE') !== FALSE) {
          if (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=104) {
              $qtyValue = str_replace(',','',number_format($qty / 104,3));
              $unit = 'SHEET';
              $partialCost *= 104;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '9"') !== FALSE && in_array('9',$matches[0])) {
            if($qty>=56) {
              $qtyValue = str_replace(',','',number_format($qty / 56,3));
              $unit = 'SHEET';
              $partialCost *= 56;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '10.5"') !== FALSE && in_array('10.5',$matches[0])) {
            if($qty>=48) {
              $qtyValue = str_replace(',','',number_format($qty / 48,3));
              $unit = 'SHEET';
              $partialCost *= 48;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=56) {
              $qtyValue = str_replace(',','',number_format($qty / 56,3));
              $unit = 'SHEET';
              $partialCost *= 56;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '14.5"') !== FALSE && in_array('14.5',$matches[0])) {
            if($qty>=42) {
              $qtyValue = str_replace(',','',number_format($qty / 42,3));
              $unit = 'SHEET';
              $partialCost *= 42;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '17"') !== FALSE && in_array('17',$matches[0])) {
            if($qty>=35) {
              $qtyValue = str_replace(',','',number_format($qty / 35,3));
              $unit = 'SHEET';
              $partialCost *= 35;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '20"') !== FALSE && in_array('20',$matches[0])) {
            if($qty>=20) {
              $qtyValue = str_replace(',','',number_format($qty / 20,3));
              $unit = 'SHEET';
              $partialCost *= 20;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '21"') !== FALSE && in_array('21',$matches[0])) {
            if($qty>=20) {
              $qtyValue = str_replace(',','',number_format($qty / 20,3));
              $unit = 'SHEET';
              $partialCost *= 20;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'PLAIN SCALLOPED SLIM TREE') !== FALSE) {
          if (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=108) {
              $qtyValue = str_replace(',','',number_format($qty / 108,3));
              $unit = 'SHEET';
              $partialCost *= 108;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=56) {
              $qtyValue = str_replace(',','',number_format($qty / 56,3));
              $unit = 'SHEET';
              $partialCost *= 56;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '17"') !== FALSE && in_array('17',$matches[0])) {
            if($qty>=108) {
              $qtyValue = str_replace(',','',number_format($qty / 108,3));
              $unit = 'SHEET';
              $partialCost *= 108;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '27"') !== FALSE && in_array('27',$matches[0])) {
            if($qty>=63) {
              $qtyValue = str_replace(',','',number_format($qty / 63,3));
              $unit = 'SHEET';
              $partialCost *= 63;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'NEO R. BASE') !== FALSE) {
          if (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=154) {
              $qtyValue = str_replace(',','',number_format($qty / 154,3));
              $unit = 'SHEET';
              $partialCost *= 154;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '9"') !== FALSE && in_array('9',$matches[0])) {
            if($qty>=88) {
              $qtyValue = str_replace(',','',number_format($qty / 88,3));
              $unit = 'SHEET';
              $partialCost *= 88;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=56) {
              $qtyValue = str_replace(',','',number_format($qty / 56,3));
              $unit = 'SHEET';
              $partialCost *= 56;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '17"') !== FALSE && in_array('17',$matches[0])) {
            if($qty>=30) {
              $qtyValue = str_replace(',','',number_format($qty / 30,3));
              $unit = 'SHEET';
              $partialCost *= 30;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'CONETREE W/ R. BASE') !== FALSE) {
          if (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=80) {
              $qtyValue = str_replace(',','',number_format($qty / 80,3));
              $unit = 'SHEET';
              $partialCost *= 80;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '8.5"') !== FALSE && in_array('8.5',$matches[0])) {
            if($qty>=70) {
              $qtyValue = str_replace(',','',number_format($qty / 70,3));
              $unit = 'SHEET';
              $partialCost *= 70;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '9"') !== FALSE && in_array('9',$matches[0])) {
            if($qty>=63) {
              $qtyValue = str_replace(',','',number_format($qty / 63,3));
              $unit = 'SHEET';
              $partialCost *= 63;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '10.5"') !== FALSE && in_array('10.5',$matches[0])) {
            if($qty>=63) {
              $qtyValue = str_replace(',','',number_format($qty / 63,3));
              $unit = 'SHEET';
              $partialCost *= 63;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=56) {
              $qtyValue = str_replace(',','',number_format($qty / 56,3));
              $unit = 'SHEET';
              $partialCost *= 56;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '14.5"') !== FALSE && in_array('14.5',$matches[0])) {
            if($qty>=35) {
              $qtyValue = str_replace(',','',number_format($qty / 35,3));
              $unit = 'SHEET';
              $partialCost *= 35;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '17"') !== FALSE && in_array('17',$matches[0])) {
            if($qty>=42) {
              $qtyValue = str_replace(',','',number_format($qty / 42,3));
              $unit = 'SHEET';
              $partialCost *= 42;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '18.5"') !== FALSE && in_array('18.5',$matches[0])) {
            if($qty>=20) {
              $qtyValue = str_replace(',','',number_format($qty / 20,3));
              $unit = 'SHEET';
              $partialCost *= 20;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'SLIM ROUND TREE') !== FALSE) {
          if (strpos($thisMat, '10"') !== FALSE && in_array('10',$matches[0])) {
            if($qty>=56) {
              $qtyValue = str_replace(',','',number_format($qty / 56,3));
              $unit = 'SHEET';
              $partialCost *= 56;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '14"') !== FALSE && in_array('14',$matches[0])) {
            if($qty>=42) {
              $qtyValue = str_replace(',','',number_format($qty / 42,3));
              $unit = 'SHEET';
              $partialCost *= 42;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'SLIM CONETREE W/ POT BASE') !== FALSE) {
          if (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=374) {
              $qtyValue = str_replace(',','',number_format($qty / 374,3));
              $unit = 'SHEET';
              $partialCost *= 374;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '9"') !== FALSE && in_array('9',$matches[0])) {
            if($qty>=221) {
              $qtyValue = str_replace(',','',number_format($qty / 221,3));
              $unit = 'SHEET';
              $partialCost *= 221;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=108) {
              $qtyValue = str_replace(',','',number_format($qty / 108,3));
              $unit = 'SHEET';
              $partialCost *= 108;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '17"') !== FALSE && in_array('17',$matches[0])) {
            if($qty>=88) {
              $qtyValue = str_replace(',','',number_format($qty / 88,3));
              $unit = 'SHEET';
              $partialCost *= 88;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'STILLETO TREE') !== FALSE) {
          if (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=374) {
              $qtyValue = str_replace(',','',number_format($qty / 374,3));
              $unit = 'SHEET';
              $partialCost *= 374;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '9"') !== FALSE && in_array('9',$matches[0])) {
            if($qty>=221) {
              $qtyValue = str_replace(',','',number_format($qty / 221,3));
              $unit = 'SHEET';
              $partialCost *= 221;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=130) {
              $qtyValue = str_replace(',','',number_format($qty / 130,3));
              $unit = 'SHEET';
              $partialCost *= 130;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '17"') !== FALSE && in_array('17',$matches[0])) {
            if($qty>=108) {
              $qtyValue = str_replace(',','',number_format($qty / 108,3));
              $unit = 'SHEET';
              $partialCost *= 108;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'NEO HOLLY STILLETO TREE') !== FALSE) {
          if (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=300) {
              $qtyValue = str_replace(',','',number_format($qty / 300,3));
              $unit = 'SHEET';
              $partialCost *= 300;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '9"') !== FALSE && in_array('9',$matches[0])) {
            if($qty>=266) {
              $qtyValue = str_replace(',','',number_format($qty / 266,3));
              $unit = 'SHEET';
              $partialCost *= 266;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=130) {
              $qtyValue = str_replace(',','',number_format($qty / 130,3));
              $unit = 'SHEET';
              $partialCost *= 130;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '17"') !== FALSE && in_array('17',$matches[0])) {
            if($qty>=70) {
              $qtyValue = str_replace(',','',number_format($qty / 70,3));
              $unit = 'SHEET';
              $partialCost *= 70;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'NEO STILLETO TREE') !== FALSE) {
          if (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=300) {
              $qtyValue = str_replace(',','',number_format($qty / 300,3));
              $unit = 'SHEET';
              $partialCost *= 300;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '9"') !== FALSE && in_array('9',$matches[0])) {
            if($qty>=216) {
              $qtyValue = str_replace(',','',number_format($qty / 216,3));
              $unit = 'SHEET';
              $partialCost *= 216;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '10"') !== FALSE && in_array('10',$matches[0])) {
            if($qty>=247) {
              $qtyValue = str_replace(',','',number_format($qty / 247,3));
              $unit = 'SHEET';
              $partialCost *= 247;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=63) {
              $qtyValue = str_replace(',','',number_format($qty / 63,3));
              $unit = 'SHEET';
              $partialCost *= 63;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '17"') !== FALSE && in_array('17',$matches[0])) {
            if($qty>=48) {
              $qtyValue = str_replace(',','',number_format($qty / 48,3));
              $unit = 'SHEET';
              $partialCost *= 48;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'NEO ELEGANT STILLETO TREE') !== FALSE) {
          if (strpos($thisMat, '9"') !== FALSE && in_array('9',$matches[0])) {
            if($qty>=130) {
              $qtyValue = str_replace(',','',number_format($qty / 130,3));
              $unit = 'SHEET';
              $partialCost *= 130;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=108) {
              $qtyValue = str_replace(',','',number_format($qty / 108,3));
              $unit = 'SHEET';
              $partialCost *= 108;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } elseif (strpos($thisMat, 'NEO FLARED STILLETO TREE') !== FALSE) {
          if (strpos($thisMat, '7"') !== FALSE && in_array('7',$matches[0])) {
            if($qty>=300) {
              $qtyValue = str_replace(',','',number_format($qty / 300,3));
              $unit = 'SHEET';
              $partialCost *= 300;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '10"') !== FALSE && in_array('10',$matches[0])) {
            if($qty>=108) {
              $qtyValue = str_replace(',','',number_format($qty / 108,3));
              $unit = 'SHEET';
              $partialCost *= 108;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } elseif (strpos($thisMat, '13"') !== FALSE && in_array('13',$matches[0])) {
            if($qty>=63) {
              $qtyValue = str_replace(',','',number_format($qty / 63,3));
              $unit = 'SHEET';
              $partialCost *= 63;
            } else {
              $qtyValue = str_replace(',','',number_format($qty,3));
              $unit = 'PC';
            }
          } else {
            $qtyValue = str_replace(',','',number_format($qty,3));
            $unit = 'PC';
          }
        } else {
          $qtyValue = str_replace(',','',number_format($qty,3));
          $unit = 'PC';
        }
      } else {
        $qtyValue = str_replace(',','',number_format($qty,3));
        $unit = 'PC';
      }
      break;
    case 'GAL':
      $qtyValue = str_replace(',','',number_format($qty,3));
      $unit = 'GAL';
      break;
    case 'LI.':
      if($qty>=4){
        $qtyValue = str_replace(',','',number_format($qty / 4,3));
        $unit = 'GAL';
        $partialCost *= 4;
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
  $converts['unit'] = $unit;
  $converts['qtyValue'] = $qtyValue;
  return $converts;
}
?>

</body></html>
