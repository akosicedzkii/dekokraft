<!-- Content Wrapper. Contains page content -->
<style>
th { font-size: 12px; }
td { font-size: 11px; }

</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<?php
$module_name = "Product Category Proto and Molds";
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
<!-- <button class="btn btn-success btn-circle btn-lg fix-btn" id="addBtn"  data-toggle="tooltip" title="Add New">
    <span class="glyphicon glyphicon-plus"></span>
</button> -->
<!-- Main content -->
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?> List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="productsList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>CLASS</th>
            <th>CODE</th>
            <th>DESCRIPTION</th>
            <th>I(INNER)</th>
            <th>M(MASTER)</th>
            <th>CBM</th>
            <th>MOQ</th>
            <th>LC(LOWEST COST)</th>
            <th>FOB</th>
            <th>OLD PRICE</th>
            <th>QUANTITY</th>
            <th>PROTO</th>
            <th>MOLDS</th>
             <th>STATUS</th>
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

<div class="modal fade" id="productsModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

             <h3 class="modal-title">Add Products</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="productsID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="productsForm" data-toggle="validator">
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
                                    <!--<div class="form-group">
                                        <label for="inputDescription" class="col-sm-2 control-label">Description</label>

                                        <div class="col-sm-10">
                                        <textarea class="form-control" id="inputDescription" placeholder="Description" style="resize:none" required></textarea>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>-->

                                    <div class="form-group">
                                        <label for="in_" class="col-sm-2 control-label">Packing</label>

                                        <div class="col-sm-5">
                                        <input type="text" style="width:150px;" class="form-control" id="in_" placeholder="IN" required>
                                        <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="col-sm-5">
                                        <input type="text"  style="width:150px;"class="form-control" id="mstr" placeholder="MSTR" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inner_carton" class="col-sm-2 control-label">Inner Box</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inner_carton" placeholder="Inner Box" >
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="master_carton" class="col-sm-2 control-label">Master Box</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="master_carton" placeholder="Master Box" >
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ml-auto">
                                <div class="form-group">
                                        <label for="proto" class="col-sm-2 control-label">Proto</label>

                                        <div class="col-sm-10">
                                        <input type="text" min="1" class="form-control" id="proto" placeholder="Proto" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="molds" class="col-sm-2 control-label">Molds</label>

                                        <div class="col-sm-10">
                                        <input type="text" min="1" class="form-control" id="molds" placeholder="Molds" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
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
                                            <option value="4">Pending</option>
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

<div class="modal fade" id="oldPriceModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

             <h3 class="modal-title">Old Price</h3>
            </div>
            <div class="modal-body">
                <center><table class="table table-bordered table-striped">
                   <thead> <tr><th>Date</th><th>Price</th></tr> </thead> 
                   <tbody id="price_body"> </tbody> 

                </table></center>
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
function _get_price_list(id){
    $("#oldPriceModal").modal("show");
    data = { "id":id }
    $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/proto_molds/get_old_price";?>",
                success: function(data){
                    $("#price_body").html(data);
                }
            });
}
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
        var table = $('#productsList').DataTable({
            "language": {
                "infoFiltered": ""
            },
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true,
            "ajax" : "<?php if($this->session->userdata("USERTYPE")!=0){ echo base_url()."portal/proto_molds/get_products_list"; }else{ echo base_url()."portal/proto_molds/get_my_products_list";}?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 3 ] }
        ], "order": [[ 0, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#productsModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#upload").attr("required","required");
            $('#productsForm').validator();
            $("#productsModal").modal("show");
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
                    $("#productsForm").submit();
                });*/
                $("#productsForm").submit();
            }else{
                $("#productsForm").submit();
            }

        });

        var image_correct = true;
        var image_error = "";
        $("#productsForm").validator().on('submit', function (e) {
            var btn = $("#saveProducts");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset");
            } else {
                e.preventDefault();
                var title = $("#inputProductsTitle").val();
                var description =  $("#inputProductsTitle").val();
                var status = $("#inputStatus").val();
                var products_id = $("#productsID").val();
                var cover_image = $("#cover_image").val();
                var classs = $("#class").val();
                //var data = $('#color').select2('data');
                //var color  = data[0].text;
                var code = $("#code").val();
                var in_ = $("#in_").val();
                var mstr = $("#mstr").val();
                var inner_carton = $("#inner_carton").val();
                var master_carton = $("#master_carton").val();
                var weight_of_box = $("#weight_of_box").val();
                var minimum_of_quantity = $("#minimum_of_quantity").val();
                var lowest_cost = $("#lowest_cost").val();
                var best_price = $("#best_price").val();
                var old_price = $("#old_price").val();
                var location = $("#location").val();
                var proto = $("#proto").val();
                var fob = $("#fob").val();
                var molds = $("#molds").val();

                var formData = new FormData();
                formData.append('id', products_id);
                formData.append('molds', molds);
                formData.append('proto', proto);
                formData.append('fob', fob);
                formData.append('title', title);
                formData.append('description', description);
                formData.append('status', status);
                formData.append('class', classs);
                formData.append('in_', in_);
                formData.append('mstr', mstr);
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
                var url = "<?php echo base_url()."portal/proto_molds/add_products";?>";
                var message = "New product successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/proto_molds/edit_products";?>";
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
                         $("#productsForm").validator('destroy');
                         $("#productsModal").modal("hide");
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
                         $("#productsForm").validator('destroy');
                         $("#productsModal").modal("hide");
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
                        url: "<?php echo base_url()."portal/proto_molds/delete_products";?>",
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

        $('#productsModal').on('hidden.bs.modal', function (e) {
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
            $("#productsForm").validator('destroy');
            $("#uploadBoxMain").hide();
            $("#inputStatus").val('').trigger('change');
            $("#proto").removeAttr("disabled");
            $("#molds").removeAttr("disabled");
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
        $("#productsModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();
        $('#productsForm').validator();
        $("#action").val("edit");
        $("#upload").removeAttr("required");
        $("#inputProductsname").attr("data-remote","<?php echo base_url()."products/check_productsname_exist?method=edit&products_id=";?>" + id);
        var data = { "id" : id }
        /*$uploadCrop.croppie('bind', {
                url :  '<?php echo base_url()."assets/images/img_bg.png";?>',
            }).then(function () {
                console.log('reset complete');
            });*/
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/proto_molds/get_products_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductsTitle").val(data.products.title).attr("disabled","disabled");
                    //$("#inputDescription").val(data.products.description);
                    $("#inputStatus").val(data.products.status).trigger('change').attr("disabled","disabled");

                    $("#class").val(data.products.class).attr("disabled","disabled");
                    $("#code").val(data.products.code).attr("disabled","disabled");
                    //$("#color").select2('data', { id:data.products.color_abb, label: data.products.color});
                    $("#color").append(new Option(data.products.color,data.products.color_abb,  true, true)).trigger('change').attr("disabled","disabled");

                    $("#color_abb").val(data.products.color_abb).attr("disabled","disabled");;
                    $("#in_").val(data.products.in_).attr("disabled","disabled");;
                    $("#mstr").val(data.products.mstr).attr("disabled","disabled");;
                    $("#inner_carton").val(data.products.inner_carton).attr("disabled","disabled");;
                    $("#master_carton").val(data.products.master_carton).attr("disabled","disabled");;
                    $("#weight_of_box").val(data.products.weight_of_box).attr("disabled","disabled");;
                    $("#minimum_of_quantity").val(data.products.minimum_of_quantity).attr("disabled","disabled");;
                    $("#lowest_cost").val(data.products.lowest_cost).attr("disabled","disabled");;
                    $("#best_price").val(data.products.best_price).attr("disabled","disabled");;
                    $("#old_price").val(data.products.old_price).attr("disabled","disabled");;
                    $("#location").val(data.products.location).attr("disabled","disabled");;
                    $("#proto").val(data.products.proto);
                    $("#molds").val(data.products.molds)    ;
                    $("#inputProductsEmailAddress").val(data.products.email_address).attr("disabled","disabled");;
                    //$("#proto").val(data.products.proto);
                    $("#fob").val(data.products.fob).attr("disabled","disabled");;

                    $("#coverImgPrev").show();
                    $("#coverImgPrev").attr("src","<?php echo base_url()."/uploads/proto_molds/"; ?>" + data.products.cover_image);
                    $("#main-cropper , .actionUpload, #cancel_edit").hide();
                    $("#edit_image").show();
                    $("#code").attr("disabled","disabled");
                    $("#productsID").val(data.products.id);
                    $("#productsModal").modal("show");
                    $("#saveProducts").html("Save Product");

                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }


    function _view(id)
    {
        $("#productsModal .modal-title").html("View <?php echo ucfirst($module_name);?>");
        $(".add").hide();
        $('#productsForm').validator();
        $("#action").val("edit");
        $("#upload").removeAttr("required");
        $("#inputProductsname").attr("data-remote","<?php echo base_url()."products/check_productsname_exist?method=edit&products_id=";?>" + id);
        var data = { "id" : id }
        /*$uploadCrop.croppie('bind', {
                url :  '<?php echo base_url()."assets/images/img_bg.png";?>',
            }).then(function () {
                console.log('reset complete');
            });*/
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/proto_molds/get_products_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductsTitle").val(data.products.title).attr("disabled","disabled");
                    $("#inputDescription").val(data.products.description).attr("disabled","disabled");
                    $("#inputStatus").val(data.products.status).trigger('change').attr("disabled","disabled");
                    $("#class").val(data.products.class).attr("disabled","disabled");
                    $("#code").val(data.products.code).attr("disabled","disabled");
                    $("#in_").val(data.products.in_).attr("disabled","disabled");
                    $("#mstr").val(data.products.mstr).attr("disabled","disabled");
                    //$("#color").select2('data', { id:data.products.color_abb, label: data.products.color});
                    $("#color").append(new Option(data.products.color,data.products.color_abb,  true, true)).trigger('change').attr("disabled","disabled");
                    $("#color_abb").val(data.products.color_abb).attr("disabled","disabled");
                    $("#inner_carton").val(data.products.inner_carton).attr("disabled","disabled");
                    $("#master_carton").val(data.products.master_carton).attr("disabled","disabled");
                    $("#weight_of_box").val(data.products.weight_of_box).attr("disabled","disabled");
                    $("#minimum_of_quantity").val(data.products.minimum_of_quantity).attr("disabled","disabled");
                    $("#lowest_cost").val(data.products.lowest_cost).attr("disabled","disabled");
                    $("#best_price").val(data.products.best_price).attr("disabled","disabled");
                    $("#old_price").val(data.products.best_price);
                    $("#proto").val(data.products.proto).attr("disabled","disabled");;
                    $("#molds").val(data.products.molds).attr("disabled","disabled");;
                    $("#location").val(data.products.location).attr("disabled","disabled");
                    $("#fob").val(data.products.fob).attr("disabled","disabled");
                    $("#inputProductsEmailAddress").val(data.products.email_address).attr("disabled","disabled");

                    $("#coverImgPrev").show();
                    $("#coverImgPrev").attr("src","<?php echo base_url()."/uploads/proto_molds/"; ?>" + data.products.cover_image);
                    $("#main-cropper , .actionUpload, #cancel_edit").hide();
                    $("#edit_image").show();
                    $("#code").attr("disabled","disabled");
                    $("#productsID").val(data.products.id);
                    $("#productsModal").modal("show");
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
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/proto_molds/"?>"+img_src);
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
