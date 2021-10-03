
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo SITE_NAME;?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">

  <link href="<?php echo base_url();?>assets/toastr/toastr.min.css" rel="stylesheet" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
  .div {
    margin-left:75px;
    margin-right:6rem;
    word-break: break-all;
    white-space: normal;
  }
  </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="row">
  
  <div class="col-md-12">
  
  <div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url();?>"><b><img height="100%"; width="200px" src="<?php echo base_url()."uploads/site_logo/".SITE_LOGO;?>"></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form id="formLogin">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" id="inputUsername" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="inputPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
        </div>
        <div class="col-xs-4">
        <!--<a href="<?php echo base_url("portal/register")?>" class="btn btn-primary btn-block btn-flat"> Register </a>-->
         
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br>
    <a href="<?php echo base_url("portal/forgot_password")?>">I forgot my password</a><br>
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
  </div>
</div>


<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>

<script src="<?php echo base_url();?>assets/toastr/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>

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
<script>
    var main = function()
    {   
        $("#formLogin").submit(function(e){
            e.preventDefault();
            $("#formLogin button").button("loading");
            var username = $("#inputUsername").val();
            var password = $("#inputPassword").val();
            var values = { "username" : username , "password" : password };
            $.ajax({
                url: "<?php echo base_url();?>portal/login/validate_login",
                type: "post",
                data: values ,
                success: function (response) {
                  
                    if(response == "User not found")
                    {
                      toastr.error("Username/Password not found");
                      $("#formLogin button").button("reset");
                    }
                    if(response == "User not active")
                    {
                      toastr.error("User not active");
                      $("#formLogin button").button("reset");
                    }
                    else if(response == "false")
                    {
                      toastr.error("Invalid password");
                      $("#formLogin button").button("reset");
                    }
                    else if(response == "true")
                    {
                      toastr.success("Login successful");
                      $("#formLogin button").button("reset");
                      setTimeout(function() {
                        window.location = "";
                      }, 200);
                    }
                    //window.location = "";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#formLogin button").button("reset");
                }


            });
        });
    };
    $(document).ready(main);
</script>
</body>
</html>
