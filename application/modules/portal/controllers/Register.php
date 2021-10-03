<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
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
            $this->load->view('main/register_view',$data);
        }
        else
        {
            redirect(base_url()."portal/main");
        }
    }

    public function register_user()
    {
        
        $this->load->model("users_model","u_model");
        $this->u_model->username = $this->input->post("username");
        $this->u_model->password = $this->input->post("password");
        $this->u_model->last_name = $this->input->post("lastname");
        $this->u_model->middle_name = $this->input->post("middlename");
        $this->u_model->first_name = $this->input->post("firstname");
        $this->u_model->email_address = $this->input->post("email");
        $this->u_model->role = 0;
        $this->u_model->status = 1;
        if(!$this->u_model->check_username_exist("add"))
        {
            $this->u_model->insert_user();
        }else{
            echo "Username already used";
        }
    }
}