<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailer extends CI_Controller {

	public function send_email()
	{
        $email_queue = $this->db->where("status","0")->order_by("ID","ASC")->get("email_queue")->row();
        if($email_queue == null)
        {
            die();
        }
        $to = $email_queue->email_address;
        echo $body =  urlencode($email_queue->message);
        $subject = $email_queue->subject;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"emailer_name=demo&to=$to&body=$body&subject=$subject&attachment=");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        echo $server_output = curl_exec ($ch);

        curl_close ($ch);
        $this->db->where("id",$email_queue->id);
        $data["status"] = "1";
        $data["date_sent"] = date("Y-m-d H:i:s");
        $this->db->update("email_queue",$data);
    }

    public function test()
    {
        $explode = explode(",","martinezcederic@gmail.com,martinezcederic@gmail.com,martinezcederic@gmail.com,martinezcederic@gmail.com,martinezcederic@gmail.com");

        foreach($explode as $string)
        {
            echo $string."<br>";
        }
    }
}
