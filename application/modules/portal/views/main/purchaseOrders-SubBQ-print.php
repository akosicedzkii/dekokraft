<!DOCTYPE html>
<html><head>
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
                <p class="m-b">CLIENT: <?php echo $detail[0]->company_name; ?> </p>
                <p>Inv # <?php echo $detail[0]->invoice_id; ?>  MO# <?php echo $detail[0]->mo_id; ?> Date: <?php echo date("y.m.d"); ?></p>
         </center>

            <div class="row">
                <center><h4 style="letter-spacing: 3px;">*** PURCHASE ORDER SUB-BQ ( BILL OF QUANTITY ) ***</h4></center>
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
              <tr>
                <th class="bb text-center">Item Name</th>
                <th class="bb text-center">Issuance Quantity</th>
                <th class="bb text-center">Issued</th>
              </tr>
            </tr>
          </thead>
          <tbody>
            <?php
              $materialArray = array();
              $tempMaterialArray = array();
              foreach ($materials as $material) {
                $qty=0;
                foreach ($material as $value) {
                  $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                  $po_count = $value["po_count"]==''? 0:str_replace(',','',$value["po_count"]);
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
                  $qty *= $po_count;
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
                                            'convert_unit'=>$value['conversion_unit'],
                                            'convert_type'=>$value['conversion_type'],
                                            'convert_value'=>$value['conversion_value']
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
                  $po_count = $value["po_count"]==''? 0:str_replace(',','',$value["po_count"]);
                  $totalQty = 1 * $fixQ * $po_count;
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
                                            'convert_unit'=>$thisMaterial['conversion_unit'],
                                          'convert_type'=>$thisMaterial['conversion_type'],
                                          'convert_value'=>$thisMaterial['conversion_value']
                                            // 'cost'=>$totalCost
                                            );
                        array_push($tempMaterialArray,$thisArray);
                    }
                  }
                }
              }

              asort($tempMaterialArray);
              //$job_typ=$job_orders->job_type=='resin'?array('M','R'):array('FA','FB','FC');
              switch ($detail[0]->job_type) {
                case 'resin':
                  $job_typ = array('M','R');
                  $colJobType = array();
                  break;
                case 'finishing':
                  $job_typ = array('FA','FB','FC');
                  $colJobType = array('FA','FB');
                  break;
                case 'hand paint':
                  $job_typ = array('FA');
                  $colJobType = array('FA');
                  break;
                case 'spray':
                  $job_typ = array('FA');
                  $colJobType = array('FA');
                  break;
                default:
                  $job_typ = array();
                  $colJobType = array();
                  break;
              }

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
                                  // $converted = $detail[0]->job_type=='resin'?resinConvert($value["unit"], $value["material_name"], $qty):convertMe($value["unit"], $value["material_name"], $qty);
                                  // $qtyValue = $converted['qtyValue'];
                                  // $unit = $converted['unit'];
                                  if($qty>=$value["convert_value"] && $value["convert_value"]!=0 && $value["convert_value"]!=""){
                                    $qtyValue = str_replace(',','',number_format($qty / $value["convert_value"],3));
                                    $unit = $value["convert_unit"];
                                  } else {
                                    $qtyValue = str_replace(',','',number_format($qty,3));
                                    $unit = $value["unit"];
                                  }
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

              for ($i=0; $i < count($colJobType); $i++) {
                  $x=0;
                  //foreach ($materials as $material) {
                      foreach ($tempMaterialArray as $value) {
                          //if ($line->product_id==$value["product_variant_id"]) {
                          if ($value["tipe"] == "color") {
                              if ($colJobType[$i]==$value["jp"]) {
                                  if ($x==0) { ?>
                                  <tr>
                                    <td class="tbl-pad" colspan="3">** Job Process: <?php echo $colJobType[$i]; ?></td>
                                  </tr>
                              <?php $x++; }
                                  // var_dump($value['product_variant_id'].'='.$value['material_name'].'='.$value['jp'].'<br>');
                                  $value["qty"] = $materialArray[$value["material_name"]];
                                  $qty = $value["qty"]==''? 0:str_replace(',','',$value["qty"]);
                                  // $converted = $detail[0]->job_type=='resin'?resinConvert($value["unit"], $value["material_name"], $qty):convertMe($value["unit"], $value["material_name"], $qty);
                                  // $qtyValue = $converted['qtyValue'];
                                  // $unit = $converted['unit'];
                                  if($qty>=$value["convert_value"] && $value["convert_value"]!=0 && $value["convert_value"]!=""){
                                    $qtyValue = str_replace(',','',number_format($qty / $value["convert_value"],3));
                                    $unit = $value["convert_unit"];
                                  } else {
                                    $qtyValue = str_replace(',','',number_format($qty,3));
                                    $unit = $value["unit"];
                                  }
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
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

</body></html>
