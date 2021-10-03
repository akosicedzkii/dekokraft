<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();    
    }
    
	public function index()
	{
        if($this->session->userdata("USERNM") == null)
        {   
            $this->load->view('main/forgot_password_view');
        }
        else
        {
            redirect(base_url()."portal/main");
        }
	}

	public function forgot_password()
	{
        $username = $this->input->post("username");
        $email_address = $this->input->post("email_address");
        if($username == null || $email_address == null)
        {
            echo "Complete all fields";
        }
        else
        {
            $this->load->model("login_model");
            $this->login_model->username = $username;
            $this->login_model->email_address = $email_address;
            $return = $this->login_model->forgot_password();
            if($return)
            {
                echo $return;
            }
        }
    }
    
    public function generate_password()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $this->db->where("username",$username);
        $user = $this->db->get("user_accounts")->row();

        if($user == null)
        {
            echo "Incorrect username";
            die();
        }
        else
        {
            $new_password_hashed =  hash ( "sha256",  $user->salt.$password );
            echo $new_password_hashed;
        }
    }
}
