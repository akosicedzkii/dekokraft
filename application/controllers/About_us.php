<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_us extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->settings_model->get_settings();  
		$this->v_counter->insert_visitor();   
	}
	public function index()
	{
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["page"] = strtolower($this->router->fetch_class());
		$data["about_us"] = $this->db->get("dynamic_settings")->row();
		$this->load->view('template/header.php',$data);
		$this->load->view('about_us_view');
		$this->load->view('template/footer.php',$data);
	}

}
