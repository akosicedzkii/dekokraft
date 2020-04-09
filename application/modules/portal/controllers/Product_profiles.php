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
        $this->product_profiles_model->group_name = $this->input->get("group_name_edit");
        echo $this->product_profiles_model->update_material_list();
	}
    public function get_materials_on_list()
    {
        $id = $this->input->post("id");
        $this->db->join("materials","materials.id=product_profile_materials.material_id");
        $material_list["material_list"] =$this->db->where("product_material_group_id",$id)->order_by("product_profile_materials.id","desc")->get("product_profile_materials")->result();
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
    public function get_product_profiles_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        
        $this->dt_model->select_columns = array("t7.id","t1.class","t1.code","t1.description","t7.color","t6.id as product_profile_id");  
        if($this->session->userdata("USERTYPE") ==1)
        {
            $this->dt_model->select_columns = array("t7.id","t1.class","t1.code","t1.description","t7.color","t6.id as product_profile_id","t6.date_created","t2.username as created_by","t6.date_modified","t3.username as modified_by");  
        }
      
        $this->dt_model->where  = array("t1.class","t1.code","t1.description","t7.color");
        if($this->session->userdata("USERTYPE") ==1)
        {
            $this->dt_model->where  = array("t1.class","t1.code","t1.description","t7.color","t6.date_created","t2.username","t6.date_modified","t3.username");  
        }  
        
        $select_columns = array("id","class","code","description","color","product_profile_id");    
        if($this->session->userdata("USERTYPE") ==1){
            $select_columns = array("id","class","code","description","color","product_profile_id","date_created","created_by","date_modified","modified_by");  
        }
        $this->dt_model->table = "product_variants AS t7  LEFT JOIN products as t1 ON t1.id = t7.product_id LEFT JOIN product_profiles as t6 ON t6.product_variant_id = t7.id LEFT JOIN user_accounts AS t2 ON t2.id = t6.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t6.modified_by";  
        $this->dt_model->index_column = "t1.id";
        $this->dt_model->staticWhere = "t1.status != 3";  
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
                            $row[] = '<center><a href="'.base_url("portal/main/product_profiles/new?product_variant_id=".$aRow['id']).'"  class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Product Profile"></a></center>';
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
