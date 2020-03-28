<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php $module_name = str_replace("_"," ",$module_name);echo ucfirst(str_replace("_"," ",$module_name));?>
    <small>Management</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucfirst($module_name);?></li>
    </ol>
</section>
<button class="btn btn-success btn-circle btn-lg fix-btn" id="addBtn"  data-toggle="tooltip" title="Add New">
    <span class="glyphicon glyphicon-plus"></span>
</button>
<!-- Main content -->
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?> List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="job_ordersList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Job Order Number</th>
            <th>Job_order</th>
            <th>MO#</th>
            <th>Status</th>
            <th>Date Created</th>
            <th>Created By</th>
            <th>Date Modified</th>
            <th>Modified By</th>
            <th>Actions</th> 
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>

<div class="modal fade" id="job_ordersModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Job_order</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="job_ordersID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="job_ordersForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="marketing_order" class="col-sm-2 control-label">Marketing Order</label>

                                <div class="col-sm-10">
                                <select type="text" class="form-control" id="marketing_order" placeholder="Marketing Order" required></select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subcon" class="col-sm-2 control-label">Job Order Code</label>

                                <div class="col-sm-10">
                                
                                <select type="text" class="form-control" id="subcon" placeholder="Subcon" required></select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="option" class="col-sm-2 control-label">Job Type</label>

                                <div class="col-sm-10">
                                <select class="form-control" id="job_type" placeholder="Job Type" style="resize:none" required>
                                    <option value="spray">Spray</option>
                                    <option value="finishing">Finishing</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="job_orders_details" class="col-sm-2 control-label">Job Order Remarks</label>

                                <div class="col-sm-10">
                                
                                <textarea type="text" class="form-control" id="job_orders_details" placeholder="Job Order Remarks" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bank_address" class="col-sm-2 control-label">Job Order Address</label>

                                <div class="col-sm-10">
                                <table class="table responsive">
                                    <thead>
                                        <th>Select</th>
                                        <th>Quantity</th>
                                        <th>Product Name</th>
                                        <th>Product Color</th>
                                    </thead>
                                    <tbody id="table_body">
                                    </tbody>
                                </table>
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
            <button type="button" class="btn btn-primary" id="saveJob_order">Save Job_order</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteJob_orderModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Job_order</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteJob_order">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<script>

    var inputRoleConfig = {
        dropdownAutoWidth : true,
        width: 'auto',
        placeholder: "--- Select Item ---"
    };


    var main = function(){
        var table = $('#job_ordersList').DataTable({
            "language": {                
                "infoFiltered": ""
            },  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."portal/job_orders/get_job_orders_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ], "order": [[ 4, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#job_ordersModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#job_ordersForm').validator();
            $("#job_ordersModal").modal("show");
        });

        $("#saveJob_order").click(function(){
            $("#job_ordersForm").submit();
        });

        var image_correct = true;
        var image_error = "";
        $("#job_ordersForm").validator().on('submit', function (e) {
           
            var btn = $("#saveJob_order");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var name = $("#name").val();
                var code = $("#code").val();
                var status = $("#inputStatus").val();
                var job_orders_id = $("#job_ordersID").val();
                var job_orders_details  = $("#job_orders_details").val();
                var bank_address  = $("#bank_address").val();
                if(name == "" || code == "")
                {
                    btn.button("reset"); 
                    return false;
                }

                var formData = new FormData();
                formData.append('id', job_orders_id);
                formData.append('name', name);
                formData.append('code', code);
                formData.append('job_orders_details', job_orders_details);
                formData.append('address', bank_address);
                formData.append('status', status);
                // Attach file
                 //fromthis    
                 var url = "<?php echo base_url()."portal/job_orders/add_job_orders";?>";
                var message = "New job order successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/job_orders/edit_job_orders";?>";
                    message = "Job Order successfully updated";
                }


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
                         if(action == "edit")
                         {
                             table.draw("page");
                         }
                         else
                         {
                             table.draw();
                         }
                         toastr.success(message);
                         $("#job_ordersForm").validator('destroy');
                         $("#job_ordersModal").modal("hide"); 
                         $('#uploadBoxMain').html('');          
                    }
                });
            }
               return false;
        });
        $("#marketing_order").select2({
            minimumInputLength: 1,
            ajax: {
                url: "<?php echo base_url()."portal/marketing_order/get_marketing_order_selection";?>",
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
        $("#subcon").select2({
            minimumInputLength: 1,
            ajax: {
                url: "<?php echo base_url()."portal/subcon/get_subcon_selection";?>",
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
        $('#marketing_order').on('select2:select', function (e) {
            var data = $('#marketing_order').select2('data');
            data = { "invoice_id": data[0].invoice_id }
            $.ajax({
                    data: data,
                    type: "get",
                    url: "<?php echo base_url()."portal/invoices/get_invoice_list";?>",
                    success: function(data){
                        $("#table_body").html("");
                        if(!data)
                        {   
                            return false;
                        }
                        data = JSON.parse(data);
                        data.forEach(function(e){
                            console.log(e["color"])
                            $("#table_body").append("<tr><td><input type=checkbox name='jo_item[]' value='" + e["id"]+"' /></td><td>" + e["quantity"]+ "</td><td>" + e["description"]+ "</td><td>" + e["color"]+ "</td></tr>");
                        });
                        
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
            });
        });
        $("#deleteJob_order").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/job_orders/delete_job_orders";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteJob_orderModal").modal("hide");
                            toastr.error('Job Order ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#job_ordersModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#inputStatus").val('1').trigger('change');
            $('#inputCoverImage').val("");
            $('#coverImgPrev').attr("src","");
            $("#job_ordersForm").validator('destroy');
        });

        $('#inputStatus').select2(inputRoleConfig);
        $('#job_type').select2(inputRoleConfig);
        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#job_ordersModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#job_ordersForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/job_orders/get_job_orders_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#name").val(data.job_orders.name);
                    $("#code").val(data.job_orders.code);
                    $("#inputStatus").val(data.job_orders.status).trigger('change');
                    $("#job_ordersID").val(data.job_orders.id);
                    $("#job_orders_details").val(data.job_orders.job_orders_details);
                    $("#bank_address").val(data.job_orders.address);
                    $("#job_ordersModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteJob_orderModal .modal-title").html("Delete Job_order");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteJob_orderModal").modal("show");
    }
    
  
  

    $(document).ready(main);
</script>