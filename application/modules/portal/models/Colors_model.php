<?php

class Colors_model extends CI_Model {
    
        public $id;
        public $name;
        public $code;
        public $status;

        public function insert_colors()
        {
                $data["name"] = $this->name ; 
                $data["code"] = $this->code;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["status"] = $this->status;
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('colors', $data);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created colors - ID:". $insertId .", colors name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "colors";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_colors()
        {
                $data["name"] = $this->name ; 
                $data["code"] = $this->code;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["status"] = $this->status;
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('colors', $data);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated colors - ID:". $this->id .", colors Title: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "colors";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>