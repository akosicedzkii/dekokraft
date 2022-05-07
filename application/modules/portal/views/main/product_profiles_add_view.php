<div class="content-wrapper" style="min-height: 1135.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Profile
        <!-- <small>#007612</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Profile</li>
      </ol>
    </section>


    <form id="product_profile_form">
        <!-- Main content -->
        <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
            <h2 class="page-header">
                <!-- <i class="fa fa-globe"></i>--> <?php echo SITE_NAME;?>
                <small class="pull-right">Date: <?php echo date("m/d/Y");?></small>

            </h2>
            <!-- /.col -->
        </div>
        <br>
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                <center><img style="width:25%;" src="<?php echo base_url("uploads/product_variants/").$product_variants->cover_image;?>" class="image"></center>
            </div>
            <div class="col-sm-6 invoice-col">
                <table class="table" id="listing">
                    <tr><td>Class: </td><td><?php echo $product_variants->class;?></td></tr>
                    <tr><td>Stock #: </td><td><?php echo $product_variants->code. "-".$product_variants->color_abb;?></td></tr>
                    <tr><td>Desc: </td><td><?php echo $product_variants->description;?></td></tr>
                    <tr><td>Color: </td><td><?php echo $product_variants->color;?></td></tr>
                    <tr><td>Target Wgt.: </td><td><input type='text' id="weight" style="width:200px;" value="<?php echo $net_weight;?>" class="form-control"></td></tr>
                    <tr><td>Resin Unit Price: </td><td><input type='text' id="resin_unit_price" style="width:200px;" value="<?php echo $resin_unit_price;?>" class="form-control"></td></tr>
                    <tr><td>Finishing Unit Price: </td><td><input type='text' id="finishing_unit_price" style="width:200px;" value="<?php echo $finishing_unit_price;?>" class="form-control"></td></tr>

                    <tr><td>Spray Unit Price: </td><td><input type='text' id="spray_unit_price" style="width:200px;" value="<?php echo $spray_unit_price;?>" class="form-control"></td></tr>
                    <tr><td>Hand Paint Unit Price: </td><td><input type='text' id="hand_paint_unit_price" style="width:200px;" value="<?php echo $hand_paint_unit_price;?>" class="form-control"></td></tr>

                </table>
            </div>
        </div>
        <div class="row invoice-info">
          <div class="col-sm-8 invoice-col">
            <div class="col-sm-12 invoice-col">
              <?php
               $subcon_resin_cast=0;
               $subcon_resin_clean=0;
               $subcon_finishing=0;
                if(isset($prod_profile_details)){
                  $subcon_resin_cast=$prod_profile_details->provided_resin_cast==''?0:$prod_profile_details->provided_resin_cast;
                  $subcon_resin_clean=$prod_profile_details->provided_resin_clean==''?0:$prod_profile_details->provided_resin_clean;
                  $subcon_finishing=$prod_profile_details->provided_finishing==''?0:$prod_profile_details->provided_finishing;
                }
               ?>
              <table class="table" id="listing">
                      <tr>
                        <th>SUBCON JOB COST  </th>
                        <th>DERIVED (A+B)</th>
                        <th>DERIVED (A+C)</th>
                        <th>PROVIDED</th>
                      </tr>
                      <tr>
                        <td>Resin - Subcon Mat’l Mold and Labor</td>
                        <td><?php echo $resin_sub_mat=number_format($total_material['total_r']+$total_material['total_m'],2); ?></td>
                        <td><?php echo $resin_derived_ac=number_format(str_replace(',', '', $resin_sub_mat)+($subcon_resin_cast+$subcon_resin_clean), 2); ?></td>
                        <td><input type='text' id="provided_resin_mat" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->provided_resin_mat; }?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td>Resin - Subcon Labor, Dekokraft Mat’l</td>
                        <td>0.00</td>
                        <td><?php echo number_format($subcon_resin_cast+$subcon_resin_clean,2); ?></td>
                        <td><input type='text' id="provided_resin_lab" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->provided_resin_lab; }?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td>Finishing - Subcon Materials and Labor</td>
                        <td><?php echo number_format($total_material['total_f'],2); ?></td>
                        <td><?php echo $finishing_ac=number_format($total_material['total_f']+$subcon_finishing,2); ?></td>
                        <td><input type='text' id="provided_finishing_mat" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->provided_finishing_mat; }?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td>Finishing - Subcon Labor, Dekokraft Mat’l</td>
                        <td>0.00</td>
                        <td><?php echo number_format($subcon_finishing,2); ?></td>
                        <td><input type='text' id="provided_finishing_lab" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->provided_finishing_lab; }?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td>Artist - Subcon Materials and Labor</td>
                        <td>0.00</td>
                        <td>0.00</td>
                        <td><input type='text' id="provided_artist_mat" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->provided_artist_mat; }?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td>Artist - Subcon Labor, Dekokraft Mat’l</td>
                        <td>0.00</td>
                        <td>0.00</td>
                        <td><input type='text' id="provided_artist_lab" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->provided_artist_lab; }?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td>Trading </td>
                        <td><?php echo number_format(str_replace(',', '', $resin_sub_mat)+$total_material['total_f'], 2); ?></td>
                        <td><?php echo number_format(str_replace(',', '', $finishing_ac)+str_replace(',', '', $resin_derived_ac), 2); ?></td>
                        <td><input type='text' id="provided_trading" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->provided_trading; }?>" class="form-control"></td>
                      </tr>
                  </table>
            </div>
            <div class="col-sm-12 invoice-col">
              <table class="table" id="listing">
                  <tr>
                    <th>CBM (Standard Pack)</th>
                    <th>LxWxH</th>
                    <th>Content</th>
                    <th>Unit Cost</th>
                  </tr>
                  <tr>
                    <td>Inner Box</td>
                    <td><?php echo $product_variants->inner_carton; ?></td>
                    <td><?php echo $product_variants->in_; ?></td>
                    <td><input type='text' id="inner_box" style="width:150px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->in_box_cost;}?>" class="form-control"></td>
                    </tr>
                  <tr>
                    <td>Master Box</td>
                    <td><?php echo $product_variants->master_carton; ?></td>
                    <td><?php echo $product_variants->mstr; ?></td>
                    <td><input type='text' id="master_box" style="width:150px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->mstr_box_cost; }?>" class="form-control"></td>
                    </tr>
                  <tr>
                    <td>Inner Polybag</td>
                    <td><select type='text' id="inner_poly_size" style="width:180px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->in_poly_size; }?>" class="form-control"></select></td>
                    <td><input type='text' id="inner_polybag" style="width:150px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->in_poly_cont; }?>" class="form-control"></td>
                    <td><input type='text' id="in_poly_cost" style="width:150px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->in_poly_cost; }?>" class="form-control"></td>
                  </tr>
                  <tr>
                    <td>Master Polybag</td>
                    <td><select type='text' id="master_poly_size" style="width:180px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->mstr_poly_size; }?>" class="form-control"></select></td>
                    <td><input type='text' id="master_polybag" style="width:150px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->mstr_poly_cont; }?>" class="form-control"></td>
                    <td><input type='text' id="mstr_poly_cost" style="width:150px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->mstr_poly_cost; }?>" class="form-control"></td>
                    </tr>
              </table>
            </div>
          </div>

            <div class="col-sm-4 invoice-col">
              <div class="col-sm-12 invoice-col">
                  <table class="table" id="listing">
                      <tr><th>Labor Cost</th><th>JP</th><th>Provided(C)</th></tr>
                      <tr><td>Resin Cast</td><td>(RA)</td><td><input type='text' id="provided_resin_cast" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->provided_resin_cast;}?>" class="form-control"></td></tr>
                      <tr><td>Resin Clean</td><td>(RL)</td><td><input type='text' id="provided_resin_clean" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->provided_resin_clean; }?>" class="form-control"></td></tr>
                      <tr><td>Finishing</td><td>(F)</td><td><input type='text' id="provided_finishing" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->provided_finishing; }?>" class="form-control"></td></tr>
                      <tr><td>Artist Painting Material</td><td>(AP)</td><td></td></tr>
                  </table>
              </div>
              <div class="col-sm-12 invoice-col">
              <table class="table" id="listing">
                      <tr><th>L.C PESO COSTING </th><th></th></tr>
                      <tr><td>Selling L.C.</td><td><input type='text' id="selling_lc" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->selling_lc; }?>" class="form-control"></td></tr>
                      <tr><td>Sub-con L.C.</td><td><input type='text' id="subcon_lc" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->subcon_lc; }?>" class="form-control"></td></tr>
                      <tr><td>Derived Price (A)</td><td><input type='text' id="derived_price_a" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->derived_price_a; }?>" class="form-control"></td></tr>
                      <tr><td>Derived Price (B)</td><td><input type='text' id="derived_price_b" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->derived_price_b; }?>" class="form-control"></td></tr>
                      <tr><td>PESO/US$Conversion</td><td><input type='text' id="peso_conversion" style="width:200px;" value="<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->peso_conversion; }?>" class="form-control"></td></tr>
                  </table>
              </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                </br>
                </br>
                <center><a href="#"  onclick="return false;" id="add_material_group" class="btn btn-success">Add Material List</a>
                <?php  if(isset($prod_profile_details)){ ?>
                &emsp;<button type="button" class="btn btn-primary" id="updateDetails">Update Product Profile Details</button></center>

                <?php } ?>


                <br>
                <br>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-md-12 invoice-col">
                <table id="material_list_tbl" class="table" style='width:100%;'>
                <?php
                    if($material_groups!=null)
                    {
                        //echo "<pre>";
                        //var_dump($material_groups);
                        foreach($material_groups as $material){
                            ?>
                            <tr>
                                <td><h4><?php echo $material["material_group_name"];?><span class="pull-right"><a href="#" onclick="_edit(<?php echo  $material["id"]?>);return false;" class="btn btn-info">Edit</a>&emsp;<a href="#" onclick="_delete(<?php echo  $material["id"]?>,'<?php echo  $material["material_group_name"];?>');return false;" class="btn btn-danger">Delete</a></span></h4>
                                <table  class="table" style='width:100%;'>
                                        <thead>
                                            <tr>
                                            <th style="width:55%;">Material</th>
                                            <th style="width:15%;">JP</th>
                                            <th style="width:15%;">QTY</th>
                                            <th style="width:15%;">Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_materialss">
                                            <?php

                                                if($material[0] != null)
                                                {
                                                    foreach($material[0] as $material_items)
                                                    {
                                                        ?>
                                                        <tr>
                                                        <td><?php echo $material_items["material_name"]?></td>
                                                        <td><?php echo $material_items["jp"]?></td>
                                                        <td><?php echo $material_items["qty"]?></td>
                                                        <td><?php echo $material_items["unit"]?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                </table>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                ?>
                </table>
            </div>
        </div>

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
            <div id="uploadBoxMain" class="col-md-12">
                                </div>
            <a href="<?php echo base_url();?>portal/main/product_profiles/list" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
            <!-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button> -->
            </div>
        </div>
    </section>
    </form>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

  <div class="modal fade" id="product_profilesModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

             <h3 class="modal-title">Add Product Profile Materials</h3>
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="product_profilesForm" data-toggle="validator">

                        <input type="hidden" id="action">
                        <input type="hidden" name="net_weight"  id="net_weight">

                        <input type="hidden" name="product_profile_id"  id="product_profile_id">
                        <input type="hidden" name="provided_resin_cast_add" id="provided_resin_cast_add">
                        <input type="hidden" name="provided_resin_clean_add" id="provided_resin_clean_add">
                        <input type="hidden" name="provided_finishing_add" id="provided_finishing_add">
                        <input type="hidden" name="selling_lc_add" id="selling_lc_add">
                        <input type="hidden" name="subcon_lc_add" id="subcon_lc_add">
                        <input type="hidden" name="derived_price_a_add" id="derived_price_a_add">
                        <input type="hidden" name="derived_price_b_add" id="derived_price_b_add">
                        <input type="hidden" name="peso_conversion_add" id="peso_conversion_add">
                        <input type="hidden" name="provided_resin_mat_add" id="provided_resin_mat_add">
                        <input type="hidden" name="provided_resin_lab_add" id="provided_resin_lab_add">
                        <input type="hidden" name="provided_finishing_mat_add" id="provided_finishing_mat_add">
                        <input type="hidden" name="provided_finishing_lab_add" id="provided_finishing_lab_add">
                        <input type="hidden" name="provided_artist_mat_add" id="provided_artist_mat_add">
                        <input type="hidden" name="provided_artist_lab_add" id="provided_artist_lab_add">
                        <input type="hidden" name="provided_trading_add"  id="provided_trading_add">
                        <input type="hidden" name="inner_box_add"  id="inner_box_add">
                        <input type="hidden" name="master_box_add"  id="master_box_add">
                        <input type="hidden" name="inner_polybag_add"  id="inner_polybag_add">
                        <input type="hidden" name="master_polybag_add"  id="master_polybag_add">
                        <input type="hidden" name="in_poly_cost_add"  id="in_poly_cost_add">
                        <input type="hidden" name="mstr_poly_cost_add"  id="mstr_poly_cost_add">
                        <input type="hidden" name="in_poly_size_add"  id="in_poly_size_add">
                        <input type="hidden" name="mstr_poly_size_add"  id="mstr_poly_size_add">
                        <input type="hidden" name="product_variant_id" value="<?php echo $product_variants->id;?>">
                        <input type="hidden" name="resin_unit_price_add"  id="resin_unit_price_add">
                        <input type="hidden" name="finishing_unit_price_add"  id="finishing_unit_price_add">
                        <input type="hidden" name="spray_unit_price_add"  id="spray_unit_price_add">
                        <input type="hidden" name="hand_paint_unit_price_add"  id="hand_paint_unit_price_add">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="group_name" class="col-sm-2 control-label">Material List Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" value="MATERIAL REQUIREMENT SUMMARY" name="group_name" id="group_name" placeholder="Material List Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-success" onclick="return false;" id="add_material_btn">Add Material</a>
                                <a href="#" class="btn btn-info pull-right" onclick="return false;" id="add_new_material_btn">Add New Material</a>
                                <table class="table">
                                    <thead>
                                        <th>Material</th>
                                        <th>JP</th>
                                        <th>QTY</th>
                                        <th>Unit</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="tbody_materials">
                                    </tbody>
                                </table>
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
            <button type="button" class="btn btn-primary" id="saveMaterials">Save Product Profile Material List</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteMaterialsModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

             <h3 class="modal-title">Delete Materials</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteMaterials">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="product_profilesModalEdit" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

             <h3 class="modal-title">Edit Product Profile Materials</h3>
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="product_profilesForm_edit" data-toggle="validator">

                        <input type="hidden" id="action">
                        <input type="hidden" name="material_list_id_edit"  id="material_list_id_edit">
                        <input type="hidden" name="product_profile_id_edit"  id="product_profile_id_edit">
                        <input type="hidden" name="provided_resin_cast_edit" id="provided_resin_cast_edit">
                        <input type="hidden" name="provided_resin_clean_edit" id="provided_resin_clean_edit">
                        <input type="hidden" name="provided_finishing_edit" id="provided_finishing_edit">
                        <input type="hidden" name="selling_lc_edit" id="selling_lc_edit">
                        <input type="hidden" name="subcon_lc_edit" id="subcon_lc_edit">
                        <input type="hidden" name="derived_price_a_edit" id="derived_price_a_edit">
                        <input type="hidden" name="derived_price_b_edit" id="derived_price_b_edit">
                        <input type="hidden" name="peso_conversion_edit" id="peso_conversion_edit">
                        <input type="hidden" name="provided_resin_mat_edit" id="provided_resin_mat_edit">
                        <input type="hidden" name="provided_resin_lab_edit" id="provided_resin_lab_edit">
                        <input type="hidden" name="provided_finishing_mat_edit" id="provided_finishing_mat_edit">
                        <input type="hidden" name="provided_finishing_lab_edit" id="provided_finishing_lab_edit">
                        <input type="hidden" name="provided_artist_mat_edit" id="provided_artist_mat_edit">
                        <input type="hidden" name="provided_artist_lab_edit" id="provided_artist_lab_edit">
                        <input type="hidden" name="provided_trading_edit"  id="provided_trading_edit">
                        <input type="hidden" name="product_variant_id_edit"  id="product_variant_id_edit">
                        <input type="hidden" name="net_weight_edit"  id="net_weight_edit">
                        <input type="hidden" name="resin_unit_price_edit"  id="resin_unit_price_edit">
                        <input type="hidden" name="finishing_unit_price_edit"  id="finishing_unit_price_edit">
                        <input type="hidden" name="spray_unit_price_edit"  id="spray_unit_price_edit">
                        <input type="hidden" name="hand_paint_unit_price_edit"  id="hand_paint_unit_price_edit">
                        <input type="hidden" name="inner_box_edit"  id="inner_box_edit">
                        <input type="hidden" name="master_box_edit"  id="master_box_edit">
                        <input type="hidden" name="inner_polybag_edit"  id="inner_polybag_edit">
                        <input type="hidden" name="master_polybag_edit"  id="master_polybag_edit">
                        <input type="hidden" name="in_poly_cost_edit"  id="in_poly_cost_edit">
                        <input type="hidden" name="mstr_poly_cost_edit"  id="mstr_poly_cost_edit">
                        <input type="hidden" name="in_poly_size_edit"  id="in_poly_size_edit">
                        <input type="hidden" name="mstr_poly_size_edit"  id="mstr_poly_size_edit">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="group_name" class="col-sm-2 control-label">Material List Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="group_name_edit" id="group_name_edit" placeholder="Material List Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-success" onclick="return false;" id="add_material_btn_edit">Add Material</a>
                                <a href="#" class="btn btn-info pull-right" onclick="return false;" id="add_new_material_btn_edit">Add New Material</a>
                                <table class="table">
                                    <thead>
                                        <th>Material</th>
                                        <th>JP</th>
                                        <th>QTY</th>
                                        <th>Unit</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="tbody_materials_edit">
                                    </tbody>
                                </table>
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
            <button type="button" class="btn btn-primary" id="saveMaterials_edit">Save Product Profile Material List</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="materialsModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

             <h3 class="modal-title">Add Materials</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="materialsID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="materialsForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="material_name" class="col-sm-2 control-label">Material Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="material_name" placeholder="Material Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jp" class="col-sm-2 control-label">JP</label>

                                <div class="col-sm-10">

                                <select class="form-control" id="jp" placeholder="JP" style="resize:none" required>
                                    <option value="FA">FA</option>
                                    <option value="FB">FB</option>
                                    <option value="FC">FC</option>
                                    <option value="M">M</option>
                                    <option value="R">R</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="unit" class="col-sm-2 control-label">Unit</label>

                                <div class="col-sm-10">

                                <select class="form-control" id="unit" placeholder="Unit" style="resize:none" required>
                                    <option value="ML">ML</option>
                                    <option value="GM">GM</option>
                                    <option value="IN">IN</option>
                                    <option value="PC">PC</option>
                                    <option value="GAL">GAL</option>
                                    <option value="LI.">LI.</option>
                                    <option value="RL">RL</option>
                                    <option value="KG">KG</option>
                                    <option value="SHEET">SHEET</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cost" class="col-sm-2 control-label">Conversion Unit</label>

                                <div class="col-sm-5">
                                
                                <select class="form-control" id="conversion_unit" placeholder="Conversion Unit" style="resize:none" required>
                                    <option value="ML">ML</option>
                                    <option value="GM">GM</option>
                                    <option value="IN">IN</option>
                                    <option value="PC">PC</option>
                                    <option value="GAL">GAL</option>
                                    <option value="LI.">LI.</option>
                                    <option value="RL">RL</option>
                                    <option value="KG">KG</option>
                                    <option value="SHEET">SHEET</option>
                                </select>

                                <div class="help-block with-errors"></div>
                                </div>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" id="conversion_value" placeholder="Coversion Value">

                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cost" class="col-sm-2 control-label">Cost</label>

                                <div class="col-sm-10">

                                <input  type="number" min="0" step="any" class="form-control" id="cost" placeholder="Cost" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="color_composition" class="col-sm-2 control-label">Material Type</label>

                                <div class="col-sm-10">
                                <select class="form-control" id="color_composition" placeholder="Content" style="resize:none" required>
                                    <option value="material">Material</option>
                                    <option value="color">Color Composition</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
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
            <button type="button" class="btn btn-primary" id="saveMaterials2">Save Materials</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<script>

material_counter = 1;
$("#add_material_btn").click(function(){
    $("#tbody_materials").append("<tr><td><input type='hidden' name='selected_material[]'><select style='width:200px;' id='mat_"+material_counter+"'></select></td><td><label class='mat_jp'></label></td><td><input type='text' name='qty[]'></td><td><label class='mat_unit'></label></td><td><a href='#'  class='btn btn-danger remove_item' >&times;</a></td></tr>");

    $("#mat_"+material_counter).select2({
        minimumInputLength: 2,
        ajax: {
            url: "<?php echo base_url()."portal/materials/get_materials_selection";?>",
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
    $("#tbody_materials").on("click", ".remove_item", function() {
        $(this).closest("tr").remove();
    });
    $('#mat_'+ material_counter).on('select2:select', function (e) {
        var data = e.params.data;
        console.log(data)
        var $row = $(this).closest("tr");
        console.log($row)
        $row.find('input[name="selected_material[]"]').val(data.id);
        $row.find(".mat_jp").html(data.jp);
        $row.find(".mat_unit").html(data.unit);
    });
    material_counter ++;
});

$("#add_material_btn_edit").click(function(){
    $("#tbody_materials_edit").append("<tr><td><input type='hidden' name='selected_material_edit[]'><select required style='width:200px;' id='mat_"+material_counter+"'></select></td><td><label class='mat_jp'></label></td><td><input type='text' name='qty_edit[]' required></td><td><label class='mat_unit'></label></td><td><a href='#'  class='btn btn-danger remove_item' >&times;</a></td></tr>");

    $("#mat_"+material_counter).select2({
        minimumInputLength: 2,
        ajax: {
            url: "<?php echo base_url()."portal/materials/get_materials_selection";?>",
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
    $("#tbody_materials_edit").on("click", ".remove_item", function() {
        $(this).closest("tr").remove();
    });
    $('#mat_'+ material_counter).on('select2:select', function (e) {
        var data = e.params.data;
        console.log(data)
        var $row = $(this).closest("tr");
        console.log($row)
        $row.find('input[name="selected_material_edit[]"]').val(data.id);
        $row.find(".mat_jp").html(data.jp);
        $row.find(".mat_unit").html(data.unit);
    });
    material_counter ++;
});

$("#add_material_group").click(function(){
    $('#product_profilesModal').modal('show');
    material_counter = 1;
});

function _delete(id,item)
{
    $("#deleteMaterialsModal .modal-title").html("Delete Materials");
    $("#deleteItem").html(item);
    $("#deleteKey").val(id);
    $("#deleteMaterialsModal").modal("show");
}

$("#add_new_material_btn").click(function(){
    $("#materialsModal .modal-title").html("Add New Material");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#materialsForm').validator();
            $("#materialsModal").modal("show");
});
$("#add_new_material_btn_edit").click(function(){
    $("#materialsModal .modal-title").html("Add New Material");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#materialsForm').validator();
            $("#materialsModal").modal("show");
});

$("#saveMaterials2").click(function(){
    $("#materialsForm").submit();
});

var image_correct = true;
        var image_error = "";
        $("#materialsForm").validator().on('submit', function (e) {

            var btn = $("#saveMaterials2");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset");
            } else {
                e.preventDefault();
                var material_name = $("#material_name").val();
                var cost = $("#cost").val();
                var unit = $("#unit").val();
                var jp = $("#jp").val();
                var status = $("#inputStatus").val();
                var materials_id = $("#materialsID").val();
                var type = $("#color_composition").val();
                
                var conversion_unit = $("#conversion_unit").val();
                var conversion_value = $("#conversion_value").val();

                if(material_name == "" || cost == "")
                {
                    btn.button("reset");
                    return false;
                }

                var formData = new FormData();
                formData.append('id', materials_id);
                formData.append('material_name', material_name);
                formData.append('cost', cost);
                formData.append('unit', unit);
                formData.append('status', status);
                
                formData.append('conversion_unit', conversion_unit);
                formData.append('conversion_value', conversion_value);
                formData.append('jp', jp);
                formData.append('type', type);
                // Attach file
                 //fromthis
                 var url = "<?php echo base_url()."portal/materials/add_materials";?>";
                var message = "New materials successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/materials/edit_materials";?>";
                    message = "Materials successfully updated";
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
                    if(data!=1)
                    {
                        btn.button("reset");
                        toastr.error(data);
                    }
                    else
                    {
                         //alert("Data Save: " + data);
                         btn.button("reset");
                         toastr.success(message);
                         $("#materialsForm").validator('destroy');
                         $("#materialsModal").modal("hide");
                         $('#uploadBoxMain').html('');
                    }
                });
            }
               return false;
        });


function _edit(id)
{
    material_counter = 1;
    data= {"id":id}
    $.ajax({
            data: data,
            type: "post",
            url: "<?php echo base_url()."portal/product_profiles/get_materials_on_list";?>",
            success: function(data){
                //alert("Data Save: " + data);
                $("#tbody_materials_edit").html("");
                data = JSON.parse(data);
                console.log(data["material_list"])
                $("#group_name_edit").val(data["material_group"].material_group_name);
                $("#material_list_id_edit").val(data["material_group"].id)
                $("#product_variant_id_edit").val(data["material_list"].product_variant_id)
                $("#product_profile_id_edit").val(data["material_group"].product_profile_id)
                var arrayLength = data["material_list"].length;
                console.log(arrayLength);
                for (var i = 0; i < arrayLength; i++) {
                    $("#tbody_materials_edit").append("<tr><td><input type='hidden' value='"+data["material_list"][i]["material_id"]+"' name='selected_material_edit[]'><select required style='width:200px;' id='mat_"+material_counter+"'></select></td><td><label class='mat_jp'>"+data["material_list"][i]["jp"]+"</label></td><td><input type='text' value='"+data["material_list"][i]["qty"]+"' name='qty_edit[]' required></td><td><label class='mat_unit'>"+data["material_list"][i]["unit"]+"</label></td><td><a href='#'  class='btn btn-danger remove_item' >&times;</a></td></tr>");
                    $("#mat_"+material_counter).select2({
                        minimumInputLength: 2,
                        ajax: {
                            url: "<?php echo base_url()."portal/materials/get_materials_selection";?>",
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
                    $('#mat_'+ material_counter).append(new Option(data["material_list"][i]["material_name"],data["material_list"][i]["materia_id"],  true, true)).trigger('change');

                    $("#tbody_materials_edit").on("click", ".remove_item", function() {
                        $(this).closest("tr").remove();
                    });

                    $('#mat_'+ material_counter).on('select2:select', function (e) {
                        var data = e.params.data;
                        console.log(data)
                        var $row = $(this).closest("tr");
                        console.log($row)
                        $row.find('input[name="selected_material[]"]').val(data.id);
                        $row.find(".mat_jp").html(data.jp);
                        $row.find(".mat_unit").html(data.unit);
                    });
                    material_counter++;
                }
                $("#product_profilesModalEdit").modal("show");
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
    });
}
$("#deleteMaterials").click(function(){
    var btn = $(this);
    var id = $("#deleteKey").val();
    var deleteItem = $("#deleteItem").html();
    var data = { "id" : id };
    btn.button("loading");

    $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/product_profiles/delete_product_materials";?>",
                success: function(data){
                    //alert("Data Save: " + data);
                    btn.button("reset");
                    $("#deleteMaterialsModal").modal("hide");
                    toastr.error('Materials ' + deleteItem + ' successfully deleted');
                    setTimeout(() => {
                        window.location = "";
                    }, 1000);
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
});

$("#updateDetails").click(function(){


    var formData = new FormData();
    formData.append("net_weight",$("#weight").val());
    formData.append("resin_unit_price",$("#resin_unit_price").val());
    formData.append("finishing_unit_price",$("#finishing_unit_price").val());

    formData.append("spray_unit_price",$("#spray_unit_price").val());
    formData.append("hand_paint_unit_price",$("#hand_paint_unit_price").val());

    formData.append("provided_resin_cast",$("#provided_resin_cast").val());
    formData.append("provided_resin_clean",$("#provided_resin_clean").val());
    formData.append("provided_finishing",$("#provided_finishing").val());
    formData.append("selling_lc",$("#selling_lc").val());
    formData.append("subcon_lc",$("#subcon_lc").val());
    formData.append("derived_price_a",$("#derived_price_a").val());
    formData.append("derived_price_b",$("#derived_price_b").val());
    formData.append("peso_conversion",$("#peso_conversion").val());
    formData.append("provided_resin_mat",$("#provided_resin_mat").val());
    formData.append("provided_resin_lab",$("#provided_resin_lab").val());
    formData.append("provided_finishing_mat",$("#provided_finishing_mat").val());
    formData.append("provided_finishing_lab",$("#provided_finishing_lab").val());
    formData.append("provided_artist_mat",$("#provided_artist_mat").val());
    formData.append("provided_artist_lab",$("#provided_artist_lab").val());
    formData.append("provided_trading",$("#provided_trading").val());
    formData.append("inner_box",$("#inner_box").val());
    formData.append("master_box",$("#master_box").val());
    formData.append("inner_polybag",$("#inner_polybag").val());
    formData.append("master_polybag",$("#master_polybag").val());
    formData.append("in_poly_cost",$("#in_poly_cost").val());
    formData.append("mstr_poly_cost",$("#mstr_poly_cost").val());
    formData.append("in_poly_size",$("#inner_poly_size").val());
    formData.append("mstr_poly_size",$("#master_poly_size").val());
    formData.append("product_profile_id","<?php if(isset($prod_profile_details)){ echo $prod_profile_details->id;}?>");

    $.ajax({
    data: formData,
    type: "post",
    processData: false,
    contentType: false,
    cache: false,
    url: "<?php echo base_url()."portal/product_profiles/update_details";?>" ,
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
        //btn.button("reset");
        toastr.error(data);
    }
    else
    {
            //alert("Data Save: " + data);
           // btn.button("reset");
            toastr.success("Update Successfully");

            setTimeout(() => {
                         window.location = "";
                    }, 1000);
    }
});
});
$("#saveMaterials").click(function(){
    var btn=$("#saveMaterials");
    $("#net_weight").val($("#weight").val());
    $("#resin_unit_price_add").val($("#resin_unit_price").val());
    $("#finishing_unit_price_add").val($("#finishing_unit_price").val());
    
    $("#spray_unit_price_add").val($("#spray_unit_price").val());
    $("#hand_paint_unit_price_add").val($("#hand_paint_unit_price").val());

    $("#provided_resin_cast_add").val($("#provided_resin_cast").val())
    $("#provided_resin_clean_add").val($("#provided_resin_clean").val())
    $("#provided_finishing_add").val($("#provided_finishing").val())
    $("#selling_lc_add").val($("#selling_lc").val())
    $("#subcon_lc_add").val($("#subcon_lc").val())
    $("#derived_price_a_add").val($("#derived_price_a").val())
    $("#derived_price_b_add").val($("#derived_price_b").val())
    $("#peso_conversion_add").val($("#peso_conversion").val())
    $("#provided_resin_mat_add").val($("#provided_resin_mat").val())
    $("#provided_resin_lab_add").val($("#provided_resin_lab").val())
    $("#provided_finishing_mat_add").val($("#provided_finishing_mat").val())
    $("#provided_finishing_lab_add").val($("#provided_finishing_lab").val())
    $("#provided_artist_mat_add").val($("#provided_artist_mat").val())
    $("#provided_artist_lab_add").val($("#provided_artist_lab").val())
    $("#provided_trading_add").val($("#provided_trading").val())
    $("#inner_box_add").val($("#inner_box").val());
    $("#master_box_add").val($("#master_box").val());
    $("#inner_polybag_add").val($("#inner_polybag").val());
    $("#master_polybag_add").val($("#master_polybag").val());
    $("#in_poly_cost_add").val($("#in_poly_cost").val());
    $("#mstr_poly_cost_add").val($("#mstr_poly_cost").val());
    $("#in_poly_size_add").val($("#inner_poly_size").val());
    $("#mstr_poly_size_add").val($("#master_poly_size").val());
    
    console.log($("#product_profilesForm_edit").serialize());
    console.log($("#product_profilesForm").serialize());
    $.ajax({
    data: $("#product_profilesForm").serialize(),
    type: "get",
    processData: false,
    contentType: false,
    cache: false,
    url: "<?php echo base_url()."portal/product_profiles/add_product_profiles";?>" ,
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
            toastr.success("Material Group Added Successfully");
            setTimeout(() => {
                        window.location = "";
                    }, 1000);
            $("#colorsForm").validator('destroy');
            $("#colorsModal").modal("hide");
            $('#uploadBoxMain').html('');
    }
});
});

$("#inner_poly_size").select2({
        minimumInputLength: 2,
        ajax: {
            url: "<?php echo base_url()."portal/product_profiles/get_product_in_poly_size";?>",
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
$("#inner_poly_size").val('<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->in_poly_size; }?>').trigger('change');
$("#inner_poly_size").append(new Option("<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->in_poly_size; }?>","<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->in_poly_size; }?>",  true, true)).trigger('change');

$("#master_poly_size").select2({
        minimumInputLength: 2,
        ajax: {
            url: "<?php echo base_url()."portal/product_profiles/get_product_inner_polybag";?>",
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
$("#master_poly_size").val('<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->mstr_poly_size; }?>').trigger('change');
$("#master_poly_size").append(new Option("<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->mstr_poly_size; }?>","<?php if(!isset($prod_profile_details)){ }else{ echo $prod_profile_details->mstr_poly_size; }?>",  true, true)).trigger('change');


$("#saveMaterials_edit").click(function(){
    var btn=$("#saveMaterials_edit");

    $("#net_weight_edit").val($("#weight").val());
    $("#resin_unit_price_edit").val($("#resin_unit_price").val());
    $("#finishing_unit_price_edit").val($("#finishing_unit_price").val());

    
    $("#spray_unit_price_edit").val($("#spray_unit_price").val());
    $("#hand_paint_unit_price_edit").val($("#hand_paint_unit_price").val());

    $("#provided_resin_cast_edit").val($("#provided_resin_cast").val())
    $("#provided_resin_clean_edit").val($("#provided_resin_clean").val())
    $("#provided_finishing_edit").val($("#provided_finishing").val())
    $("#selling_lc_edit").val($("#selling_lc").val())
    $("#subcon_lc_edit").val($("#subcon_lc").val())
    $("#derived_price_a_edit").val($("#derived_price_a").val())
    $("#derived_price_b_edit").val($("#derived_price_b").val())
    $("#peso_conversion_edit").val($("#peso_conversion").val())
    $("#provided_resin_mat_edit").val($("#provided_resin_mat").val())
    $("#provided_resin_lab_edit").val($("#provided_resin_lab").val())
    $("#provided_finishing_mat_edit").val($("#provided_finishing_mat").val())
    $("#provided_finishing_lab_edit").val($("#provided_finishing_lab").val())
    $("#provided_artist_mat_edit").val($("#provided_artist_mat").val())
    $("#provided_artist_lab_edit").val($("#provided_artist_lab").val())
    $("#provided_trading_edit").val($("#provided_trading").val())
    $("#inner_box_edit").val($("#inner_box").val());
    $("#master_box_edit").val($("#master_box").val());
    $("#inner_polybag_edit").val($("#inner_polybag").val());
    $("#master_polybag_edit").val($("#master_polybag").val());
    $("#in_poly_cost_edit").val($("#in_poly_cost").val());
    $("#mstr_poly_cost_edit").val($("#mstr_poly_cost").val());
    $("#in_poly_size_edit").val($("#inner_poly_size").val());
    $("#mstr_poly_size_edit").val($("#master_poly_size").val());
    console.log($("#product_profilesForm_edit").serialize());
    $.ajax({
    data: $("#product_profilesForm_edit").serialize(),
    type: "get",
    processData: false,
    contentType: false,
    cache: false,
    url: "<?php echo base_url()."portal/product_profiles/update_product_profiles";?>" ,
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
            toastr.success("Material Group Added Successfully");

            setTimeout(() => {
                        window.location = "";
                    }, 1000);
            $("#colorsForm").validator('destroy');
            $("#colorsModal").modal("hide");
            $('#uploadBoxMain').html('');
    }
});
});

</script>
