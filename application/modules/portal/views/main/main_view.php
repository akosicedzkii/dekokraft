
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Main</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-star"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Site Views</span>
              <span class="info-box-number"><?php echo $all_visitors;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Views this Month</span>
              <span class="info-box-number"><?php echo $month_visitors;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-eye-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Unique views</span>
              <span class="info-box-number"><?php echo $unique_visitors?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-glasses-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Views Today</span>
              <span class="info-box-number"><?php echo $today_visitors?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
          <!-- MAP & BOX PANE -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Visitors Map
                <select id="filter">
                  <option value="today">Today</option>
                  <option value="this_month">This month</option>
                  <option value="all">All</option>
                </select>
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="pad">
                    <!-- Map will be created here -->
                    <div id="world-map-markers" style="height: 325px;"></div>
                  </div>
                </div>
                <!-- /.col -->
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
       

        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Contact Us Response</span>
              <span class="info-box-number"><?php if($submissions_counter != null){ echo $submissions_counter->contact_us; }else{ echo "0";}?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Franchise Request Submissions</span>
              <span class="info-box-number"><?php if($submissions_counter != null){ echo $submissions_counter->franchise; }else{ echo "0";}?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Careers Submissions</span>
              <span class="info-box-number"><?php if($submissions_counter != null){ echo $submissions_counter->careers; }else{ echo "0";}?></span>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="ion-android-bus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Number of Stations</span>
              <span class="info-box-number"><?php echo $blogs_count;?></span>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
            <div class="col-md-6">
              <!-- DIRECT CHAT -->
          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Blog</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
              <?php 
                      if($blogs != null)
                      {
                        $count = 0;
                        foreach($blogs as $row)
                        {
                          if($count==4)
                          {
                            break;
                          }
                            ?>
                               <li class="item" data-toggle="tooltip"  title="<?php echo ucfirst($row->description);?>">
                                <div class="product-img">
                                  <img src="<?php echo base_url("uploads/".$row->content_type."/".$row->cover_image);?>" alt="Cover Image">
                                </div>
                                <div class="product-info">
                                  <a href="javascript:void(0)"  class="product-title"><?php echo ucfirst($row->title);?>
                                   
                                  <span class="product-description">
                                        <?php echo substr(ucfirst($row->description),0,80);?>
                                      </span>
                                </div>
                              </li>
                            <?php
                            $count++;
                        }
                      }
                      ?>
                
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
            <?php 
              if (in_array("products", $menu)) {
              ?>
                  <a href="<?php echo base_url("portal/main/products");?>" class="uppercase">View All Blogs</a>
              <?php }?>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
              <!--/.direct-chat -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                      <?php 
                      if($users != null)
                      {
                        $count = 0;
                        foreach($users as $row)
                        {
                          if($count==8)
                          {
                            break;
                          }
                            ?>
                                <li>
                                <img style="height:60px;" src="<?php echo base_url("uploads/profile_image/").$row->profile_image;?>" alt="User Image">
                                <a class="users-list-name" data-toggle="tooltip" title="<?php echo ucwords(str_replace("  "," ",$row->first_name." ".$row->middle_name. " " .$row->last_name));?>" href="#"><?php echo ucwords(str_replace("  "," ",$row->first_name." ".$row->middle_name. " " .$row->last_name));?></a>
                                <span class="users-list-date"><?php echo date("Y-m-d",strtotime($row->date_created));?></span>
                                </li>
                            <?php
                            $count++;
                        }
                      }
                      ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <?php 
                        if (in_array("users", $menu)) {
                        ?>
                          <a href="<?php echo base_url("portal/main/users");?>" class="uppercase">View All Users</a>
                    <?php }?>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>

    var map = null;
    function initialize_map(locations)
    {
      map = AmCharts.makeChart( "world-map-markers", {
            "type": "map",
            "theme": "light",
            "projection": "miller",

            "imagesSettings": {
              "rollOverColor": "#089282",
              "rollOverScale": 3,
              "selectedScale": 3,
              "selectedColor": "#089282",
              "color": "#13564e"
            },

            "areasSettings": {
              "unlistedAreasColor": "#15A892"
            },

            "dataProvider": {
              "map": "worldLow",
              "images": locations
            }
        } );

        // add events to recalculate map position when the map is moved or zoomed
        map.addListener( "positionChanged", updateCustomMarkers );

    }

     // this function will take current images on the map and create HTML elements for them
     function updateCustomMarkers( event ) {
          // get map object
          var maps = event.chart;

          // go through all of the images
          for ( var x in maps.dataProvider.images ) {
            // get MapImage object
            var image = maps.dataProvider.images[ x ];

            // check if it has corresponding HTML element
            if ( 'undefined' == typeof image.externalElement )
              image.externalElement = createCustomMarker( image );

            // reposition the element accoridng to coordinates
            var xy = map.coordinatesToStageXY( image.longitude, image.latitude );
            image.externalElement.style.top = xy.y + 'px';
            image.externalElement.style.left = xy.x + 'px';
          }
        }

      
        // this function creates and returns a new marker element
        function createCustomMarker( image ) {
          // create holder
          var holder = document.createElement( 'div' );
          holder.className = 'map-marker';
          holder.title = image.title;
          holder.style.position = 'absolute';

          // maybe add a link to it?
          if ( undefined != image.url ) {
            holder.onclick = function() {
              window.location.href = image.url;
            };
            holder.className += ' map-clickable';
          }

          // create dot
          var dot = document.createElement( 'div' );
          dot.className = 'dot';
          holder.appendChild( dot );

          // create pulse
          var pulse = document.createElement( 'div' );
          pulse.className = 'pulse';
          holder.appendChild( pulse );

          // append the marker to the map container
          image.chart.chartDiv.appendChild( holder );

          return holder;
        }
   var main = function()
   {

    $("#filter").change(function(){
        var data = {"filter" : $("#filter").val() } 
        $.ajax({
          type: "get",
          data: data,
          url: "<?php echo base_url("portal/main/visitor_map");?>" ,
          success: function(data){
              data = JSON.parse( "["+ data + "]" );
              initialize_map(data);
              map.zoomOut();
                
          },
          error: function (request, status, error) {
              alert(request.responseText);
          }
      });
    });
    
    $("#filter").change();
   }
   $(document).ready(main);
</script>
