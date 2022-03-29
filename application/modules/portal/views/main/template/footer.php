
<div class="modal fade" id="profileModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">My Profile</h3>
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="profileForm" data-toggle="validator">
                        <div class="box-body">
                          <div class="form-group">
                              <label for="inputProfilePhoto" class="col-sm-4 control-label">Profile Photo</label>

                              <div class="col-sm-8">
                              <input type="file" class="form-control" id="inputProfilePhoto" placeholder="Profile Photo">
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="inputProfileUsername" class="col-sm-4 control-label">Username</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileUsername" data-minlength="5" name="username" placeholder="Username" disabled>
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                         
                          <div class="form-group">
                              <label for="inputProfileFirstname" class="col-sm-4 control-label">Firstname</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileFirstname" placeholder="Firstname" required>
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileMiddlename" class="col-sm-4 control-label">Middlename</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileMiddlename" placeholder="Middlename">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileLastname" class="col-sm-4 control-label">Lastname</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileLastname" placeholder="Lastname"  required>
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileContact" class="col-sm-4 control-label">Contact Number</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileContact" placeholder="Contact Number">
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileBirthday" class="col-sm-4 control-label">Birthday</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileBirthday" placeholder="Birthday">
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileEmail" class="col-sm-4 control-label">Email Address</label>

                              <div class="col-sm-8">
                              <input type="email" class="form-control" id="inputProfileEmail" placeholder="Email Address">
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileAddress" class="col-sm-4 control-label">Address</label>

                              <div class="col-sm-8">
                              <textarea class="form-control" id="inputProfileAddress" placeholder="Address" style="resize:none"></textarea>
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfilePassword" class="col-sm-4 control-label">New Password</label>

                              <div class="col-sm-8">
                              <input type="password" class="form-control" data-minlength="8" id="inputProfilePassword" placeholder="Password">
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfilePassword2" class="col-sm-4 control-label">Validate Password</label>

                              <div class="col-sm-8">
                              <input type="password" class="form-control" data-minlength="8" id="inputProfilePassword2"  data-match="#inputProfilePassword" data-match-error="Whoops, these don't match" placeholder="Password">
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="inputProfileOldPassword" class="col-sm-4 control-label">Old Password Password</label>

                              <div class="col-sm-8">
                              <input type="password" class="form-control" id="inputProfileOldPassword" placeholder="Old Password" required>
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>  
                            <div class="form-group">
                                <div id="uploadBoxMainProfile" class="col-md-12">
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveProfile">Update Profile</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<script>

    $("body").removeClass("skin-blue").addClass("skin-green-light");
    $("#inputProfileBirthday").datepicker({
            format: 'yyyy-mm-dd'
            });
  $("#viewProfile").click(function(e){
    e.preventDefault();
        $.ajax({
                type: "post",
                url: "<?php echo base_url()."portal/main/get_profile_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#profileID").val(data.user_account.id);
                    $("#inputProfileUsername").val(data.user_account.username);
                    $("#inputProfileFirstname").val(data.user_profile.first_name);
                    $("#inputProfileMiddlename").val(data.user_profile.middle_name);
                    $("#inputProfileLastname").val(data.user_profile.last_name);
                    $("#inputProfileEmail").val(data.user_profile.email_address);
                    $("#inputProfileContact").val(data.user_profile.contact_number);
                    $("#inputProfileAddress").val(data.user_profile.address);
                    
                    $("#inputProfileBirthday").val(data.user_profile.birthday);
                    $("#inputProfilePassword").val("");
                    $("#inputProfilePassword2").val("");
                    $("#profileModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
  });

  $("#saveProfile").click(function(){
      $("#profileForm").submit();
  });
  $("#profileForm").validator().on('submit', function (e) {
           var btn = $("#saveProfile");
           btn.button("loading");
           if (e.isDefaultPrevented()) {
               btn.button("reset"); 
           } else {
                e.preventDefault();
                var username = $("#inputProfileUsername").val();
                var password = $("#inputProfilePassword2").val();
                var old_password = $("#inputProfileOldPassword").val();
                var first_name = $("#inputProfileFirstname").val();
                var middle_name = $("#inputProfileMiddlename").val();
                var last_name = $("#inputProfileLastname").val();
                var email_address = $("#inputProfileEmail").val();
                var contact_number = $("#inputProfileContact").val();
                var address = $("#inputProfileAddress").val();
                var birthday = $("#inputProfileBirthday").val();
                var user_id = $("#userID").val();
                var formData = new FormData();

                formData.append('profile_image', $('#inputProfilePhoto').prop("files")[0]);

                formData.append("username" , username);
                formData.append("password" , password);
                formData.append("old_password" , old_password);
                formData.append("first_name" , first_name);
                formData.append("middle_name" , middle_name);
                formData.append("last_name" ,  last_name);
                formData.append("email_address" , email_address);
                formData.append("contact_number" , contact_number);
                formData.append("address" , address);
              
                formData.append("birthday" , birthday);
               
              url =  "<?php echo base_url()."portal/main/update_profile";?>";
              message = "Profile successfully updated";
          
               $('#uploadBoxMainProfile').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMainProfile" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
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
                                
                                $('#progressBarMainProfile').css('width',percent+'%').html(percent+'%');
                                                                
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
                        $("#profileForm").validator('destroy');
                        $("#profileModal").modal("hide");
                        $('#uploadBoxMainProfile').html('');
                        window.location = "<?php echo base_url()."portal/logout";?>";        
                    }
                });              
           }
              return false;
       });
</script>
 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y");?> <a href="#"><?php echo SITE_NAME;?></a>.</strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
</body>
</html>
