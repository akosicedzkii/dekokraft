<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php $module_name = str_replace("_", " ", $module_name);echo ucfirst(str_replace("_", " ", $module_name));?>
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
            <th>Subcon</th>
            <th>MO#</th>
            <th>Deadline</th>
            <th>Remarks</th>
            <th>Job Type</th>
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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="marketing_order" class="col-sm-6 control-label">Marketing Order</label>

                                        <div class="col-sm-6">
                                        <select type="text" style="width:150px;" class="form-control" id="marketing_order" placeholder="Marketing Order" required><option value="">Select Marketing Order</option></select>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="subcon" class="col-sm-6 control-label">Subcon</label>

                                        <div class="col-sm-6">

                                        <select type="text"  style="width:150px;" class="form-control" id="subcon" placeholder="Subcon" required><option value="">Select Subcon</option></select>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                <label for="option" class="col-sm-6 control-label">Job Type</label>

                                <div class="col-sm-6">
                                <select class="form-control" id="job_type" placeholder="Job Type" style="resize:none" required>

                                    <option value="resin">Resin</option>
                                    <option value="finishing">Finishing</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>



                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="deadline" class="col-sm-6 control-label">Deadline</label>

                                        <div class="col-sm-6">
                                        <input type="date" style="width:150px;" class="form-control" id="deadline" placeholder="Deadline" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_created" class="col-sm-6 control-label">Date Created</label>

                                        <div class="col-sm-6">
                                        <input type="date" style="width:150px;" class="form-control" id="date_created" placeholder="Date Created" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>


                            <div class="form-group">

                                <div class="col-sm-12">
                                <table class="table responsive">
                                    <thead>
                                        <th>Select</th>
                                        <th>Quantity</th>
                                        <th>Product Name</th>
                                        <th>Product Color</th>
                                        <th>JO Count</th>
                                    </thead>
                                    <tbody id="table_body">
                                    </tbody>
                                </table>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="remarks" class="col-sm-2 control-label">Job Order Remarks</label>

                                <div class="col-sm-10">

                                <textarea type="text" class="form-control" id="remarks" placeholder="Job Order Remarks" required></textarea>
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


<!-- /.modal -->
<div class="modal fade" id="completeJob_orderModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

             <h3 class="modal-title">Complete Job Order</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="completeKey">
                <center><h4>Are you sure to complete JO#: <label id="completeItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="completeJob_order">Save</button>
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
            { "width": "20%",  "targets": [ 5 ] }
        ], "order": [[ 8, 'desc' ]]
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
            var selected = [];
            var jo_count_values = [];
            $.each($("input[name='jo_item']:checked"), function(e){
                selected.push($(this).val());
                jo_count_values.push($(this).parent().parent().find('input[type=number]').val());
            });

            var btn = $("#saveJob_order");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset");
            } else {
                e.preventDefault();

                var job_orders_id = $("#job_ordersID").val();


                var formData = new FormData();
                formData.append('id', job_orders_id);
                formData.append('marketing_order', $("#marketing_order").val());
                formData.append('subcon', $("#subcon").val());
                formData.append('deadline', $("#deadline").val());
                formData.append('date_created', $("#date_created").val());
                formData.append('job_type', $("#job_type").val());
                formData.append('remarks', $("#remarks").val());
                formData.append('selected_items',selected)
                formData.append('jo_count_values',jo_count_values)
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
                    if(data!=true)
                    {
                         $('#uploadBoxMain').html('');
                        btn.button("reset");

                        toastr.error(JSON.parse(data).warning);
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

        initialize_selects()
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
        $("#completeJob_order").click(function(){
            var btn = $(this);
            var id = $("#completeKey").val();
            var completeItem = $("#completeItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/job_orders/complete_job_orders";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#completeJob_orderModal").modal("hide");
                            toastr.success('Job Order ' + completeItem + ' successfully completed');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });
        
        $("#date_created").val("<?php echo date("Y-m-d");?>");
        $('#job_ordersModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#job_type").val('spray').trigger('change');
            $("#marketing_order").val('').trigger('change');
            $("#subcon").val('').trigger('change');
            $('#inputCoverImage').val("");
            $('#coverImgPrev').attr("src","");
            $("#table_body").html("");
            $("#remarks").val("");
            $("#deadline").val("");
            $("#date_created").val("<?php echo date("Y-m-d");?>");
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
    function initialize_selects()
    {
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
            //console.log(data);
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
                        counters = 1;
                        data.forEach(function(e){
                            //console.log(e["color"])
                            $("#table_body").append("<tr><td>"+counters+".&emsp;<input type=checkbox name='jo_item' value='" + e["id"]+"' /></td><td>" + e["quantity"]+ "</td><td>" + e["description"]+ "</td><td>" + e["color"]+ "</td><td><input class='form-control' type=number name='jo_count' value="+e["quantity"]+" min=1 max="+e["jo_count"]+" /></td></tr>");
                            counters++;
                        });

                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
            });
        });
    }
    function _edit(id)
    {
        $("#job_ordersModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();
        $('#job_ordersForm').validator();
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        var data = { "id" : id ,"job_type":$("#job_type_option").val()}
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/job_orders/get_job_orders_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    //console.log(data);
                        $("#table_body").html("");
                    $("#marketing_order").append(new Option(data.marketing_order.id,data.marketing_order.id,  true, true)).trigger('change');
                    if(data.subcon!=null){
                        $("#subcon").append(new Option(data.subcon.name,data.subcon.id,  true, true)).trigger('change');
                    }
                   
                    $("#job_ordersID").val(data.job_orders.id);
                    $("#remarks").val(data.job_orders.remarks);
                    $("#deadline").val(data.job_orders.deadline);
                    $("#date_created").val(data.job_orders.date_created);
                    $("#job_type").val(data.job_orders.job_type).trigger('change');
                        data2 = data.invoice_lines;
                        data3 = data.jo_lines;
                        counters = 1;
                        data2.forEach(function(e){
                            selected = 0;
                            data3.forEach(function(e2){
                                if(e["id"] == e2["invoice_line_id"])
                                {
                                    counts = e2["jo_count"];
                                    if(e2["jo_count"] == 0)
                                    {
                                        counts = e["quantity"];
                                    }
                                     $("#table_body").append("<tr><td>"+counters+".&emsp;<input checked type=checkbox name='jo_item' value='" + e["id"]+"' /></td><td>" + e["quantity"]+ "</td><td>" + e["description"]+ "</td><td>" + e["color"]+ "</td><td><input class='form-control' type=number name='jo_count' min=1  value="+counts+" max="+ e["quantity"]+" /></td></tr>");
                                        selected = 1;
                                        return false;
                                }
                            });
                            if(selected == 0)
                            {
                                $("#table_body").append("<tr><td>"+counters+".&emsp;<input type=checkbox name='jo_item' value='" + e["id"]+"' /></td><td>" + e["quantity"]+ "</td><td>" + e["description"]+ "</td><td>" + e["color"]+ "</td><td><input class='form-control' value="+ e["quantity"]+" type=number name='jo_count' min=1 max="+ e["quantity"]+" /></td></tr>");
                            }
                            counters++;
                        });
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

    function _complete(id,item)
    {
        $("#completeJob_orderModal .modal-title").html("Complete Job Order");
        $("#completeItem").html(item);
        $("#completeKey").val(id);
        $("#completeJob_orderModal").modal("show");
    }


    $(document).ready(main);
</script>
