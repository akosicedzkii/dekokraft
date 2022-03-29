<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo ucwords(str_replace("_"," ",$module_name));?>
    <small>Management</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucwords(str_replace("_"," ",$module_name));?></li>
    </ol>
</section>
<button class="btn btn-success btn-circle btn-lg fix-btn" id="addBtn"  data-toggle="tooltip" title="Add New">
    <span class="glyphicon glyphicon-plus"></span>
</button>
<!-- Main content -->
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucwords(str_replace("_"," ",$module_name));?> List</h3>
        <button class="btn btn-info pull-right" id="uploadPrices"  data-toggle="tooltip" title="Upload Prices">Upload Prices</button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="stationList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Map Url</th>
            <th>Station Name</th>
            <th>Branch Name</th>
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

<div class="modal fade" id="stationModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Station</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="stationID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="stationForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputStationName" class="col-sm-2 control-label">Station Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputStationName" placeholder="Station Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputMapUrl" class="col-sm-2 control-label">Map URL</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputMapUrl" placeholder="Map URL" style="resize:none" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="inputContact" class="col-sm-2 control-label">Contact Number</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputContact" placeholder="Contact Number" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputBranch" class="col-sm-2 control-label">Branch</label>

                                <div class="col-sm-10">
                                <select class="form-control" id="inputBranch" placeholder="Content" style="resize:none" required>
                                    <option value=""></option>
                                    <?php 
                                        if($branches != null){
                                            foreach($branches as $row){
                                                ?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $row->branch_name;?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div id="fuelTextbox">
                                <?php 
                                        if($fuel_list != null){
                                            foreach($fuel_list as $row){
                                                ?>
                                                    <div class="form-group">
                                                        <label for="fuel_<?php echo $row->id;?>" class="col-sm-2 control-label"><?php echo ucfirst($row->product_name);?></label>

                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="fuel_<?php echo $row->id;?>" placeholder="<?php echo ucfirst($row->product_name);?>" pattern="^\d+(\.\d{1,2})?$">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    ?>
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
            <button type="button" class="btn btn-primary" id="saveStation">Save Station</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteStationModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Station</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteStation">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="stationMap" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Station Map</h3>
            </div>
            <div class="modal-body">
                <center><iframe id="stationMapFrame" style="width:100%;"></iframe></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- /.modal -->
<div class="modal fade" id="uploadPricesModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Upload Prices</h3>
            </div>
            <div class="modal-body">
                <a href="<?php echo base_url("portal/stations/download_station_prices");?>" download>Download Prices Template</a>
                <center><input type="file" id="pricelist" accept=".csv" class="form-control"></center>
                <center>
                    <div class="form-group">
                        <div id="uploadBoxMainUpload" class="col-md-12">
                        </div>
                    </div>
                </center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="savePriceList">Upload New Pricelist</button>
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
        var table = $('#stationList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."portal/stations/get_stations_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },            
            { "visible": false,  "targets": [ 1 ] }
        ], "order": [[ 4, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#stationModal .modal-title").html("Add <?php echo ucwords(str_replace("_"," ",$module_name));?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#stationForm').validator();
            $("#stationModal").modal("show");
        });

        $("#saveStation").click(function(){
            $("#stationForm").submit();
        });
        $("#stationForm").validator().on('submit', function (e) {
           fuel_price = "";
            $('#fuelTextbox input[type=text]').each(function (){
                fuel_price += $(this).attr('id') + "||" + $(this).val() + "__";//used || __ as delimiter
            });
            var btn = $("#saveStation");
            var action = $("#action").val();
            btn.button("loading");
            if (!e.isDefaultPrevented()) {
               
                e.preventDefault();
                var station_name = $("#inputStationName").val();
                var map_url = $("#inputMapUrl").val();
                var branch_id = $("#inputBranch").val();
                var contact_number = $("#inputContact").val();
                if(station_name == "" || map_url =="" || contact_number == "" || branch_id == "")
                {
                    btn.button("reset");
                    return false;
                }
                var id = $("#stationID").val();
                var data = {
                    "id" : id,
                    "station_name" : station_name,
                    "contact_number" : contact_number,
                    "fuel_price" : fuel_price,
                    "map_url" : map_url,
                    "branch_id" : branch_id
                }

                var url = "<?php echo base_url()."portal/stations/add_station";?>";
                var message = "New station successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/stations/edit_station";?>";
                    message = "Station successfully updated";
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
                        $("#stationForm").validator('destroy');
                        $("#stationModal").modal("hide");        
                       $('#uploadBoxMain').html('');      
    
                    }
                });
            } else {
                 btn.button("reset"); 
            }
               return false;
        });

        
        $("#savePriceList").click(function(){
            var btn = $(this);
            btn.button("loading");
            var formData = new FormData();
            formData.append('pricelist', $('#pricelist').prop("files")[0]);

            $('#uploadBoxMainUpload').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMainUpload" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
            $.ajax({
                data: formData,
                type: "post",
                processData: false,
                contentType: false,
                cache: false,
                url: "<?php echo base_url()."portal/stations/upload_prices";?>" ,
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
                            
                            $('#progressBarMainUpload').css('width',percent+'%').html(percent+'%');
                                                            
                        }, true);
                    }
                    return xhr;
                },
                mimeType:"multipart/form-data"
            }).done(function(data){ 
                if(data == true)
                {
                    toastr.success('Station Prices Successfully Updated'); 
                }
                else
                {                    
                    toastr.error(data); 
                }
                btn.button("reset");
                $("#uploadPricesModal").modal("hide");
                
                $('#pricelist').val("");
                $('#uploadBoxMainUpload').html(''); 
                
            });

        });

        $("#deleteStation").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/stations/delete_station";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteStationModal").modal("hide");
                            toastr.error('Station ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#stationModal,#uploadPrices').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#stationForm").validator('destroy');
            $('#inputBranch').val("").trigger("change");
        });

        $('#inputBranch').select2(inputRoleConfig);
        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
        
        $("#uploadPrices").click(function(){
            $("#uploadPricesModal").modal("show");
        });
    };
    function _edit(id)
    {
        $("#stationModal .modal-title").html("Edit <?php echo ucwords(str_replace("_"," ",$module_name));?>");
        $('#stationForm').validator();    
        $("#action").val("edit");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/stations/get_stations_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    console.log(data);
                    $("#inputStationName").val(data.stations.station_name);
                    $("#inputMapUrl").val(data.stations.map_url);
                    $("#inputContact").val(data.stations.contact_number);
                    $("#inputBranch").val(data.stations.branch_id).trigger("change");
                    data_station_prices = JSON.parse( data.stations_fuel_prices );
                    for(var key in data_station_prices) {
                        if (data_station_prices.hasOwnProperty(key)) {
                            $("#fuel_" + data_station_prices[key].fuel_id).val(data_station_prices[key].price);
                        }
                    }
                    $("#stationID").val(data.stations.id);
                    $("#stationModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteStationModal .modal-title").html("Delete <?php echo rtrim(ucwords(str_replace("_"," ",$module_name)),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteStationModal").modal("show");
    }
    function _showMap(mapUrl)
    {
        $("#stationMapFrame").attr("src",mapUrl);
        $("#stationMap").modal("show");
    }
    $(document).ready(main);
</script>