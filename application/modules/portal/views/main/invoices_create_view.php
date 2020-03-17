<div class="content-wrapper" style="min-height: 1135.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#007612</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

  

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <!-- <i class="fa fa-globe"></i>--> <?php echo SITE_NAME;?> 
            <small class="pull-right">Date: <?php echo date("m/d/Y");?></small>
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
          To
          <address>
            <input class="form-control" style="width:70%;" type="text" placeholder="Customer Name" id="customer_name"/>
            <br>
            <textarea class="form-control" style="width:70%;" placeholder="Customer Address" id="customer_address"/></textarea>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <input type="button" id="add_new_product" class="btn btn-info" value="Add Product">
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped"  id="product_table">
            <thead>
            <tr>
              <th>QTY</th>
              <th>PRODUCT</th>
              <th>PRODUCT CODE</th>
              <th>COLOR</th>
              <th>DESCRIPTION</th>
              <th>U. PRICE</th>
              <th>TOTAL</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Terms:</p>
            <select id="payment_terms"  style="width:20%;" class="form-control">
                <option>A</option>
                <option>A</option>
                <option>A</option>
                <option>A</option>
            </select>
            <br>
            <br>
          <textarea class="form-control" style="width:70%;" placeholder="Remarks" id="invoice_remarks"/></textarea>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due 2/22/2014</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal:</th>
                <td>$ <label id="mega_total"></label></td>
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

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo base_url();?>portal/main/invoice_print?invoice_id=" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Save Invoice</button>
          <!-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

  <script> 
        let lineNo = 1; 
        $(document).ready(function () { 
            $("#add_new_product").click(function () { 
                markup =  "<tr><td><input required value=1 type='number' min=0 class='form-control quantity' style='width:100px;' ></td><td><input type='hidden' name='product_selected'><input type='hidden' name='base_amount'><input type='hidden' name='total_amount'><select type='text' style='width:300px;' required id='product"+ lineNo+"'></select></td><td><label class='product_code'></label></td><td><label class='product_color'></label></td><td><label class='product_desc'></label></td><td><label class='product_price'></td><td><label class='total_price'></td><td><input type='button' id='DeleteButton' value='x' class='btn btn-danger'></td></tr>"; 
                tableBody = $("#product_table tbody"); 
                tableBody.append(markup); 
                $("#product"+lineNo).select2({
                    minimumInputLength: 2,
                    ajax: {
                        url: "<?php echo base_url()."portal/product_variants/get_product_variants_selection";?>",
                        dataType: 'json',
                        type: "GET",
                        data: function (term) {
                            return {
                                term: term
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data.items
                            };
                        }

                    }
                });
                
                var total = 0;
                $('#product'+ lineNo).on('select2:select', function (e) {
                    var data = e.params.data;
        
                  
                    var $row = $(this).closest("tr");
                    console.log($row)
                    $row.find(".product_selected").val(data.id);
                    $row.find(".product_code").html(data.code);
                    $row.find(".product_desc").html(data.description);
                    $row.find(".product_color").html(data.color);
                    $row.find(".product_price").html(data.fob);
                    $row.find("[name=base_amount]").val(data.fob);
                    //alert( $row.find("#quantity").val()*$row.find("#base_amount").val())
                    $row.find(".total_price").html(($row.find(".quantity").val()*$row.find("[name=base_amount]").val()).toFixed(2))
                    $row.find(".quantity").on('input',function (e) {
                        var $row = $(this).closest("tr");
                        $row.find("[name=total_amount]").val($row.find(".quantity").val()*$row.find("[name=base_amount]").val())
                        $row.find(".total_price").html(($row.find(".quantity").val()*$row.find("[name=base_amount]").val()).toFixed(2))
                        get_total(total)
                    });
                    
                    $row.find("[name=total_amount]").val($row.find(".quantity").val()*$row.find("[name=base_amount]").val())
                    // or $( 'input[name^="ingredient"]' )
                    get_total(total)
                 });
                 /*$('#quantity').on('input',function (e) {
                    var $row = $(this).closest("tr");
                    alert($row.find("#base_amount").val())
                    ;
                 });*/
                lineNo++; 
            }); 
            function get_total(total){
                $( 'input[name^="total_amount"]' ).each( function( i , e ) {
                            var v = parseInt( $( e ).val() );
                                if ( !isNaN( v ) )
                                    total += v;
                            } );
                            $("#mega_total").html(total.toFixed(2));
                }
            $("#product_table").on("click", "#DeleteButton", function() {
                $(this).closest("tr").remove();
            });

           

            
        });  
    </script> 