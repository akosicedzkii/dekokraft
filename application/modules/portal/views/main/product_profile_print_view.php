<!DOCTYPE html>
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

<style type="text/css">
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
        font-size:13px;
    }

}

</style>
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
    }
  }
  .tbl-pad{
    padding:1px !important;
  }
  .bb{
    border-bottom: 1px solid black !important;
  }
  .m-b{
    margin-bottom:0px;
  }
</style>
<body onload="window.print();" style="font-size: 13px;line-height: 1;">

<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <p class="m-b">Date: <?php echo date("Y.m.d"); ?></p>
        <h4 class="text-center text-uppercase m-b" style="margin-top:0px;letter-spacing: 3px;"><b><?php echo SITE_NAME;?></b></h4>
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
        <br><br>
        <div class="row">
          <div class="col-sm-12 table-responsive">
            <p class="m-b">MATERIAL REQUIREMENT SUMMARY :</p>
            <table class="table table-striped table-condensed" style="font-size:12px;border-bottom: 1px solid black;margin-bottom:10px">
              <thead>
                <tr>
                  <th class="tbl-pad bb"></th>
                  <th class="tbl-pad bb">Item Name</th>
                  <th class="tbl-pad bb">JP</th>
                  <th class="tbl-pad bb text-right">Qty.</th>
                  <th class="tbl-pad bb">Unit</th>
                  <th class="tbl-pad bb text-right">U. Cost</th>
                  <th class="tbl-pad bb text-right">Total Cost</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total_r=0;
                $total_m=0;
                $total_f=0;
                $total_ap=0;
                  if ($material_groups!=null) {
                      $counts=0;
                      foreach ($material_groups as $material_items) {
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
                                <td class="tbl-pad text-center"><?php echo $counts; ?>.</td>
                                <td class="tbl-pad"><?php echo $material_items['material_name']; ?></td>
                                <td class="tbl-pad"><?php echo $material_items['jp']; ?></td>
                                <td class="tbl-pad text-right"><?php echo $material_items['qty']; ?></td>
                                <td class="tbl-pad"><?php echo $material_items['unit']; ?></td>
                                <td class="tbl-pad text-right"><?php echo $material_items['cost']; ?></td>
                                <td class="tbl-pad text-right"><?php echo number_format(floatval($material_items['qty'])*floatval($material_items['cost']), 2); ?></td>
                              </tr>
                  <?php
                              //}
                          //}
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
                  <th class="tbl-pad">MATERIAL COST (A)</th>
                  <th class="tbl-pad">-JP-</th>
                  <th class="tbl-pad"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tbl-pad">Resin Materials</td>
                  <td class="tbl-pad">( R )</td>
                  <td class="tbl-pad text-right">P <?php echo number_format($total_r, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">Silicon Rubber Mold</td>
                  <td class="tbl-pad">( M )</td>
                  <td class="tbl-pad text-right">P <?php echo number_format($total_m, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">Finishing Materials</td>
                  <td class="tbl-pad">( F )</td>
                  <td class="tbl-pad text-right">P <?php echo number_format($total_f, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">Artist Painting Material</td>
                  <td class="tbl-pad">( AP )</td>
                  <td class="tbl-pad text-right">P <?php echo number_format($total_ap, 2); ?></td>
                </tr>
                <tr>
                  <td colspan="2" class="tbl-pad">*** TOTAL MATERIALS COST ***</td>
                  <td class="tbl-pad text-right">P <?php echo number_format($total_r+$total_m+$total_f+$total_ap, 2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <p class="m-b">PROCESS ROUTE SUMMARY :</p>
            <table class="table">
              <thead>
                <tr>
                  <th class="tbl-pad"></th>
                  <th class="tbl-pad">Job Process</th>
                  <th class="tbl-pad">JP</th>
                  <th class="tbl-pad">Min.</th>
                  <th class="tbl-pad">Sec.</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <table class="table" style="margin-bottom:10px">
              <thead>
                <tr>
                  <th class="tbl-pad">LABOR COST :</th>
                  <th class="tbl-pad">-JP-</th>
                  <th class="tbl-pad">MIN.</th>
                  <th class="tbl-pad">SEC.</th>
                  <th class="tbl-pad text-right">DELIVERED(B)</th>
                  <th class="tbl-pad text-right">PROVIDED(C)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tbl-pad">Resin Cast</td>
                  <td class="tbl-pad">( RA )</td>
                  <td class="tbl-pad">0'</td>
                  <td class="tbl-pad">0"</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P <?php echo $resin_cast=number_format(($prod_profile->provided_resin_cast=='')?0:$prod_profile->provided_resin_cast, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">Resin Clean</td>
                  <td class="tbl-pad">( RL )</td>
                  <td class="tbl-pad">0'</td>
                  <td class="tbl-pad">0"</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P <?php echo $resin_clean=number_format(($prod_profile->provided_resin_clean=='')?0:$prod_profile->provided_resin_clean, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">Finishing</td>
                  <td class="tbl-pad">( F )</td>
                  <td class="tbl-pad">0'</td>
                  <td class="tbl-pad">0"</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P <?php echo $finisheng=number_format(($prod_profile->provided_finishing=='')?0:$prod_profile->provided_finishing, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">Artist Painting</td>
                  <td class="tbl-pad">( AP )</td>
                  <td class="tbl-pad">0'</td>
                  <td class="tbl-pad">0"</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                </tr>
                <tr>
                  <td colspan="4" class="tbl-pad">*** TOTAL LABOR COST ***</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P <?php echo number_format(str_replace(',', '', $resin_cast)+str_replace(',', '', $resin_clean)+str_replace(',', '', $finisheng), 2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- <hr style="border-top: 1px dashed black;margin:1px 0 5px 0;">
        <div class="row">
          <div class="col-xs-12">
            <p class="m-b">L.C. PESO COSTING:</p>
            <div class="container">
              <p class="m-b">Selling L.C = P <?php echo number_format(($prod_profile->selling_lc=='')?0:$prod_profile->selling_lc, 2); ?></p>
              <p>Sub-con L.C = P <?php echo number_format(($prod_profile->subcon_lc=='')?0:$prod_profile->subcon_lc, 2); ?></p>
            </div>
            <div class="row col-xs-6">
              <dl class="">
                <dt class="col-xs-3" style="padding-left: 0px;padding-right: 0px;">Derived Price</dt>
                <dd class="col-xs-9" style="padding-left: 0px;">(A) US$ <?php echo number_format(($prod_profile->derived_price_a=='')?0:$prod_profile->derived_price_a, 2); ?></dd>
                <dt class="col-xs-3" style="padding-left: 0px;padding-right: 0px;"></dt>
                <dd class="col-xs-9 offset-xs-3" style="padding-left: 0px;">(B) US$ <?php echo number_format(($prod_profile->derived_price_b=='')?0:$prod_profile->derived_price_b, 2); ?></dd>
                <dt class="col-xs-3" style="padding-left: 0px;padding-right: 0px;">Quoted Price</dt>
              </dl>
            </div>
            <div class="col-xs-6">
              <p>PESO/US$ Conversion = <?php echo number_format(($prod_profile->peso_conversion=='')?0:$prod_profile->peso_conversion, 2); ?></p>
            </div>
          </div>

        </div> -->
        <hr style="border-top: 1px dashed black;margin:5px 0 1px 0;">
        <div class="row">
          <div class="col-sm-12">
            <table class="table">
              <thead>
                <tr>
                  <th class="tbl-pad">SUBCON JOB COST :</th>
                  <th class="tbl-pad text-right">DERIVED(A+B)</th>
                  <th class="tbl-pad text-right">DERIVED(A+C)</th>
                  <th class="tbl-pad text-right">PROVIDED</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tbl-pad">1. Resin -Subcon Mat'l, Mold & Labor</td>
                  <td class="tbl-pad text-right">P <?php echo $resin_sub_mat=number_format($total_r+$total_m, 2); ?></td>
                  <td class="tbl-pad text-right">P <?php echo $resin_derived_ac=number_format(str_replace(',', '', $resin_sub_mat)+str_replace(',', '', $resin_cast)+str_replace(',', '', $resin_clean), 2); ?></td>
                  <td class="tbl-pad text-right">P <?php echo number_format(($prod_profile->provided_resin_mat=='')?0:$prod_profile->provided_resin_mat, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">2. Resin -Subcon Labor, Dekokraft Matl</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P <?php echo number_format(str_replace(',', '', $resin_cast)+str_replace(',', '', $resin_clean), 2); ?></td>
                  <td class="tbl-pad text-right">P <?php echo number_format(($prod_profile->provided_resin_lab=='')?0:$prod_profile->provided_resin_lab, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">3. Fin. -Subcon Materials & Labor</td>
                  <td class="tbl-pad text-right">P <?php echo number_format($total_f, 2); ?></td>
                  <td class="tbl-pad text-right">P <?php echo $finishing_ac=number_format($total_f+str_replace(',', '', $finisheng), 2); ?></td>
                  <td class="tbl-pad text-right">P <?php echo number_format(($prod_profile->provided_finishing_mat=='')?0:$prod_profile->provided_finishing_mat, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">4. Fin. -Subcon Labor, Dekokraft Matl</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P <?php echo number_format(str_replace(',', '', $finisheng), 2); ?></td>
                  <td class="tbl-pad text-right">P <?php echo number_format(($prod_profile->provided_finishing_lab=='')?0:$prod_profile->provided_finishing_lab, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">5. Artist -Subcon Materials & Labor</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P <?php echo number_format(($prod_profile->provided_artist_mat=='')?0:$prod_profile->provided_artist_mat, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">6. Artist -Subcon Labor, Dekokraft Matl</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P 0.00</td>
                  <td class="tbl-pad text-right">P <?php echo number_format(($prod_profile->provided_artist_lab=='')?0:$prod_profile->provided_artist_lab, 2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">7. Trading</td>
                  <td class="tbl-pad text-right">P <?php echo number_format(str_replace(',', '', $resin_sub_mat)+$total_f, 2); ?></td>
                  <td class="tbl-pad text-right">P <?php echo number_format(str_replace(',', '', $finishing_ac)+str_replace(',', '', $resin_derived_ac), 2); ?></td>
                  <td class="tbl-pad text-right">P <?php echo number_format(($prod_profile->provided_trading=='')?0:$prod_profile->provided_trading, 2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <hr style="border-top: 1px dashed black;margin:1px 0 5px 0;">
        <div class="row">
          <div class="col-sm-12">
            <p>IN-HOUSE WORK IN PROCESS :</p>
            <table class="table">
              <thead>
                <tr>
                  <th class="tbl-pad">PROCESS CODE</th>
                  <th class="tbl-pad">JOB DESCRIPTION</th>
                  <th class="tbl-pad">RATE PESO</th>
                  <th class="tbl-pad">B.C. QTY.</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <hr style="border-top: 1px dashed black;margin:1px 0 5px 0;">
        <div class="row">
          <div class="col-sm-12">

            <table class="table">
              <thead>
                <tr>
                  <th class="tbl-pad">CBM [Standard Pack]</th>
                  <th class="tbl-pad">Lb x Flute x Joint x L x W x H</th>
                  <th class="tbl-pad text-right">CONTENT</th>
                  <th class="tbl-pad text-right">UNIT COST</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tbl-pad">Inner Box = </td>
                  <td class="tbl-pad"><?php echo $product_variants->inner_carton; ?></td>
                  <td class="tbl-pad text-right"><?php echo ($product_variants->in_=='')?'0':$product_variants->in_; ?> pcs.</td>
                  <td class="tbl-pad text-right">P <?php echo number_format(floatval($prod_profile->in_box_cost),2); ?></td>
                </tr>
                <tr>
                  <?php
                    $res_mstr=0;
                    $mstr_data=trim(strtolower($product_variants->master_carton));
                    $slice_mstr=explode('x',$mstr_data);
                    if(count($slice_mstr)>0){
                      foreach ($slice_mstr as $value) {
                        $res_mstr=($res_mstr<1)?$res_mstr+floatval(trim($value)):$res_mstr*floatval(trim($value));
                      }
                      $res_mstr=$res_mstr/61023;
                    }

                   ?>
                  <td class="tbl-pad">Master Box = <?php echo number_format($res_mstr,4); ?> </td>
                  <td class="tbl-pad"><?php echo $product_variants->master_carton; ?></td>
                  <td class="tbl-pad text-right"><?php echo ($product_variants->mstr=='')?'0':$product_variants->mstr; ?> pcs.</td>
                  <td class="tbl-pad text-right">P <?php echo number_format(floatval($prod_profile->mstr_box_cost),2); ?></td>
                </tr>
              </tbody>
              <thead>
                <tr>
                  <th class="tbl-pad">[Standard Pack]</th>
                  <th class="tbl-pad">L x W x T</th>
                  <th class="tbl-pad"></th>
                  <th class="tbl-pad"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tbl-pad">Inner Polybag</td>
                  <td class="tbl-pad"><?php echo $prod_profile->in_poly_size; ?><!--BUBBLE BAG 00 X 00--></td>
                  <td class="tbl-pad text-right"><?php echo $prod_profile->in_poly_cont; ?> pcs.</td>
                  <td class="tbl-pad text-right">P <?php echo number_format(floatval($prod_profile->in_poly_cost),2); ?></td>
                </tr>
                <tr>
                  <td class="tbl-pad">Master Polybag</td>
                  <td class="tbl-pad"><?php echo $prod_profile->mstr_poly_size; ?></td>
                  <td class="tbl-pad text-right"><?php echo $prod_profile->mstr_poly_cont; ?> pcs.</td>
                  <td class="tbl-pad text-right">P <?php echo number_format(floatval($prod_profile->mstr_poly_cost),2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <hr style="border-top: 1px dashed black;margin:1px 0 5px 0;">
        <div class="row">
          <div class="col-xs-3">
            <p>Prepared by :</p>
            <p>__________________________</p>
            <p>Date: ____________________</p>
          </div>
          <div class="col-xs-3">
            <p>Approved by :</p>
            <p>__________________________</p>
            <p>Date: ____________________</p>
          </div>
          <div class="col-xs-3">
            <p>Computer Entry by :</p>
            <p>__________________________</p>
            <p>Date: ____________________</p>
          </div>
          <div class="col-xs-3">
            <p>Computer Checked by :</p>
            <p>__________________________</p>
            <p>Date: ____________________</p>
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
