<?php

class Stocks_model extends CI_Model {

        public function add_stock($count,$product_variant_id)
        {
            $counter = 0;
            while($counter< $count)
            {
                $data["product_variant_id"] = $product_variant_id;
                $data["date_created"] = date("Y-m-d h:i:s A");
                $data["created_by"] = $this->session->userdata("USERID");
                $this->db->insert("stocks",$data);
                $counter++;
            }
        }

        public function reduce_stock($count,$product_variant_id)
        {

            $result = $this->db->where("product_variant_id",$product_variant_id)->limit($count)->order_by("id","desc")->get("stocks");
            if($result!= null)
            {
                foreach($result->result() as $row)
                {
                    $this->db->where("id",$row->id);
                    $this->db->delete("stocks");
                }
            }
            return true;
        }
}

?>