<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_variants extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("portal/product_variants_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_product_variants()
	{
        $this->product_variants_model->description = $this->input->post("description");
        $this->product_variants_model->status = $this->input->post("status");
        $this->product_variants_model->cover_image = $this->input->post("cover_image");
        $this->product_variants_model->color = $this->input->post("color");
        $this->product_variants_model->color_abb = $this->input->post("color_abb");
        $this->product_variants_model->count = $this->input->post("count");
        $this->product_variants_model->product_id = $this->input->post("product_id");
        $this->product_variants_model->count = $this->input->post("count");
        $this->product_variants_model->location = $this->input->post("location");
        $this->product_variants_model->code = $this->input->post("code");
        //$this->product_variants_model->proto = $this->input->post("proto");
        //$this->product_variants_model->molds = $this->input->post("molds");
        echo $this->product_variants_model->insert_product_variants();
        
	}

	public function edit_product_variants()
	{
        $this->product_variants_model->id = $this->input->post("id");
        $this->product_variants_model->description = $this->input->post("description");
        $this->product_variants_model->status = $this->input->post("status");
        $this->product_variants_model->cover_image = $this->input->post("cover_image");
        $this->product_variants_model->color = $this->input->post("color");
        $this->product_variants_model->color_abb = $this->input->post("color_abb");
        $this->product_variants_model->count = $this->input->post("count");
        $this->product_variants_model->product_id  = $this->input->post("product_id");
        $this->product_variants_model->location = $this->input->post("location");
        //$this->product_variants_model->proto = $this->input->post("proto");
        //$this->product_variants_model->molds = $this->input->post("molds");
        $this->product_variants_model->code = $this->input->post("code");
        echo $this->product_variants_model->update_product_variants();
	}

	public function delete_product_variants()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        
        $data_product_variants = $this->db->get("product_variants");
        $this->db->where("id",$id);
        $data["status"] = 3; 
        echo $result = $this->db->update("product_variants",$data);
        //unlink($upload_path = './uploads/product_variants/'.$data_product_variants->row()->cover_image);
        $data = json_encode($data_product_variants->row());
        $this->logs->log = "Deleted Product - ID:". $data_product_variants->row()->id .", Product Title: ".$data_product_variants->row()->title ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "product_variants";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_product_variants_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $this->db->select("*");
        $this->db->select("(SELECT COUNT(id) FROM stocks WHERE product_variant_id=product_variants.id) as stock");
        $result = $this->db->get("product_variants");
        $product_variants = $result->row();
        $prod_id = $result->row()->product_id;
        $this->db->where("id",$prod_id);
        $result2 = $this->db->get("products");
        $products = $result2->row();
        $product_variants->description = $this->db->where("id",$product_variants->product_id)->get("products")->row()->description;
        if($product_variants->cover_image != null)
        {
            if(is_numeric( $product_variants->cover_image ))
            {
                $product_variants->cover_image_id = $product_variants->cover_image;
                $product_variants->cover_image = $this->db->where("id",$product_variants->cover_image)->get("media")->row()->file_name;
            }
        }
        $return["product_variants"] = $product_variants;
        $return["products"]= $products;
        echo json_encode($return); 
        
    }

    public function add_prod_colors()
    {
        $id = $this->input->post("id");
        $name = $this->input->post("name");
        $code = $this->input->post("code");
        $stock = $this->input->post("stock");

        $result = $this->db->where("id",$id)->get("product_variants")->row();
        if($result!=null)
        {
            unset($result->id);
            unset($result->color);
            unset($result->color_abb);
            unset($result->cover_image);
            unset($result->created_by);
            unset($result->modified_by);
            unset($result->date_created);
            unset($result->date_modified);
            unset($result->location);
            $this->db->where("color",$name);
            $this->db->where("product_id",$result->product_id);
            $validation = $this->db->get("product_variants")->row();
            if($validation == null)
            {
                $result->color = $name;
                $result->color_abb = $code;
                $result->date_created = date("Y-m-d h:i:s A");
                $result->created_by = $this->session->userdata("USERID");
                $result->color_abb = $code;
                $result->status = 1;
                $this->db->insert("product_variants",(array) $result);
                $insertId = $this->db->insert_id();
                $this->load->model("stocks_model");
                $this->stocks_model->add_stock(1,$insertId);
                $returns = array();
                $returns["product_id"] = $insertId;
                $returns["description"] = $result->description;
                $returns["color"] = $result->color;
                //echo json_encode($result);
                echo true;
            }
            else
            {
                echo "Product Color Exists";
            }
        }
    }
    public function get_product_variants_selection()
    {
        
        $search = $this->input->get("term[term]");
         
        
        $filteredValues=$this->db->query("SELECT CONCAT(t1.title, ' - ', t2.color) as text, `t1`.`class`, `t1`.`code`, `t1`.`description`, `t1`.`fob`, `t2`.`color`, `t2`.`id`, `t1`.`status`,`t2`.`status` FROM `products` as `t1` JOIN `product_variants` as `t2` ON `t2`.`product_id` = `t1`.`id` WHERE `t1`.`status` = '1' AND `t2`.`status` = '1' AND( `t1`.`title` LIKE '%$search%' ESCAPE '!' OR `t1`.`code` LIKE '%$search%' ESCAPE '!' OR `t1`.`class` LIKE '%$search%' ESCAPE '!')")->result_array();
        //print_r($this->db->last_query());   
        echo json_encode(array(
            'items' => $filteredValues
        ));
    }
    public function get_product_variants_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.cover_image","t4.class","t4.code","t4.description","t1.location","CONCAT(t1.color,' (',t1.color_abb,')') as color","t4.proto","t4.molds","(SELECT COUNT(id) FROM stocks WHERE product_variant_id=t1.id) as stock","(SELECT fob FROM products WHERE id=t1.product_id) as fob","t1.status");  
        if($this->session->userdata("USERTYPE") ==1)
        {
            $this->dt_model->select_columns = array("t1.id","t1.cover_image","t4.class","t4.code","t4.description","t1.location","CONCAT(t1.color,' (',t1.color_abb,')') as color","t1.proto","t1.molds","(SELECT COUNT(id) FROM stocks WHERE product_variant_id=t1.id) as stock","(SELECT fob FROM products WHERE id=t1.product_id) as fob","t1.status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        }
        $this->dt_model->where  = array("t1.id","t1.id","t4.class","t4.code","t4.description","t1.location","t1.color","t4.proto","t4.molds","t1.status");  
        if($this->session->userdata("USERTYPE") ==1)
        {
            $this->dt_model->where  = array("t1.id","t1.id","t4.class","t4.code","t4.description","t1.location","t1.color","t4.proto","t4.molds","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");  
        }
        $select_columns = array("id","cover_image","class","code","description","location","color","proto","molds","stock","fob","status");  
        if($this->session->userdata("USERTYPE") ==1)
        {
            $select_columns = array("id","cover_image","class","code","description","location","color","proto","molds","stock","fob","status","date_created","created_by","date_modified","modified_by");
        }  
        $this->dt_model->table = "product_variants AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by LEFT JOIN products AS t4 ON t4.id = t1.product_id"; 
        $this->dt_model->index_column = "t1.id"; 
        if($this->session->userdata("USERTYPE") ==1){
            $this->dt_model->staticWhere = "";
        }else{
            $this->dt_model->staticWhere = "t1.status != 3";
        }
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }
                    else if($col == "fob")
                    {
                        $row[] = "$ ". $aRow[$col] ;
                    }
                    else if($col == "description")
                    {
                        $row[] =  $aRow[$col] ;
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
                        }else if($aRow[$col] == "3"){
                            $row[] = '<center><small class="label bg-red">Deleted</small></center>';
                        }
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {    
                            $row[] = "<center><a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/product_variants/thumb/".$aRow[$col]."?dummy=".time()."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a></center>";
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
            
            $btns = '<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_reflenish('.$aRow['id'].',\''.htmlentities ($aRow["description"]).'\');return false;" class="glyphicon glyphicon-plus text-blue" data-toggle="tooltip" title="Reflenish"></a>
            <a href="#" onclick="_reduce('.$aRow['id'].',\''.htmlentities ($aRow["description"]).'\');return false;" class="glyphicon glyphicon-minus text-orange" data-toggle="tooltip" title="Reduce"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.htmlentities ($aRow["description"]).'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }

    

}
