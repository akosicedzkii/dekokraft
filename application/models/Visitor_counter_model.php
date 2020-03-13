<?php

class Visitor_counter_model extends CI_Model {
    
        public function insert_visitor()
        {
                $externalIp = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
                

                $this->db->where("ip_address",$externalIp);
                $this->db->where("date_created",date("Y-m-d"));
                $result = $this->db->get("visit_counts")->row();
                if($result == null){
                    $data["ip_address"] = $externalIp;

                    
                    $url = "http://freegeoip.net/json/{$externalIp}";
                    $ch  = curl_init();
                    
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    $data_curl = curl_exec($ch);
                    curl_close($ch);
                    $data_curl = json_decode($data_curl,true) ;
                    $data["lat"] =  $data_curl["latitude"];
                    $data["long"] = $data_curl["longitude"];
                    $data["time"] = date("Y-m-d H:i:s A");
                    $data["date_created"] = date("Y-m-d");
                    $data["country"] = $data_curl["country_name"];
                    $data["region"] = $data_curl["region_name"];
                    $data["city"] = $data_curl["city"];
                    $data["country_code"] = $data_curl["country_code"];
                    $this->db->insert("visit_counts",$data);
                }
        }
}

