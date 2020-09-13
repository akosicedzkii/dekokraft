<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo "Product:#".$product_variants->description;?></title>
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

<style>
.avoidBreak {
    border: 2px solid;
    page-break-inside:avoid;
}
@media only print {
   .wrapper {
     width: auto;
     height: auto;
     overflow: visible;
   }

    body
    {
        font-size:10px;
    }
}

</style>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <p style="margin-bottom:0px;">Date:</p>
        <h4 class="text-center text-uppercase" style="margin-bottom:0px;margin-top:0px;letter-spacing: 3px;"><b><?php echo SITE_NAME;?></b></h4>
        <h4 class="text-center" style="margin-top:0px;">PRODUCT PROFILE</h4>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->

        <div class="row invoice-info">
            <div class="col-xs-6">
                <center><img style="width:25%;" src="<?php echo base_url("uploads/product_variants/").$product_variants->cover_image;?>" class="image"></center>
            </div>
            <div class="col-xs-6">
              <dl class="row">
                  <dt class="col-xs-1">Class:</dt>
                  <dd class="col-xs-11"><?php echo $product_variants->class;?></dd>
                  <dt class="col-xs-1">Stock#</dt>
                  <dd class="col-xs-11"><?php echo $product_variants->code. "-".$product_variants->color_abb;?></dd>
                  <dt class="col-xs-1">Desc.:</dt>
                  <dd class="col-xs-11"><?php echo $product_variants->description;?></dd>
                  <dt class="col-xs-1">Color:</dt>
                  <dd class="col-xs-11"><?php echo $product_variants->color;?></dd>
                  <dd class="col-xs-12"><b>Target Wgt (gms)</b> <?php echo $net_weight;?></dd>
                  <!-- <dd class="col-xs-8">30-40<?php echo $product_variants->class;?></dd> -->
              </dl>
                <!-- <table class="table" id="listing">
                    <tr><td>Class: </td><td><?php echo $product_variants->class;?></td></tr>
                    <tr><td>Stock #: </td><td><?php echo $product_variants->code. "-".$product_variants->color_abb;?></td></tr>
                    <tr><td>Desc: </td><td><?php echo $product_variants->description;?></td></tr>
                    <tr><td>Color: </td><td><?php echo $product_variants->color;?></td></tr>
                    <tr><td>Target Wgt.: </td><td><?php echo $net_weight;?></td></tr>
                </table> -->
            </div>
        </div>
        <div class="row">
          <div class="col-sm-12 table-responsive">
            <p>MATERIAL REQUIREMENT SUMMARY :</p>
            <table class="table">
              <thead>
                <tr>
                  <th></th>
                  <th>Item Name</th>
                  <th>JP</th>
                  <th>Qty.</th>
                  <th>Unit</th>
                  <th>U. Cost</th>
                  <th>Total Cost</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total_r=0;
                $total_m=0;
                $total_f=0;
                $total_ap=0;
                  if ($material_groups!=null) {
                      foreach ($material_groups as $material) {
                          if ($material[0] != null) {
                              $counts=0;
                              foreach ($material[0] as $material_items) {
                                  switch ($material_items['jp']) {
                                  case 'R':
                                    $total_r=$total_r+floatval($material_items['qty'])*floatval($material_items['cost']);
                                    break;

                                  case 'M':
                                    $total_m=$total_m+floatval($material_items['qty'])*floatval($material_items['cost']);
                                    break;

                                  case ('F' || 'FA' || 'FB' || 'FC'):
                                    $total_f=$total_f+floatval($material_items['qty'])*floatval($material_items['cost']);
                                    break;

                                  case 'AP':
                                    $total_ap=$total_ap+floatval($material_items['qty'])*floatval($material_items['cost']);
                                    break;

                                  default:
                                    // code...
                                    break;
                                }
                                  $counts++; ?>
                              <tr>
                                <td><?php echo $counts; ?></td>
                                <td><?php echo $material_items['material_name']; ?></td>
                                <td><?php echo $material_items['jp']; ?></td>
                                <td><?php echo $material_items['qty']; ?></td>
                                <td><?php echo $material_items['unit']; ?></td>
                                <td><?php echo $material_items['cost']; ?></td>
                                <td><?php echo number_format(floatval($material_items['qty'])*floatval($material_items['cost']), 2); ?></td>
                              </tr>
                  <?php
                              }
                          }
                      }
                  } ?>
              </tbody>
            </table>
          </div>

        </div>
        <div class="row">
          <div class="col-xs-12">
            <table class="table">
              <thead>
                <tr>
                  <th>MATERIAL COST (A)</th>
                  <th>-JP-</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Resin Materials</td>
                  <td>( R )</td>
                  <td>P <?php echo number_format($total_r, 2); ?></td>
                </tr>
                <tr>
                  <td>Silicon Rubber Mold</td>
                  <td>( M )</td>
                  <td>P <?php echo number_format($total_m, 2); ?></td>
                </tr>
                <tr>
                  <td>Finishing Materials</td>
                  <td>( F )</td>
                  <td>P <?php echo number_format($total_f, 2); ?></td>
                </tr>
                <tr>
                  <td>Artist Painting Material</td>
                  <td>( AP )</td>
                  <td>P <?php echo number_format($total_ap, 2); ?></td>
                </tr>
                <tr>
                  <td colspan="2">*** TOTAL MATERIALS COST ***</td>
                  <td>P <?php echo number_format($total_r+$total_m+$total_f+$total_ap, 2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <p style="margin-bottom:0px;">PROCESS ROUTE SUMMARY :</p>
            <table class="table">
              <thead>
                <tr>
                  <th></th>
                  <th>Job Process</th>
                  <th>JP</th>
                  <th>Min.</th>
                  <th>Sec.</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <table class="table">
              <thead>
                <tr>
                  <th>LABOR COST :</th>
                  <th>-JP-</th>
                  <th>MIN.</th>
                  <th>SEC.</th>
                  <th>DELIVERED(B)</th>
                  <th>PROVIDED(C)</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4">*** TOTAL LABOR COST ***</td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <p style="margin-bottom:0px;">L.C. PESO COSTING:</p>
            <div class="container">
              <p style="margin-bottom:0px;">Selling L.C = </p>
              <p>Sub-con L.C = </p>
            </div>
            <div class="row col-xs-6">
              <dl class="">
                <dt class="col-xs-3" style="padding-left: 0px;padding-right: 0px;">Derived Price</dt>
                <dd class="col-xs-9" style="padding-left: 0px;">(A)</dd>
                <dt class="col-xs-3" style="padding-left: 0px;padding-right: 0px;"></dt>
                <dd class="col-xs-9 offset-xs-3" style="padding-left: 0px;">(B)</dd>
                <dt class="col-xs-3" style="padding-left: 0px;padding-right: 0px;">Quoted Price</dt>
              </dl>
            </div>
            <div class="col-xs-6">
              <p>PESO/US$ Conversion = </p>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-sm-12">
            <table class="table">
              <thead>
                <tr>
                  <th>SUBCON JOB COST :</th>
                  <th>DERIVED(A+B)</th>
                  <th>DERIVED(A+C)</th>
                  <th>PROVIDED</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <p>IN-HOUSE WORK IN PROCESS :</p>
            <table class="table">
              <thead>
                <tr>
                  <th>PROCESS CODE</th>
                  <th>JOB DESCRIPTION</th>
                  <th>RATE PESO</th>
                  <th>B.C. QTY.</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <p>IN-HOUSE WORK IN PROCESS :</p>
            <table class="table">
              <thead>
                <tr>
                  <th>CBM [Standard Pack]</th>
                  <th>Lb x Flute x Joint x L x W x H</th>
                  <th>CONTENT</th>
                  <th>UNIT COST</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
            <table class="table">
              <thead>
                <tr>
                  <th>[Standard Pack]</th>
                  <th>L x W x T</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-3">
            <p>Prepared by :</p>
            <p>______________________________</p>
            <p>Date: ________________________</p>
          </div>
          <div class="col-xs-3">
            <p>Approved by :</p>
            <p>______________________________</p>
            <p>Date: ________________________</p>
          </div>
          <div class="col-xs-3">
            <p>Computer Entry by :</p>
            <p>______________________________</p>
            <p>Date: ________________________</p>
          </div>
          <div class="col-xs-3">
            <p>Computer Checked by :</p>
            <p>______________________________</p>
            <p>Date: ________________________</p>
          </div>
        </div>
        <div class="row invoice-info">
            <div class="col-md-12">
                <table id="material_list_tbl" class="table" style='width:100%;'>
                <?php
                    if ($material_groups!=null) {
                        //echo "<pre>";
                        //var_dump($material_groups);
                        foreach ($material_groups as $material) {
                            ?>
                            <tr>
                                <td><h4><?php echo $material["material_group_name"]; ?><span class="pull-right"></span></h4>
                                <table  class="table" style='width:100%;'>
                                        <thead>
                                            <tr>
                                            <th style="width:55%;">Material</th>
                                            <th style="width:15%;">JP</th>
                                            <th style="width:15%;">QTY</th>
                                            <th style="width:15%;">Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_materialss">
                                            <?php

                                                if ($material[0] != null) {
                                                    foreach ($material[0] as $material_items) {
                                                        ?>
                                                        <tr>
                                                        <td><?php echo $material_items["material_name"]?></td>
                                                        <td><?php echo $material_items["jp"]?></td>
                                                        <td><?php echo $material_items["qty"]?></td>
                                                        <td><?php echo $material_items["unit"]?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } ?>
                                        </tbody>
                                </table>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                ?>
                </table>
            </div>
        </div>
        <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<script>

$(".table td, .table th").each(function(){ $(this).css("width",  $(this).width() + "px")  });
$(".table tr").wrap("<div class='avoidBreak'></div>");
//window.print();

</script>

</body></html>
