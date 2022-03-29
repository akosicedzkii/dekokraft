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
        <table id="colorsList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Color Name</th>
            <th>Color Code</th>
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

<div class="modal fade" id="colorsModal" role="dialog"  data-backdrop="static">
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
                                
                                <input type="text" class="form-control" id="code" placeholder="Color Code" required>
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
            <button type="button" class="btn btn-primary" id="saveColors">Save Colors</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteColorsModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Colors</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteColors">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="addColorsCompositionModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Color Composition for <label id="color_name"></label></h3>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" id="colorCompositionAdd" data-toggle="validator">
                    <input type="hidden" id="action">
                    <input type="hidden" name="color_id"  id="color_id">
                    <div class="box-body"> 
                        <div class="form-group">
                            <a href="#" class="btn btn-success" onclick="return false;" id="add_material_btn">Add Material</a>
                            <a href="#" class="btn btn-info pull-right" onclick="return false;" id="add_new_material_btn">Add New Material</a>
                            <table class="table">
                                <thead>
                                    <th>Material</th>
                                    <th>JP</th>
                                    <th>QTY</th>
                                    <th>Unit</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="tbody_materials">
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <div id="uploadBoxMain" class="col-md-12">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="saveColorCompositions">Save Color Composition</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="materialsModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Materials</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="materialsID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="materialsForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="material_name" class="col-sm-2 control-label">Material Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="material_name" placeholder="Material Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jp" class="col-sm-2 control-label">JP</label>

                                <div class="col-sm-10">
                                
                                <select class="form-control" id="jp" placeholder="JP" style="resize:none" required>
                                    <option value="FA">FA</option>
                                    <option value="FB">FB</option>
                                    <option value="FC">FC</option>
                                    <option value="M">M</option>
                                    <option value="R">R</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="unit" class="col-sm-2 control-label">Unit</label>

                                <div class="col-sm-10">
                                
                                <select class="form-control" id="unit" placeholder="Unit" style="resize:none" required>
                                    <option value="GM">GM</option>
                                    <option value="ML">ML</option>
                                    <option value="IN">IN</option>
                                    <option value="PC">PC</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cost" class="col-sm-2 control-label">Cost</label>

                                <div class="col-sm-10">
                                
                                <input  type="number" min="0" step="any" class="form-control" id="cost" placeholder="Cost" required>
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
            <button type="button" class="btn btn-primary" id="saveMaterials2">Save Materials</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<script>

    var inputRoleConfig = {
        dropdownAutoWidth : true,
        width: 'auto',
        placeholder: "--- Select Item ---"
    };


    var main = function(){
        var table = $('#colorsList').DataTable({
            "language": {                
                "infoFiltered": ""
            },  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."portal/colors/get_colors_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ], "order": [[ 4, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#colorsModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#colorsForm').validator();
            $("#colorsModal").modal("show");
        });

        $("#saveColors").click(function(){
            $("#colorsForm").submit();
        });

        var image_correct = true;
        var image_error = "";
        $("#colorsForm").validator().on('submit', function (e) {
           
            var btn = $("#saveColors");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var name = $("#name").val();
                var code = $("#code").val();
                var status = $("#inputStatus").val();
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
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/colors/edit_colors";?>";
                    message = "Colors successfully updated";
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
                         $("#colorsForm").validator('destroy');
                         $("#colorsModal").modal("hide"); 
                         $('#uploadBoxMain').html('');          
                    }
                });
            }
               return false;
        });

        $("#deleteColors").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/colors/delete_colors";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteColorsModal").modal("hide");
                            toastr.error('Colors ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#colorsModal').on('hidden.bs.modal', function (e) {
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
            $("#colorsForm").validator('destroy');
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
        $("#colorsModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#colorsForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/colors/get_colors_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#name").val(data.colors.name);
                    $("#code").val(data.colors.code);
                    $("#inputStatus").val(data.colors.status).trigger('change');
                    $("#colorsID").val(data.colors.id);
                    $("#colorsModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteColorsModal .modal-title").html("Delete Colors");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteColorsModal").modal("show");
    }
    
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/colors/"?>"+img_src);
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
            "ajax" : "<?php echo base_url()."portal/media/get_media_list?module=colors";?>",
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
    function _view(id,name)
    {
        material_counter = 1;
        data= {"id":id}
        $("#color_id").val(id);
        $("#color_name").html(name);
        $.ajax({
            data: data,
            type: "post",
            url: "<?php echo base_url()."portal/colors/get_materials_of_color";?>",
            success: function(data){
                //alert("Data Save: " + data);
                $("#tbody_materials").html("");
                data = JSON.parse(data);
                console.log(data)
                var arrayLength = data["color_materials"].length;
                for (var i = 0; i < arrayLength; i++) {
                    $("#tbody_materials").append("<tr><td><input type='hidden' value='"+data["color_materials"][i]["material_id"]+"' name='selected_material[]'><select required style='width:300px;' id='mat_"+material_counter+"'></select></td><td><label class='mat_jp'>"+data["color_materials"][i]["jp"]+"</label></td><td><input type='number' value='"+data["color_materials"][i]["qty"]+"' name='qty[]' required></td><td><label class='mat_unit'>"+data["color_materials"][i]["unit"]+"</label></td><td><a href='#'  class='btn btn-danger remove_item' >&times;</a></td></tr>");
                    $("#mat_"+material_counter).select2({
                        minimumInputLength: 2,
                        ajax: {
                            url: "<?php echo base_url()."portal/materials/get_materials_selection";?>",
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
                    $('#mat_'+ material_counter).append(new Option(data["color_materials"][i]["material_name"],data["color_materials"][i]["materia_id"],  true, true)).trigger('change');

                    $("#tbody_materials").on("click", ".remove_item", function() {
                        $(this).closest("tr").remove();
                    });

                    $('#mat_'+ material_counter).on('select2:select', function (e) {
                        var data = e.params.data;
                        console.log(data)
                        var $row = $(this).closest("tr");
                        console.log($row)
                        $row.find('input[name="selected_material[]"]').val(data.id);
                        $row.find(".mat_jp").html(data.jp);
                        $row.find(".mat_unit").html(data.unit);
                    });
                    material_counter++;
                }
            }
        });
        
        $("#addColorsCompositionModal").modal("show");
    }

    
    material_counter = 1;
    $("#add_material_btn").click(function(){
        $("#tbody_materials").append("<tr><td><input type='hidden' name='selected_material[]'><select style='width:300px;' id='mat_"+material_counter+"'></select></td><td><label class='mat_jp'></label></td><td><input type='number' name='qty[]'></td><td><label class='mat_unit'></label></td><td><a href='#'  class='btn btn-danger remove_item' >&times;</a></td></tr>");

        $("#mat_"+material_counter).select2({
            minimumInputLength: 2,
            ajax: {
                url: "<?php echo base_url()."portal/materials/get_materials_selection";?>",
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
        $('#mat_'+ material_counter).on('select2:select', function (e) {
            var data = e.params.data;
            console.log(data)
            var $row = $(this).closest("tr");
            console.log($row)
            $row.find('input[name="selected_material[]"]').val(data.id);
            $row.find(".mat_jp").html(data.jp);
            $row.find(".mat_unit").html(data.unit);
        });
        material_counter= material_counter +1;
    });
    $("#tbody_materials").on("click", ".remove_item", function() {
        $(this).closest("tr").remove();
    });
    

    
$("#saveColorCompositions").click(function(){
    var btn=$("#saveColorCompositions");
    console.log($("#colorCompositionAdd").serialize());
    $.ajax({
    data: $("#colorCompositionAdd").serialize(),
    type: "get",
    processData: false,
    contentType: false,
    cache: false,
    url: "<?php echo base_url()."portal/colors/insert_color_materials";?>" , 
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
            toastr.success("Color Composition Added Successfully");
            // setTimeout(() => {
            //             window.location = "";
            //         }, 1000);
            $("#addColorsCompositionModal").modal("hide"); 
    }
});
});

$("#saveMaterials2").click(function(){
$("#materialsForm").submit();
});

var image_correct = true;
var image_error = "";
$("#materialsForm").validator().on('submit', function (e) {
    
    var btn = $("#saveMaterials2");
    var action = $("#action").val();
    btn.button("loading");
    if (e.isDefaultPrevented()) {
        btn.button("reset"); 
    } else {
        e.preventDefault();
        var material_name = $("#material_name").val();
        var cost = $("#cost").val();
        var unit = $("#unit").val();
        var jp = $("#jp").val();
        var status = $("#inputStatus").val();
        var materials_id = $("#materialsID").val();

        if(material_name == "" || cost == "")
        {
            btn.button("reset"); 
            return false;
        }

        var formData = new FormData();
        formData.append('id', materials_id);
        formData.append('material_name', material_name);
        formData.append('cost', cost);
        formData.append('unit', unit);
        formData.append('status', status);
        formData.append('jp', jp);
        // Attach file
            //fromthis    
            var url = "<?php echo base_url()."portal/materials/add_materials";?>";
        var message = "New materials successfully added";
        if(action == "edit")
        {
            url =  "<?php echo base_url()."portal/materials/edit_materials";?>";
            message = "Materials successfully updated";
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
                    toastr.success(message);
                    $("#materialsForm").validator('destroy');
                    $("#materialsModal").modal("hide"); 
                    $('#uploadBoxMain').html('');          
            }
        });
    }
        return false;
});
$("#add_new_material_btn").click(function(){
    $("#materialsModal .modal-title").html("Add New Material");
    $("#action").val("add");
    $("#inputCoverImage").attr("required","required");
    $('#materialsForm').validator();
    $("#materialsModal").modal("show");
});
$('#materialsModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#inputStatus").val('1').trigger('change');
            $("#jp").val('FA').trigger('change');
            $("#unit").val('GM').trigger('change');
            $('#inputCoverImage').val("");
            $('#coverImgPrev').attr("src","");
            $("#materialsForm").validator('destroy');
        });

    $(document).ready(main);
</script>