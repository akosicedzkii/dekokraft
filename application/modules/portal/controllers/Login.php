<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();    
    }
    
	public function index()
	{
        if($this->session->userdata("USERNM") == null)
        {   
            
		    $data["faqs"] = $this->db->get("dynamic_settings")->row();
            $this->load->view('main/login_view',$data);
        }
        else
        {
            redirect(base_url()."portal/main");
        }
	}

	public function validate_login()
	{
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        if($username == null || $password == null)
        {
            echo "Complete all fields";
        }
        else
        {
            $this->load->model("login_model");
            $this->login_model->username = $username;
            $this->login_model->password = $password;
            $return = $this->login_model->validate_login();
            if($return)
            {
                echo $return;
            }
        }
	}
}
