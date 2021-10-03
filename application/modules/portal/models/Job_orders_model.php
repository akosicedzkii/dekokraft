<?php

class Job_orders_model extends CI_Model {
    
        public $id;
        public $mo_id;
        public $subcon_id;
        public $status;
        public $remarks;
        public $job_type;
        public $date_created;
        public $created_by;
        public $modified_by;
        public $date_modified;
        public $deadline;

        public function insert_job_orders($arr_jo,$jo_count)
        {
                echo $result = $this->db->insert('job_orders', $this);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->insert_jo_item($arr_jo, $insertId,$jo_count);
                $this->logs->log = "Created Job Order - ID:". $insertId  ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "job_orders";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }
        public function validate_jo_item($invoice_line_id,$job_type,$jo_id=null)
        {
            $this->db->where("invoice_line_id",$invoice_line_id);
            $this->db->where("job_type",$job_type);
            if($jo_id!=null)
            {
                $this->db->where("jo_id !=",$jo_id);
            }
            return $this->db->get("job_order_lines")->row();
        }

        public function insert_jo_item($arr_jo,$jo_id,$jo_count)
        {
            $counter = 0;
            foreach($arr_jo as $item)
            {
                $data["subcon_id"] = $this->subcon_id;
                $data["mo_id"] = $this->mo_id;
                $data["job_type"] = $this->job_type;
                $data["jo_id"] = $jo_id;
                $data["invoice_line_id"] = $item;
                $data["jo_count"] = $jo_count[$counter];
                $this->db->insert("job_order_lines",$data);
                $counter++;
            }
        }
        public function update_job_orders($jo_items,$jo_count)
        {
            //unset($this->date_created);
            unset($this->created_by);
            $this->db->where("id",$this->id);
            echo $result = $this->db->update('job_orders', $this);
            
            $this->insert_jo_item($jo_items, $this->id,$jo_count);
            
            $data["id"] = $this->id;
            $data = json_encode($data);
            $this->logs->log = "Updated Job Order - ID:". $this->id ;
            $this->logs->details = json_encode($data);
            $this->logs->module = "job_orders";

            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();

        }

}

?>