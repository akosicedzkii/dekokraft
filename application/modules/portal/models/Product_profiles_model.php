<?php

class Product_profiles_model extends CI_Model {
    
        public $id;
        public $product_variant_id;
        public $materials;
        public $qty;
        public $group_name;
        public $net_weight;
        public $material_group_id;
        public function insert_product_profiles()
        {
            $insertId = "";
            $data = array();
            $data2 = array();
            $data3 = array();
            $this->db->where("product_variant_id",$this->product_variant_id);
            if(!$this->db->get("product_profiles")->row())
            {
                $data["product_variant_id"] = $this->product_variant_id;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["created_by"] =  $this->session->userdata("USERID");
                $data["net_weight"] =  $this->net_weight;
                $this->db->insert("product_profiles",$data);
                $insertId = $this->db->insert_id();
                $this->id = $insertId;
            }else{
                $this->db->where("product_variant_id",$this->product_variant_id);
                $this->id = $this->db->get("product_profiles")->row()->id;
            }
            
            $data2["material_group_name"] = $this->group_name;
            $data2["product_profile_id"] = $this->id;
            $data2["date_created"] = date("Y-m-d H:i:s A");
            $data2["created_by"] =  $this->session->userdata("USERID");
            $this->db->insert("product_material_group",$data2);
            $groupId = $this->db->insert_id();
            $counter = 0;
            foreach($this->materials as $material)
            {
                $data3["material_id"] =$material;
                $data3["qty"] =$this->qty[$counter];
                $data3["product_material_group_id"] = $groupId;
                $data3["product_profile_id"] = $this->id;
                $data3["product_variant_id"] = $this->product_variant_id;
                $data3["date_created"] = date("Y-m-d H:i:s A");
                $data3["created_by"] =  $this->session->userdata("USERID");
                $this->db->insert("product_profile_materials",$data3);
                $counter++;
            }
            $this->logs->log = "Created Product Profile - ID:". $insertId ;
            $this->logs->details = json_encode(array($data,$data2,$data3));
            $this->logs->module = "product_profiles";
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
            echo 1;
        }

        public function update_material_list()
        {

            $this->db->where("product_material_group_id",$this->material_group_id);
            $this->db->delete("product_profile_materials");
            $data["material_group_name"] = $this->group_name;
            
            $data3["date_modified"] = date("Y-m-d H:i:s A");
            $data3["modified_by"] =  $this->session->userdata("USERID");
            $this->db->where("id",$this->material_group_id);
            $this->db->update("product_material_group",$data);
            $counter = 0;
            foreach($this->materials as $material)
            {
                $data3["material_id"] =$material;
                $data3["qty"] =$this->qty[$counter];
                $data3["product_material_group_id"] = $this->material_group_id;
                $data3["product_profile_id"] = $this->product_profile_id;
                $data3["product_variant_id"] = $this->product_variant_id;
                $data3["date_created"] = date("Y-m-d H:i:s A");
                $data3["created_by"] =  $this->session->userdata("USERID");
                $this->db->insert("product_profile_materials",$data3);
                $counter++;
            }
            $data4["net_weight"] = $this->net_weight;
            $this->db->where("id",$this->product_profile_id);
            $this->db->update("product_profiles",$data4);
            $this->logs->log = "Updated Product Profile - ID:". $this->product_profile_id ;
            $this->logs->details = json_encode(array($data,$data3));
            $this->logs->module = "product_profiles";
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
            echo 1;
        }
        public function update_product_profiles()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                //$cover_image = $this->cover_image;
                $data["status"] = $this->status;
                $data["class"] = $this->class;
                //$data["color"] = $this->color;
                $data["code"]  = $this->code;
                //$data["color_abb"] = $this->color_abb; 
                $data["inner_carton"] = $this->inner_carton;
                $data["master_carton"] = $this->master_carton;
                $data["weight_of_box"] = $this->weight_of_box;
                $data["minimum_of_quantity"] = $this->minimum_of_quantity;
                $data["lowest_cost"] = $this->lowest_cost;
                $data["best_price"] = $this->best_price;
                $data["fob"] = $this->fob;
                //$data["location"] = $this->location;
                if($this->best_price != $this->old_price)
                {
                        $insertId = $this->id;
                        $data_price["price"] = $this->best_price;
                        $data_price["date_created"] = date("Y-m-d H:i:s A");
                        $data_price["created_by"] =  $this->session->userdata("USERID");
                        $data_price["product_id"] = $insertId;
                        $this->db->insert("product_price_history",$data_price);
                }
                
                /*if( $cover_image != null)
                {
                        $upload_path = './uploads/product_profiles/'; 
                        $path = $upload_path.$data["code"].".png";
                        if(file_exists($path))
                        {
                                unlink($path);
                        } 
                        if (!is_dir($upload_path)) 
                        {
                                mkdir($upload_path, 0777, TRUE);
                                
                        }
                        
                        $img =  $cover_image ;
                        $img = str_replace('data:image/png;base64,', '', $img);
                        $img = str_replace(' ', '+', $img);
                        $datas = base64_decode($img);
                        file_put_contents($path, $datas);
                        $data["cover_image"] = $data["code"].".png";
                 }*/       
                $data["modified_by"] =  $this->session->userdata("USERID");
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('product_profiles', $data);
               
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Product - ID:". $this->id .", Product Name: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "product_profiles";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>