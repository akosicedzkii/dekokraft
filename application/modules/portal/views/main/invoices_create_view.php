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
                    <option value="order">Proforma Invoice</option>
                    <option value="sample">Sample Invoice</option>
                    <option value="photo qoutation">PQ Invoice</option>
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
                <select class="form-control" style="width:70%;"  type="text" placeholder="Customer Name" id="customer_name"/></select>
                <br>
                <br>
                <textarea class="form-control" style="width:70%;"   placeholder="Customer Address" id="customer_address"/></textarea>
                
                <br>
                <input type="text" class="form-control" style="width:70%;"   placeholder="ATTN" id="attn"/>
            </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
            <!-- <b>Invoice #007612</b><br> -->
            Bank Account:
            <br>
            <select class="form-control" style="width:70%;"  type="text" placeholder="Bank" id="bank"/></select>
            <br>
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
                <th>ARTICLE#</th>
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
            <textarea class="form-control" style="width:70%;" placeholder="Remarks" id="remarks"/></textarea>
            <br>
            <br>
            <textarea class="form-control" style="width:70%;" placeholder="Packing Instructions" id="packing_instruction"/></textarea>
            <br>
            <br>
            <textarea class="form-control" style="width:70%;" placeholder="Label Instructions" id="label_instructions"/></textarea>
            <br>
            
            <br>
            <textarea class="form-control" style="width:70%;" placeholder="PDF Due" id="pdf_due"/></textarea>
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
                    <th>IQ:</th>
                    <td><input type="text" class="form-control" id="iq"></td>
                </tr>
                <!--<tr>
                    <th>MO Number:</th>
                    <td><input type="number" class="form-control" id="mo_number"></td>
                </tr>-->
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
            <div id="uploadBoxMain" class="col-md-12">
                                </div>
            <a  href="<?php echo base_url();?>portal/main/invoices/list" class="btn btn-success"><i class="fa fa-credit-card"></i> Cancel</a>
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

<!-- /.modal -->
<div class="modal fade" id="addProductColorModal" z-index=9999 role="dialog"  data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            
                <h3 class="modal-title">Add Product Color: <label id="prod_name_add_color"></label></h3>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" id="prod_id_color">
                            <input type="hidden" id="line_number">
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>

                                <div class="col-sm-10">
                                <select  style="width:100%;" class="form-control" id="color" placeholder="Color" required></select>
                                <a class="btn btn-info" id="add_color">+</a>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color_abb" class="col-sm-2 control-label">Color Abbrieviation</label>

                                <div class="col-sm-10">
                                <input type="text" disabled class="form-control" id="color_abb" placeholder="Color Abbrieviation" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-sm-10">
                                <input type="number" min="1" class="form-control" id="stock" placeholder="Stock" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="uploadBoxMain" class="col-md-12">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addProductColor">Add Product Color</button>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->  
<div class="modal fade" id="colorsModal"  z-index=99999 role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Colors</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="colorsID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="colorsForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Color Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" placeholder="Color Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="code" class="col-sm-2 control-label">Color Code</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="code_" placeholder="Color Code" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputStatus_" class="col-sm-2 control-label">Status</label>

                                <div class="col-sm-10">
                                <select class="form-control" id="inputStatus_" placeholder="Content" style="resize:none" required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="uploadBoxMain" class="col-md-12">
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveColors">Save Colors</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

    
  <script> 
        let lineNo = 1; 
        $(document).ready(function () { 
            
            $("#add_new_product").click(function () { 
                markup =  "<tr><td><input type='hidden' name='total_discount_percentage[]'><input type='hidden' name='base_amount[]'><input type='hidden' name='total_discount[]'><input type='hidden' name='total_amount[]'><input type='hidden' name='total_quantity[]'><input type='hidden' name='product_selected[]'><input required value=1 type='number' min=0 class='form-control quantity' style='width:100px;' ><td><input type='text' min=0 class='form-control article' name='article[]' style='width:100px;' ></td></td><td><select type='text' style='width:200px;' required id='product"+ lineNo+"'></select><input type='button' id='AddColor' name='addColor[]' line-number='" + lineNo + "'  value='+' class='btn btn-info'></td><td><label class='product_code'></label></td><td><label class='product_color'></label></td><td><label class='product_desc'></label></td><td><label class='product_price'></td><td><input required value=0 type='number' min=0 class='form-control discount' style='width:100px;' ></td><td><label class='total_price'></td><td><label class='discounted_price'></td><td><input type='button' id='DeleteButton' value='x' class='btn btn-danger'></td></tr>"; 
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
                    $row.find(".article").html(data.article);
                    $row.find(".product_price").html(data.fob);
                    $row.find('input[name="base_amount[]"]').val(data.fob);
                    $row.find('input[name="addColor[]"]').attr("data",data.id)
                    $row.find('input[name="addColor[]"]').attr("data-description",data.description)
                    //alert( $row.find("#quantity").val()*$row.find("#base_amount").val())
                    $row.find(".total_price").html(($row.find(".quantity").val()*$row.find('input[name="base_amount[]"]').val()).toFixed(2))
                    $row.find(".discounted_price").html(($row.find('input[name="base_amount[]"]').val()*$row.find(".quantity").val() - (($row.find(".discount").val()/100)*$row.find('input[name="base_amount[]"]').val())).toFixed(2))
                    $row.find(".quantity").on('input',function (e) {
                        var $row = $(this).closest("tr");
                        $row.find('input[name="total_amount[]"]').val($row.find(".quantity").val()*$row.find('input[name="base_amount[]"]').val())
                        $row.find('input[name="total_quantity[]"]').val($row.find(".quantity").val())
                        $row.find('input[name="total_discount[]"]').val($row.find(".discount").val())
                        $row.find(".total_price").html(($row.find(".quantity").val()*$row.find('input[name="base_amount[]"]').val()).toFixed(2))
                        $row.find(".discounted_price").html(($row.find('input[name="base_amount[]"]').val()*$row.find(".quantity").val() - (($row.find(".discount").val()/100)*$row.find('input[name="base_amount[]"]').val())).toFixed(2))
                        get_total(total)
                        get_total_quantity(total_quantity)
                        get_total_discount(total_discount)
                    });
                    
                    $row.find(".discount").on('input',function (e) {
                        var $row = $(this).closest("tr");
                        $row.find('input[name="total_discount[]"]').val($row.find(".discount").val())
                        $row.find('input[name="total_quantity[]"]').val($row.find(".quantity").val())
                        $row.find(".total_price").html(($row.find(".quantity").val()*$row.find('input[name="base_amount[]"]').val()).toFixed(2))
                        $row.find(".discounted_price").html(($row.find('input[name="base_amount[]"]').val()*$row.find(".quantity").val() - (($row.find(".discount").val()/100)*$row.find('input[name="base_amount[]"]').val())).toFixed(2))
                        get_total(total)
                        get_total_quantity(total_quantity)
                        get_total_discount(total_discount)
                    });

                    $row.find('input[name="total_amount[]"]').val($row.find(".quantity").val()*$row.find('input[name="base_amount[]"]').val())
                    $row.find('input[name="total_quantity[]"]').val($row.find(".quantity").val())
                    $row.find('input[name="total_discount[]"]').val($row.find(".discount").val())
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
                var v = parseFloat( $( e ).val() );
                    if ( !isNaN( v ) )
                        total += parseFloat(v);
                } );
                $("#mega_total").html(total.toFixed(2));
            }
            function get_total_quantity(total_quantity){
            $( 'input[name^="total_quantity"]' ).each( function( i , e ) {
                var v = parseFloat( $( e ).val() );
                    if ( !isNaN( v ) )
                    total_quantity += v;
                } );
                $("#mega_quantity").html(total_quantity);
            }
            function get_total_discount(total_discount){
            $(".discounted_price").each( function( i , e ) {
                var v = parseFloat( $( e ).html() );
                    if ( !isNaN( v ) )
                    total_discount += parseFloat(v);
                } );
                $("#mega_discounted_total").html(total_discount.toFixed(2));
            }
            $("#product_table").on("click", "#DeleteButton", function() {
                $(this).closest("tr").remove();
            });

            $("#product_table").on("click", "#AddColor", function() {
                console.log($(this).attr("data"));
                $("#prod_name_add_color").html($(this).attr("data-description"))
                $("#prod_id_color").val($(this).attr("data"))
                $("#addProductColorModal").modal("show");
            });
            $("#customer_name").select2({
                minimumInputLength: 1,
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
            $('#color').on('select2:select', function (e) {
                var data = $('#color').select2('data');
                console.log(data)
                $("#color_abb").val(data[0].id);
            });
            $("#addProductColor").click(function(){
                $("#addProductColor").button("loading");
                var name = $("#color").text();
                var code = $("#color_abb").val();
                var prod_var_id = $("#prod_id_color").val();
                var stock = $("#stock").val();
                console.log(name)
                console.log(code)
                console.log(prod_var_id)
                    // Attach file
                    //fromthis    
                    data = { "id" : prod_var_id, "code" : code , "name" : name , "stock" : stock};
                    var url = "<?php echo base_url()."portal/product_variants/add_prod_colors";?>";
                    var message = "New product color successfully added";
                    $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/product_variants/add_prod_colors";?>",
                        success: function(data){
                            //data = JSON.parse(data);
                            $("#name").val("");
                            $("#color").val("");
                            $("#stock").val("");
                            $("#color_abb").val("");
                            $("#prod_id_color").val("");
                            $("#addProductColor").button("reset");
                            $("#addProductColorModal").modal("hide");
                            if(data)
                            {
                                toastr.success("Product Variant Color Added Succesfully")
                            }else{
                                toastr.danger(data);
                            }
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
                
            });
            $("#bank").select2({
                minimumInputLength: 1,
                ajax: {
                    url: "<?php echo base_url()."portal/banks/get_banks_selection";?>",
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
                $("#attn").val(data[0].attn);
            });
            $("#payment_terms").select2({
                minimumInputLength:1,
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
           
            $("#add_color").click(function(){
                $("#colorsModal .modal-title").html("Add New Color");
                $('#colorsForm').validator();
                $("#colorsModal").modal("show");
            });
            $("#saveColors").click(function(){
                //alert("yeah");
                $("#colorsForm").submit();
            });
            $("#colorsForm").validator().on('submit', function (e) {
                
                var btn = $("#saveColors");
                btn.button("loading");
                if (e.isDefaultPrevented()) {
                    btn.button("reset"); 
                } else {
                    e.preventDefault();
                    var name = $("#name").val();
                    var code = $("#code_").val();
                    var status = $("#inputStatus_").val();
                    var colors_id = $("#colorsID").val();

                    if(name == "" || code == "")
                    {
                        btn.button("reset"); 
                        return false;
                    }

                    var formData = new FormData();
                    formData.append('id', colors_id);
                    formData.append('name', name);
                    formData.append('code', code);
                    formData.append('status', status);
                    // Attach file
                    //fromthis    
                    var url = "<?php echo base_url()."portal/colors/add_colors";?>";
                    var message = "New colors successfully added";


                    $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
                    $.ajax({
                        data: formData,
                        type: "post",
                        processData: false,
                        contentType: false,
                        cache: false,
                        url: url ,
                        xhr: function(){
                            //upload Progress
                            var xhr = $.ajaxSettings.xhr();
                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', function(event) {
                                    var percent = 0;
                                    var position = event.loaded || event.position;
                                    var total = event.total;
                                    if (event.lengthComputable) {
                                        percent = Math.ceil(position / total * 100);
                                    }
                                    //update progressbar
                                    
                                    $('#progressBarMain').css('width',percent+'%').html(percent+'%');
                                                                    
                                }, true);
                            }
                            return xhr;
                        },
                        mimeType:"multipart/form-data"
                    }).done(function(data){ 
                        if(!data)
                        {
                            btn.button("reset");
                            toastr.error(data);
                        }
                        else
                        {
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            toastr.success(message);
                            $("#colorsForm").validator('destroy');
                            $("#colorsModal").modal("hide"); 
                            $('#uploadBoxMain').html('');          
                        }
                    });
                }
                    return false;
            });
            $("#color").select2({
                minimumInputLength: 2,
                ajax: {
                    url: "<?php echo base_url()."portal/colors/get_colors_selection";?>",
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

                $("#save_invoice").button("loading");
                var values = [];
                $("input[name='product_selected[]']").each(function( index, currentElement  ) {
                    console.log(index);
                    prod_selected = $('input[name="product_selected[]"]')[index].value;
                    articles = $('input[name="article[]"]')[index].value;
                    total_quan =  $('input[name="total_quantity[]"]')[index].value;
                    total_am =  $('input[name="base_amount[]"]')[index].value;
                    total_dis =  $('input[name="total_discount[]"]')[index].value;
                    var arr_val = []
                    arr_val.push(prod_selected,total_quan,articles,total_am,total_dis)
                    values.push(arr_val);
                });
                if( $("#mega_total").html() == "")
                {  
                    toastr.error("Please add a product");

                    $("#save_invoice").button("reset");
                    e.preventDefault();
                    return false;
                }
                $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');

                var url = "<?php echo base_url()."portal/invoices/insert_invoices";?>";
                var message = "New invoice successfully added";
                var formData = new FormData();
                formData.append('id',$("#id").val());
                formData.append('customer_name',$("#customer_name").val());
                formData.append('attn',$("#attn").val());
                formData.append('invoice_number',$("#invoice_number").val());
                formData.append('mo_number',$("#mo_number").val());
                formData.append('iq',$("#iq").val());
                formData.append('remarks',$("#remarks").val());
                formData.append('packing_instruction',$("#packing_instruction").val());
                formData.append('invoice_type',$("#invoice_type").val());
                formData.append('bank',$("#bank").val());
                formData.append('payment_terms',$("#payment_terms").val());
                formData.append('delivery_time',$("#delivery_time").val());
                formData.append('pdf_due',$("#pdf_due").val());
                formData.append('shipping_instruction',$("#shipping_instruction").val());
                formData.append('markings',$("#markings").val());
                formData.append('date_created',$("#date_created").val());
                formData.append('created_by',$("#created_by").val());
                formData.append('date_modified',$("#date_modified").val());
                formData.append('modified_by',$("#modified_by").val());
                formData.append('total_amount',$("#total_amount").val());
                formData.append('status',$("#status").val());
                formData.append('label_instructions',$("#label_instructions").val());
                formData.append('invoice_remarks',$("#invoice_remarks").val());
                formData.append('invoice_items',JSON.stringify(values));
                $.ajax({
                    data: formData,
                    type: "post",
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: url ,
                    xhr: function(){
                        //upload Progress
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function(event) {
                                var percent = 0;
                                var position = event.loaded || event.position;
                                var total = event.total;
                                if (event.lengthComputable) {
                                    percent = Math.ceil(position / total * 100);
                                }
                                //update progressbar
                                
                                $('#progressBarMain').css('width',percent+'%').html(percent+'%');
                                                                
                            }, true);
                        }
                        return xhr;
                    },
                    mimeType:"multipart/form-data"
                }).done(function(data){ 
                    if(!data)
                    {
                        btn.button("reset");
                        toastr.error(data);
                    }
                    else
                    {
                        
                         toastr.success(message);
                         $('#uploadBoxMain').html('');  
                         setTimeout(function(){
                            window.location = "<?php echo base_url()."portal/main/invoices/list";?>";
                         }, 1000);        
                    }
                });
                e.preventDefault();
                $('input[name="product_selected[]"]').each(function (index, member) {
                    var value = $(member).val();
                    console.log(value)
                });
                e.preventDefault();
            });
            
        });  
    </script> 
