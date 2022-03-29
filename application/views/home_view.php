
  <h2 id="homes"></h2>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    
    <ol class="carousel-indicators">
    <?php if($banners != null)
    {
        $increment = 0;
        foreach($banners as $row)
        {?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $increment;?>" <?php if($increment==0){ echo 'class="active"';}?>></li>
            <?php 
            $increment++;
        }
    }?>
    </ol>
    <div class="carousel-inner">
        <?php if($banners != null)
        {
            $increment = 0;
            foreach($banners as $row)
            {?>
                <div class="item<?php if($increment==0){ echo ' active';}?>">
                    <img class="carousel-bg" src="<?php echo base_url()."uploads/banners/".$row->banner_image;?>">
                    <div class="carousel-caption">
                        <h3><?php echo $row->title;?></h3>
                        <p><?php echo $row->description;?></p>
                    </div>
                    <?php if($row->inner_banner_image != null || $row->inner_banner_image != ""){?>
                        <!--<img id="doing-your-part-copy" class="carousel-content animate fade-in" src="<?php echo base_url()."uploads/banners/".$row->inner_banner_image;?>">-->
                    <?php }?>
                </div>
        <?php 
            $increment++;   }
        }?>
    </div>
   
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
    <section id="services">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-8 col-md-offset-2 pad-bottom" data-scroll-reveal="enter from the bottom after 0.2s">
                    <h2><strong>Services</strong></h2>
                    <p></p>

                </div>
            </div>

            <div class="row text-center">

                <?php foreach($charities as $charity){?>
                <div class="col-md-4 col-sm-4 html">
                    <center>
                       
                       <a  data-toggle="modal" data-target="#myModal<?php echo $charity->id;?>" href="#">
						<h3><?php echo $charity->title;?></h3>
                            
                        </a>


						<!-- Modal -->
						<div id="myModal<?php echo $charity->id;?>" class="modal fade" role="dialog">
						  <div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><?php echo $charity->title;?></h4>
							  </div>
							  <div class="modal-body">
								<?php echo $charity->content;?>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							  </div>
							</div>

						  </div>
						</div>
                </center>
                </div>
                <?php }?>
            </div>
        </div>
    </section>
    <!-- WORK SECTION END  -->
    <div id="technology" data-scroll-reveal="enter from the bottom after 0.2s">
        <div class="overlay">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
                        <i class="ion-ios-drag clr-set f-big"></i>
                        <br />
                       <?php echo $dynamic_settings->about_us;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- TESTIMONIAL SECTION END  -->
    <section id="osi">
        <div class="container">

            <div class="row text-center" data-scroll-reveal="enter from the bottom after 0.2s">
                <div class="col-md-12  pad-bottom">
                <?php echo $dynamic_settings->faqs;?>
                </div>
            </div>
           


        </div>
    </section>
    
 <section id="partners">
        <div class="partners">
      <div class="row text-center">
                <div class="col-md-8 col-md-offset-2 pad-bottom" data-scroll-reveal="enter from the bottom after 0.2s">
                    <h2><strong>Partners</strong></h2>
                    <p></p>

                </div>
            </div>
            <div class="row text-center" data-scroll-reveal="enter from the bottom after 0.2s">
                <div class="col-md-12  pad-bottom">
                  
                       <a  data-toggle="modal" href="http://mortgagequalityservices.com">
						<h3>MQS</h3>
                            
                        </a>
                           
                       <a  data-toggle="modal" href="http://advantageprocessserver.com">
						<h3>Advantage Process</h3>
                            
                        </a>
                           
                       <a  data-toggle="modal" href="http://processserversandiego.com">
						<h3>EServe</h3>
                            
                        </a>
                </div>
            </div>
           


        </div>
    </section>
    <!-- TEAM SECTION END -->
