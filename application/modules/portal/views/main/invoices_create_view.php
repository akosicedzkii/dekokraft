<div class="content-wrapper" style="min-height: 1135.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <!-- <small>#007612</small> --> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

  
    <form id="invoice_form">
        <!-- Main content -->
        <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
            <h2 class="page-header">
                <!-- <i class="fa fa-globe"></i>--> <?php echo SITE_NAME;?> 
                <small class="pull-right">Date: <?php echo date("m/d/Y");?></small>
            
            </h2>
            <select id="invoice_type" style="width:200px;" class="form-control pull-left">
                    <option value="proforma">Proforma Invoice</option>
                    <option value="marketing">Marketing Invoice</option>
                    <option value="sample">Sample Invoice</option>
                </select>
            </div>
            <!-- /.col -->
        </div>
        <br>
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
                <select class="form-control" style="width:70%;" required type="text" placeholder="Customer Name" id="customer_name"/></select>
                <br>
                <br>
                <textarea class="form-control" style="width:70%;"  required placeholder="Customer Address" id="customer_address"/></textarea>
            </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
            <!-- <b>Invoice #007612</b><br> -->
            <br>
            <!-- <b>Order ID:</b> 4F3S8J<br>
            <b>Payment Due:</b> 2/22/2014<br>
            <b>Account:</b> 968-34567 -->
            
            <textarea class="form-control" style="width:70%;" placeholder="Remarks" id="invoice_remarks"/></textarea>
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
                <th>DISCOUNT(%)</th>
                <th>TOTAL</th>
                <th>DISCOUNTED PRICE</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                    <tr>
                    <td>TOTAL: <b><label id="mega_quantity"></label></b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                </tfoot>
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
                </select>
                <br>
                <br>
            <textarea class="form-control" style="width:70%;" placeholder="Remarks" id="invoice_remarks"/></textarea>
            <br>
            <br>
            <textarea class="form-control" style="width:70%;" placeholder="Packing Instructions" id="packing_instructions"/></textarea>
            <br>
            <br>
            <textarea class="form-control" style="width:70%;" placeholder="Label Instructions" id="label_instructions"/></textarea>
            <br>
            <br>
            <textarea class="form-control" style="width:70%;" placeholder="Markings" id="markings"/></textarea>
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
                    <td>$ <label id="mega_total"></label></td>
                </tr>
                <tr>
                    <th style="width:50%">Total Discounted Price:</th>
                    <td>$ <label id="mega_discounted_total"></label></td>
                </tr>
                <tr>
                    <th>Delivery Time:</th>
                    <td><input type="date" class="form-control" id="delivery_time"></td>
                </tr>
                <tr>
                    <th>Shipping Instruction:</th>
                    <td><textarea class="form-control" style="width:100%;" placeholder="Shipping Instruction" id="shipping_instruction"/></textarea></td>
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
            <a href="<?php echo base_url();?>portal/main/page/invoice_print?invoice_id=" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <button type="submit" id="save_invoice" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Save Invoice</button>
            <!-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button> -->
            </div>
        </div>
    </section>
    </form>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

  <script> 
        let lineNo = 1; 
        $(document).ready(function () { 
            $("#add_new_product").click(function () { 
                markup =  "<tr><td><input type='hidden' name='total_discount[]'><input type='hidden' name='total_amount[]'><input type='hidden' name='total_quantity[]'><input type='hidden' name='product_selected[]'><input required value=1 type='number' min=0 class='form-control quantity' style='width:100px;' ></td><td><input type='hidden' name='base_amount'><select type='text' style='width:300px;' required id='product"+ lineNo+"'></select></td><td><label class='product_code'></label></td><td><label class='product_color'></label></td><td><label class='product_desc'></label></td><td><label class='product_price'></td><td><input required value=0 type='number' min=0 class='form-control discount' style='width:100px;' ></td><td><label class='total_price'></td><td><label class='discounted_price'></td><td><input type='button' id='DeleteButton' value='x' class='btn btn-danger'></td></tr>"; 
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
                var total_quantity = 0;
                var total_discount = 0;
                $('#product'+ lineNo).on('select2:select', function (e) {
                    var data = e.params.data;
        
                  
                    var $row = $(this).closest("tr");
                    console.log($row)
                    $row.find('input[name="product_selected[]"]').val(data.id);
                    $row.find(".product_code").html(data.code);
                    $row.find(".product_desc").html(data.description);
                    $row.find(".product_color").html(data.color);
                    $row.find(".product_price").html(data.fob);
                    $row.find("[name=base_amount]").val(data.fob);
                    //alert( $row.find("#quantity").val()*$row.find("#base_amount").val())
                    $row.find(".total_price").html(($row.find(".quantity").val()*$row.find("[name=base_amount]").val()).toFixed(2))
                    $row.find(".discounted_price").html(($row.find("[name=base_amount]").val() - (($row.find(".discount").val()/100)*$row.find("[name=base_amount]").val())).toFixed(2))
                    $row.find(".quantity").on('input',function (e) {
                        var $row = $(this).closest("tr");
                        $row.find('input[name="total_amount[]"]').val($row.find(".quantity").val()*$row.find("[name=base_amount]").val())
                        $row.find('input[name="total_quantity[]"]').val($row.find(".quantity").val())
                        $row.find(".total_price").html(($row.find(".quantity").val()*$row.find("[name=base_amount]").val()).toFixed(2))
                        $row.find(".discounted_price").html(($row.find("[name=base_amount]").val() - (($row.find(".discount").val()/100)*$row.find("[name=base_amount]").val())).toFixed(2))
                        get_total(total)
                        get_total_quantity(total_quantity)
                        get_total_discount(total_discount)
                    });
                    
                    $row.find(".discount").on('input',function (e) {
                        var $row = $(this).closest("tr");
                        $row.find('input[name="total_discount[]"]').val($row.find("[name=base_amount]").val() - (($row.find(".discount").val()/100)*$row.find("[name=base_amount]").val()))
                        $row.find('input[name="total_quantity[]"]').val($row.find(".quantity").val())
                        $row.find(".total_price").html(($row.find(".quantity").val()*$row.find("[name=base_amount]").val()).toFixed(2))
                        $row.find(".discounted_price").html(($row.find("[name=base_amount]").val() - (($row.find(".discount").val()/100)*$row.find("[name=base_amount]").val())).toFixed(2))
                        get_total(total)
                        get_total_quantity(total_quantity)
                        get_total_discount(total_discount)
                    });

                    $row.find('input[name="total_amount[]"]').val($row.find(".quantity").val()*$row.find("[name=base_amount]").val())
                    $row.find('input[name="total_quantity[]"]').val($row.find(".quantity").val())
                    $row.find('input[name="total_discount[]"]').val($row.find("[name=base_amount]").val() - (($row.find(".discounted_price").val()/100)*$row.find("[name=base_amount]").val()))
                    // or $( 'input[name^="ingredient"]' )
                    get_total(total)
                    get_total_quantity(total_quantity)
                    get_total_discount(total_discount)
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
            function get_total_quantity(total_quantity){
            $( 'input[name^="total_quantity"]' ).each( function( i , e ) {
                var v = parseInt( $( e ).val() );
                    if ( !isNaN( v ) )
                    total_quantity += v;
                } );
                $("#mega_quantity").html(total_quantity);
            }
            function get_total_discount(total_discount){
            $( 'input[name^="total_discount"]' ).each( function( i , e ) {
                var v = parseInt( $( e ).val() );
                    if ( !isNaN( v ) )
                    total_discount += v;
                } );
                $("#mega_discounted_total").html(total_discount.toFixed(2));
            }
            $("#product_table").on("click", "#DeleteButton", function() {
                $(this).closest("tr").remove();
            });
            $("#customer_name").select2({
                minimumInputLength: 2,
                ajax: {
                    url: "<?php echo base_url()."portal/customers/get_customers_selection";?>",
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

            $('#customer_name').on('select2:select', function (e) {
                var data = $('#customer_name').select2('data');
                $("#customer_address").val(data[0].address);
            });
            $("#payment_terms").select2({
                minimumInputLength: 2,
                ajax: {
                    url: "<?php echo base_url()."portal/payment_terms/get_payment_terms_selection";?>",
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
           
            $("#invoice_form").submit(function(e){
                console.log( $('input[name="product_selected[]"]').val())
                console.log( $('input[name="total_quantity[]"]').val())
                console.log( $('input[name="total_amount[]"]').val())
                e.preventDefault();
                $('input[name="product_selected[]"]').each(function (index, member) {
                    var value = $(member).val();
                    console.log(value)
                });
                e.preventDefault();
            });
            
        });  
    </script> 