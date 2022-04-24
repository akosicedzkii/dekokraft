<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_profiles extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();
        $this->load->model("portal/product_profiles_model");

        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_product_profiles()
	{
        $this->product_profiles_model->product_variant_id = $this->input->get("product_variant_id");
        $this->product_profiles_model->materials = $this->input->get("selected_material");
        $this->product_profiles_model->qty = $this->input->get("qty");
        $this->product_profiles_model->group_name = $this->input->get("group_name");
        $this->product_profiles_model->net_weight = $this->input->get("net_weight");
        $this->product_profiles_model->resin_unit_price = $this->input->get("resin_unit_price_add");
        $this->product_profiles_model->finishing_unit_price = $this->input->get("finishing_unit_price_add");
        $this->product_profiles_model->spray_unit_price = $this->input->get("spray_unit_price_add");
        $this->product_profiles_model->hand_paint_unit_price = $this->input->get("hand_paint_unit_price_add");
        $this->product_profiles_model->provided_resin_cast =	$this->input->get("provided_resin_cast_add");
        $this->product_profiles_model->provided_resin_clean =	$this->input->get("provided_resin_clean_add");
        $this->product_profiles_model->provided_finishing =	 	 $this->input->get("provided_finishing_add");
        $this->product_profiles_model->selling_lc =	 	 	 $this->input->get("selling_lc_add");
        $this->product_profiles_model->subcon_lc =	 	 	 $this->input->get("subcon_lc_add");
        $this->product_profiles_model->derived_price_a =	 	 	$this->input->get("derived_price_a_add");
        $this->product_profiles_model->derived_price_b =	 	 	$this->input->get("derived_price_b_add");
        $this->product_profiles_model->peso_conversion =	 	 	$this->input->get("peso_conversion_add");
        $this->product_profiles_model->provided_resin_mat =	 	 	$this->input->get("provided_resin_mat_add");
        $this->product_profiles_model->provided_resin_lab =	 	 	$this->input->get("provided_resin_lab_add");
        $this->product_profiles_model->provided_finishing_mat =	 	$this->input->get("provided_finishing_mat_add");
        $this->product_profiles_model->provided_finishing_lab =	 	$this->input->get("provided_finishing_lab_add");
        $this->product_profiles_model->provided_artist_mat = 	 	$this->input->get("provided_artist_mat_add");
        $this->product_profiles_model->provided_artist_lab =	 	$this->input->get("provided_artist_lab_add");
        $this->product_profiles_model->provided_trading =           $this->input->get("provided_trading_add");
        $this->product_profiles_model->inner_box = $this->input->get("inner_box_add");
        $this->product_profiles_model->master_box = $this->input->get("master_box_add");
        $this->product_profiles_model->inner_polybag = $this->input->get("inner_polybag_add");
        $this->product_profiles_model->master_polybag = $this->input->get("master_polybag_add");
        $this->product_profiles_model->in_poly_cost = $this->input->get("in_poly_cost_add");
        $this->product_profiles_model->mstr_poly_cost = $this->input->get("mstr_poly_cost_add");
        $this->product_profiles_model->in_poly_size = $this->input->get("in_poly_size_add");
        $this->product_profiles_model->mstr_poly_size = $this->input->get("mstr_poly_size_add");
        echo $this->product_profiles_model->insert_product_profiles();
	}
    public function update_product_profiles()
	{
        $this->product_profiles_model->product_variant_id = $this->input->get("product_variant_id_edit");
        $this->product_profiles_model->product_profile_id = $this->input->get("product_profile_id_edit");
        $this->product_profiles_model->materials = $this->input->get("selected_material_edit");
        $this->product_profiles_model->material_group_id = $this->input->get("material_list_id_edit");
        $this->product_profiles_model->qty = $this->input->get("qty_edit");
        $this->product_profiles_model->net_weight = $this->input->get("net_weight_edit");
        $this->product_profiles_model->resin_unit_price = $this->input->get("resin_unit_price_edit");
        $this->product_profiles_model->finishing_unit_price = $this->input->get("finishing_unit_price_edit");

        $this->product_profiles_model->spray_unit_price = $this->input->get("spray_unit_price_edit");
        $this->product_profiles_model->hand_paint_unit_price = $this->input->get("hand_paint_unit_price_edit");
        $this->product_profiles_model->provided_resin_cast =	$this->input->get("provided_resin_cast_edit");
        $this->product_profiles_model->provided_resin_clean =	$this->input->get("provided_resin_clean_edit");
        $this->product_profiles_model->provided_finishing =	 	 $this->input->get("provided_finishing_edit");
        $this->product_profiles_model->selling_lc =	 	 	 $this->input->get("selling_lc_edit");
        $this->product_profiles_model->subcon_lc =	 	 	 $this->input->get("subcon_lc_edit");
        $this->product_profiles_model->derived_price_a =	 	 	$this->input->get("derived_price_a_edit");
        $this->product_profiles_model->derived_price_b =	 	 	$this->input->get("derived_price_b_edit");
        $this->product_profiles_model->peso_conversion =	 	 	$this->input->get("peso_conversion_edit");
        $this->product_profiles_model->provided_resin_mat =	 	 	$this->input->get("provided_resin_mat_edit");
        $this->product_profiles_model->provided_resin_lab =	 	 	$this->input->get("provided_resin_lab_edit");
        $this->product_profiles_model->provided_finishing_mat =	 	$this->input->get("provided_finishing_mat_edit");
        $this->product_profiles_model->provided_finishing_lab =	 	$this->input->get("provided_finishing_lab_edit");
        $this->product_profiles_model->provided_artist_mat = 	 	$this->input->get("provided_artist_mat_edit");
        $this->product_profiles_model->provided_artist_lab =	 	$this->input->get("provided_artist_lab_edit");
        $this->product_profiles_model->provided_trading =           $this->input->get("provided_trading_edit");
        $this->product_profiles_model->group_name = $this->input->get("group_name_edit");
        $this->product_profiles_model->inner_box = $this->input->get("inner_box_edit");
        $this->product_profiles_model->master_box = $this->input->get("master_box_edit");
        $this->product_profiles_model->inner_polybag = $this->input->get("inner_polybag_edit");
        $this->product_profiles_model->master_polybag = $this->input->get("master_polybag_edit");
        $this->product_profiles_model->in_poly_cost = $this->input->get("in_poly_cost_edit");
        $this->product_profiles_model->mstr_poly_cost = $this->input->get("mstr_poly_cost_edit");
        $this->product_profiles_model->in_poly_size = $this->input->get("in_poly_size_edit");
        $this->product_profiles_model->mstr_poly_size = $this->input->get("mstr_poly_size_edit");
        echo $this->product_profiles_model->update_material_list();
    }

    public function update_details()
	{
        $this->product_profiles_model->product_variant_id = $this->input->post("product_variant_id");
        $this->product_profiles_model->product_profile_id = $this->input->post("product_profile_id");
        $this->product_profiles_model->net_weight = $this->input->post("net_weight");
        $this->product_profiles_model->provided_resin_cast =	$this->input->post("provided_resin_cast");
        $this->product_profiles_model->provided_resin_clean =	$this->input->post("provided_resin_clean");
        $this->product_profiles_model->provided_finishing =	 	 $this->input->post("provided_finishing");
        $this->product_profiles_model->selling_lc =	 	 	 $this->input->post("selling_lc");
        $this->product_profiles_model->subcon_lc =	 	 	 $this->input->post("subcon_lc");
        $this->product_profiles_model->derived_price_a =	 	 	$this->input->post("derived_price_a");
        $this->product_profiles_model->derived_price_b =	 	 	$this->input->post("derived_price_b");
        $this->product_profiles_model->peso_conversion =	 	 	$this->input->post("peso_conversion");
        $this->product_profiles_model->provided_resin_mat =	 	 	$this->input->post("provided_resin_mat");
        $this->product_profiles_model->provided_resin_lab =	 	 	$this->input->post("provided_resin_lab");
        $this->product_profiles_model->provided_finishing_mat =	 	$this->input->post("provided_finishing_mat");
        $this->product_profiles_model->provided_finishing_lab =	 	$this->input->post("provided_finishing_lab");
        $this->product_profiles_model->provided_artist_mat = 	 	$this->input->post("provided_artist_mat");
        $this->product_profiles_model->provided_artist_lab =	 	$this->input->post("provided_artist_lab");
        $this->product_profiles_model->provided_trading =           $this->input->post("provided_trading");
        $this->product_profiles_model->inner_box = $this->input->post("inner_box");
        $this->product_profiles_model->master_box = $this->input->post("master_box");
        $this->product_profiles_model->inner_polybag = $this->input->post("inner_polybag");
        $this->product_profiles_model->master_polybag = $this->input->post("master_polybag");
        $this->product_profiles_model->in_poly_cost = $this->input->post("in_poly_cost");
        $this->product_profiles_model->mstr_poly_cost = $this->input->post("mstr_poly_cost");
        $this->product_profiles_model->in_poly_size = $this->input->post("in_poly_size");
        $this->product_profiles_model->mstr_poly_size = $this->input->post("mstr_poly_size");
        
        $this->product_profiles_model->resin_unit_price = $this->input->post("resin_unit_price");
        $this->product_profiles_model->finishing_unit_price = $this->input->post("finishing_unit_price");

        $this->product_profiles_model->spray_unit_price = $this->input->post("spray_unit_price");
        $this->product_profiles_model->hand_paint_unit_price = $this->input->post("hand_paint_unit_price");
        echo $this->product_profiles_model->update_details();
    }

    public function get_materials_on_list()
    {
        $id = $this->input->post("id");
        $this->db->join("materials","materials.id=product_profile_materials.material_id");
        $material_list["material_list"] =$this->db->where("product_material_group_id",$id)->order_by("FIELD(materials.jp, 'M', 'R', 'FA', 'FB', 'FC')")->get("product_profile_materials")->result();
        $this->db->where("id",$id);
        $material_list["material_group"] = $this->db->get("product_material_group")->row();
        echo json_encode($material_list);
    }
	public function edit_product_profiles()
	{
        $this->product_profiles_model->id = $this->input->post("id");
        $this->product_profiles_model->title = $this->input->post("title");
        $this->product_profiles_model->description = $this->input->post("description");
        $this->product_profiles_model->status = $this->input->post("status");
        $this->product_profiles_model->class = $this->input->post("class");
        $this->product_profiles_model->code = $this->input->post("code");
        //$this->product_profiles_model->cover_image = $this->input->post("cover_image");
        //$this->product_profiles_model->color = $this->input->post("color");
        //$this->product_profiles_model->color_abb = $this->input->post("color_abb");
        $this->product_profiles_model->inner_carton = $this->input->post("inner_carton");
        $this->product_profiles_model->master_carton = $this->input->post("master_carton");
        $this->product_profiles_model->weight_of_box = $this->input->post("weight_of_box");
        $this->product_profiles_model->minimum_of_quantity = $this->input->post("minimum_of_quantity");
        $this->product_profiles_model->lowest_cost = $this->input->post("lowest_cost");
        $this->product_profiles_model->best_price = $this->input->post("best_price");
        $this->product_profiles_model->old_price = $this->input->post("old_price");
        $this->product_profiles_model->product_year = $this->input->post("product_year");
        $this->product_profiles_model->product_month = $this->input->post("product_month");
        $this->product_profiles_model->fob = $this->input->post("fob");
        //$this->product_profiles_model->location = $this->input->post("location");
        echo $this->product_profiles_model->update_product_profiles();
	}

	public function delete_product_materials()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);

        $data_product_profiles = $this->db->get("product_material_group");

        $this->db->where("product_material_group_id",$id);
        $data_product_profile_materials  = $this->db->get("product_profile_materials");
        $this->db->where("id",$id);
        $result = $this->db->delete("product_material_group");
        $this->db->where("product_material_group_id",$id);
        echo $result = $this->db->delete("product_profile_materials");
        $data = json_encode($data_product_profiles->row());
        $this->logs->log = "Deleted Material Group ID - ID:". $data_product_profiles->row()->id .", Material Group Name: ".$data_product_profiles->row()->title ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "product_profiles";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();

	}

    public function get_product_profiles_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("product_profiles");
        $product_profiles = $result->row();
        if($product_profiles->cover_image != null)
        {
            if(is_numeric( $product_profiles->cover_image ))
            {
                $product_profiles->cover_image_id = $product_profiles->cover_image;
                $product_profiles->cover_image = $this->db->where("id",$product_profiles->cover_image)->get("media")->row()->file_name;
            }
        }
        $return["product_profiles"] = $product_profiles;
        echo json_encode($return);
    }
    public function get_product_profiles_selection()
    {

        $search = $this->input->get("term[term]");
        $this->db->like("title",$search);
        //$this->db->where("status",1);
        $this->db->or_like("code",$search);
        //$this->db->where("status",1);
        $this->db->or_like("class",$search);
        //$this->db->where("status",1);
        $this->db->select("title as text");
        $this->db->select("class");
        $this->db->select("code");
        $this->db->select("description");
        $this->db->select("id");
        $this->db->limit(10);
        $filteredValues=$this->db->get("product_profiles")->result_array();

        echo json_encode(array(
            'items' => $filteredValues
        ));
    }


    public function get_product_in_poly_size()
    {

        $search = $this->input->get("term[term]");
        $this->db->like("in_poly_size",$search);
        //$this->db->where("status",1);
        
        $this->db->distinct('in_poly_size');
        //$this->db->where("status",1);
        $this->db->select("in_poly_size as text");
        $this->db->select("in_poly_size as id");
        $this->db->limit(10);
        $filteredValues=$this->db->get("product_profiles")->result_array();

        echo json_encode(array(
            'items' => $filteredValues
        ));
    }

    
    public function get_product_inner_polybag()
    {

        $search = $this->input->get("term[term]");
        $this->db->like("mstr_poly_size",$search);
        //$this->db->where("status",1);
        //$this->db->where("status",1);
        $this->db->distinct('mstr_poly_size');
        $this->db->select("mstr_poly_size as text");
        $this->db->select("mstr_poly_size as id");
        $this->db->limit(10);
        $filteredValues=$this->db->get("product_profiles")->result_array();

        echo json_encode(array(
            'items' => $filteredValues
        ));
    }

    public function get_product_profiles_list()
    {
        $this->load->model("portal/data_table_model","dt_model");

        $this->dt_model->select_columns = array("t7.id","t1.class","t1.code","t1.description","t7.color","t6.id as product_profile_id","t6.net_weight","t6.resin_unit_price","t6.finishing_unit_price","t6.spray_unit_price","t6.hand_paint_unit_price");
        if($this->session->userdata("USERTYPE") ==1)
        {
            $this->dt_model->select_columns = array("t7.id","t1.class","t1.code","t1.description","t7.color","t6.id as product_profile_id","t6.net_weight","t6.resin_unit_price","t6.finishing_unit_price","t6.spray_unit_price","t6.hand_paint_unit_price","t6.date_created","t2.username as created_by","t6.date_modified","t3.username as modified_by");
        }

        $this->dt_model->where  = array("t1.class","t1.code","t1.description","t7.color","t6.net_weight","t6.resin_unit_price","t6.finishing_unit_price","t6.spray_unit_price","t6.hand_paint_unit_price");
        if($this->session->userdata("USERTYPE") ==1)
        {
            $this->dt_model->where  = array("t1.class","t1.code","t1.description","t7.color","t6.net_weight","t6.resin_unit_price","t6.finishing_unit_price","t6.spray_unit_price","t6.hand_paint_unit_price","t6.date_created","t2.username","t6.date_modified","t3.username");
        }

        $select_columns = array("id","class","code","description","color","product_profile_id","net_weight","resin_unit_price","finishing_unit_price","spray_unit_price","hand_paint_unit_price");
        if($this->session->userdata("USERTYPE") ==1){
            $select_columns = array("id","class","code","description","color","product_profile_id","net_weight","resin_unit_price","finishing_unit_price","spray_unit_price","hand_paint_unit_price","date_created","created_by","date_modified","modified_by");
        }
        $this->dt_model->table = "product_variants AS t7  LEFT JOIN products as t1 ON t1.id = t7.product_id LEFT JOIN product_profiles as t6 ON t6.product_variant_id = t7.id LEFT JOIN user_accounts AS t2 ON t2.id = t6.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t6.modified_by";
        $this->dt_model->index_column = "t1.id";
        $this->dt_model->staticWhere = "t1.status != 3 and t7.status !=3";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            $btns = "";
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }
                    else if($col == "fob")
                    {
                        $row[] = "$ ". $aRow[$col] ;
                    }else if($col == "quantity")
                    {
                        if($aRow[$col] == null){
                            $row[] = 0;
                        }else{
                            $row[] = $aRow[$col] ;
                        }

                    }else if($col == "product_profile_id")
                    {

                        if($aRow[$col] == "")
                        {
                            $row[] = "No Product profile";
                            $btns.='<a href="'.base_url("portal/main/product_profiles/new?product_variant_id=".$aRow['id']).'"  class="glyphicon glyphicon-plus text-orange" data-toggle="tooltip" title="Edit Product Profile"></a>';
                        }else{
                            $this->db->select("materials.id");
                            $this->db->join("materials","materials.id=product_profile_materials.material_id");
                            $material_list =$this->db->order_by("product_profile_materials.id","desc")->where("materials.type","color")->where("product_profile_id",$aRow[$col])->get("product_profile_materials")->result_array();

                            $ids = "";
                            foreach($material_list as $id)
                            {
                                $ids .= $id["id"] . ",";
                            }
                            $ids = rtrim($ids,",");
                            $row[] = '<center><a target=_blank href="'.base_url("portal/main/product_profiles/print?product_variant_id=".$aRow['id']).'"  class="glyphicon glyphicon-print text-orange" data-toggle="tooltip" title="Print Product Profile"></a>&emsp;
                            <a target=_blank href="'.base_url("portal/main/prints/color_composition?id=".$ids).'"  class="glyphicon glyphicon-print text-violet" data-toggle="tooltip" title="Print Color Composition"></a>
                            </center>';
                            $btns.='<a href="'.base_url("portal/main/product_profiles/new?product_variant_id=".$aRow['id']).'"  class="glyphicon glyphicon-plus text-orange" data-toggle="tooltip" title="Edit Product Profile"></a>';
                        }

                    }
                    else if($col == "status")
                    {
                        if($aRow[$col] == "0")
                        {
                            $row[] = '<center><small class="label bg-gray">Inactive</small></center>';
                        }
                        else if($aRow[$col] == "1")
                        {
                            $row[] = '<center><small class="label bg-green">Active</small></center>';
                        }else if($aRow[$col] == "4"){
                            $row[] = '<center><small class="label bg-orange">Pending</small></center>';
                        }
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {
                            $row[] = "<center><a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/product_profiles/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a></center>";
                        }
                        else
                        {
                            $row[] = "None";
                        }
                     }
                    else
                    {
                        $row[] = $aRow[$col] ;
                    }
            }

            $btns .= '
            <!--<a href="'.base_url("portal/main/product_profiles/new?product_variant_id=".$aRow['id']).'"  class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="view Product Profile"></a>-->

            <!--<a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit Product Profile"></a>-->
            <a href="#" onclick="_delete('.$aRow['id'].',\''.htmlentities($aRow["description"]).'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete Product Profile"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }



}
