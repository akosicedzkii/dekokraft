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
        <table id="roleList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Role</th>
            <th>Description</th>
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

<div class="modal fade" id="roleModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Role</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="roleID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="roleForm" data-toggle="validator">
                        <div class="box-body">
                        <div class="form-group">
                            <label for="inputRoleName" class="col-sm-4 control-label">Role Name</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputRoleName"  placeholder="Role Name" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription" class="col-sm-4 control-label">Description</label>

                            <div class="col-sm-8">
                            <textarea class="form-control" id="inputDescription" placeholder="Description" style="resize:none"></textarea>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                             <label for="inputDescription" class="col-sm-4 control-label">Role Modules</label>
                             <div class="col-sm-8">
                                    <b>Main Navigation</b>

                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="dashboard">
                                        Dashboard
                                        </label>
                                    </div>
                                    <b>Home</b>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="products">
                                        Products
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="product_variants">
                                        Product Variants
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="product_profiles">
                                        Product Profiles
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="proto_molds">
                                        Proto and Molds
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="colors">
                                        Colors
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="materials">
                                        Materials
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="invoices">
                                        Invoices
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="banks">
                                        Banks
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="payment_terms">
                                        Payment Terms
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="customers">
                                        Customers
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="subcon">
                                        Subcon
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="marketing_order">
                                        Marketing Order
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="purchase_orders">
                                        Purchase Order
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="job_orders">
                                        Job Order
                                        </label>
                                    </div>
                                    <b>System Administrator</b>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="roles">
                                        Roles
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="users">
                                        Users
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="site_settings">
                                        Site Settings
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="modules" value="logs">
                                        Logs
                                        </label>
                                    </div>

                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputDescription" class="col-sm-4 control-label">Default Page</label>

                            <div class="col-sm-8">
                            <select id="inputDefaultPage">
                                <option value="dashboard">Dashboard</option>
                                <option value="products">Product Categories</option>
                                <option value="product_variants">Product Variants</option>
                                <option value="invoices">Invoices</option>
                                <option value="proto_molds">Proto and Molds</option>
                                <option value="colors">Colors</option>
                                <option value="materials">Materials</option>
                                <option value="roles">Roles</option>
                                <option value="users">Users</option>
                                <option value="achievements">Achievements</option>
                                <option value="site_settings">Site Settings</option>
                                <option value="logs">Logs</option>
                            </select>
                            <div class="help-block with-errors" id="errorDefault"></div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <div id="uploadBoxMain" class="col-md-12">
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveRole">Save Role</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteRoleModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Role</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteRole">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $("#inputDefaultPage").select2();
    var main = function(){
        var table = $('#roleList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."portal/roles/get_roles_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
                { "visible": false,  "targets": [ 0 ] }
            ], "order": [[ 3, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#roleModal .modal-title").html("Add <?php echo rtrim(ucfirst($module_name),"s");?>");
            $("#action").val("add");  
            $('#roleForm').validator();
            $("#roleModal").modal("show");
        });

        $("#saveRole").click(function(){
            $("#roleForm").submit();
        });
        
        $("#roleForm").validator().on('submit', function (e) {
            var ids = [];
            var is_default_in_selected = 0;
            $('#modules:checked').each(function(i, e) {
                ids.push($(this).val());
                if($(this).val() == $("#inputDefaultPage").val())
                {
                    is_default_in_selected = 1;
                }
            });
            console.log(ids.join());
            if(is_default_in_selected == 0)
            {
                $("#errorDefault").html("<span style='color:red;'>Please select one checked on the role modules.</span>");
                return false;
            }
            else
            {
                $("#errorDefault").html("");
            }
            var btn = $("#saveRole");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var name = $("#inputRoleName").val();
                var default_page = $("#inputDefaultPage").val();
                var description = $("#inputDescription").val();
                var role_modules = ids.join();
                var role_id = $("#roleID").val();
                if( name == "" )
                {
                    btn.button("reset"); 
                    return false;
                }
                var data = {
                    "role_id" : role_id,
                    "name" : name,
                    "description" : description,
                    "role_modules" : role_modules,
                    "default_page" : default_page
                };
                
                var url = "<?php echo base_url()."portal/roles/add_role";?>";
                var message = "New role successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/roles/edit_role";?>";
                    message = "Role successfully updated";
                }

                $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
                $.ajax({
                    data: data,
                    type: "post",
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
                        $('#uploadBoxMain').html('<div id="progressOverlay"><div class="progress progress-striped"><div class="bar" id="progressBar" style="width: 0%;">0%</div></div></div>');       

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
                        $("#roleForm").validator('destroy');
                        $("#roleModal").modal("hide");
                        $(".select2-inputRole-container").attr("html", "--- Select Item ---"); 
                        $(".select2-inputRole-container").attr("title", "--- Select Item ---"); 
                        $('#uploadBoxMain').html('');      
                    }
                });

            }
               return false;
        });

        $("#deleteRole").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                    data: data,
                    type: "post",
                    url: "<?php echo base_url()."portal/roles/delete_role";?>",
                    success: function(data){
                        //alert("Data Save: " + data);
                        btn.button("reset");
                        table.draw("page");
                        $("#deleteRoleModal").modal("hide");
                        toastr.error('Role ' + deleteItem + ' successfully deleted');
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
                });
        });

        $('#roleModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input[type=email],input[type=text],input[type=password],input[type=number],textarea,select")
                .val('')
                .end();
            $(this).find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#roleForm").validator('destroy');
        });

        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#roleModal .modal-title").html("Edit <?php echo rtrim(ucfirst($module_name),"s");?>");     
        $("#action").val("edit"); var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/roles/get_role_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#roleID").val(data.roles.id);
                    $("#inputRoleName").val(data.roles.role_name);
                    $("#inputDescription").val(data.roles.description);
                    $("#inputDefaultPage").val(data.roles.default_page).trigger("change");
                    data.role_modules.forEach(function(entry) {
                        $(":checkbox[value='"+entry+"']").prop("checked","true");
                    });
                    $("#roleModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteRoleModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteRoleModal").modal("show");
    }
    $(document).ready(main);
</script>