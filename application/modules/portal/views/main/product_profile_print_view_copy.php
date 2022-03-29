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
        <h2 class="page-header">
           <!-- <i class="fa fa-globe"></i>--> <?php echo SITE_NAME;?> 
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
        
        <div class="row invoice-info">
            <div class="col-md-6">
                <center><img style="width:25%;" src="<?php echo base_url("uploads/product_variants/").$product_variants->cover_image;?>" class="image"></center>
            </div>
            <div class="col-md-6">
                <table class="table" id="listing">
                    <tr><td>Class: </td><td><?php echo $product_variants->class;?></td></tr>
                    <tr><td>Stock #: </td><td><?php echo $product_variants->code. "-".$product_variants->color_abb;?></td></tr>
                    <tr><td>Desc: </td><td><?php echo $product_variants->description;?></td></tr>
                    <tr><td>Color: </td><td><?php echo $product_variants->color;?></td></tr>
                    <tr><td>Target Wgt.: </td><td><?php echo $net_weight;?></td></tr>
                </table>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-md-12">
                <table id="material_list_tbl" class="table" style='width:100%;'>
                <?php 
                    if($material_groups!=null)
                    {
                        //echo "<pre>";
                        //var_dump($material_groups);
                        foreach($material_groups as $material){
                            ?>
                            <tr>
                                <td><h4><?php echo $material["material_group_name"];?><span class="pull-right"></span></h4>
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
                                            
                                                if($material[0] != null)
                                                {
                                                    foreach($material[0] as $material_items)
                                                    {
                                                        ?>
                                                        <tr>
                                                        <td><?php echo $material_items["material_name"]?></td>
                                                        <td><?php echo $material_items["jp"]?></td>
                                                        <td><?php echo $material_items["qty"]?></td>
                                                        <td><?php echo $material_items["unit"]?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
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