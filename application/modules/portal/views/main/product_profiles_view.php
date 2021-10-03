<!-- Content Wrapper. Contains page content -->
<style>
th { font-size: 12px; }
td { font-size: 11px; }

</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<?php 
$module_name = "Product Profile";
$module_name = rtrim($module_name,"s");?>
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
<!-- <a class="btn btn-success btn-circle btn-lg fix-btn" href="<?php echo base_url("portal/main/product_profiles/new");?>" data-toggle="tooltip" title="New Product Profiles">
    <span class="glyphicon glyphicon-plus"></span>
</a> -->
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?> List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="product_profilesList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>CLASS</th>
            <th>CODE</th>
            <th>DESCRIPTION</th>  
            <th>COLOR</th>
            <th>Product Profile</th>
            <th>Target Weight</th>
            <th>Resin Unit Price</th>
            <th>Finishing Unit Price</th>

            <th>Spray Unit Price</th>
            <th>Hand Paint Unit Price</th>

            <?php if($this->session->userdata("USERTYPE") ==1){ ?><th>Date Created</th>
            <th>Created By</th>
            <th>Date Modified</th>
            <th>Modified By</th><?php }?>
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

<div class="modal fade" id="product_profilesModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Products</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="product_profilesID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="product_profilesForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 ml-auto">
                                <!--<div class="form-group">
                                <label for="inputCoverImage" class="col-sm-2 control-label">Product Image </label>

                                <div class="col-sm-10">
                                    <center><img id="coverImgPrev" src="#" class='img-thumbnail' onerror="this.src='<?php echo base_url()."assets/images/img_bg.png";?>'"></center>
                                        <div id="main-cropper"></div>
                                        <a class="button actionUpload">
                                            <input type="file" required id="upload" value="Choose Image" accept="image/*">
                                        </a>
                                        <center><a class='btn btn-success' id="edit_image">Update</a>
                                        <a class='btn btn-warning' id="cancel_edit">Cancel</a></center>
                                    <center><div class="help-block with-errors" id="coverError"></div></center>
                                </div>
                                
                                <input type="hidden" id="imagebase64">
                            </div>-->
                            <div class="form-group">
                                        <label for="inputProductsTitle"  class="col-sm-2 control-label">Product Name</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" id="inputProductsTitle" placeholder="Product Name" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="class" class="col-sm-2 control-label">Class</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="class" placeholder="Class" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Code" class="col-sm-2 control-label">Code</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code" placeholder="Code" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription" class="col-sm-2 control-label">Description</label>

                                        <div class="col-sm-10">
                                        <textarea class="form-control" id="inputDescription" placeholder="Description" style="resize:none" required></textarea>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                   
                                    <!--<div class="form-group">
                                        <label for="color" class="col-sm-2 control-label">Color</label>

                                        <div class="col-sm-10">
                                        <select  class="form-control" id="color" placeholder="Color" required></select>
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
                                    </div>-->
                                    
                                    <div class="form-group">
                                        <label for="inner_carton" class="col-sm-2 control-label">Inner Carton</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inner_carton" placeholder="Inner Carton" >
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="master_carton" class="col-sm-2 control-label">Master Carton</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="master_carton" placeholder="Master Carton" >
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ml-auto">
                                <!--<div class="form-group">
                                        <label for="proto" class="col-sm-2 control-label">Proto</label>

                                        <div class="col-sm-10">
                                        <input type="text" min="1" class="form-control" id="proto" placeholder="Proto" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <label for="fob" class="col-sm-2 control-label">FOB</label>

                                        <div class="col-sm-10">
                                        <input type="text" min="1" class="form-control" id="fob" placeholder="FOB" >
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="weight_of_box" class="col-sm-2 control-label">Weight of Box</label>

                                        <div class="col-sm-10">
                                        <input type="number" min="1" class="form-control" id="weight_of_box" placeholder="Weight of Box" >
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="minimum_of_quantity" class="col-sm-2 control-label">Minimum of Quantity</label>

                                        <div class="col-sm-10">
                                        <input type="number" class="form-control" id="minimum_of_quantity" placeholder="Minimum of Quantity" >
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="lowest_cost" class="col-sm-2 control-label">Lowest Cost</label>

                                        <div class="col-sm-10">
                                        <input  class="form-control" id="lowest_cost" placeholder="Lowest Cost(In Dollars)" type="number" min="1" step="any">
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="best_price" class="col-sm-2 control-label">Best Price</label>

                                        <div class="col-sm-10">
                                        <input type="hidden" id="old_price">
                                        <input  type="number" min="1" step="any" class="form-control" id="best_price" placeholder="Best Price(In Dollars)">
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                        <label for="location" class="col-sm-2 control-label">Location</label>

                                        <div class="col-sm-10">
                                        <textarea class="form-control" id="location" placeholder="Location" required></textarea>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>-->
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
            <button type="button" class="btn btn-primary" id="saveProducts"></button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteProductsModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Products</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteProducts">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="imgPreviewModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Cover Image Preview</h3>
            </div>
            <div class="modal-body">
                <center><img src="" id="imgPreview" style="width:100%;"></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
/*$uploadCrop = $('#main-cropper');
$uploadCrop .croppie({
    viewport: { width: 250, height: 250 },
    boundary: { width: 300, height: 300 },
    showZoomer: true,
    url: '<?php echo base_url()."assets/images/img_bg.png";?>',
    enableResize: true,
    enableOrientation: true,
    mouseWheelZoom: 'ctrl'
});*/
$("#add_color").click(function(){
    $("#colorsModal .modal-title").html("Add New Color");
    $('#colorsForm').validator();
    $("#colorsModal").modal("show");
});
$("#saveColors").click(function(){
    alert("yeah");
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

$('#color').on('select2:select', function (e) {
    var data = $('#color').select2('data');
    console.log(data)
    $("#color_abb").val(data[0].id);
});
/*function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
        url: e.target.result
      });
    }

    reader.readAsDataURL(input.files[0]);
  }
}*/

$('.actionUpload input').on('change', function () { readFile(this); });
$('.actionDone').on('click', function(){
  $('.actionDone').toggle();
  $('.actionUpload').toggle();
})
    var inputRoleConfig = {
        dropdownAutoWidth : true,
        width: 'auto',
        placeholder: "--- Select Item ---"
    };
    $("#inputProductsEventDate").datepicker({
            
        autoclose: true,format: 'yyyy-mm-dd'
            });
    $("#inputProductsEventTime").clockpicker({
        align: 'left',
        autoclose: true,
        'default': 'now',
        donetext : "Done"
    });

    var main = function(){
        var table = $('#product_profilesList').DataTable({
            "language": {                
                "infoFiltered": ""
            },    
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php if($this->session->userdata("USERTYPE")!=0){ echo base_url()."portal/product_profiles/get_product_profiles_list"; }else{ echo base_url()."portal/product_profiles/get_my_product_profiles_list";}?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 3 ] }
        ], "order": [[ 0, 'desc' ]]
        }); 
        $("#addBtn").click(function(){
            $("#product_profilesModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#upload").attr("required","required");
            $('#product_profilesForm').validator();
            $("#product_profilesModal").modal("show");
            $("#main-cropper , .actionUpload").show();
            $("#edit_image , #cancel_edit, #coverImgPrev").hide();
            
            $("#code").removeAttr("disabled");
            is_edit = 1;
            /*$uploadCrop.croppie('bind', {
                url :  '<?php echo base_url()."assets/images/img_bg.png";?>',
            }).then(function () {
                console.log('reset complete');
            });*/
            $("#saveProducts").html("Save Product");
        });

        $("#saveProducts").click(function(){
            if(is_edit==1)
            {
                  /*$('#main-cropper').croppie('result', {
                    type: 'canvas',
                    size: 'original'
                }).then(function (resp) {
                    $('#imagebase64').val(resp);
                    $("#product_profilesForm").submit();
                });*/
                $("#product_profilesForm").submit();
            }else{
                $("#product_profilesForm").submit();
            }
          
        });

        var image_correct = true;
        var image_error = "";
        $("#product_profilesForm").validator().on('submit', function (e) {
            var btn = $("#saveProducts");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var title = $("#inputProductsTitle").val();
                var description = $("#inputDescription").val();
                var status = $("#inputStatus").val();
                var product_profiles_id = $("#product_profilesID").val();
                var cover_image = $("#cover_image").val();
                var classs = $("#class").val();
                //var data = $('#color').select2('data');
                //var color  = data[0].text;
                var code = $("#code").val();
                //var color_abb = $("#color_abb").val();
                var inner_carton = $("#inner_carton").val();
                var master_carton = $("#master_carton").val();
                var weight_of_box = $("#weight_of_box").val();
                var minimum_of_quantity = $("#minimum_of_quantity").val();
                var lowest_cost = $("#lowest_cost").val();
                var best_price = $("#best_price").val();
                var old_price = $("#old_price").val(); 
                var location = $("#location").val();
                //var proto = $("#proto").val();
                var fob = $("#fob").val();

                var formData = new FormData();
                formData.append('id', product_profiles_id);
                //formData.append('molds', molds);
                formData.append('fob', fob);
                formData.append('title', title);
                formData.append('description', description);
                formData.append('status', status);
                formData.append('class', classs);
                //formData.append('color', color);
                //formData.append('color_abb', color_abb);
                formData.append('inner_carton', inner_carton);
                formData.append('master_carton', master_carton);
                formData.append('weight_of_box', weight_of_box);
                formData.append('minimum_of_quantity', minimum_of_quantity);
                formData.append('lowest_cost', lowest_cost);
                formData.append('best_price', best_price);
                formData.append('old_price', old_price);
                //formData.append('location', location);
                formData.append('code', code);
                formData.append('fob', fob);
                
                if(is_edit==1)
                {
                    formData.append('cover_image', $('#imagebase64').val());
                }
                var url = "<?php echo base_url()."portal/product_profiles/add_product_profiles";?>";
                var message = "New product successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/product_profiles/edit_product_profiles";?>";
                    message = "Product successfully updated";
                
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
                    console.log(data)
                    if(data!=true)
                    {
                        btn.button("reset");
                        toastr.error(data);
                         $("#product_profilesForm").validator('destroy');
                         $("#product_profilesModal").modal("hide"); 
                    }
                    else
                    {
                         //alert("Data Save: " + data);
                         btn.button("reset");
                         if(action == "edit")
                         {
                            if(table.page.info().page == 0)
                            {
                                window.location="";
                            }
                            else
                            {
                                table.draw("page");
                            }
                         }
                         else
                         {
                             table.draw();
                         }
                         toastr.success(message);
                         $("#product_profilesForm").validator('destroy');
                         $("#product_profilesModal").modal("hide"); 
                    }
                });

            }
               return false;
        });

        $("#deleteProducts").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/product_profiles/delete_product_profiles";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteProductsModal").modal("hide");
                            toastr.error('Products ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#product_profilesModal').on('hidden.bs.modal', function (e) {
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
            $("#product_profilesForm").validator('destroy');
            $("#uploadBoxMain").hide();
            $("#inputStatus").val('').trigger('change');
            $("#inputProductsTitle").removeAttr("disabled");
            $("#inputDescription").removeAttr("disabled");
            $("#inputStatus").removeAttr("disabled");
            $("#class").removeAttr("disabled");
            $("#code").removeAttr("disabled");
            //$("#color").select2('data', { id:data.product_profiles.color_abb, label: data.product_profiles.color});
            $("#color").removeAttr("disabled");
            $("#inner_carton").removeAttr("disabled");
            $("#master_carton").removeAttr("disabled");
            $("#weight_of_box").removeAttr("disabled");
            $("#minimum_of_quantity").removeAttr("disabled");
            $("#lowest_cost").removeAttr("disabled");
            $("#best_price").removeAttr("disabled");
            $("#old_price").removeAttr("disabled");
            $("#location").removeAttr("disabled");

            $("#code").removeAttr("disabled");
            $("#saveProducts").html("Save Product").show();
            $("#add_color").removeAttr("disabled");
            $("#edit_image").removeAttr("disabled");
            //$("#proto").removeAttr("disabled");
            $("#fob").removeAttr("disabled");
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
        $("#product_profilesModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#product_profilesForm').validator();    
        $("#action").val("edit");
        $("#upload").removeAttr("required");
        $("#inputProductsname").attr("data-remote","<?php echo base_url()."product_profiles/check_product_profilesname_exist?method=edit&product_profiles_id=";?>" + id);
        var data = { "id" : id }
        /*$uploadCrop.croppie('bind', {
                url :  '<?php echo base_url()."assets/images/img_bg.png";?>',
            }).then(function () {
                console.log('reset complete');
            });*/
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/product_profiles/get_product_profiles_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductsTitle").val(data.product_profiles.title);
                    $("#inputDescription").val(data.product_profiles.description);
                    $("#inputStatus").val(data.product_profiles.status).trigger('change');
                    
                    $("#class").val(data.product_profiles.class);
                    $("#code").val(data.product_profiles.code);
                    //$("#color").select2('data', { id:data.product_profiles.color_abb, label: data.product_profiles.color});
                    $("#color").append(new Option(data.product_profiles.color,data.product_profiles.color_abb,  true, true)).trigger('change');
                    
                    $("#color_abb").val(data.product_profiles.color_abb);
                    $("#inner_carton").val(data.product_profiles.inner_carton);
                    $("#master_carton").val(data.product_profiles.master_carton);
                    $("#weight_of_box").val(data.product_profiles.weight_of_box);
                    $("#minimum_of_quantity").val(data.product_profiles.minimum_of_quantity);
                    $("#lowest_cost").val(data.product_profiles.lowest_cost);
                    $("#best_price").val(data.product_profiles.best_price);
                    $("#old_price").val(data.product_profiles.best_price);
                    $("#location").val(data.product_profiles.location);
                    $("#inputProductsEmailAddress").val(data.product_profiles.email_address);
                    //$("#proto").val(data.product_profiles.proto);
                    $("#fob").val(data.product_profiles.fob);

                    $("#coverImgPrev").show();
                    $("#coverImgPrev").attr("src","<?php echo base_url()."/uploads/product_profiles/"; ?>" + data.product_profiles.cover_image);
                    $("#main-cropper , .actionUpload, #cancel_edit").hide();
                    $("#edit_image").show();
                    $("#code").attr("disabled","disabled");
                    $("#product_profilesID").val(data.product_profiles.id);
                    $("#product_profilesModal").modal("show");
                    $("#saveProducts").html("Save Product");

                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }


    function _view(id)
    {
        $("#product_profilesModal .modal-title").html("View <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#product_profilesForm').validator();    
        $("#action").val("edit");
        $("#upload").removeAttr("required");
        $("#inputProductsname").attr("data-remote","<?php echo base_url()."product_profiles/check_product_profilesname_exist?method=edit&product_profiles_id=";?>" + id);
        var data = { "id" : id }
        /*$uploadCrop.croppie('bind', {
                url :  '<?php echo base_url()."assets/images/img_bg.png";?>',
            }).then(function () {
                console.log('reset complete');
            });*/
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/product_profiles/get_product_profiles_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductsTitle").val(data.product_profiles.title).attr("disabled","disabled");
                    $("#inputDescription").val(data.product_profiles.description).attr("disabled","disabled");
                    $("#inputStatus").val(data.product_profiles.status).trigger('change').attr("disabled","disabled");
                    $("#class").val(data.product_profiles.class).attr("disabled","disabled");
                    $("#code").val(data.product_profiles.code).attr("disabled","disabled");
                    //$("#color").select2('data', { id:data.product_profiles.color_abb, label: data.product_profiles.color});
                    $("#color").append(new Option(data.product_profiles.color,data.product_profiles.color_abb,  true, true)).trigger('change').attr("disabled","disabled");
                    $("#color_abb").val(data.product_profiles.color_abb).attr("disabled","disabled");
                    $("#inner_carton").val(data.product_profiles.inner_carton).attr("disabled","disabled");
                    $("#master_carton").val(data.product_profiles.master_carton).attr("disabled","disabled");
                    $("#weight_of_box").val(data.product_profiles.weight_of_box).attr("disabled","disabled");
                    $("#minimum_of_quantity").val(data.product_profiles.minimum_of_quantity).attr("disabled","disabled");
                    $("#lowest_cost").val(data.product_profiles.lowest_cost).attr("disabled","disabled");
                    $("#best_price").val(data.product_profiles.best_price).attr("disabled","disabled");
                    $("#old_price").val(data.product_profiles.best_price);
                    $("#location").val(data.product_profiles.location).attr("disabled","disabled");
                    $("#fob").val(data.product_profiles.fob).attr("disabled","disabled");
                    $("#inputProductsEmailAddress").val(data.product_profiles.email_address).attr("disabled","disabled");

                    $("#coverImgPrev").show();
                    $("#coverImgPrev").attr("src","<?php echo base_url()."/uploads/product_profiles/"; ?>" + data.product_profiles.cover_image);
                    $("#main-cropper , .actionUpload, #cancel_edit").hide();
                    $("#edit_image").show();
                    $("#code").attr("disabled","disabled");
                    $("#product_profilesID").val(data.product_profiles.id);
                    $("#product_profilesModal").modal("show");
                    $("#saveProducts").html("Save Product").hide();
                    $("#add_color").attr("disabled","disabled");
                    $("#edit_image").attr("disabled","disabled");

                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }

    is_edit = 0;
    $("#edit_image").click(function(){
        $("#main-cropper , .actionUpload, #cancel_edit").show();
        $("#edit_image").hide();
        $("#coverImgPrev").hide();
        is_edit = 1;
    });
    $("#cancel_edit").click(function(){
        $("#main-cropper , .actionUpload, #cancel_edit").hide();
        $("#edit_image").show();
        $("#coverImgPrev").show();
        $("#imagebase64").val("");
        is_edit = 0;
    });
    function _delete(id,item)
    {
        $("#deleteProductsModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteProductsModal").modal("show");
    }
    
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/product_profiles/"?>"+img_src);
        $("#imgPreviewModal").modal("show");
    }

    
    function set_image_loader(var_holder,file_holder)
    {
        $("#var_holder").val(var_holder);
        $("#file_holder").val(file_holder);
        $("#mediaGalleryModal").modal("show");
    }


    $(document).ready(main);

</script>