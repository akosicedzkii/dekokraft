<?php

class Subcon_model extends CI_Model {
    
        public $id;
        public $name;
        public $code;
        public $status;
        public $subcon_details;
        public $address;
        public $date_created;
        public $created_by;
        public $modified_by;
        public $date_modified;

        public function insert_subcon()
        {
                echo $result = $this->db->insert('subcon', $this);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created subcon - ID:". $insertId .", subcon name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "subcon";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_subcon()
        {
            unset($this->date_created);
            unset($this->created_by);
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('subcon', $this);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated bank - ID:". $this->id .", Bank name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "subcon";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>