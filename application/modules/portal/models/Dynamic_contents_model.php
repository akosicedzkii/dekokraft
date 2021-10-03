<?php

class Dynamic_contents_model extends CI_Model {
    
        public $id;
        public $title;
        public $description;
        public $content;
        public $cover_image;
        public $status;

        public function insert_dynamic_contents()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["status"] = $this->status;
                $data["created_by"] =  $this->session->userdata("USERID");
                $data["content_type"] =  "dynamic_contents";
                echo $result = $this->db->insert('dynamic_contents', $data);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created Dynamic Page Contents - ID:". $insertId .", Dynamic Page Contents Title: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "dynamic_contents";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_dynamic_contents()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["status"] = $this->status;
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('dynamic_contents', $data);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Dynamic Page Contents - ID:". $this->id .", Dynamic Page Contents Title: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "dynamic_contents";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>