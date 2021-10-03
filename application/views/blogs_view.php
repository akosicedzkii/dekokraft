<style>
body {
    padding-top: 100px; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
}

footer {
    margin: 50px 0;
}
</style>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Blog Post
                </h1>
                <?php 
                    if($blogs == null && $search != ""){
                        ?>
                        <h2>
                            No results found for "<?php echo $search;?>"
                        </h2>
                        <?php
                    }
                    else  if($blogs == null)
                    {
                        ?>
                        <h2>
                            No results found
                        </h2>
                        <?php
                    }
                    foreach($blogs as $post)
                    {
                        ?>
                            <h2>
                                <a href="<?php echo base_url()."blogs/page/".str_replace(" ","-",strtolower($post->title))."-".$post->id?>"><?php echo $post->title;?></a>
                            </h2>
                            <p class="lead">
                              by <a href="#"><?php if($post->author != null){echo $post->author;}else{ echo "Anonymous";}?></a>
                            </p><p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date("F d, Y H:i A",strtotime($post->date_created));?></p>

                            <hr> 
                            <?php
                                if($post->file_name != "")
                                {
                            ?>
                                <center><img class="img-responsive" src="<?php echo base_url()."uploads/blogs/".$post->file_name;?>" alt=""></center>     
                                <hr>
                            <?php
                                }
                            ?>
                            <p><?php echo $post->description;?></p>
                            <a class="btn btn-primary" href="<?php echo base_url()."blogs/page/".str_replace(" ","-",strtolower($post->title))."-".$post->id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>

                        <?php
                    }
                ?>

                <!-- Pager -->
                <ul class="pager">
                    <?php
                        if($prev_url != null)
                        {
                            ?>
                                <li class="previous">
                                    <a href="<?php echo $prev_url;?>">&larr; Older</a>
                                </li>
                            <?php
                        } 
                    ?>

                    <?php
                        if($next_url != null)
                        {
                            ?>
                                <li class="next">
                                    <a href="<?php echo $next_url;?>">Newer &rarr;</a>
                                </li>
                            <?php
                        } 
                    ?>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>    
                    <form action="<?php echo base_url()."blogs";?>">
                        <div class="input-group">                        
                            <input type="text" class="form-control" name="q" value="<?php echo $search;?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- 
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>-->

                <div class="well">
                    <h4>Recent Blog Post</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php foreach($recent_blog as $recent)
                                {
                                    ?>
                                        <li>
                                        <a href="<?php echo base_url()."blogs/page/".str_replace(" ","-",strtolower($recent->title))."-".$recent->id?>">
                                            <div class="row">
                                                <div class = "col-md-4">
                                                    <img class="img-responsive" src="<?php echo base_url()."uploads/blogs/".$recent->file_name;?>" alt="">
                                                </div>
                                                <div class = "col-md-8">
                                                <?php echo $recent->title?>
                                                <br>
                                                <?php echo $recent->description;?>
                                                </div>
                                            </div>
                                        </a>
                                       </li>
                                       <hr>
                                    <?php
                                }?>
                                
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

    </div>
    <!-- /.container -->