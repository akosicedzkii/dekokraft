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
<a class="btn btn-success btn-circle btn-lg fix-btn" href="<?php echo base_url("portal/main/invoices/new");?>" data-toggle="tooltip" title="New Invoice">
    <span class="glyphicon glyphicon-plus"></span>
</a>
<!-- Main content -->
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?> List</h3>    
        <!--<button class="btn btn-info pull-right" id="downloadLogs"  data-toggle="tooltip" title="Upload Prices">Download Logs</button>-->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="invoicesList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>INVOICE ID</th>
            <th>CUSTOMER NAME</th>
            <th>TOTAL AMOUNT</th>
            <th>INVOICE TYPE</th>
            <th>REMARKS</th>
            <th>DATE CREATED</th>
            <th>CREATED BY</th>
            <th>DATE MODIFIED</th>
            <th>MODIFIED BY</th>
            <th>STATUS</th>
            <th>ACTIONS</th>
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

<!-- /.modal -->
<div class="modal fade" id="deleteInvoiceModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Invoice</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteInvoice">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="CreateMOInvoiceModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Create Marketing Order</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="MOKey">
                <center><h4>Are you sure to create marketing order for <label id="moItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="createMo">Create MO</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    var startDateDownload;
    var endDateDownload;

    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        startDateDownload = start.format('YYYY-MM-DD');
        endDateDownload = end.format('YYYY-MM-DD');
        console.log(startDateDownload + endDateDownload);
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    );
    var table = $('#invoicesList').DataTable({ 
        "order": [[ 0, "desc" ]] ,
        'autoWidth'   : true,
        "processing" : true,
        "serverSide" : true, 
        "ajax" : "<?php echo base_url()."portal/invoices/get_invoices_list";?>",
        "initComplete": function(settings,json){
            $('[data-toggle="tooltip"]').tooltip()
        }
        ,"columnDefs": [
        { "visible": false,  "targets": [ 0 ] },
        { "width": "20%",  "targets": [ 1 ] }
    ]
    });

    var main = function(){
       
       
        $("#clear").click(function(){
            $("#deleteLogsModal").modal("show");
        });

        $("#deleteLogs").click(function(){
            $("#deleteLogs").button("loading");
            var values = {"action" : "delete"}
            $.ajax({
                url: "<?php echo base_url();?>portal/invoices/delete_all_invoices",
                type: "post",
                data: values ,
                success: function (response) {
                    toastr.success("All invoices successfully deleted");
                    $("#deleteLogsModal").modal("hide");
                    table.draw();
                    $("#deleteLogs").button("reset");
                    //window.location = "";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#deleteLogs").button("reset");
                }


            });
        });
        $("#downloadLogs").click(function(){
            $("#downloadLogsModal").modal("show");
        });
        $("#downloadBtn").click(function(){
            window.open ("<?php echo base_url()."portal/invoices/download?fromDate="?>" + startDateDownload + "&toDate=" + endDateDownload,"_blank") ;
        });
    }

    function _view(id)
    {
        var values = { "id": id };
        $.ajax({
            url: "<?php echo base_url();?>portal/invoices/get_log_details",
            type: "post",
            data: values ,
            success: function (response) {
                data = JSON.parse(response);
                $("#log").html(data.log.log);
                $("#details").html(data.log.details);
                $("#date_created").html(data.log.date_created);
                $("#created_by").html(data.log.created_by);
                $("#module").html(data.log.module);
                $("#invoicesDetailsModal").modal("show");
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            $("#deleteLogs").button("reset");
            }


        });
       

    }
    $(document).ready(main);
    $("#deleteInvoice").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/invoices/delete_invoice";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteInvoiceModal").modal("hide");
                            toastr.error('Invoice ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });
    function _delete(id,item)
    {
        $("#deleteInvoiceModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(" invoice#: "+ item);
        $("#deleteKey").val(id);
        $("#deleteInvoiceModal").modal("show");
    }

    function _create_mo(id,item)
    {
        $("#moItem").html(" invoice#: "+ item);
        $("#MOKey").val(id);
        $("#CreateMOInvoiceModal").modal("show");
    }
    $("#createMo").click(function(){
            var btn = $(this);
            var id = $("#MOKey").val();
            var deleteItem = $("#moItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/invoices/create_mo";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#CreateMOInvoiceModal").modal("hide");
                            toastr.success('Marketing order for ' + id + ' successfully crated');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });
</script>