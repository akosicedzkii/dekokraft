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
                $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                $cost = $value["cost"]==''? 0:str_replace(',','',$value["cost"]);
                foreach ($invoice_lines as $line) {
                  if ($line->product_id==$value["product_variant_id"]) {
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
                                          'cost'=>$cost);
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
                $totalQty = $qty * $colorQty * $moQty;
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
                                          'cost'=>$totalCost);
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
            asort($tempMaterialArray);
            // echo '<tr>
            //       <td class="tbl-pad" colspan="5">Material Type: Materials</td>
            //     </tr>';
            for ($i=0; $i < count($job_typ); $i++) {
                $x=0;
                      // foreach ($tempMaterialArray as $material) {
                        $totalAmountMat = 0;
                        $partialCost = 0;
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
                                  $partialCost = $value["cost"]==''? 0:str_replace(',','',$value["cost"]);
                                  $unit = '';
                                  switch ($value["unit"]) {
                                    case 'GM':
                                      if(strpos($value["material_name"], 'DURA') !== FALSE){
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
                                        $unit = 'LI';
                                        $partialCost *= 1000;
                                      }else{
                                        $qtyValue = str_replace(',','',number_format($qty,3));
                                        $unit = 'ML';
                                      }
                                      break;
                                    case 'IN':
                                        if(strpos($value["material_name"], 'GOLD LEAF') !== FALSE){
                                          if($qty>=1800) {
                                            $qtyValue = str_replace(',','',number_format($qty / 1800,3));
                                            $unit = 'ROLL';
                                            $partialCost *= 1800;
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'IN';
                                          }
                                        } elseif($qty>=1100) {
                                          $qtyValue = str_replace(',','',number_format($qty / 1100,3));
                                          $unit = 'ROLL';
                                          $partialCost *= 1100;
                                        } else {
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = 'IN';
                                        }
                                      break;
                                    case 'PC':
                                      if(strpos($value["material_name"], 'LONG FEATHER WHITE- BALAKANG') !== FALSE) {
                                        if($qty>=500) {
                                          $qtyValue = str_replace(',','',number_format($qty / 500,3));
                                          $unit = 'YARDS';
                                          $partialCost *= 500;
                                        } else {
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = 'PC';
                                        }
                                      } elseif (strpos($value["material_name"], 'FELT PAPER') !== FALSE) {
                                        if (strpos($value["material_name"], 'CONETREE W/POT BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '5.5"') !== FALSE) {
                                            if($qty>=280) {
                                              $qtyValue = str_replace(',','',number_format($qty / 280,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.06;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '6.5"') !== FALSE) {
                                            if($qty>=280) {
                                              $qtyValue = str_replace(',','',number_format($qty / 280,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.06;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=234) {
                                              $qtyValue = str_replace(',','',number_format($qty / 234,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.07;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=88) {
                                              $qtyValue = str_replace(',','',number_format($qty / 88,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.19;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=70) {
                                              $qtyValue = str_replace(',','',number_format($qty / 70,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.23;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO CONETREE W/POT BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=280) {
                                              $qtyValue = str_replace(',','',number_format($qty / 280,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.06;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=180) {
                                              $qtyValue = str_replace(',','',number_format($qty / 180,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.09;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=80) {
                                              $qtyValue = str_replace(',','',number_format($qty / 80,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.20;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'CONETREE W/R.BALL BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=104) {
                                              $qtyValue = str_replace(',','',number_format($qty / 104,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.16;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '10.5"') !== FALSE) {
                                            if($qty>=48) {
                                              $qtyValue = str_replace(',','',number_format($qty / 48,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.33;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '14.5"') !== FALSE) {
                                            if($qty>=42) {
                                              $qtyValue = str_replace(',','',number_format($qty / 42,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.38;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=35) {
                                              $qtyValue = str_replace(',','',number_format($qty / 35,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.46;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '20"') !== FALSE) {
                                            if($qty>=20) {
                                              $qtyValue = str_replace(',','',number_format($qty / 20,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.80;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '21"') !== FALSE) {
                                            if($qty>=20) {
                                              $qtyValue = str_replace(',','',number_format($qty / 20,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.80;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'PLAIN SCALLOPED SLIM TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '27"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO RIBBED BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=154) {
                                              $qtyValue = str_replace(',','',number_format($qty / 154,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.10;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=88) {
                                              $qtyValue = str_replace(',','',number_format($qty / 88,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.18;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=30) {
                                              $qtyValue = str_replace(',','',number_format($qty / 30,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.53;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'CONETREE W/RIBBED BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=80) {
                                              $qtyValue = str_replace(',','',number_format($qty / 80,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.20;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '8.5"') !== FALSE) {
                                            if($qty>=70) {
                                              $qtyValue = str_replace(',','',number_format($qty / 70,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.23;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '10.5"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '14.5"') !== FALSE) {
                                            if($qty>=35) {
                                              $qtyValue = str_replace(',','',number_format($qty / 35,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.46;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=42) {
                                              $qtyValue = str_replace(',','',number_format($qty / 42,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.38;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '18.5"') !== FALSE) {
                                            if($qty>=20) {
                                              $qtyValue = str_replace(',','',number_format($qty / 20,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.80;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'SLIM ROUND TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '10"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '14"') !== FALSE) {
                                            if($qty>=42) {
                                              $qtyValue = str_replace(',','',number_format($qty / 42,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.38;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'SLIM CONETREE W/POT BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=374) {
                                              $qtyValue = str_replace(',','',number_format($qty / 374,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.04;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=221) {
                                              $qtyValue = str_replace(',','',number_format($qty / 221,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.07;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=88) {
                                              $qtyValue = str_replace(',','',number_format($qty / 88,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.18;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'STILLETO TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=374) {
                                              $qtyValue = str_replace(',','',number_format($qty / 374,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.04;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=221) {
                                              $qtyValue = str_replace(',','',number_format($qty / 221,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.07;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=130) {
                                              $qtyValue = str_replace(',','',number_format($qty / 130,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.12;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO HOLLY STILLETO TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=300) {
                                              $qtyValue = str_replace(',','',number_format($qty / 300,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.05;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=266) {
                                              $qtyValue = str_replace(',','',number_format($qty / 266,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.06;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=130) {
                                              $qtyValue = str_replace(',','',number_format($qty / 130,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.12;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=70) {
                                              $qtyValue = str_replace(',','',number_format($qty / 70,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.23;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO STILLETO TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=300) {
                                              $qtyValue = str_replace(',','',number_format($qty / 300,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.05;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=216) {
                                              $qtyValue = str_replace(',','',number_format($qty / 216,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.07;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '10"') !== FALSE) {
                                            if($qty>=247) {
                                              $qtyValue = str_replace(',','',number_format($qty / 247,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.06;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=48) {
                                              $qtyValue = str_replace(',','',number_format($qty / 48,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.33;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO ELEGANT STILLETO TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=130) {
                                              $qtyValue = str_replace(',','',number_format($qty / 130,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.12;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO FLARED STILLETO TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=300) {
                                              $qtyValue = str_replace(',','',number_format($qty / 300,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.05;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '10"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
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
                                      $cost = $partialCost;
                                      $amount = number_format($cost * $qtyValue,2);
                                      $totalAmountMat += ($cost * $qtyValue);
                                      // var_dump($value['product_variant_id'].'='.$value['material_name'].'='.$value['jp'].'<br>');

                                      // var_dump($materialArray);
                                      //var_dump($tempMaterialArray);
                                      ?>
                                    <tr>
                                      <td class="tbl-pad"><?php echo $value["material_name"]; ?></td>
                                      <td class="tbl-pad text-right"><?php echo number_format($cost,2); ?></td>
                                      <td class="tbl-pad text-right"><div style="width:90%"><?php echo $amount; ?></div></td>
                                      <td class="tbl-pad text-right"><div style="width:90%"><?php echo $qtyValue.' '.$unit; ?></div></td>
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
            // echo '<tr><td class="tbl-pad" colspan="5">** Total Materials **</td></tr>';
            // echo '<tr><td class="tbl-pad" colspan="2"></td>
            //       <td class="tbl-pad text-right"><div style="width:90%">'.number_format($totalMat,2).'</div></td></tr>';

            // this is for color composition
            // echo '<tr>
            //         <td class="tbl-pad" colspan="5">Material Type: Color Composition</td>
            //       </tr>';
              // foreach ($invoice_lines as $line) {

                  for ($i=0; $i < count($job_typ); $i++) {
                      $x=0;
                      // foreach ($tempMaterialArray as $material) {
                        $totalAmount = 0;
                        $partialCost = 0;
                          foreach ($tempMaterialArray as $values => $value) {
                              // if ($line->product_id==$value["product_variant_id"]) {
                                if ($value["tipe"] == "color") {
                                  if ($job_typ[$i]==$value["jp"]) {
                                      if ($x==0) { ?>
                                        <tr>
                                          <td class="tbl-pad" colspan="5">** Job Process: <?php echo $job_typ[$i]; ?></td>
                                        </tr>
                                  <?php $x++; }
                                  $value["qty"] = $materialArray[$value["material_name"]];
                                  $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                                  $qtyValue = 0;
                                  $partialCost = $value["cost"]==''? 0:str_replace(',','',$value["cost"]);
                                  $unit = '';
                                  switch ($value["unit"]) {
                                    case 'GM':
                                      if(strpos($value["material_name"], 'DURA') !== FALSE){
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
                                        $unit = 'LI';
                                        $partialCost *= 1000;
                                      }else{
                                        $qtyValue = str_replace(',','',number_format($qty,3));
                                        $unit = 'ML';
                                      }
                                      break;
                                    case 'IN':
                                        if(strpos($value["material_name"], 'GOLD LEAF') !== FALSE){
                                          if($qty>=1800) {
                                            $qtyValue = str_replace(',','',number_format($qty / 1800,3));
                                            $unit = 'ROLL';
                                            $partialCost *= 1800;
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'IN';
                                          }
                                        } elseif($qty>=1100) {
                                          $qtyValue = str_replace(',','',number_format($qty / 1100,3));
                                          $unit = 'ROLL';
                                          $partialCost *= 1100;
                                        } else {
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = 'IN';
                                        }
                                      break;
                                    case 'PC':
                                      if(strpos($value["material_name"], 'LONG FEATHER WHITE- BALAKANG') !== FALSE) {
                                        if($qty>=500) {
                                          $qtyValue = str_replace(',','',number_format($qty / 500,3));
                                          $unit = 'YARDS';
                                          $partialCost *= 500;
                                        } else {
                                          $qtyValue = str_replace(',','',number_format($qty,3));
                                          $unit = 'PC';
                                        }
                                      } elseif (strpos($value["material_name"], 'FELT PAPER') !== FALSE) {
                                        if (strpos($value["material_name"], 'CONETREE W/POT BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '5.5"') !== FALSE) {
                                            if($qty>=280) {
                                              $qtyValue = str_replace(',','',number_format($qty / 280,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.06;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '6.5"') !== FALSE) {
                                            if($qty>=280) {
                                              $qtyValue = str_replace(',','',number_format($qty / 280,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.06;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=234) {
                                              $qtyValue = str_replace(',','',number_format($qty / 234,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.07;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=88) {
                                              $qtyValue = str_replace(',','',number_format($qty / 88,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.19;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=70) {
                                              $qtyValue = str_replace(',','',number_format($qty / 70,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.23;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO CONETREE W/POT BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=280) {
                                              $qtyValue = str_replace(',','',number_format($qty / 280,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.06;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=180) {
                                              $qtyValue = str_replace(',','',number_format($qty / 180,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.09;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=80) {
                                              $qtyValue = str_replace(',','',number_format($qty / 80,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.20;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'CONETREE W/R.BALL BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=104) {
                                              $qtyValue = str_replace(',','',number_format($qty / 104,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.16;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '10.5"') !== FALSE) {
                                            if($qty>=48) {
                                              $qtyValue = str_replace(',','',number_format($qty / 48,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.33;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '14.5"') !== FALSE) {
                                            if($qty>=42) {
                                              $qtyValue = str_replace(',','',number_format($qty / 42,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.38;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=35) {
                                              $qtyValue = str_replace(',','',number_format($qty / 35,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.46;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '20"') !== FALSE) {
                                            if($qty>=20) {
                                              $qtyValue = str_replace(',','',number_format($qty / 20,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.80;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '21"') !== FALSE) {
                                            if($qty>=20) {
                                              $qtyValue = str_replace(',','',number_format($qty / 20,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.80;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'PLAIN SCALLOPED SLIM TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '27"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO RIBBED BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=154) {
                                              $qtyValue = str_replace(',','',number_format($qty / 154,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.10;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=88) {
                                              $qtyValue = str_replace(',','',number_format($qty / 88,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.18;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=30) {
                                              $qtyValue = str_replace(',','',number_format($qty / 30,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.53;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'CONETREE W/RIBBED BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=80) {
                                              $qtyValue = str_replace(',','',number_format($qty / 80,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.20;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '8.5"') !== FALSE) {
                                            if($qty>=70) {
                                              $qtyValue = str_replace(',','',number_format($qty / 70,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.23;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '10.5"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '14.5"') !== FALSE) {
                                            if($qty>=35) {
                                              $qtyValue = str_replace(',','',number_format($qty / 35,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.46;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=42) {
                                              $qtyValue = str_replace(',','',number_format($qty / 42,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.38;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '18.5"') !== FALSE) {
                                            if($qty>=20) {
                                              $qtyValue = str_replace(',','',number_format($qty / 20,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.80;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'SLIM ROUND TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '10"') !== FALSE) {
                                            if($qty>=56) {
                                              $qtyValue = str_replace(',','',number_format($qty / 56,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.29;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '14"') !== FALSE) {
                                            if($qty>=42) {
                                              $qtyValue = str_replace(',','',number_format($qty / 42,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.38;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'SLIM CONETREE W/POT BASE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=374) {
                                              $qtyValue = str_replace(',','',number_format($qty / 374,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.04;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=221) {
                                              $qtyValue = str_replace(',','',number_format($qty / 221,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.07;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=88) {
                                              $qtyValue = str_replace(',','',number_format($qty / 88,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.18;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'STILLETO TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=374) {
                                              $qtyValue = str_replace(',','',number_format($qty / 374,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.04;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=221) {
                                              $qtyValue = str_replace(',','',number_format($qty / 221,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.07;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=130) {
                                              $qtyValue = str_replace(',','',number_format($qty / 130,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.12;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO HOLLY STILLETO TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=300) {
                                              $qtyValue = str_replace(',','',number_format($qty / 300,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.05;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=266) {
                                              $qtyValue = str_replace(',','',number_format($qty / 266,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.06;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=130) {
                                              $qtyValue = str_replace(',','',number_format($qty / 130,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.12;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=70) {
                                              $qtyValue = str_replace(',','',number_format($qty / 70,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.23;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO STILLETO TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=300) {
                                              $qtyValue = str_replace(',','',number_format($qty / 300,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.05;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=216) {
                                              $qtyValue = str_replace(',','',number_format($qty / 216,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.07;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '10"') !== FALSE) {
                                            if($qty>=247) {
                                              $qtyValue = str_replace(',','',number_format($qty / 247,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.06;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '17"') !== FALSE) {
                                            if($qty>=48) {
                                              $qtyValue = str_replace(',','',number_format($qty / 48,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.33;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO ELEGANT STILLETO TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '9"') !== FALSE) {
                                            if($qty>=130) {
                                              $qtyValue = str_replace(',','',number_format($qty / 130,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.12;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } else {
                                            $qtyValue = str_replace(',','',number_format($qty,3));
                                            $unit = 'PC';
                                          }
                                        } elseif (strpos($value["material_name"], 'NEO FLARED STILLETO TREE') !== FALSE) {
                                          if (strpos($value["material_name"], '7"') !== FALSE) {
                                            if($qty>=300) {
                                              $qtyValue = str_replace(',','',number_format($qty / 300,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.05;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '10"') !== FALSE) {
                                            if($qty>=108) {
                                              $qtyValue = str_replace(',','',number_format($qty / 108,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.15;
                                            } else {
                                              $qtyValue = str_replace(',','',number_format($qty,3));
                                              $unit = 'PC';
                                            }
                                          } elseif (strpos($value["material_name"], '13"') !== FALSE) {
                                            if($qty>=63) {
                                              $qtyValue = str_replace(',','',number_format($qty / 63,3));
                                              $unit = 'SHEET';
                                              $partialCost = 16 * 0.25;
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
                                      $cost = $partialCost;
                                      $amount = number_format($cost * $qtyValue,2);
                                      $totalAmountMat += ($cost * $qtyValue);
                                      // var_dump($value['product_variant_id'].'='.$value['material_name'].'='.$value['jp'].'<br>');

                                      // var_dump($materialArray);
                                      //var_dump($tempMaterialArray);
                                      ?>
                                    <tr>
                                      <td class="tbl-pad"><?php echo $value["material_name"]; ?></td>
                                      <td class="tbl-pad text-right"><?php echo number_format($cost,2); ?></td>
                                      <td class="tbl-pad text-right"><div style="width:90%"><?php echo $amount; ?></div></td>
                                      <td class="tbl-pad text-right"><div style="width:90%"><?php echo $qtyValue.' '.$unit; ?></div></td>
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
                      }
                  // }
              // }
            // }
              // echo '<tr><td class="tbl-pad" colspan="5">** Total Color Composition **</td></tr>';
              // echo '<tr><td class="tbl-pad" colspan="2"></td>
              //       <td class="tbl-pad text-right"><div style="width:90%">'.number_format($totalColor,2).'</div></td></tr>';
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
