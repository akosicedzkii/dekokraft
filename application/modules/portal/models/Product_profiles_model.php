<?php

class Product_profiles_model extends CI_Model {

        public $id;
        public $product_variant_id;
        public $materials;
        public $qty;
        public $group_name;
        public $net_weight;
        public $provided_resin_cast;
        public $provided_resin_clean;
        public $provided_finishing;
        public $selling_lc;
        public $subcon_lc;
        public $derived_price_a;
        public $derived_price_b;
        public $peso_conversion;
        public $provided_resin_mat;
        public $provided_resin_lab;
        public $provided_finishing_mat;
        public $provided_finishing_lab;
        public $provided_artist_mat;
        public $provided_artist_lab;
        public $provided_trading;
        public $material_group_id;
        public $resin_unit_price;
        public $finishing_unit_price;
        public $spray_unit_price;
        public $hand_paint_unit_price;
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
                $data["net_weight"] = $this->net_weight;
                $data["provided_resin_cast"] = $this->provided_resin_cast;
                $data["provided_resin_clean"] = $this->provided_resin_clean;
                $data["provided_finishing"] = $this->provided_finishing;
                $data["selling_lc"] = $this->selling_lc;
                $data["subcon_lc"] = $this->subcon_lc;
                $data["derived_price_a"] = $this->derived_price_a;
                $data["derived_price_b"] = $this->derived_price_b;
                $data["peso_conversion"] = $this->peso_conversion;
                $data["provided_resin_mat"] = $this->provided_resin_mat;
                $data["provided_resin_lab"] = $this->provided_resin_lab;
                $data["provided_finishing_mat"] = $this->provided_finishing_mat;
                $data["provided_finishing_lab"] = $this->provided_finishing_lab;
                $data["provided_artist_mat"] = $this->provided_artist_mat;
                $data["provided_artist_lab"] = $this->provided_artist_lab;
                $data["provided_trading"] = $this->provided_trading;
                $data["in_box_cost"] = $this->inner_box;
                $data["mstr_box_cost"] = $this->master_box;
                $data["in_poly_cont"] = $this->inner_polybag;
                $data["mstr_poly_cont"] = $this->master_polybag;
                $data["in_poly_cost"] = $this->in_poly_cost;
                $data["mstr_poly_cost"] = $this->mstr_poly_cost;
                $data["in_poly_size"] = $this->in_poly_size;
                $data["mstr_poly_size"] = $this->mstr_poly_size;
                $data["resin_unit_price"] = $this->resin_unit_price;
                $data["finishing_unit_price"] = $this->finishing_unit_price;
                $data["spray_unit_price"] = $this->spray_unit_price;
                $data["hand_paint_unit_price"] = $this->hand_paint_unit_price;
                $this->db->insert("product_profiles",$data);
                $insertId = $this->db->insert_id();
                $this->id = $insertId;
            }else{
                $this->db->where("product_variant_id",$this->product_variant_id);
                $this->id = $this->db->get("product_profiles")->row()->id;

                $data4["net_weight"] = $this->net_weight;
                $data4["provided_resin_cast"] = $this->provided_resin_cast;
                $data4["provided_resin_clean"] = $this->provided_resin_clean;
                $data4["provided_finishing"] = $this->provided_finishing;
                $data4["selling_lc"] = $this->selling_lc;
                $data4["subcon_lc"] = $this->subcon_lc;
                $data4["derived_price_a"] = $this->derived_price_a;
                $data4["derived_price_b"] = $this->derived_price_b;
                $data4["peso_conversion"] = $this->peso_conversion;
                $data4["provided_resin_mat"] = $this->provided_resin_mat;
                $data4["provided_resin_lab"] = $this->provided_resin_lab;
                $data4["provided_finishing_mat"] = $this->provided_finishing_mat;
                $data4["provided_finishing_lab"] = $this->provided_finishing_lab;
                $data4["provided_artist_mat"] = $this->provided_artist_mat;
                $data4["provided_artist_lab"] = $this->provided_artist_lab;
                $data4["provided_trading"] = $this->provided_trading;
                $data4["in_box_cost"] = $this->inner_box;
                $data4["mstr_box_cost"] = $this->master_box;
                $data4["in_poly_cont"] = $this->inner_polybag;
                $data4["mstr_poly_cont"] = $this->master_polybag;
                $data4["in_poly_cost"] = $this->in_poly_cost;
                $data4["mstr_poly_cost"] = $this->mstr_poly_cost;
                $data4["in_poly_size"] = $this->in_poly_size;
                $data4["mstr_poly_size"] = $this->mstr_poly_size;
                $data4["resin_unit_price"] = $this->resin_unit_price;
                $data4["finishing_unit_price"] = $this->finishing_unit_price;
                $data["spray_unit_price"] = $this->spray_unit_price;
                $data["hand_paint_unit_price"] = $this->hand_paint_unit_price;

                $this->db->where("id",$this->id);
                $this->db->update("product_profiles",$data4);
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
            $data4["resin_unit_price"] = $this->resin_unit_price;
            $data4["finishing_unit_price"] = $this->finishing_unit_price;

            $data4["spray_unit_price"] = $this->spray_unit_price;
            $data4["hand_paint_unit_price"] = $this->hand_paint_unit_price;
            $data4["provided_resin_cast"] = $this->provided_resin_cast;
            $data4["provided_resin_clean"] = $this->provided_resin_clean;
            $data4["provided_finishing"] = $this->provided_finishing;
            $data4["selling_lc"] = $this->selling_lc;
            $data4["subcon_lc"] = $this->subcon_lc;
            $data4["derived_price_a"] = $this->derived_price_a;
            $data4["derived_price_b"] = $this->derived_price_b;
            $data4["peso_conversion"] = $this->peso_conversion;
            $data4["provided_resin_mat"] = $this->provided_resin_mat;
            $data4["provided_resin_lab"] = $this->provided_resin_lab;
            $data4["provided_finishing_mat"] = $this->provided_finishing_mat;
            $data4["provided_finishing_lab"] = $this->provided_finishing_lab;
            $data4["provided_artist_mat"] = $this->provided_artist_mat;
            $data4["provided_artist_lab"] = $this->provided_artist_lab;
            $data4["provided_trading"] = $this->provided_trading;
            $data4["in_box_cost"] = $this->inner_box;
            $data4["mstr_box_cost"] = $this->master_box;
            $data4["in_poly_cont"] = $this->inner_polybag;
            $data4["mstr_poly_cont"] = $this->master_polybag;
            $data4["in_poly_cost"] = $this->in_poly_cost;
            $data4["mstr_poly_cost"] = $this->mstr_poly_cost;
            $data4["in_poly_size"] = $this->in_poly_size;
            $data4["mstr_poly_size"] = $this->mstr_poly_size;
            $this->db->where("id",$this->product_profile_id);
            $this->db->update("product_profiles",$data4);
            $this->logs->log = "Updated Product Profile - ID:". $this->product_profile_id ;
            $this->logs->details = json_encode(array($data,$data3));
            $this->logs->module = "product_profiles";
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
            echo 1;
        }

        public function update_details()
        {
            $data4["net_weight"] = $this->net_weight;
            $data4["resin_unit_price"] = $this->resin_unit_price;
            $data4["finishing_unit_price"] = $this->finishing_unit_price;

            $data4["spray_unit_price"] = $this->spray_unit_price;
            $data4["hand_paint_unit_price"] = $this->hand_paint_unit_price;
            $data4["provided_resin_cast"] = $this->provided_resin_cast;
            $data4["provided_resin_clean"] = $this->provided_resin_clean;
            $data4["provided_finishing"] = $this->provided_finishing;
            $data4["selling_lc"] = $this->selling_lc;
            $data4["subcon_lc"] = $this->subcon_lc;
            $data4["derived_price_a"] = $this->derived_price_a;
            $data4["derived_price_b"] = $this->derived_price_b;
            $data4["peso_conversion"] = $this->peso_conversion;
            $data4["provided_resin_mat"] = $this->provided_resin_mat;
            $data4["provided_resin_lab"] = $this->provided_resin_lab;
            $data4["provided_finishing_mat"] = $this->provided_finishing_mat;
            $data4["provided_finishing_lab"] = $this->provided_finishing_lab;
            $data4["provided_artist_mat"] = $this->provided_artist_mat;
            $data4["provided_artist_lab"] = $this->provided_artist_lab;
            $data4["provided_trading"] = $this->provided_trading;
            $data4["in_box_cost"] = $this->inner_box;
            $data4["mstr_box_cost"] = $this->master_box;
            $data4["in_poly_cont"] = $this->inner_polybag;
            $data4["mstr_poly_cont"] = $this->master_polybag;
            $data4["in_poly_cost"] = $this->in_poly_cost;
            $data4["mstr_poly_cost"] = $this->mstr_poly_cost;
            $data4["in_poly_size"] = $this->in_poly_size;
            $data4["mstr_poly_size"] = $this->mstr_poly_size;
            $this->db->where("id",$this->product_profile_id);
            $this->db->update("product_profiles",$data4);
            $this->logs->log = "Updated Product Profile - ID:". $this->product_profile_id ;
            $this->logs->details = json_encode(array($data4,$data4));
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
