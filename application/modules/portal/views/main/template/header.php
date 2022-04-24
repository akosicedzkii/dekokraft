
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="<?php echo base_url()."uploads/site_icon/".SITE_ICON;?>" /> 
  <title><?php echo SITE_NAME;?> | <?php echo ucwords(str_replace("_"," ",$module_name));?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/clockpicker-gh-pages/dist/bootstrap-clockpicker.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/sortable.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?php echo base_url();?>assets/malsup/jquery.form.js"></script> 
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url();?>assets/clockpicker-gh-pages/dist/bootstrap-clockpicker.js"></script>
<!--<script src="<?php echo base_url();?>assets/bower_components/PACE/pace.min.js"></script> FastClick -->
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>assets/dist/js/pages/dashboard2.js"></script>

<script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>

<!-- <link href="<?php echo base_url();?>assets/select2/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url();?>assets/select2/select2.min.js"></script> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="<?php echo base_url();?>assets/toastr/toastr.min.css" rel="stylesheet" />

<script src="<?php echo base_url();?>assets/toastr/toastr.min.js"></script>
<!--toastr  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/pace/pace.min.css">-->

<script src="<?php echo base_url();?>assets/validator/validator.js"></script>


<!--ckeditor-->
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>


<!--ckeditor-->
<script src="<?php echo base_url();?>assets/croppie.min.js"></script>
<link href="<?php echo base_url();?>assets/croppie.css" rel="stylesheet" />

<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
<script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script>
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-left",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  } 
</script>

<style>

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.btn-circle.btn-lg {
  width: 50px;
  height: 50px;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.33;
  border-radius: 25px;
}
.btn-circle.btn-xl {
  width: 70px;
  height: 70px;
  padding: 10px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
}

.fix-btn {
    position: fixed; /* Fixed/sticky position */
    bottom: 60px; /* Place the button at the bottom of the page */
    right: 30px; /* Place the button 30px from the right */
    z-index: 999;
}

.select2-container--default .select2-selection--single {
    height: 34px;
    border-radius: 0px;
}

#imgPreviewModal .modal-body{
  background-color:#ecf0f5;
}

@media only screen and (max-width: 700px) {
  #main-list{
    overflow-x: auto;
  }
}
</style>
<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}

.map-marker {
    /* adjusting for the marker dimensions
    so that it is centered on coordinates */
    margin-left: -8px;
    margin-top: -8px;
}
.map-marker.map-clickable {
    cursor: pointer;
}
.pulse {
    width: 10px;
    height: 10px;
    border: 5px solid #f7f14c;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
    background-color: #716f42;
    z-index: 10;
    position: absolute;
  }
.map-marker .dot {
    border: 10px solid #fff601;
    background: transparent;
    -webkit-border-radius: 60px;
    -moz-border-radius: 60px;
    border-radius: 60px;
    height: 50px;
    width: 50px;
    -webkit-animation: pulse 3s ease-out;
    -moz-animation: pulse 3s ease-out;
    animation: pulse 3s ease-out;
    -webkit-animation-iteration-count: infinite;
    -moz-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    position: absolute;
    top: -20px;
    left: -20px;
    z-index: 1;
    opacity: 0;
  }
  @-moz-keyframes pulse {
   0% {
      -moz-transform: scale(0);
      opacity: 0.0;
   }
   25% {
      -moz-transform: scale(0);
      opacity: 0.1;
   }
   50% {
      -moz-transform: scale(0.1);
      opacity: 0.3;
   }
   75% {
      -moz-transform: scale(0.5);
      opacity: 0.5;
   }
   100% {
      -moz-transform: scale(1);
      opacity: 0.0;
   }
  }
  @-webkit-keyframes "pulse" {
   0% {
      -webkit-transform: scale(0);
      opacity: 0.0;
   }
   25% {
      -webkit-transform: scale(0);
      opacity: 0.1;
   }
   50% {
      -webkit-transform: scale(0.1);
      opacity: 0.3;
   }
   75% {
      -webkit-transform: scale(0.5);
      opacity: 0.5;
   }
   100% {
      -webkit-transform: scale(1);
      opacity: 0.0;
   }
  }
  .modal { overflow: auto !important; }
</style>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?php echo base_url();?>assets/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?php echo base_url();?>assets/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url()."portal";?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php $val = explode(" ",SITE_NAME); foreach($val as $a){ echo $a[0];}?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo SITE_NAME;?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url("uploads/profile_image/").$this->session->userdata("USERIMG");?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata("FULLNM");?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url("uploads/profile_image/").$this->session->userdata("USERIMG");?>" class="img-circle" alt="User Image">
                <p>
                <?php echo $this->session->userdata("FULLNM");?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat" id="viewProfile">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()."portal/logout";?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <?php 
          if (in_array("dashboard", $menu) ) {
             ?>
               <li class="header">MAIN NAVIGATION</li>  
               <li <?php if($module_name == "dashboard"){echo 'class="active"';}?>><a href="<?php echo base_url("portal/main/dashboard"); ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
               <?php
          } 
        ?>
        <?php  if ( in_array("banners", $menu) ) {?>
        <li class="header">HOME</li> 
        <?php }?>
        
       
         <?php 
          if (in_array("products", $menu)) {
             ?>
              <li <?php if($module_name == "products"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/products"?>"><i class="glyphicon glyphicon-briefcase"></i><span>Product Category</span></a></li>
             <?php
          } 
        ?>
        <?php 
         if (in_array("product_variants", $menu)) {
            ?>
             <li <?php if($module_name == "product_variants"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/product_variants"?>"><i class="glyphicon glyphicon-th-list"></i><span>Product Variants</span></a></li>
            <?php
         } 
       ?>
       <?php 
         if (in_array("product_profiles", $menu)) {
            ?>
             <li <?php if($module_name == "product_profiles"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/product_profiles/list"?>"><i class="glyphicon glyphicon-th"></i><span>Product Profile</span></a></li>
            <?php
         } 
       ?>
        <?php 
          if (in_array("proto_molds", $menu)) {
             ?>
              <li <?php if($module_name == "proto_molds"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/proto_molds"?>"><i class="fa fa-list"></i><span>Proto and Molds</span></a></li>
             <?php
          } 
        ?>
        <?php 
         if (in_array("colors", $menu)) {
            ?>
             <li <?php if($module_name == "colors"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/colors"?>"><i class="glyphicon glyphicon-tint"></i><span>Colors</span></a></li>
            <?php
         } 
       ?>
      <?php 
          if (in_array("materials", $menu)) {
             ?>
              <li <?php if($module_name == "materials"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/materials"?>"><i class="fa fa-list"></i><span>Materials</span></a></li>
             <?php
          } 
        ?>

        <?php 
          if (in_array("invoices", $menu)) {
             ?>
              <li <?php if($module_name == "invoices"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/invoices/list"?>"><i class="fa fa-barcode"></i><span>Invoices</span></a></li>
             <?php
          } 
        ?>


    <?php 
          if (in_array("banks", $menu)) {
             ?>
              <li <?php if($module_name == "banks"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/banks"?>"><i class="fa fa-bank"></i><span>Banks</span></a></li>
             <?php
          } 
        ?>


    <?php 
          if (in_array("payment_terms", $menu)) {
             ?>
              <li <?php if($module_name == "payment_terms"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/payment_terms"?>"><i class="fa fa-money"></i><span>Payment Terms</span></a></li>
             <?php
          } 
        ?>
    <?php 
        if (in_array("customers", $menu)) {
            ?>
            <li <?php if($module_name == "customers"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/customers"?>"><i class="fa fa-group"></i><span>Customers</span></a></li>
            <?php
        } 
    ?>

<?php 
          if (in_array("subcon", $menu)) {
             ?>
              <li <?php if($module_name == "subcon"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/subcon"?>"><i class="fa fa-bank"></i><span>Subcon</span></a></li>
             <?php
          } 
        ?>
        <?php 
          if (in_array("marketing_order", $menu)) {
             ?>
              <li <?php if($module_name == "marketing_order"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/marketing_order"?>"><i class="fa fa-bank"></i><span>Marketing Order</span></a></li>
             <?php
          } 
        ?>
         <?php 
          if (in_array("purchase_orders", $menu)) {
             ?>
              <li <?php if($module_name == "purchase_orders"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/purchase_orders"?>"><i class="fa fa-bank"></i><span>Purchase Order</span></a></li>
             <?php
          } 
        ?> 
         <?php 
          if (in_array("job_orders", $menu)) {
             ?>
              <li <?php if($module_name == "job_orders"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/job_orders"?>"><i class="fa fa-bank"></i><span>Job Order</span></a></li>
             <?php
          } 
        ?>
        <?php 
          if ( in_array("roles", $menu) ||  in_array("users", $menu) ||  in_array("site_settings", $menu) ||  in_array("logs", $menu) ) {
             ?>
              <li class="header">SYSTEM ADMINISTRATOR</li> 
              <li class="<?php if($module_name == "roles" || $module_name == "users" || $module_name == "site_settings" || $module_name == "logs"){echo 'active ';}?>treeview">
                <a href="#">
                  <i class="fa fa-gear"></i> <span>System Administrator</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <?php 
                    if (in_array("roles", $menu)) {
                     ?>
                        <li <?php if($module_name == "roles"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/roles"?>"><i class="fa fa-user"></i> Roles</a></li>
                     <?php
                     } 
                  ?>
                  <?php 
                    if (in_array("users", $menu)) {
                     ?>
                        <li <?php if($module_name == "users"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/users"?>"><i class="fa fa-users"></i> Users</a></li>
                     <?php
                     } 
                  ?>
                  <?php 
                    if (in_array("site_settings", $menu)) {
                     ?>
                        <li <?php if($module_name == "site_settings"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/site_settings"?>"><i class="fa fa-gear"></i> Site Settings</a></li>
                     <?php
                     } 
                  ?>
                  <?php 
                    if (in_array("logs", $menu)) {
                     ?>
                         <li <?php if($module_name == "logs"){echo 'class="active"';}?>><a href="<?php echo base_url()."portal/main/page/logs"?>"><i class="fa fa-gear"></i> Logs</a></li>
                     <?php
                     } 
                  ?>
                </ul>
              </li>
        <?php
          } 
        ?>
      </ul>
    </section>
  </aside>
