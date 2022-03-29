<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo "INVOINCE:#".$invoice->id;?></title>
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
<body onload="//window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
           <!-- <i class="fa fa-globe"></i>--> 
           <center>
            <address style="font-size:14px;">
                <strong><?php echo SITE_NAME;?></strong><br>
                <?php echo nl2br(COMPANY_ADDRESS);?>
            </address>
         </center>
           <input type="hidden" value="<?php echo $invoice->id;?>" id="id">
           <div class="row">
                <table class="pull-right">
                <tr><td><small style="font-size:14px;"> M.O. # <?php echo $mo->id;?></b>&emsp;</small><td></tr>
                
                <tr><td><small  style="font-size:14px;">Authorized Signature: <u>______________</u></small><td></tr>
                </table>
           </div>
           
            <div class="row">
                </br>
                <center><small>MARKETING ORDER</small></center>
            </div>

            <div class="row">
                </br>
                <small><b>DATE: <?php echo date("m/d/Y",strtotime($invoice->invoice_date));?></small>
                <small class="pull-right"><b>Inv. #<?php echo $invoice->id;?><b></small>
            </div>
        </h2>
      </div>
      <!-- /.col -->    
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        
  
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        Customer:
        <address>
            <?php echo $customer_address->customer_name;?>
            <br>
            <br>
            <?php echo $customer_address->customer_address;?>
            <br>
            <?php echo "ATTN: ".$invoice->attn;?>
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
                <th>Item</th>
                <th>Stock #</th>
                <th>Article #</th>
                <th>Packing<br>IN/MSTR</th>
                <th>CBM</th>
                <th>COLOR</th>
                <th>QTY</th>
                <th>PRODUCT</th>
                <th>PRODUCT CODE</th>
                <th>DESCRIPTION</th>
                <th>U. PRICE</th>
                <th>DISCOUNT(%)</th>
                <th>TOTAL</th>
                <th>DISCOUNTED PRICE</th>
                </tr>
                </thead>
          <tbody>
          <?php 
            $total_price = 0;
            $total_discounted = 0;
            $count = 1;
          ?>
          <?php foreach($invoice_lines as $line){
              $total_price = $total_price + ( $line->quantity* $line->product_price);
              $total_discounted = $total_discounted + (($line->quantity*$line->product_price)-($line->quantity*$line->product_price)*($line->discount/100));
            ?>
          <tr>
            <td><?php echo  $count;?></td>
            <td><?php echo  $line->class."-".$line->code."-".$line->color_abb;?></td>
            <td><?php echo  "______";?></td>
            <td><?php echo  $line->master_carton." ".$line->master_carton;?></td>
            <td><?php echo  $line->weight_of_box;?></td> 
            <td><?php echo  $line->color;?></td>
            <td><?php echo  $line->quantity;?></td>
            <td><?php echo  $line->description. " - " . $line->color;?></td>
            <td><?php echo  $line->code;?></td>
            <td><?php echo  $line->description;?></td>
            <td><?php echo  $line->product_price;?></td>
            <td><?php echo  number_format((float)$line->discount, 2, '.', '');?></td>
            <td><?php echo  number_format((float)($line->quantity * $line->product_price), 2, '.', '') ;?></td>
            <td><?php echo  number_format((float)(($line->quantity * $line->product_price) - (($line->quantity * $line->product_price)*($line->discount/100))), 2, '.', '');?></td>
          </tr>
          <?php $count++;}?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    
    <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
            <p class="lead">Payment Terms: <?php echo $payment_terms->code;?></p>
                <br>
                <br>
                Remarks: <?php echo $invoice->remarks;?>
            <br>
            <br>
            Packing Instruction: <?php echo $invoice->packing_instruction;?>
            <br>
            <br>
            Label Instructions: <?php echo $invoice->label_instructions;?>
            <br>
            <br>
            Markings: <?php echo $invoice->markings;?>
            <br>
            <br>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
            <!-- <p class="lead">Amount Due 2/22/2014</p> -->

            <div class="table-responsive">
                <table class="table">
                <tbody><tr>
                    <th style="width:50%">Total:</th>
                    <td>$ <?php echo  number_format((float)$total_price, 2, '.', '');?></td>
                </tr>
                <tr>
                    <th style="width:50%">Total Discounted Price:</th>
                    <td>$ <?php echo  number_format((float)$total_discounted, 2, '.', '');?></td>
                </tr>
                <tr>
                    <th>Delivery Time:</th>
                    <td><?php echo date("Y-m-d",strtotime($invoice->delivery_time));?></td>
                </tr>
                <tr>
                    <th>IQ:</th>
                    <td><?php echo $invoice->iq;?></td>
                </tr>
                <tr>
                    <th>Shipping Instruction:</th>
                    <td><?php echo $invoice->shipping_instruction;?></td>
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