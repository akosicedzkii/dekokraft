<?php

class Banks_model extends CI_Model {
    
        public $id;
        public $name;
        public $code;
        public $status;
        public $bank_details;
        public $address;
        public $date_created;
        public $created_by;
        public $modified_by;
        public $date_modified;

        public function insert_banks()
        {
                echo $result = $this->db->insert('banks', $this);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created banks - ID:". $insertId .", banks name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "banks";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_banks()
        {
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('banks', $this);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated bank - ID:". $this->id .", Bank name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "banks";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>