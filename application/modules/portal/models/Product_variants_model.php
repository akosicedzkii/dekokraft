<?php

class Product_variants_model extends CI_Model {
    
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
        //public $proto;
        //public $mold;

        public function insert_product_variants()
        {
                $data["description"] = $this->description;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["status"] = $this->status;
                $data["created_by"] =  $this->session->userdata("USERID");
                $data["product_id"] =  $this->product_id;
                $data["color"] = $this->color;
                $data["color_abb"] = $this->color_abb;
                $data["count"] = $this->count;
                $data["location"] = $this->location;
                $data["product_year"] =  date("Y");
                $data["product_month"] =  date("m");
               // $data["proto"] = $this->proto;
                //$data["molds"] = $this->molds;
                $upload_path = './uploads/product_variants/';  
                echo $result = $this->db->insert('product_variants', $data);
                if($result)
                {
                                              
                        $insertId = $this->db->insert_id();
                        if (!is_dir($upload_path)) 
                        {
                                mkdir($upload_path, 0777, TRUE);
                        }
                        $path = $upload_path.$this->code."_".$this->color_abb."_".$insertId.".png"; 
                        $thumbpath = $upload_path.'thumb/'.$this->code."_".$this->color_abb."_".$insertId.".png";        
                        $img =  $this->cover_image;
                        $img = str_replace('data:image/png;base64,', '', $img);
                        $img = str_replace('data:image/png;base64,', '', $img);
                        $img = str_replace(' ', '+', $img);
                        $datas = base64_decode($img);
                        file_put_contents($path, $datas); 
                        $this->make_thumbnail($path  ,$thumbpath); 
                        $dataImage["cover_image"] = $this->code."_".$this->color_abb."_".$insertId.".png";
                        $this->db->where("id",$insertId);
                        $this->db->update("product_variants",$dataImage);
                        $this->load->model("stocks_model");
                        $this->stocks_model->add_stock($this->count,$insertId);
                        $this->logs->log = "Created Product_variants - ID:". $insertId .", Product_variants Name: ".$this->title ;
                        $this->logs->details = json_encode($data);
                        $this->logs->module = "product_variants";
                        $this->logs->created_by = $this->session->userdata("USERID");
                        $this->logs->insert_log();
                }else{
                      echo $this->db->error()["message"];
                }
        }

        public function update_product_variants()
        {
                $cover_image = $this->cover_image;
                $data["description"] = $this->description;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["status"] = $this->status;
                $data["created_by"] =  $this->session->userdata("USERID");
                $data["product_id"] =  $this->product_id;
                $data["color"] = $this->color;
                $data["color_abb"] = $this->color_abb;
                $data["count"] = $this->count;
                $data["location"] = $this->location;
               // $data["proto"] = $this->proto;
               // $data["molds"] = $this->molds;
                if( $cover_image != null)
                {
                        if ($cover_image != "data:,")
                        {

                                $upload_path = './uploads/product_variants/'; 
                                $path = $upload_path.$this->code."_".$this->color_abb."_".$this->id.".png";
                                $thumbpath = $upload_path.'thumb/'.$this->code."_".$this->color_abb."_".$this->id.".png";
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
                                $this->make_thumbnail($path  ,$thumbpath); 
                                $data["cover_image"] = $this->code."_".$this->color_abb."_".$this->id.".png";
                        }
                 }       
                $data["modified_by"] =  $this->session->userdata("USERID");
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('product_variants', $data);
               
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Product - ID:". $this->id .", Product Name: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "product_variants";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

        public function make_thumbnail($filename,$destination_img)
        {
                $im = imagecreatefrompng($filename);
                $source_width = imagesx($im);
                $source_height = imagesy($im);
                $ratio =  $source_height / $source_width;

                $new_width = 300; // assign new width to new resized image
                $new_height = $ratio * 300;

                $thumb = imagecreatetruecolor($new_width, $new_height);

                $transparency = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
                imagefilledrectangle($thumb, 0, 0, $new_width, $new_height, $transparency);

                imagecopyresampled($thumb, $im, 0, 0, 0, 0, $new_width, $new_height, $source_width, $source_height);

                imagepng($thumb, $destination_img, 9);
                imagedestroy($im);
        }

}

?>