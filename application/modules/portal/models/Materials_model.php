<?php

class Materials_model extends CI_Model {
    
        public $id;
        public $material_name;
        public $cost;
        public $unit;
        public $status;
        public $type;

        public function insert_materials()
        {
                $data["material_name"] = $this->material_name ; 
                $data["cost"] = $this->cost;
                $data["unit"] = $this->unit;
                $data["jp"] = $this->jp;
                $data["type"] = $this->type;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["status"] = $this->status;
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('materials', $data);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created materials - ID:". $insertId .", materials name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "materials";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_materials()
        {
                $data["material_name"] = $this->material_name ; 
                $data["cost"] = $this->cost;
                $data["unit"] = $this->unit;
                $data["jp"] = $this->jp;
                $data["type"] = $this->type;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["status"] = $this->status;
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('materials', $data);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated materials - ID:". $this->id .", materials name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "materials";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>