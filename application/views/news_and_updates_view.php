<section id="page-content">
<section id="page-title">
    <h3>NEWS &amp; UPDATES</h3>
</section>
<section id="news-preview-container">
    <div class="container">
        <div class="row">
            <?php if($news_and_updates != null){

                    foreach($news_and_updates as $row)
                    {
                        
                        ?>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                <a class="preview-anchor" data-toggle="modal" href="#" onclick="get_more_details(<?php echo $row->id;?>,'<?php echo $row->content_type;?>');return false;">
                                    <div class="news-preview appr">
                                        <div class="preview-img-container">
                                            <img src="<?php echo base_url()."uploads/".$row->content_type."/".$row->cover_image;?>" class="img-fluid" alt="">
                                            <div class="preview-title-container">
                                                <h4 class="preview-title"><?php echo ucfirst($row->title);?></h4>
                                            </div>
                                        </div>
                                        <p class="preview-content" align="justify"><?php echo ucfirst($row->description);?></p>
                                    </div>
                                </a>
                            </div>
                        <?php
                    }            

            }?>
        </div>
    </div>
</section>
</section>
<div class="modal fade" id="news-modal" tabindex="-1" role="dialog" aria-labelledby="article-type" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="article-type"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="article-title" id="article-title"></h5>
                <p><span id="publish-date"></span><!-- | <span id="publish-time">10:00 AM</span></p>
                <p>Written by <span id="publish-author">Unioil-Admin</span></p>-->
            </div>
            <div id="article-content" class="modal-body">
            </div>
            <div class="modal-footer">
                <a class="article-back" href="#" id="prev">BACK</a>
                <a class="article-next" href="#" id="next">NEXT</a>
            </div>
        </div>
    </div>
</div>
<script>
    function get_more_details(id,source)
    {
        var data = { "id" : id , "source" : source}
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."news_and_updates/get_news_and_updates_details";?>",
                success: function(data){
                    data = JSON.parse(data);
                    if(data.buttons.next != "none")
                    {
                        $("#next").show();
                        $("#next").attr("onClick",data.buttons.next);
                    }
                    else
                    {
                        $("#next").hide();
                    }
                    if(data.buttons.prev != "none")
                    {
                        $("#prev").show();
                        $("#prev").attr("onClick",data.buttons.prev);
                    }
                    else
                    {
                        $("#prev").hide();
                    }
                    $("#article-title").html(data.return.title);
                    $("#article-type").html(source.toUpperCase());
                    var date_created = new Date(data.return.date_created);
                    var monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                    ];
                    var dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                    var new_date = dayNames[date_created.getDay()] + ", " + monthNames[date_created.getMonth()] + " " + date_created.getDate() +", "+date_created.getFullYear();
                    $("#publish-date").html(new_date);
                    $("#article-content").html(data.return.content);
                    $("#news-modal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }

    function get_more_details_prev_next(id,source)
    {
        var data = { "id" : id , "source" : source}
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."news_and_updates/get_news_and_updates_details";?>",
                success: function(data){
                    data = JSON.parse(data);
                    if(data.buttons.next != "none")
                    {
                        $("#next").show();
                        $("#next").attr("onClick",data.buttons.next);
                    }
                    else
                    {
                        $("#next").hide();
                    }
                    if(data.buttons.prev != "none")
                    {
                        $("#prev").show();
                        $("#prev").attr("onClick",data.buttons.prev);
                    }
                    else
                    {
                        $("#prev").hide();
                    }
                    $("#article-title").html(data.return.title);
                    $("#article-type").html(source.toUpperCase());
                    var date_created = new Date(data.return.date_created);
                    var monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                    ];
                    var dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                    var new_date = dayNames[date_created.getDay()] + ", " + monthNames[date_created.getMonth()] + " " + date_created.getDate() +", "+date_created.getFullYear();
                    $("#publish-date").html(new_date);
                    $("#article-content").html(data.return.content);
                    $('#news-modal').animate({ scrollTop: 0 }, 'slow');
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }

</script>