<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<?php $module_name = ucwords(str_replace("_"," ",$module_name));?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo ucfirst($module_name)."";?>
    <small>Management</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucfirst( $module_name);?></li>
    </ol>
</section>
<section class="content">
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name)."";?></h3>
    </div>
    <!-- /.box-header -->
<div class="box-body">
    <form class="form-horizontal" id="AboutUsForm" data-toggle="validator">
        <div class="box-body">
            <div class="form-group">

                <div class="col-md-12">
                <textarea id="inputText" class="form-control" style="height:500px;"><?php echo $dynamic_settings->about_us;?></textarea>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                <input type="submit" class="btn btn-success pull-right" id="saveSettings" value="Save">
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
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>

<script>
    var editor = CKEDITOR.replace('inputText');
    editor.config.height = 500;
    var main = function(){
        
        $("#AboutUsForm").submit(function(e){
          e.preventDefault();
          var btn =  $("#saveSettings");

            btn.button("loading");


            var formData = new FormData();

            formData.append("page" , "<?php echo $page;?>");
            var dynamic_about_us  = editor.getData();
            formData.append("about_us" , dynamic_about_us);
            $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
                $.ajax({
                    data: formData,
                    type: "post",
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: "<?php echo base_url()."portal/about_us/update_settings";?>" ,
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
                    if(data == true)
                    { 
                        btn.button("reset");
                        toastr.success('<?php echo str_replace("_"," ",ucfirst($page));?> successfully updated');
                        setTimeout(function() {
                        window.location = "";
                        }, 200);

                    }else{
                            btn.button("reset");
                            toastr.error(data); $('#uploadBoxMain').html('');     
                    }
                });   
            });         
    };
    
    
    $(document).ready(main);
</script>
