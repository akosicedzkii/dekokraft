<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl extends CI_Controller {
    public function __construct()
    {
        
    }

	public function index()
	{
	
        $ch = curl_init();
        $card_number = "1100000000090097";
        $card_number = $this->input->post("card_number");
        $birthdate = "19800814";
        $birthdate = $this->input->post("birthdate");
        $date = date("Ymd");
        $random_key = rand(1001,5000);
        $vendor_key = md5("UNI".$random_key.$date.$card_number);
        curl_setopt($ch, CURLOPT_URL,"http://13.229.0.154/cgi-bin/uni_web.cgi");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "state=state_login&card_number=$card_number&birth_date=$birthdate&random_key=$random_key&yyyymmdd=$date&vendor_key=$vendor_key");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        curl_close ($ch);
        
        echo json_encode($server_output);
	}

}
