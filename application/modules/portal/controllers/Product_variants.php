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
        unlink($upload_path = './uploads/product_variants/'.$data_product_variants->row()->cover_image);
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
        $result = $this->db->get("product_variants");
        $product_variants = $result->row();
        if($product_variants->cover_image != null)
        {
            if(is_numeric( $product_variants->cover_image ))
            {
                $product_variants->cover_image_id = $product_variants->cover_image;
                $product_variants->cover_image = $this->db->where("id",$product_variants->cover_image)->get("media")->row()->file_name;
            }
        }
        $return["product_variants"] = $product_variants;
        echo json_encode($return); 
    }

    public function get_product_variants_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.cover_image","t1.location","t4.class","t4.code","t1.description","t1.color","t1.count","IF(t1.status=1,'Active','Inactive') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.cover_image","t1.location","t4.class","t4.code","t1.description","t1.color","t1.count","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","cover_image","location","class","code","description","color","count","status","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "product_variants AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by LEFT JOIN products AS t4 ON t4.id = t1.product_id";  
        $this->dt_model->index_column = "t1.id"; 
        $this->dt_model->staticWhere = "t1.status != 3";  
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
                    else if($col == "best_price")
                    {
                        $row[] = "$ ". $aRow[$col] ;
                    }
                    else if($col == "status")
                    {
                        if($aRow[$col] == "Inactive")
                        {
                            $row[] = '<center><small class="label bg-gray">'.$aRow[$col].'</small></center>';
                        }
                        else if($aRow[$col] == "Active")
                        {
                            $row[] = '<center><small class="label bg-green">'.$aRow[$col].'</small></center>';
                        }
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {    
                            $row[] = "<center><a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/product_variants/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a></center>";
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
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["description"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }

    

}
