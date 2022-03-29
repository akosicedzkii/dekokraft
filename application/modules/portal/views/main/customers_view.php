<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo ucfirst($module_name);?>
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
        <table id="customersList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Company Name</th>
            <th>ATTN</th>
            <th>Customer Address</th>
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

<div class="modal fade" id="customersModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add customers</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="customersID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="customersForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="customer_name" class="col-sm-2 control-label">Customers Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="customer_name" placeholder="Customer Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="company_name" class="col-sm-2 control-label">Company Name</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="company_name" placeholder="Customers Code" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="attn" class="col-sm-2 control-label">ATTN</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="attn" placeholder="ATTN" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_mobile" class="col-sm-2 control-label">Customer Mobile Number</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="customer_mobile" placeholder="Customer Mobile Number" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="customer_fax" class="col-sm-2 control-label">Customers Fax Number</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="customer_fax" placeholder="Customers Fax Number" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="customer_email" class="col-sm-2 control-label">Customers Email Address</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="customer_email" placeholder="Customer Email Address" >
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="customer_address" class="col-sm-2 control-label">Customer Address</label>

                                <div class="col-sm-10">
                                
                                <textarea type="text" class="form-control" id="customer_address" placeholder="Customer Address" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="state" class="col-sm-2 control-label">State</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="state" placeholder="State" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city" class="col-sm-2 control-label">City</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="city" placeholder="City" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="country" class="col-sm-2 control-label">Country</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="country" placeholder="Country" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="postal_code" class="col-sm-2 control-label">Postal Code</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="postal_code" placeholder="Postal Code" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputStatus" class="col-sm-2 control-label">Status</label>

                                <div class="col-sm-10">
                                <select class="form-control" id="inputStatus" placeholder="Content" style="resize:none" required>
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
            <button type="button" class="btn btn-primary" id="savecustomers">Save customers</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deletecustomersModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Customers</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deletecustomers">Delete</button>
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
        var table = $('#customersList').DataTable({
            "language": {                
                "infoFiltered": ""
            },  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."portal/customers/get_customers_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ], "order": [[ 4, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#customersModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#customersForm').validator();
            $("#customersModal").modal("show");
        });

        $("#savecustomers").click(function(){
            $("#customersForm").submit();
        });

        var image_correct = true;
        var image_error = "";
        $("#customersForm").validator().on('submit', function (e) {
           
            var btn = $("#savecustomers");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var formData = new FormData();
                formData.append('id',$("#customersID").val());
                formData.append('customer_name',$("#customer_name").val());
                formData.append('attn',$("#attn").val());
                formData.append('customer_address',$("#customer_address").val());
                formData.append('customer_mobile',$("#customer_mobile").val());
                formData.append('customer_fax',$("#customer_fax").val());
                formData.append('customer_email',$("#customer_email").val());
                formData.append('company_name',$("#company_name").val());
                formData.append('state',$("#state").val());
                formData.append('city',$("#city").val());
                formData.append('country',$("#country").val());
                formData.append('postal_code',$("#postal_code").val());
                formData.append('status',$("#inputStatus").val());
                // Attach file
                 //fromthis    
                 var url = "<?php echo base_url()."portal/customers/add_customers";?>";
                var message = "New customers successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/customers/edit_customers";?>";
                    message = "customers successfully updated";
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
                         $("#customersForm").validator('destroy');
                         $("#customersModal").modal("hide"); 
                         $('#uploadBoxMain').html('');          
                    }
                });
            }
               return false;
        });

        $("#deletecustomers").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/customers/delete_customers";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deletecustomersModal").modal("hide");
                            toastr.error('customers ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#customersModal').on('hidden.bs.modal', function (e) {
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
            $("#customersForm").validator('destroy');
        });

        $('#inputStatus').select2(inputRoleConfig);
        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#customersModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#customersForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/customers/get_customers_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    console.log(data)
                    $("#inputStatus").val(data.customers.status).trigger('change');
                    $("#customersID").val(data.customers.id);
                    $("#customer_name").val(data.customers.customer_name);
                    $("#customer_address").val(data.customers.customer_address);
                    $("#attn").val(data.customers.attn);
                    $("#customer_mobile").val(data.customers.customer_mobile);
                    $("#customer_fax").val(data.customers.customer_fax);
                    $("#customer_email").val(data.customers.customer_email);
                    $("#company_name").val(data.customers.company_name);
                    $("#state").val(data.customers.state);
                    $("#city").val(data.customers.city);
                    $("#country").val(data.customers.country);
                    $("#postal_code").val(data.customers.postal_code);
                    $("#customersModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deletecustomersModal .modal-title").html("Delete customers");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deletecustomersModal").modal("show");
    }
    
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/customers/"?>"+img_src);
        $("#imgPreviewModal").modal("show");
    }

    
    
    function set_image_loader(var_holder,file_holder)
    {
        $("#var_holder").val(var_holder);
        $("#file_holder").val(file_holder);
        $("#mediaGalleryModal").modal("show");
    }

    var new_table = $('#imageGalleryTable').DataTable({  
            "language": {                
                "infoFiltered": ""
            },
            "processing" : true,
            "serverSide" : true,
            "searching" : false,
            "pageLength": 10, "bLengthChange": false,
            "ajax" : "<?php echo base_url()."portal/media/get_media_list?module=customers";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 1 ] }
        ], "order": [[ 0, 'desc' ]]
        });

    $('#galleryFormUpload').ajaxForm( {
            dataType : 'json',
            beforeSubmit: function() {
                $("#startUpload").button("loading");
                $('#uploadBox').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
            },
            uploadProgress: function ( event, position, total, percentComplete ) {
                if (percentComplete == 100) {
                    $('#progressBar').css('width',percentComplete+'%').html('Processing...');
                } else {
                    $('#progressBar').css('width',percentComplete+'%').html(percentComplete+'%');
                }
            },
            success: function(data){
                
                if(!data)
                {
                    $("#startUpload").button("reset");
                    toastr.error(data);
                }
                else
                {   
                    $("#startUpload").button("reset");
                    new_table.draw();
                    toastr.success("Upload Complete");
                    $('#uploadBox').html('<div id="progressOverlay"><div class="progress progress-striped"><div class="bar" id="progressBar" style="width: 0%;">0%</div></div></div>');       
                    $("#media_file").val('');     
                    $('#uploadBox').html("");
                }
            
            },
            error: function (request, status, error) {
                $("#startUpload").button("reset");
                toastr.error(request.responseText);
            }
    });

    $("#selectImage").click(function(){
        $("#"+$("#var_holder").val()).val($('input[name=selected_image]:checked').val());
        $("#"+$("#file_holder").val()).attr("src",$('input[name=selected_image]:checked').attr("data"));
        $("#mediaGalleryModal").modal("hide"); 
        new_table.draw();
    });

    function _delete_media(id,file_name)
    {
        $("#imgPreviewDel").attr("src",file_name);
        $("#deleteImage").val(id);
        $("#deleteImageModal").modal("show");
    }

    $("#deleteImageBtn").click(function(){
        var btn = $(this);
        var id = $("#deleteImage").val();
        var data = { "id" : id };
        btn.button("loading");

        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/media/delete_media";?>",
                success: function(data){
                    //alert("Data Save: " + data);
                    btn.button("reset");
                    new_table.draw('page');
                    $("#deleteImageModal").modal("hide");
                    toastr.error('Image successfully deleted');
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    });

    $(document).ready(main);
</script>