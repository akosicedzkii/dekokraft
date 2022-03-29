<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Product List</title>
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

<script src="<?php echo base_url("assets/print/jquery.min.js");?>"></script>
<script src="<?php echo base_url("assets/print/jquery-printme.js");?>"></script>
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
}
</style>
<body onload="//window.print();">
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
        
        <div class="col-sm-4 invoice-col">
        <address>
            <strong><?php //echo SITE_NAME;?></strong><br>
        </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped" style="font-size:10px;">
        <thead>
                <tr>
                <th>LOCATION</th>
                <th>DESCRIPTION</th>
                <th>CLASS</th>
                <th>CODE</th>
                <th>COLOR ABBR.</th>
                <th>COLOR</th>
                <th>IMAGE</th>
                </tr>
                </thead>
          <tbody>
          <?php 
            $total_price = 0;
            $total_discounted = 0;
          ?>
          <?php foreach($product_variants as $line){
             
            ?>
          <tr>
            <td><?php echo  $line->location;?></td>
            <td><?php echo  $line->description?></td>
            <td><?php echo  $line->class;?></td>
            <td><?php echo  $line->code;?></td>
            <td><?php echo  $line->color_abb;?></td>
            <td><?php echo  $line->color;?></td>
            <td><?php if($line->cover_image == null){ echo "No Image"; }else{ echo  "<img style='height:60px;' src='".base_url("uploads/product_variants/".$line->cover_image)."'>"; } ?></td>
          </tr>
          <?php }?>
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


</body>

<script>

$(".table td, .table th").each(function(){ $(this).css("width",  $(this).width() + "px")  });
$(".table tr").wrap("<div class='avoidBreak'></div>");
//window.print();
$("body").printMe({
    path:"<?php echo base_url();?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css"
});

</script>
</html>