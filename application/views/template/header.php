<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title><?php echo SITE_NAME;?></title>
    <!-- BOOTSTRAP CORE CSS -->
    <link href="<?php echo base_url()."pink/assets/";?>css/bootstrap.css" rel="stylesheet" />
    <!-- IONICON STYLE SHEET FOR BEAUTIFUL ICONS -->
    <link href="<?php echo base_url()."pink/assets/";?>css/ionicons.css" rel="stylesheet" />
    <!-- STYLE FOR OPENING IMAGE IN POPUP USING FANCYBOX-->
    <link href="<?php echo base_url()."pink/assets/";?>js/source/jquery.fancybox.css" rel="stylesheet" />
    <!-- CUSTOM CSS -->
    <link href="<?php echo base_url()."pink/assets/";?>css/style.css" rel="stylesheet" />
    <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	.modal-header {
  background-color: #1E90FF;
  color: white;
}
	.modal-body p{
	color:black;	
}
.modal-body h1{
	color:black;	
}
	</style>
</head>
<body data-spy="scroll" data-target=".navbar-fixed-top">

    <div class="navbar navbar-default navbar-fixed-top scroll-me">
        <!-- pass scroll-me class above a tags to starts scrolling -->
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#homes">
                    <img src="<?php echo base_url()."uploads/site_logo/".SITE_LOGO;?>"  alt=""/>
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#homes">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#technology">Technology</a></li>
                    <li><a href="#osi">Why OSI?</a></li>
                    <!--<li <?php if($page == "about_us"){ echo "class='active'";}?>><a href="<?php echo base_url()."about_us"?>">About</a></li>
                    <li ><a href="#clients">Events</a></li>
                    <li><a href="<?php echo base_url();?>#charities">Charities</a></li>-->
                    <!--<li <?php if($page == "faqs"){ echo "class='active'";}?>><a href="<?php echo base_url()."faqs"?>">FAQ</a></li>-->
                    <!--<li <?php if($page == "blogs"){ echo "class='active'";}?>><a href="<?php echo base_url()."blogs"?>">Blog</a></li>
                    <li <?php if($page == "login"){ echo "class='active'";}?>><a href="<?php echo base_url()."portal/login"?>">Login/Register</a></li>-->
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="#partners">Partners</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
   
