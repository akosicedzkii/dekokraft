<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("portal/roles_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

    public function get_roles_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns  = array("id","role_name","description","date_created","(SELECT username from user_accounts where id = t1.created_by) as created_by","date_modified","(SELECT username from user_accounts where id = t1.modified_by) as modified_by");  
        $this->dt_model->where = $select_columns = array("id","role_name","description","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "roles as t1";  
        $this->dt_model->index_column = "id";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "modified_by" || $col == "created_by")
                    {
                        $row[] = $aRow[$col];
                    }
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            //filtering normal user and super admin
            if( $aRow['id'] == 1)
            {
                $btns = '';
                $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
                <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
                <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow['role_name'].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
                
            }
            else if( $aRow['id'] == 0)
            {
                $btns = '';
                $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
                <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
                <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow['role_name'].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
                
            }
            else
            {
                $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
                <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
                <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow['role_name'].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            }
             array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }

    public function add_role()
    {
        $this->roles_model->role_name = $this->input->post("name");
        $this->roles_model->default_page = $this->input->post("default_page");
        $this->roles_model->description = $this->input->post("description");
        echo $this->roles_model->insert_role(explode(",",$this->input->post("role_modules")));
    }

    public function edit_role()
    {
        $this->roles_model->id = $this->input->post("role_id");
        $this->roles_model->role_name = $this->input->post("name");
        $this->roles_model->default_page = $this->input->post("default_page");
        $this->roles_model->description = $this->input->post("description");
        echo $this->roles_model->update_role(explode(",",$this->input->post("role_modules")));
    }

    public function delete_role()
	{
        
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_roles = $this->db->get("roles");
        $this->db->where("role_id",$id);
        $result = $this->db->delete("role_modules");
        if($result)
        {
            $this->db->where("id",$id);
            echo $result = $this->db->delete("roles");
            $data = json_encode($data_roles->row());
            $this->logs->log = "Deleted Role - ID:". $data_roles->row()->id .", Role Name: ".$data_roles->row()->role_name ;
            $this->logs->details = json_encode($data);
            $this->logs->module = "roles";
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
        }
    }
    
    public function get_role_data()
    {
        $id = $this->input->post("id");
        $this->db->where("role_id",$id);
        $this->db->select("module");
        $result = $this->db->get("role_modules");
        $role_modules = array();
        foreach($result->result() as $row)
        {
            array_push($role_modules,$row->module);
        }
        $this->db->select("id,role_name,description,default_page,date_created,date_modified,created_by,modified_by");
        $this->db->where("id",$id);
        $result = $this->db->get("roles");
        $roles = $result->row();
        $return["role_modules"] = $role_modules;
        $return["roles"] = $roles;
        echo json_encode($return);
    }

}
