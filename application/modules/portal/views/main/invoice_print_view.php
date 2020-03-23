<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo SITE_NAME;?></title>
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
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
           <!-- <i class="fa fa-globe"></i>--> <?php echo SITE_NAME;?> 
           <input type="hidden" value="<?php echo $invoice->id;?>" id="id">
           <small class="pull-right"> <b>Invoice #<?php echo $invoice->id;?><b>&emsp;MO #<?php echo $mo->id;?></b>&emsp;Invoice Date: <?php echo date("m/d/Y",strtotime($invoice->invoice_date));?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        
        <div class="col-sm-4 invoice-col">
        From
        <address>
            <strong><?php echo SITE_NAME;?></strong><br>
            <?php echo nl2br(COMPANY_ADDRESS);?>
        </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        Customer:
        <address>
            <?php echo $customer_address->customer_name;?>
            <br>
            <br>
            <?php echo $customer_address->customer_address;?>
        </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        Bank Account:
        <br>
       <?php echo $invoice->bank;?>
        <br>
        <br>
        <!-- <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567 -->
        
        <?php echo $invoice->invoice_remarks;?>


        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
        <thead>
                <tr>
                <th>QTY</th>
                <th>PRODUCT</th>
                <th>PRODUCT CODE</th>
                <th>COLOR</th>
                <th>DESCRIPTION</th>
                <th>U. PRICE</th>
                <th>DISCOUNT(%)</th>
                <th>TOTAL</th>
                <th>DISCOUNTED PRICE</th>
                </tr>
                </thead>
          <tbody>
          <?php foreach($invoice_lines as $line){?>
          <tr>
            <td><?php echo  $line->quantity;?></td>
            <td><?php echo  $line->description. " - " . $line->color;?></td>
            <td><?php echo  $line->code;?></td>
            <td><?php echo  $line->color;?></td>
            <td><?php echo  $line->description;?></td>
            <td><?php echo  $line->product_price;?></td>
            <td><?php echo  number_format((float)$line->discount, 2, '.', '');?></td>
            <td><?php echo  number_format((float)($line->quantity * $line->product_price), 2, '.', '') ;?></td>
            <td><?php echo  number_format((float)(($line->quantity * $line->product_price) - (($line->quantity * $line->product_price)*($line->discount/100))), 2, '.', '');?></td>
          </tr>
          <?php }?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        <img src="<?php echo base_url();?>/assets/dist/img/credit/visa.png" alt="Visa">
        <img src="<?php echo base_url();?>/assets/dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="<?php echo base_url();?>/assets/dist/img/credit/american-express.png" alt="American Express">
        <img src="<?php echo base_url();?>/assets/dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
            <tbody><tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
            </tr>
          </tbody></table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->


</body></html>