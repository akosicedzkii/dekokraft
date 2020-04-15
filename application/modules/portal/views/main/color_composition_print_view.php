<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $colors->name;?> - <?php echo $colors->code;?></title>
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
            <div class="col-md-12">
                <center><h3><?php echo "Color Composition for: <b>".$colors->name;?> - <?php echo $colors->code;?></b></h3></center>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-md-12">
            <table  class="table" style='width:100%;'>
                <thead>
                    <tr>
                    <th style="width:30%;">Material</th>
                    <th style="width:15%;">JP</th>
                    <th style="width:15%;">UNIT COST</th>
                    <th style="width:15%;">QTY</th>
                    <th style="width:15%;">Unit</th>
                    </tr>
                </thead>
                <tbody id="tbody_materialss">
                    <?php
                        $total_unit = 0;
                        if($color_materials != null)
                        {
                            foreach($color_materials as $material_items)
                            {
                                ?>
                                <tr>
                                <td><?php echo $material_items["material_name"]?></td>
                                <td><?php echo $material_items["jp"]?></td>
                                <td><?php echo number_format($material_items["cost"], 2, '.', '');?></td>
                                <td><?php echo $material_items["qty"]?></td>
                                <td><?php echo $material_items["unit"];$total_unit=$total_unit+$material_items["qty"];?></td>
                                </tr>
                                <?php
                            }
                        }
                    ?><tfoot>
                    <tr>
                    <th style="width:30%;"></th>
                    <th style="width:15%;"></th>
                    <th style="width:15%;"></th>
                    <th style="width:15%;"><?php echo $total_unit;?></th>
                    <th style="width:15%;"></th>
                    </tr>
                </tfoot>
                </tbody>
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