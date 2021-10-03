<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailer extends CI_Controller {
   
    
	public function send_email()
	{
        $email_queue = $this->db->where("status","0")->order_by("ID","ASC")->limit(40)->get("email_queue")->result();
        if($email_queues == null)
        {
            die();
        }
        foreach($email_queues as $email_queue)
        {
            $to = $email_queue->email_address;
            $body = $email_queue->message;
            $subject = $email_queue->subject;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,"to=$to&body=$body&subject=$subject&attachment=");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
            $server_output = curl_exec ($ch);
    
            curl_close ($ch);
            $this->db->where("id",$email_queue->id);
            $data["status"] = "1";
            $this->db->update("email_queue",$data);
        }
        
    }
}
