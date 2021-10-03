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
        <table id="userList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Usertype</th>
            <th>Date Created</th>
            <th>Created By</th>
            <th>Date Modified</th>
            <th>Modified By</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <!--<tr>
            <td>Cedzkii</td>
            <td>Cederic Ferrer Martinez</td>
            <td>Admin</td>
            <td>
                <a href="#" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>
                <a href="#" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
                <a href="#" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>
            </td>
        </tr>-->
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>

<div class="modal fade" id="userModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add User</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="userID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="userForm" data-toggle="validator">
                        <div class="box-body">
                        <div class="form-group">
                            <label for="inputUsername" class="col-sm-4 control-label">Username</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputUsername" data-minlength="5" name="username" placeholder="Username" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group add">
                            <label for="inputPassword" class="col-sm-4 control-label">Password</label>

                            <div class="col-sm-8">
                            <input type="password" class="form-control" data-minlength="8" id="inputPassword" placeholder="Password" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group add">
                            <label for="inputPassword2" class="col-sm-4 control-label">Validate Password</label>

                            <div class="col-sm-8 add">
                            <input type="password" class="form-control" data-minlength="8" id="inputPassword2"  data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Password" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputFirstname" class="col-sm-4 control-label">Firstname</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputFirstname" placeholder="Firstname" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMiddlename" class="col-sm-4 control-label">Middlename</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputMiddlename" placeholder="Middlename">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputLastname" class="col-sm-4 control-label">Lastname</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputLastname" placeholder="Lastname"  required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputBirthday" class="col-sm-4 control-label">Birthday</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputBirthday" placeholder="Birthday">
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputContact" class="col-sm-4 control-label">Contact Number</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputContact" placeholder="Contact Number">
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-4 control-label">Email Address</label>

                            <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email Address" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="col-sm-4 control-label">Address</label>

                            <div class="col-sm-8">
                            <textarea class="form-control" id="inputAddress" placeholder="Address" style="resize:none"></textarea>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userRole" class="col-sm-4 control-label">User Role</label>

                            <div class="col-sm-8">
                            <select class="form-control" id="inputRole" required>
                                <option value=""></option>
                                <?php 
                                    if($roles != null){
                                        foreach($roles as $row){
                                            ?>
                                                <option value="<?php echo $row->id;?>"><?php echo $row->role_name;?></option>
                                            <?php
                                        }
                                    }
                                  ?>
                            </select>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus" class="col-sm-4 control-label">Address</label>

                            <div class="col-sm-8">
                                <select class="form-control" id="inputStatus" required>
                                    <option value="1">Enabled</option>
                                    <option value="0">Disabled</option>
                                    <option value="2">Unverified</option>
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
            <button type="button" class="btn btn-primary" id="saveUser">Save User</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteUserModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete User</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteUser">Delete</button>
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
        $("#inputBirthday").datepicker({
            format: 'yyyy-mm-dd'
            });
        var table = $('#userList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, responsive: true,
            "ajax" : "<?php echo base_url()."portal/users/get_user_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return data +' '+ row[3]+' '+row[4];
                },
                "targets": 2
            },
            { "visible": false,  "targets": [ 3 ] },
            { "visible": false,  "targets": [ 4 ] },
            { "visible": false,  "targets": [ 0 ] }
        ], "order": [[ 6, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#userModal .modal-title").html("Add <?php echo rtrim(ucfirst($module_name),"s");?>");
            $("#action").val("add");
            $("#inputUsername").attr("data-remote","<?php echo base_url()."portal/users/check_username_exist?method=add";?>");
            $(".add").show();     
            $('#userForm').validator();
            $("#userModal").modal("show");
        });

        $("#saveUser").click(function(){
            $("#userForm").submit();
        });
        $("#userForm").validator().on('submit', function (e) {
           
            var btn = $("#saveUser");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var username = $("#inputUsername").val();
                var password = $("#inputPassword2").val();
                var password1 = $("#inputPassword").val();
                var first_name = $("#inputFirstname").val();
                var middle_name = $("#inputMiddlename").val();
                var last_name = $("#inputLastname").val();
                var email_address = $("#inputEmail").val();
                var contact_number = $("#inputContact").val();
                var address = $("#inputAddress").val();
                var role = $("#inputRole").val();
                var user_id = $("#userID").val();
                var birthday = $("#inputBirthday").val();
                var status = $("#inputStatus").val();
                if(username == "" ||  password == "" || first_name == "" || last_name == "" || email_address == "" || role == "")
                {
                    btn.button("reset"); 
                    return false;
                }
                if(password1 != password)
                {
                    btn.button("reset"); 
                    return false;
                }
                if(password1.length < 5 || password.length < 8)
                {
                    btn.button("reset"); 
                    return false;
                }
                var data = {
                    "user_id" : user_id,
                    "username" : username,
                    "password" : password,
                    "first_name" : first_name,
                    "middle_name" : middle_name,
                    "last_name" :  last_name,
                    "email_address" : email_address,
                    "contact_number" : contact_number,
                    "address" : address,
                    "role" : role,
                    "status" : status,
                    "birthday" : birthday
                };
                
                var url = "<?php echo base_url()."portal/users/add_user";?>";
                var message = "New user successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/users/edit_user";?>";
                    message = "User successfully updated";
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
                         $("#userForm").validator('destroy');
                         $("#userModal").modal("hide");
                         $(".select2-inputRole-container").attr("html", "--- Select Item ---"); 
                         $(".select2-inputRole-container").attr("title", "--- Select Item ---"); 
                         $("#inputRole").select2("val", "null");
                         $('#uploadBoxMain').html('');   
                         $("#userForm").modal("hide");      
                    }
                });

            }
               return false;
        });

        $("#deleteUser").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/users/delete_user";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteUserModal").modal("hide");
                            toastr.error('User ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#userModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });
        $('#inputStatus').select2(inputRoleConfig);
        $('#inputRole').select2(inputRoleConfig);
        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#userModal .modal-title").html("Edit <?php echo rtrim(ucfirst($module_name),"s");?>");
        $(".add").hide();    
        $('#userForm').validator();    
        $("#action").val("edit");
        $("#inputUsername").attr("data-remote","<?php echo base_url()."portal/users/check_username_exist?method=edit&user_id=";?>" + id);
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/users/get_user_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#userID").val(data.user_account.id);
                    $("#inputUsername").val(data.user_account.username);
                    $("#inputPassword").val("this is not the real password");
                    $("#inputPassword2").val("this is not the real password");
                    $("#inputFirstname").val(data.user_profile.first_name);
                    $("#inputMiddlename").val(data.user_profile.middle_name);
                    $("#inputLastname").val(data.user_profile.last_name);
                    $("#inputEmail").val(data.user_profile.email_address);
                    $("#inputContact").val(data.user_profile.contact_number);
                    $("#inputAddress").val(data.user_profile.address);
                    $("#inputBirthday").val(data.user_profile.birthday);
                    $("#inputRole").select2(inputRoleConfig).val(data.user_account.role_id).trigger("change");
                    $("#inputStatus").select2(inputRoleConfig).val(data.user_account.status).trigger("change");
                    $("#userModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteUserModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteUserModal").modal("show");
    }
    $(document).ready(main);
</script>