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

}

?>