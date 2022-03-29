<?php

class Purchase_orders_model extends CI_Model {
    
        public $id;
        public $mo_id;
        public $subcon_id;
        public $status;
        public $remarks;
        public $job_type;
        public $date_created;
        public $created_by;
        public $modified_by;
        public $deadline;
        public $date_modified;

        public function insert_purchase_orders($arr_jo,$po_count)
        {
                echo $result = $this->db->insert('purchase_orders', $this);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->insert_jo_item($arr_jo, $insertId,$po_count);
                $this->logs->log = "Created Job Order - ID:". $insertId  ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "purchase_orders";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }
        public function validate_po_item($invoice_line_id,$job_type,$po_id=null) 
        {
            $this->db->where("invoice_line_id",$invoice_line_id);
            $this->db->where("job_type",$job_type);
            if($po_id!=null)
            {
                $this->db->where("po_id !=",$po_id);
            }
            return $this->db->get("purchase_order_lines")->row();
        }

        public function insert_jo_item($arr_jo,$po_id,$po_count)
        {
            $counter = 0;
            foreach($arr_jo as $item)
            {
                $data["subcon_id"] = $this->subcon_id;
                $data["mo_id"] = $this->mo_id;
                $data["job_type"] = $this->job_type;
                $data["po_id"] = $po_id;
                $data["invoice_line_id"] = $item;
                $data["po_count"] = $po_count[$counter];
                $this->db->insert("purchase_order_lines",$data);
                $counter++;
            }
        }
        public function update_purchase_orders($po_items,$po_count)
        {
            //unset($this->date_created);
            unset($this->created_by);
            $this->db->where("id",$this->id);
            echo $result = $this->db->update('purchase_orders', $this);
            
            $this->insert_jo_item($po_items, $this->id,$po_count);
                        
            $data["id"] = $this->id;
            $data = json_encode($data);
            $this->logs->log = "Updated Job Order - ID:". $this->id ;
            $this->logs->details = json_encode($data);
            $this->logs->module = "purchase_orders";

            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();

        }

}

?>