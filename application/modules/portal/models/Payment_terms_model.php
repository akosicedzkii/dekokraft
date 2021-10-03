<?php

class Payment_terms_model extends CI_Model {
    
        public $id;
        public $name;
        public $code;
        public $status;
        public $details;
        public $date_created;
        public $created_by;
        public $modified_by;
        public $date_modified;

        public function insert_payment_terms()
        {
                echo $result = $this->db->insert('payment_terms', $this);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created payment_terms - ID:". $insertId .", payment_terms name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "payment_terms";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_payment_terms()
        {
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('payment_terms', $this);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated bank - ID:". $this->id .", Bank name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "payment_terms";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>