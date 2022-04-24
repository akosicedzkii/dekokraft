<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materials extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("portal/materials_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_materials()
	{
        $this->materials_model->material_name = $this->input->post("material_name");
        $this->materials_model->unit = $this->input->post("unit");
        $this->materials_model->jp = $this->input->post("jp");
        $this->materials_model->cost = $this->input->post("cost");
        $this->materials_model->status = $this->input->post("status");
        $this->materials_model->type = $this->input->post("type");
        $this->materials_model->conversion_value = $this->input->post("conversion_value");
        $this->materials_model->conversion_unit = $this->input->post("conversion_unit");
        echo $this->materials_model->insert_materials();
	}

	public function edit_materials()
	{
        $materials_id = $this->input->post("id");
        $this->materials_model->material_name = $this->input->post("material_name");
        $this->materials_model->unit = $this->input->post("unit");
        $this->materials_model->jp = $this->input->post("jp");
        $this->materials_model->cost = $this->input->post("cost");
        $this->materials_model->status = $this->input->post("status");
        $this->materials_model->type = $this->input->post("type");
        $this->materials_model->conversion_value = $this->input->post("conversion_value");
        $this->materials_model->conversion_unit = $this->input->post("conversion_unit");
        $this->materials_model->id = $materials_id;
        echo $this->materials_model->update_materials();
	}

	public function delete_materials()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_materials = $this->db->get("materials");
        $this->db->where("id",$id);
        $data["status"] = 3;
        echo $result = $this->db->update("materials",$data);
        $data = json_encode($data_materials->row());
        $this->logs->log = "Deleted materials - ID:". $data_materials->row()->id .", materials Title: ".$data_materials->row()->name ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "materials";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_materials_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("materials");
        $materials = $result->row(); 
        $return["materials"] = $materials;
        echo json_encode($return); 
    } 

    public function get_materials_selection()
    {
        
        $search = $this->input->get("term[term]");
        $this->db->like("material_name",$search);  
        $this->db->where("status","1");  
        $this->db->select("material_name as text"); 
        $this->db->select("id");
        $this->db->select("unit");
        $this->db->select("jp");
        $this->db->limit(10);
        $filteredValues=$this->db->get("materials")->result_array();

        echo json_encode(array(
            'items' => $filteredValues
        ));
    }
    public function get_materials_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.material_name","t1.unit","t1.cost","t1.jp","IF(t1.status=1,'Active','Inactive') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by","t1.type");  
        $this->dt_model->where  = array("t1.id","t1.material_name","t1.unit","t1.cost","t1.jp","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username","t1.type");  
        $select_columns = array("id","material_name","unit","cost","jp","status","date_created","created_by","date_modified","modified_by","type");  
        $this->dt_model->table = "materials AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by ";  
        $this->dt_model->index_column = "t1.id";
        //$this->dt_model->staticWhere = "t1.status != 3"; 
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
                    }else if($col == "type")
                    {
                        if($aRow[$col] == "color")
                        {
                            $btns .= '<a href="#" onclick="_view('.$aRow['id'].',\''.$aRow["material_name"].'\');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" name="View Composition of Colors"></a>
                        <a href="'.base_url("portal/main/prints/color_composition?id=").$aRow['id'].'" target=_blank class="glyphicon glyphicon-print text-green" data-toggle="tooltip" name="Print Composition of Colors"></a>&nbsp;';
                        }else{

                        }
                    }
                    else
                    {
                        $row[] = $aRow[$col] ;
                    }
            } 
            
          
            $btns .= '<a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" name="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["material_name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" name="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
