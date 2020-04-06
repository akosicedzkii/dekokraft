<div class="content-wrapper" style="min-height: 1135.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Profile
        <!-- <small>#007612</small> --> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Profile</li>
      </ol>
    </section>

  
    <form id="product_profile_form">
        <!-- Main content -->
        <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
            <h2 class="page-header">
                <!-- <i class="fa fa-globe"></i>--> <?php echo SITE_NAME;?> 
                <small class="pull-right">Date: <?php echo date("m/d/Y");?></small>
            
            </h2>
            <!-- /.col --> 
        </div>
        <br>
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                <center><img style="width:25%;" src="<?php echo base_url("uploads/product_variants/").$product_variants->cover_image;?>" class="image"></center>
            </div>
            <div class="col-sm-6 invoice-col">
                <table class="table" id="listing">
                    <tr><td>Class: </td><td><?php echo $product_variants->class;?></td></tr>
                    <tr><td>Stock #: </td><td><?php echo $product_variants->code. "-".$product_variants->color_abb;?></td></tr>
                    <tr><td>Desc: </td><td><?php echo $product_variants->description;?></td></tr>
                    <tr><td>Color: </td><td><?php echo $product_variants->color;?></td></tr>
                    <tr><td>Target Wgt.: </td><td><input type='text' id="weight" style="width:300px;" value="<?php echo $net_weight;?>" class="form-control"></td></tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                </br>
                </br>
                <center><a href="#"  onclick="return false;" id="add_material_group" class="btn btn-success">Add Material List</a></center>
                <br>
                <br>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-md-12 invoice-col">
                <table id="material_list_tbl" class="table" style='width:100%;'>
                <?php 
                    if($material_groups!=null)
                    {
                        //echo "<pre>";
                        //var_dump($material_groups);
                        foreach($material_groups as $material){
                            ?>
                            <tr>
                                <td><h4><?php echo $material["material_group_name"];?><span class="pull-right"><a href="#" onclick="_edit(<?php echo  $material["id"]?>);return false;" class="btn btn-info">Edit</a>&emsp;<a href="#" onclick="_delete(<?php echo  $material["id"]?>,'<?php echo  $material["material_group_name"];?>');return false;" class="btn btn-danger">Delete</a></span></h4>
                                <table  class="table" style='width:100%;'>
                                        <thead>
                                            <tr>
                                            <th style="width:55%;">Material</th>
                                            <th style="width:15%;">JP</th>
                                            <th style="width:15%;">QTY</th>
                                            <th style="width:15%;">Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_materialss">
                                            <?php
                                            
                                                if($material[0] != null)
                                                {
                                                    foreach($material[0] as $material_items)
                                                    {
                                                        ?>
                                                        <tr>
                                                        <td><?php echo $material_items["material_name"]?></td>
                                                        <td><?php echo $material_items["jp"]?></td>
                                                        <td><?php echo $material_items["qty"]?></td>
                                                        <td><?php echo $material_items["unit"]?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                </table>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                ?>
                </table>
            </div>
        </div>

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
            <div id="uploadBoxMain" class="col-md-12">
                                </div>
            <a href="<?php echo base_url();?>portal/main/product_profiles/list" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
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

  <div class="modal fade" id="product_profilesModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Product Profile Materials</h3>
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="product_profilesForm" data-toggle="validator">
                    
                        <input type="hidden" id="action">
                        <input type="hidden" id="net_weight" name="net_weight">
                        <input type="hidden" name="product_variant_id" value="<?php echo $product_variants->id;?>">
                        <div class="box-body"> 
                            <div class="form-group">
                                <label for="group_name" class="col-sm-2 control-label">Material List Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="group_name" id="group_name" placeholder="Material List Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-success" onclick="return false;" id="add_material_btn">Add Material</a>
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
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveMaterials">Save Product Profile Material List</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteMaterialsModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Materials</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteMaterials">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="product_profilesModalEdit" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Edit Product Profile Materials</h3>
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="product_profilesForm_edit" data-toggle="validator">
                    
                        <input type="hidden" id="action">
                        <input type="hidden" name="material_list_id_edit"  id="material_list_id">
                        <input type="hidden" name="product_profile_id_edit"  id="product_profile_id">
                        <input type="hidden" name="net_weight_edit" id="net_weight_edit">
                        <input type="hidden" name="product_variant_id_edit"  id="product_variant_id">
                        <div class="box-body"> 
                            <div class="form-group">
                                <label for="group_name" class="col-sm-2 control-label">Material List Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="group_name_edit" id="group_name_edit" placeholder="Material List Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-success" onclick="return false;" id="add_material_btn_edit">Add Material</a>
                                <table class="table">
                                    <thead>
                                        <th>Material</th>
                                        <th>JP</th>
                                        <th>QTY</th>
                                        <th>Unit</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="tbody_materials_edit">
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
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveMaterials_edit">Save Product Profile Material List</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<script>

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
    material_counter ++;
});

$("#add_material_btn_edit").click(function(){
    $("#tbody_materials_edit").append("<tr><td><input type='hidden' name='selected_material_edit[]'><select required style='width:300px;' id='mat_"+material_counter+"'></select></td><td><label class='mat_jp'></label></td><td><input type='number' name='qty_edit[]' required></td><td><label class='mat_unit'></label></td><td><a href='#'  class='btn btn-danger remove_item' >&times;</a></td></tr>");

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
    $("#tbody_materials_edit").on("click", ".remove_item", function() {
        $(this).closest("tr").remove();
    });
    $('#mat_'+ material_counter).on('select2:select', function (e) {
        var data = e.params.data;
        console.log(data)
        var $row = $(this).closest("tr");
        console.log($row)
        $row.find('input[name="selected_material_edit[]"]').val(data.id);
        $row.find(".mat_jp").html(data.jp);
        $row.find(".mat_unit").html(data.unit);
    });
    material_counter ++;
});

$("#add_material_group").click(function(){
    $('#product_profilesModal').modal('show');
    material_counter = 1;
});

function _delete(id,item)
{
    $("#deleteMaterialsModal .modal-title").html("Delete Materials");
    $("#deleteItem").html(item);
    $("#deleteKey").val(id);
    $("#deleteMaterialsModal").modal("show");
}

function _edit(id)
{
    material_counter = 1;
    data= {"id":id}
    $.ajax({
            data: data,
            type: "post",
            url: "<?php echo base_url()."portal/product_profiles/get_materials_on_list";?>",
            success: function(data){
                //alert("Data Save: " + data);
                $("#tbody_materials_edit").html("");
                data = JSON.parse(data);
                console.log(data["material_list"])
                $("#group_name_edit").val(data["material_group"].material_group_name);
                $("#material_list_id").val(data["material_group"].id)
                $("#product_variant_id").val(data["material_group"].product_variant_id)
                $("#product_profile_id").val(data["material_group"].product_profile_id)
                var arrayLength = data["material_list"].length;
                console.log(arrayLength);
                for (var i = 0; i < arrayLength; i++) {
                    $("#tbody_materials_edit").append("<tr><td><input type='hidden' value='"+data["material_list"][i]["material_id"]+"' name='selected_material_edit[]'><select required style='width:300px;' id='mat_"+material_counter+"'></select></td><td><label class='mat_jp'>"+data["material_list"][i]["jp"]+"</label></td><td><input type='number' value='"+data["material_list"][i]["qty"]+"' name='qty_edit[]' required></td><td><label class='mat_unit'>"+data["material_list"][i]["unit"]+"</label></td><td><a href='#'  class='btn btn-danger remove_item' >&times;</a></td></tr>");
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
                    $('#mat_'+ material_counter).append(new Option(data["material_list"][i]["material_name"],data["material_list"][i]["materia_id"],  true, true)).trigger('change');

                    $("#tbody_materials_edit").on("click", ".remove_item", function() {
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
                $("#product_profilesModalEdit").modal("show");
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
    });
}
$("#deleteMaterials").click(function(){
    var btn = $(this);
    var id = $("#deleteKey").val();
    var deleteItem = $("#deleteItem").html();
    var data = { "id" : id };
    btn.button("loading");

    $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/product_profiles/delete_product_materials";?>",
                success: function(data){
                    //alert("Data Save: " + data);
                    btn.button("reset");
                    $("#deleteMaterialsModal").modal("hide");
                    toastr.error('Materials ' + deleteItem + ' successfully deleted');
                    setTimeout(() => {
                        window.location = "";
                    }, 1000);
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
});
$("#saveMaterials").click(function(){
    var btn=$("#saveMaterials");
    $("#net_weight").val($("#weight").val());
    console.log($("#product_profilesForm").serialize());
    $.ajax({
    data: $("#product_profilesForm").serialize(),
    type: "get",
    processData: false,
    contentType: false,
    cache: false,
    url: "<?php echo base_url()."portal/product_profiles/add_product_profiles";?>" , 
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
            toastr.success("Material Group Added Successfully");
            setTimeout(() => {
                        window.location = "";
                    }, 1000);
            $("#colorsForm").validator('destroy');
            $("#colorsModal").modal("hide"); 
            $('#uploadBoxMain').html('');          
    }
});
});



$("#saveMaterials_edit").click(function(){
    var btn=$("#saveMaterials_edit");
    
    $("#net_weight_edit").val($("#weight").val());
    console.log($("#product_profilesForm_edit").serialize());
    $.ajax({
    data: $("#product_profilesForm_edit").serialize(),
    type: "get",
    processData: false,
    contentType: false,
    cache: false,
    url: "<?php echo base_url()."portal/product_profiles/update_product_profiles";?>" , 
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
            toastr.success("Material Group Added Successfully");

            setTimeout(() => {
                        window.location = "";
                    }, 1000);
            $("#colorsForm").validator('destroy');
            $("#colorsModal").modal("hide"); 
            $('#uploadBoxMain').html('');          
    }
});
});

</script>