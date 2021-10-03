<!-- Content Wrapper. Contains page content -->
<style>
th { font-size: 12px; }
td { font-size: 11px; }

</style>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="
https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="
https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.dataTables.min.css"> 
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<?php $module_name =str_replace("_"," ", rtrim($module_name,"s"));?>
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
        <!--<a target=_blank href="<?php echo base_url("portal/main/prints/product_variants");?>" class="btn btn-success pull-right"><i class="fa fa-print"></i>&nbsp;Print</a>-->
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="product_variantsList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>IMAGE</th>
            <th>CLASS</th>
            <th>CODE</th>
            <th>DESCRIPTION</th>
            <th>LOCATION</th>
            <th>COLOR</th>
            <th>PROTO</th>
            <th>MOLD</th>
            <th>PCS</th>
            <th>FOB</th>
            <th>Status</th>
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

<div class="modal fade" id="product_variantsModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Product Variants</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="product_variantsID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="product_variantsForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 ml-auto">
                                <div class="form-group">
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
                            </div>
                                   
                                    <div class="form-group">
                                        <label for="color" class="col-sm-2 control-label">Color</label>

                                        <div class="col-sm-10">
                                        <select  style="width:100%;" class="form-control" id="color" placeholder="Color" required></select>
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
                                    </div>
                                    
                                </div>
                                <div class="col-md-6 ml-auto">
                                    <div class="form-group">
                                        <label for="product" class="col-sm-2 control-label">Category</label>

                                        <div class="col-sm-10">
                                        <select style="width:100%;" class="form-control" id="product" placeholder="Product" required></select>
                                        <a class="btn btn-success" id="add_product" href="#">+</a>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="class" class="col-sm-2 control-label">Class</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" disabled id="class" placeholder="Class" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Code" class="col-sm-2 control-label">Product Code</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code" placeholder="Code" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription" class="col-sm-2 control-label">Description</label>

                                        <div class="col-sm-10">
                                        <textarea class="form-control" disabled id="inputDescription" placeholder="Description" style="resize:none" required></textarea>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label for="location" class="col-sm-2 control-label">Location</label>

                                        <div class="col-sm-10">
                                        
                                        <table class="table" id="tbl_location">
                                            <tr><td><input  class="form-control location" id="location" name="location[]" placeholder="Location" type="text"></td></tr>
                                        </table>
                                        
                                        <a href="#" class="btn btn-success" id="add_loc">+</a>
                                        <a href="#" class="btn btn-danger" id="sub_loc">-</a>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="count" class="col-sm-2 control-label">PCS</label>

                                        <div class="col-sm-10">
                                        <input  class="form-control" id="count" placeholder="Count" type="number" min="1" step="any">
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="form-group">
                                        <label for="proto" class="col-sm-2 control-label">Proto</label>

                                        <div class="col-sm-10">
                                        <input type="text" min="1" class="form-control" id="proto" placeholder="Proto">
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="molds" class="col-sm-2 control-label">Molds</label>

                                        <div class="col-sm-10">
                                        <input type="text" min="1" class="form-control" id="molds" placeholder="Molds">
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

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
            <button type="button" class="btn btn-primary" id="saveProduct_variants"></button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteProduct_variantsModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Product Variants</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteProduct_variants">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="reflenishProduct"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Reflenish Product: <label id="reflenish_name"></label></h3>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <input type="hidden" id="reflenish_id">
                        <center>Count: <input  class="form-control" min=1 type="number" id="reflenish_count" placeholder="Product Count"></center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="saveReflenish">Reflenish</button>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="reduceProduct"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Reduce Product: <label id="reduce_name"></label></h3>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <input type="hidden" id="reduce_id">
                        <center>Count: <input  class="form-control" min=1 type="number" id="reduce_count" placeholder="Product Count"></center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="saveReduce">Reduce</button>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="imgPreviewModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Cover Image Preview</h3>
            </div>
            <div class="modal-body">
                <center><img src="" id="imgPreview" style="width:25%;"></center>
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
                                        <label for="inputProductsTitle2"  class="col-sm-2 control-label">Product Name</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" id="inputProductsTitle2" placeholder="Product Name" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="class2" class="col-sm-2 control-label">Class</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="class2" placeholder="Class" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Code" class="col-sm-2 control-label">Code</label>

                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code__" placeholder="Code" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription" class="col-sm-2 control-label">Description</label>

                                        <div class="col-sm-10">
                                        <textarea class="form-control" id="inputDescription2" placeholder="Description" style="resize:none" required></textarea>
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
                                        <select class="form-control" id="inputStatus2" placeholder="Content" style="resize:none" required>
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
<script>
$uploadCrop = $('#main-cropper');
$uploadCrop .croppie({
    viewport: { width: 250, height: 250 },
    boundary: { width: 300, height: 300 },
    showZoomer: true,
    url: '<?php echo base_url()."assets/images/img_bg.png";?>',
    enableResize: true,
    enableOrientation: true,
    mouseWheelZoom: 'ctrl'
});
$("#add_loc").click(function(){
    $("#tbl_location").append('<tr><td><input  class="form-control location" id="location" name="location[]" placeholder="Location" type="text"></td></tr>')
});
$("#sub_loc").click(function(){
    $("#tbl_location tr:last").remove();
});
$("#add_product").click(function(){
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
                var title = $("#inputProductsTitle2").val();
                var description = $("#inputDescription2").val();
                var status = $("#inputStatus2").val();
                var products_id = $("#productsID").val();
                var cover_image = $("#cover_image").val();
                var classs = $("#class2").val();
                //var data = $('#color').select2('data');
                //var color  = data[0].text;
                var code = $("#code__").val();
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
                formData.append('id', products_id);
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
                var url = "<?php echo base_url()."portal/products/add_products";?>";
                var message = "New product successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/products/edit_products";?>";
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
$("#add_color").click(function(){
    $("#colorsModal .modal-title").html("Add New Color");
    $('#colorsForm').validator();
    $("#colorsModal").modal("show");
});
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
$("#product").select2({
    minimumInputLength: 2,
    ajax: {
        url: "<?php echo base_url()."portal/products/get_products_selection";?>",
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

$('#product').on('select2:select', function (e) {
    var data = $('#product').select2('data');
    $("#class").val(data[0].class);
    $("#code").val(data[0].code);
    $("#inputDescription").val(data[0].description);
});

function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
        url: e.target.result
      });
    }

    reader.readAsDataURL(input.files[0]);
  }
}

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
    $("#inputProduct_variantsEventDate").datepicker({
            
        autoclose: true,format: 'yyyy-mm-dd'
            });
    $("#inputProduct_variantsEventTime").clockpicker({
        align: 'left',
        autoclose: true,
        'default': 'now',
        donetext : "Done"
    });

    var main = function(){
        var table = $('#product_variantsList').DataTable({
            colReorder: false,
            "lengthMenu": [[10, 25, 50,100,250,500,1000, -1], [10, 25, 50,100,250, 500,1000,"All"]], 
            dom: 'Btli<"top"fp<"clear">>rt<"bottom"ip<"clear">>',
        buttons: [ 
            {
                extend: 'print',
                customize: function ( win ) {
                    $(win.document.body).find( 'table' )
                        .css( 'font-size', '50px' );
                        
                },
                autoPrint: true,
                exportOptions: {
                    columns: ':visible',
                    stripHtml : false
                },messageTop: function () {
                    return "Page - " + (table.page.info().page + 1)
                }
            },
            {
                extend: 'pdf',
                messageBottom: null
            },
            'colvis'
        ],
            "language": {                
                "infoFiltered": ""
            },    "paging": true,
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php if($this->session->userdata("USERTYPE")!=0){ echo base_url()."portal/product_variants/get_product_variants_list"; }else{ echo base_url()."portal/product_variants/get_my_product_variants_list";}?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ], "order": [[ 0, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#product_variantsModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#product").val(null).trigger("change"); 
            $("#color").val(null).trigger("change"); 
            $("#upload").attr("required","required");
            $("#color").removeAttr("disabled");
            $("#product").removeAttr("disabled");
            $('#product_variantsForm').validator();
            $("#product_variantsModal").modal("show");
            $("#main-cropper , .actionUpload").show();
            $("#edit_image , #cancel_edit, #coverImgPrev").hide();
            
            
            is_edit = 1;
            $uploadCrop.croppie('bind', {
                url :  '<?php echo base_url()."assets/images/img_bg.png";?>',
            }).then(function () {
                console.log('reset complete');
            });
            $("#saveProduct_variants").html("Save Product");
        });

        $("#saveProduct_variants").click(function(){
            if(is_edit==1)
            {
                  $('#main-cropper').croppie('result', {
                    type: 'canvas',
                    size: 'original'
                }).then(function (resp) {
                    $('#imagebase64').val(resp);
                    $("#product_variantsForm").submit();
                });
            }else{
                $("#product_variantsForm").submit();
            }
          
        });

        var image_correct = true;
        var image_error = "";
        $("#product_variantsForm").validator().on('submit', function (e) {
            var btn = $("#saveProduct_variants");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var title = $("#inputProduct_variantsTitle").val();
                var description = $("#inputDescription").val();
                var status = $("#inputStatus").val();
                var product_variants_id = $("#product_variantsID").val();
                var cover_image = $("#cover_image").val();
                var data = $('#color').select2('data');
                var color  = data[0].text;
                var color_abb = $("#color_abb").val();
                var product = $("#product").val();
                var count = $("#count").val();
                var code = $("#code").val();
                //var molds = $("#molds").val();
                //var proto = $("#proto").val();
                values = [];
                $("input[name='location[]']").each(function() {
                    values.push($(this).val());
                });
                var location = values.join(",");
                
                var formData = new FormData();
                formData.append('id', product_variants_id);
                formData.append('title', title);
                formData.append('description', description);
                formData.append('status', status);
                formData.append('color', color);
                formData.append('color_abb', color_abb);
                formData.append('product_id', product);
                if(action != "edit"){
                    formData.append('count', count);
                }
                formData.append('location', location);
                formData.append('code', code);
                //formData.append('molds', molds);
                //formData.append('proto', proto);
                
                if(is_edit==1)
                {
                    if($('#imagebase64').val()!= null){
                    formData.append('cover_image', $('#imagebase64').val());
                    }
                }
                var url = "<?php echo base_url()."portal/product_variants/add_product_variants";?>";
                var message = "New product successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/product_variants/edit_product_variants";?>";
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
                         $("#product_variantsForm").validator('destroy');
                         $("#product_variantsModal").modal("hide"); 
                    }
                    else
                    {
                         //alert("Data Save: " + data);
                         btn.button("reset");
                         if(action == "edit")
                         {
                            console.log(table.page.info().page);
                            if(table.page.info().page == 0)
                            {
                                table.draw("page");
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
                         $("#product_variantsForm").validator('destroy');
                         $("#product_variantsModal").modal("hide"); 
                    }
                });

            }
               return false;
        });
        $("#saveReduce").click(function(){
            var btn = $(this);
            var id = $("#reduce_id").val();
            var count = $("#reduce_count").val();
            var reduce_name = $("#reduce_name").html();
            var data = { "product_variant_id" : id , "count" : count};
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/stocks/reduce";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#reduceProduct").modal("hide");
                            toastr.success('Product Variant ' + reduce_name + ' successfully reduced');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $("#saveReflenish").click(function(){
            var btn = $(this);
            var id = $("#reflenish_id").val();
            var count = $("#reflenish_count").val();
            var reflenish_name = $("#reflenish_name").html();
            var data = { "product_variant_id" : id , "count" : count};
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/stocks/reflenish";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#reflenishProduct").modal("hide");
                            toastr.success('Product Variant ' + reflenish_name + ' successfully reflenished');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });
        $("#deleteProduct_variants").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/product_variants/delete_product_variants";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteProduct_variantsModal").modal("hide");
                            toastr.error('Product Variant ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#product_variantsModal').on('hidden.bs.modal', function (e) {
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
            $("#product_variantsForm").validator('destroy');
            $("#uploadBoxMain").hide();
            $("#inputStatus").val('').trigger('change');
            $("#inputProduct_variantsTitle").removeAttr("disabled");
            //$("#inputDescription").removeAttr("disabled");
            $("#inputStatus").removeAttr("disabled");
            //$("#color").select2('data', { id:data.product_variants.color_abb, label: data.product_variants.color});
            $("#color").removeAttr("disabled");
            $("#inner_carton").removeAttr("disabled");
            $("#master_carton").removeAttr("disabled");
            $("#weight_of_box").removeAttr("disabled");
            $("#minimum_of_quantity").removeAttr("disabled");
            $("#lowest_cost").removeAttr("disabled");
            $("#best_price").removeAttr("disabled");
            $("#old_price").removeAttr("disabled");
            $("#location").removeAttr("disabled");
            $("#tbl_location").html('<tr><td><input  class="form-control" id="location" name="location[]" placeholder="Location" type="text"></td></tr>')
            $("#count").removeAttr("disabled");
            //$("#proto").removeAttr("disabled");
            //$("#molds").removeAttr("disabled");

            $("#saveProduct_variants").html("Save Product").show();
            $("#add_color").removeAttr("disabled");
            $("#edit_image").removeAttr("disabled");
            $("#imagebase64").val("");
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
        $("#product_variantsModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#product_variantsForm').validator();    
        $("#action").val("edit");
        $("#upload").removeAttr("required");
        $("#inputProduct_variantsname").attr("data-remote","<?php echo base_url()."product_variants/check_product_variantsname_exist?method=edit&product_variants_id=";?>" + id);
        var data = { "id" : id }
        $uploadCrop.croppie('bind', {
                url :  '<?php echo base_url()."assets/images/img_bg.png";?>',
            }).then(function () {
                console.log('reset complete');
            });
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/product_variants/get_product_variants_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProduct_variantsTitle").val(data.product_variants.title);
                    $("#inputDescription").val(data.product_variants.description);
                    $("#inputStatus").val(data.product_variants.status).trigger('change');
                    
                    //$("#color").select2('data', { id:data.product_variants.color_abb, label: data.product_variants.color});
                    $("#color").append(new Option(data.product_variants.color,data.product_variants.color_abb,  true, true)).trigger('change');
                    $("#product").append(new Option(data.products.title,data.products.id,  true, true)).trigger('change');
                    
                    $("#class").val(data.products.class);
                    $("#code").val(data.products.code);
                    $("#color_abb").val(data.product_variants.color_abb);
                    $("#inner_carton").val(data.product_variants.inner_carton);
                    $("#master_carton").val(data.product_variants.master_carton);
                    $("#weight_of_box").val(data.product_variants.weight_of_box);
                    $("#minimum_of_quantity").val(data.product_variants.minimum_of_quantity);
                    $("#lowest_cost").val(data.product_variants.lowest_cost);
                    $("#best_price").val(data.product_variants.best_price);
                    $("#old_price").val(data.product_variants.best_price);
                    //$("#location").val(data.product_variants.location);
                    var str_array = data.product_variants.location.split(',');
                    
                    $("#tbl_location").html("");
                    for(var i = 0; i < str_array.length; i++) {
                    // Trim the excess whitespace.
                    str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");
                    // Add additional code here, such as:
                        $("#tbl_location").append('<tr><td><input value="'+str_array[i]+'" class="form-control location" id="location" name="location[]" placeholder="Location" type="text"></td></tr>')
                    }
                    //$("#proto").val(data.product_variants.proto);
                    //$("#molds").val(data.product_variants.molds);
                    $("#count").val(data.product_variants.stock).attr("disabled","disabled");
                    $("#inputProduct_variantsEmailAddress").val(data.product_variants.email_address);

                    $("#coverImgPrev").show();
                    $("#coverImgPrev").attr("src","<?php echo base_url()."/uploads/product_variants/"; ?>" + data.product_variants.cover_image + "?test=" + Math.random().toString(36).substring(7));
                    $("#main-cropper , .actionUpload, #cancel_edit").hide();
                    $("#edit_image").show();
                    $("#code").attr("disabled","disabled");
                    $("#product_variantsID").val(data.product_variants.id);
                    $("#product_variantsModal").modal("show");
                    $("#saveProduct_variants").html("Save Product");

                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }


    function _view(id)
    {
        $("#product_variantsModal .modal-title").html("View <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#product_variantsForm').validator();    
        $("#action").val("edit");
        $("#upload").removeAttr("required");
        $("#inputProduct_variantsname").attr("data-remote","<?php echo base_url()."product_variants/check_product_variantsname_exist?method=edit&product_variants_id=";?>" + id);
        var data = { "id" : id }
        $uploadCrop.croppie('bind', {
                url :  '<?php echo base_url()."assets/images/img_bg.png";?>',
            }).then(function () {
                console.log('reset complete');
            });
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/product_variants/get_product_variants_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProduct_variantsTitle").val(data.product_variants.title).attr("disabled","disabled");
                    $("#inputDescription").val(data.product_variants.description).attr("disabled","disabled");
                    $("#inputStatus").val(data.product_variants.status).trigger('change').attr("disabled","disabled");
                    $("#product").append(new Option(data.products.title,data.products.id,  true, true)).trigger('change').attr("disabled","disabled");
                    $("#class").val(data.products.class).attr("disabled","disabled");
                    $("#code").val(data.products.code).attr("disabled","disabled");
                    //$("#color").select2('data', { id:data.product_variants.color_abb, label: data.product_variants.color});
                    $("#color").append(new Option(data.product_variants.color,data.product_variants.color_abb,  true, true)).trigger('change').attr("disabled","disabled");
                    $("#color_abb").val(data.product_variants.color_abb).attr("disabled","disabled");
                    $("#inner_carton").val(data.product_variants.inner_carton).attr("disabled","disabled");
                    $("#master_carton").val(data.product_variants.master_carton).attr("disabled","disabled");
                    $("#weight_of_box").val(data.product_variants.weight_of_box).attr("disabled","disabled");
                    $("#minimum_of_quantity").val(data.product_variants.minimum_of_quantity).attr("disabled","disabled");
                    $("#lowest_cost").val(data.product_variants.lowest_cost).attr("disabled","disabled");
                    $("#best_price").val(data.product_variants.best_price).attr("disabled","disabled");
                    $("#old_price").val(data.product_variants.best_price);
                    $("#location").val(data.product_variants.location).attr("disabled","disabled");
                    $("#inputProduct_variantsEmailAddress").val(data.product_variants.email_address).attr("disabled","disabled");

                    $("#coverImgPrev").show();
                    $("#coverImgPrev").attr("src","<?php echo base_url()."/uploads/product_variants/"; ?>" + data.product_variants.cover_image);
                    $("#main-cropper , .actionUpload, #cancel_edit").hide();
                    $("#edit_image").show();
                    $("#count").val(data.product_variants.stock).attr("disabled","disabled");
                    //$("#proto").val(data.product_variants.proto).attr("disabled","disabled");
                    //$("#molds").val(data.product_variants.molds).attr("disabled","disabled");
                    $("#product_variantsID").val(data.product_variants.id);
                    $("#product_variantsModal").modal("show");
                    $("#saveProduct_variants").html("Save Product").hide();
                    $("#add_color").attr("disabled","disabled");
                    $("#edit_image").attr("disabled","disabled");
                    $("#count").val(data.product_variants.stock);

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
        $("#deleteProduct_variantsModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteProduct_variantsModal").modal("show");
    }
    
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/product_variants/"?>"+img_src+"?text="+Math.random().toString(36).substring(7));
        $("#imgPreviewModal").modal("show");
    }

    
    function set_image_loader(var_holder,file_holder)
    {
        $("#var_holder").val(var_holder);
        $("#file_holder").val(file_holder);
        $("#mediaGalleryModal").modal("show");
    }

    function _reflenish(id,description)
    {
        $("#reflenish_id").val(id);
        $("#reflenish_name").html(description);
        $("#reflenishProduct").modal("show");

    }
    function _reduce(id,description)
    {
        $("#reduce_id").val(id);
        $("#reduce_name").html(description);
        $("#reduceProduct").modal("show");

    }

    $(document).ready(main);

</script>
