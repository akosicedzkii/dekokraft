<?php

class customers_model extends CI_Model {
    
        public $id;
        public $customer_name;
        public $customer_address;
        public $customer_mobile;
        public $customer_fax;
        public $customer_email;
        public $company_name;
        public $state;
        public $city;
        public $country;
        public $postal_code;
        public $date_created;
        public $created_by;
        public $modified_by;
        public $attn;
        public $date_modified;

        public function insert_customers()
        {
                echo $result = $this->db->insert('customers', $this);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created customers - ID:". $insertId .", customers name: ".$this->customer_name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "customers";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_customers()
        {
                
                unset($this->date_created);
                unset($this->created_by);
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('customers', $this);
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated bank - ID:". $this->id .", Bank name: ".$this->customer_name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "customers";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>