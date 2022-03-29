<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colors extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("portal/colors_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_colors()
	{
        $this->colors_model->name = $this->input->post("name");
        $this->colors_model->code = $this->input->post("code");
        $this->colors_model->status = $this->input->post("status");
        echo $this->colors_model->insert_colors();
	}

	public function edit_colors()
	{
        $colors_id = $this->input->post("id");
        $this->colors_model->name = $this->input->post("name");
        $this->colors_model->code = $this->input->post("code");
        $this->colors_model->status = $this->input->post("status");
        $this->colors_model->id = $colors_id;
        echo $this->colors_model->update_colors();
	}

	public function delete_colors()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_colors = $this->db->get("colors");
        $this->db->where("id",$id);
        $data["status"] = 3;
        echo $result = $this->db->update("colors",$data);
        $data = json_encode($data_colors->row());
        $this->logs->log = "Deleted colors - ID:". $data_colors->row()->id .", colors Title: ".$data_colors->row()->name ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "colors";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_colors_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("colors");
        $colors = $result->row(); 
        $return["colors"] = $colors;
        echo json_encode($return); 
    } 

    public function get_colors_selection()
    {
        
        $search = $this->input->get("term[term]");
        $this->db->like("name",$search);  
        $this->db->where("status",1);  
        $this->db->select("name as text"); 
        $this->db->select("code as id");
        $filteredValues=$this->db->order_by("name","asc")->get("colors")->result_array();

        echo json_encode(array(
            'items' => $filteredValues
        ));
    }

    public function get_materials_of_color()
    {
        $id = $this->input->post("id");
        $this->db->join("materials","materials.id=color_materials.material_id");
        $color_materials["color_materials"] =$this->db->where("color_id",$id)->order_by("color_materials.id","asc")->get("color_materials")->result();
        echo json_encode($color_materials);
    }

    public function insert_color_materials()
    {
        $this->colors_model->materials = $this->input->get("selected_material");
        $this->colors_model->qty = $this->input->get("qty");
        $this->colors_model->id = $this->input->get("color_id");
        $this->colors_model->insert_color_materials();
    }
    public function get_colors_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.name","t1.code","IF(t1.status=1,'Active','Inactive') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.name","t1.code","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","name","code","status","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "colors AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by ";  
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
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/colors/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a>";
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
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].',\''.$aRow["name"].'\');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" name="View Composition of Colors"></a>
            <a href="'.base_url("portal/main/prints/color_composition?id=").$aRow['id'].'" target=_blank class="glyphicon glyphicon-print text-green" data-toggle="tooltip" name="Print Composition of Colors"></a>-->
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" name="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" name="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
