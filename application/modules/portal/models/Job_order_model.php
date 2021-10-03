<?php

class Job_orders_model extends CI_Model {
    
        public $id;
        public $name;
        public $code;
        public $status;
        public $job_orders_details;
        public $address;
        public $date_created;
        public $created_by;
        public $modified_by;
        public $date_modified;

        public function insert_job_orders()
        {
                echo $result = $this->db->insert('job_orders', $this);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created job_orders - ID:". $insertId .", job_orders name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "job_orders";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_job_orders()
        {
            unset($this->date_created);
            unset($this->created_by);
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('job_orders', $this);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated bank - ID:". $this->id .", Bank name: ".$this->name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "job_orders";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>