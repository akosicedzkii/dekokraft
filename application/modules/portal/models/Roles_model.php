<?php

class Roles_model extends CI_Model {
    
    public $id;
    public $role_name;
    public $description;
    public $created_by;
    public $date_created;
    public $modified_by;
    public $date_modified;
    public $default_page;

    public function insert_role($role_modules)
    {
            $data["role_name"] = $this->role_name ; 
            $data["default_page"] = $this->default_page ; 
            $data["description"] = $this->description;
            $data["date_created"] = date("Y-m-d H:i:s A");
            $data["created_by"] =  $this->session->userdata("USERID");
            $result = $this->db->insert('roles', $data);

            $insertId = $this->db->insert_id();
            foreach($role_modules as $row)
            {
                    
                $data_modules["role_id"] = $insertId; 
                $data_modules["module"] = $row;
                $this->db->insert('role_modules', $data_modules);
            }
            $data = json_encode($data);
            $this->logs->log = "Created Role - ID:". $insertId .", Role Name: ".$this->role_name ;
            $this->logs->module = "roles";
            $this->logs->details =  $data ." Access: " . json_encode($role_modules) ;
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
            echo true;
    }

    public function update_role($role_modules)
    {
        $data["role_name"] = $this->role_name ; 
        $data["description"] = $this->description;
        $data["default_page"] = $this->default_page ; 
        $data["date_modified"] = date("Y-m-d H:i:s A");
        $data["modified_by"] =  $this->session->userdata("USERID");
        $this->db->where("id",$this->id);
        $result = $this->db->update('roles', $data);
        $this->db->where("role_id",$this->id);
        $this->db->delete("role_modules");
        foreach($role_modules as $row)
        {
                
            $data_modules["role_id"] = $this->id; 
            $data_modules["module"] = $row;
            $this->db->insert('role_modules', $data_modules);
        }
        $data = json_encode($data);
        $this->logs->log = "Updated Role - ID:". $this->id .", Role Name: ".$this->role_name ;
        $this->logs->module = "roles";
        $this->logs->details =  $data ." Access: " . json_encode($role_modules) ;
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        echo true;
    }

    public function get_user_roles($search)
    {
            $this->db->like("role_name",$search);
            $result = $this->db->select("id,role_name as text")->get("roles");
            return json_encode($result->result());
    }

}

?>