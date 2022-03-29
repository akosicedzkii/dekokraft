<?php

class Marketing_order_model extends CI_Model {
    
        public $id;
        public $name;
        public $code;
        public $status;
        public $marketing_order_details;
        public $address;
        public $date_created;
        public $created_by;
        public $modified_by;
        public $date_modified;

        public function insert_marketing_order()
        {
                echo $result = $this->db->insert('marketing_order', $this);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created marketing_order - ID:". $insertId .", marketing_order name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "marketing_order";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_marketing_order()
        {
            unset($this->date_created);
            unset($this->created_by);
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('marketing_order', $this);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated bank - ID:". $this->id .", Bank name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "marketing_order";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>