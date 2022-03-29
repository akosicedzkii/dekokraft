<?php

class Products_model extends CI_Model {
    
        public $id;
        public $title;
        public $description;
        public $cover_image;
        public $date_created;
        public $created_by;
        public $date_modified;
        public $modified_by;
        public $status;
        public $class;
        public $code;
        public $color;
        public $color_abb;
        public $inner_carton;
        public $master_carton;
        public $weight_of_box;
        public $minimum_of_quantity;
        public $lowest_cost;
        public $best_price;
        public $product_year;
        public $product_month;
        public $location;
        public $fob;
        public function insert_products()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["status"] = $this->status;
                $data["class"] = $this->class;
                $data["created_by"] =  $this->session->userdata("USERID");
                $data["code"] =  $this->code;
                //$data["color"] = $this->color;
                //$data["color_abb"] = $this->color_abb;
                $data["inner_carton"] = $this->inner_carton;
                $data["master_carton"] = $this->master_carton;
                $data["weight_of_box"] = $this->weight_of_box;
                $data["minimum_of_quantity"] = $this->minimum_of_quantity;
                $data["lowest_cost"] = $this->lowest_cost;
                $data["best_price"] = $this->best_price;
                $data["fob"] = $this->fob;
                //$data["location"] = $this->location;
                $data["product_year"] =  date("Y");
                $data["product_month"] =  date("m");
                /*$upload_path = './uploads/products/';  
                if (!is_dir($upload_path)) 
                {
                        mkdir($upload_path, 0777, TRUE);
                }
                $path = $upload_path.$data["code"].".png";
                $img =  $this->cover_image;
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $datas = base64_decode($img);
                
                $data["cover_image"] = $data["code"].".png";
                */
                echo $result = $this->db->insert('products', $data);
                if($result)
                {
                        //file_put_contents($path, $datas);
                
                        
                        $insertId = $this->db->insert_id();
                        $data_price["price"] = $this->best_price;
                        $data_price["created_by"] =  $this->session->userdata("USERID");
                        $data_price["product_id"] = $insertId;
                        $data_price["date_created"] = date("Y-m-d H:i:s A");
                        $this->db->insert("product_price_history",$data_price);
                        $this->logs->log = "Created Products - ID:". $insertId .", Products Name: ".$this->title ;
                        $this->logs->details = json_encode($data);
                        $this->logs->module = "products";
                        $this->logs->created_by = $this->session->userdata("USERID");
                        $this->logs->insert_log();
                }else{
                      echo $this->db->error()["message"];
                }
        }

        public function update_products()
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
                        $upload_path = './uploads/products/'; 
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
                echo $result = $this->db->update('products', $data);
               
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Product - ID:". $this->id .", Product Name: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "products";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>