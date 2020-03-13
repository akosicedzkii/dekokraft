<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->settings_model->get_settings(); 
		 
	}
	public function index()
	{
		echo "test";

	}
	public function send_contact_us()
	{
		$session = $this->session->userdata('submission');

		if(!empty($session))
		{
			if($session ==99999)
			{
				echo "Max submission reached. Limit is only 2 submissions per 2 hours";
				die();
			}
			$this->session->set_userdata("submission",$this->session->userdata('submission') + 1);   
		}else{
	 
			 $this->session->set_userdata("submission",1);     
		}  

		$to = CONTACT_US_EMAIL_ADDRESS;
		$body = $this->input->post("body");
		$subject = "Contact Us Response";
		$emailer_name = $this->input->post("emailer_name");
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"emailer_name=$emailer_name&to=$to&body=$body&subject=$subject&attachment="."&others=");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);
		
		$to = $this->input->post("to");
		$body = CONTACT_US_BODY_REPLY;
		$subject = CONTACT_US_SUBJECT_REPLY;
		$emailer_name = "OSI Mailer";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"emailer_name=$emailer_name&to=$to&body=$body&subject=$subject&attachment="."&others=");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		echo $server_output = curl_exec ($ch);

		curl_close ($ch);

		$this->db->query("UPDATE submissions_counter SET contact_us = contact_us + 1");
		
		  
	}

	public function send_franchise()
	{
		$session = $this->session->userdata('submission');

		if(!empty($session))
		{
			if($session == 2)
			{
				echo "Max submission reached. Limit is only 2 submissions per 2 hours";
				die();
			}
			$this->session->set_userdata("submission",$this->session->userdata('submission') + 1);   
		}else{
	 
			 $this->session->set_userdata("submission",1);     
		}  

		if ( 0 < $_FILES['file']['error'] ) {
			echo 'Error';
		}
		else {
			move_uploaded_file($_FILES['file']['tmp_name'], './emailer/attachment/' . $_FILES['file']['name']);
			
			$to = FRANCHISE_EMAIL_ADDRESS;
			$body = $this->input->post("body");
			$subject = $this->input->post("subject");
			$emailer_name = $this->input->post("emailer_name");
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"emailer_name=$emailer_name&to=$to&body=$body&subject=$subject&attachment=".$_FILES['file']['name']."&others=");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec ($ch);

			curl_close ($ch);

			$to = $this->input->post("to");
			$body = FRANCHISE_BODY_REPLY;
			$subject = FRANCHISE_SUBJECT_REPLY;
			$emailer_name = "Mailer";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"emailer_name=$emailer_name&to=$to&body=$body&subject=$subject&attachment="."&others=");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			echo $server_output = curl_exec ($ch);

			curl_close ($ch);
			$this->db->query("UPDATE submissions_counter SET franchise = franchise + 1");
		}

	}

	public function send_careers()
	{	
		$session = $this->session->userdata('submission');

		if(!empty($session))
		{
			if($session == 2)
			{
				echo "Max submission reached. Limit is only 2 submissions per 2 hours";
				die();
			}
			$this->session->set_userdata("submission",$this->session->userdata('submission') + 1);   
		}else{
	 
			 $this->session->set_userdata("submission",1);     
		}  
		if ( 0 < $_FILES['file']['error'] ) {
			echo 'Error';
		}
		else {
			move_uploaded_file($_FILES['file']['tmp_name'], './emailer/attachment/' . $_FILES['file']['name']);
			$to = CAREERS_EMAIL_ADDRESS;
			$body = $this->input->post("body");
			$emailer_name = $this->input->post("emailer_name");
			$subject = "Careers Response";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
			curl_setopt($ch, CURLOPT_POST, 1);
			
			curl_setopt($ch, CURLOPT_POSTFIELDS,"emailer_name=$emailer_name&to=$to&body=$body&subject=$subject&attachment=".$_FILES['file']['name']."&others=");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
			$server_output = curl_exec ($ch);
	
			curl_close ($ch);
			
			$to = $this->input->post("to");
			$body = CAREERS_BODY_REPLY;
			$subject = CAREERS_SUBJECT_REPLY;
			$attachment = CAREERS_ATTACHMENT;

			if($attachment != "")
			{
				$attachment = "&attachment=../uploads/careers_attachment/".CAREERS_ATTACHMENT."&others=careers";
			}else{
				$attachment = "&attachment=";
			}
			$emailer_name = "Mailer";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"emailer_name=$emailer_name&to=$to&body=$body&subject=$subject".$attachment);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			echo $server_output = curl_exec ($ch);

			curl_close ($ch);

			$this->db->query("UPDATE submissions_counter SET careers = careers + 1");
		}

	}
	
}
