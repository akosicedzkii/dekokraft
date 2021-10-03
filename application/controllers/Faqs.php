<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->settings_model->get_settings();  
		$this->v_counter->insert_visitor();   
	}
	public function index()
	{
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["faqs"] = $this->db->get("dynamic_settings")->row();
		$data["page"] = "faqs";
		$this->load->view('template/header.php',$data);
		$this->load->view('faqs_view');
		$this->load->view('template/footer.php',$data);
	}

}
