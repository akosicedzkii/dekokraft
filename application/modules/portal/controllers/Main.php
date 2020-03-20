<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	private $user_access;
	private $default_page;
    public function __construct()
    {
        parent::__construct();
		$this->settings_model->get_settings();    
        $this->load->model("portal/users_model"); 
		if($this->session->userdata("USERID") == null)
        {   
            redirect(base_url()."portal/login");
		}
		$this->user_access = $this->settings_model->get_user_access();
		$this->default_page = $this->settings_model->get_role_default_page();
    }

	public function index()
	{
        if($this->default_page == "dashboard")
        {
            redirect(base_url()."portal/main/".$this->default_page);
        }
        else
        {
		    redirect(base_url()."portal/main/page/".$this->default_page);
        }
    }

   
	public function dashboard()
	{
		if (!in_array($this->router->fetch_method(), $this->user_access)) 
		{
			redirect(base_url()."portal/main/".$this->default_page);
		}
		$module["module_name"] = $this->router->fetch_method();
		$module["menu"] = $this->user_access;
		$this->db->distinct();
		$this->db->select("ip_address");
		$module["unique_visitors"] = $this->db->get("visit_counts")->num_rows();
		$query = "SELECT t2.code,t2.description,CONCAT(t1.color,' (',t1.color_abb,')') as color,t1.cover_image FROM product_variants as t1 LEFT JOIN products as t2 ON t2.id = t1.product_id ORDER BY t1.date_created DESC LIMIT 4";
		$module["product_variants"] = $this->db->query($query)->result();

		$this->db->order_by("user_accounts.id","desc");
		$this->db->select('*');
		$this->db->from('user_accounts');
		$this->db->join('user_profiles', 'user_profiles.user_id = user_accounts.id');
		$module["users"]= $this->db->get()->result();

		$module["month_products"] = $this->db->where("month(date_created)",date("m"))->where("year(date_created)",date("Y"))->get("product_variants")->num_rows();
		
		

		$module["today_visitors"] = $this->db->where("day(date_created)",date("d"))->where("month(date_created)",date("m"))->where("year(date_created)",date("Y"))->get("visit_counts")->num_rows();
		
		$module["all_products"] = $this->db->get("product_variants")->num_rows();
		$module["total_invoice"] = $this->db->get("invoices")->num_rows();
		$module["total_invoice_this_month"] = $this->db->where("month(date_created)",date("m"))->where("year(date_created)",date("Y"))->get("invoices")->num_rows();
		$module["pending_invoice"] = $this->db->where("status",0)->get("invoices")->num_rows();
		$module["pending_products"] = $this->db->where("status",4)->get("products")->num_rows();
		$module["total_customers"] = $this->db->get("customers")->num_rows();
		$module["user_counts"] = $this->db->get("user_accounts")->num_rows();
		
		$this->load->view('main/template/header',$module);
		$this->load->view('main/main_view',$module);
		$this->load->view('main/template/footer');
	}
  

    public function page()
    {
        $_view = $this->uri->segment(4, 0); 
        if (!in_array($_view, $this->user_access)) 
		{
			redirect(base_url()."portal/main/".$this->default_page);
		}
		$module["module_name"] = $_view;
        $module["menu"] = $this->user_access;
        $module["site_settings"] = $this->db->get("site_settings")->row();
		$this->load->view('main/template/header',$module);
		$this->load->view("main/$_view"."_view",$module);
		$this->load->view('main/template/footer');
    }
	
	
   

    public function invoices()
    {
        
        $page = $this->uri->segment(4, 0); 
       
        if (!in_array($this->router->fetch_method(), $this->user_access)) 
        {
            redirect(base_url()."portal/main/".$this->default_page);
        }
        if($page == "new")
        {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header',$module);
            $this->load->view('main/invoices_create_view',$module);
            $this->load->view('main/template/footer');
        }
        else if($page == "print")
        {
            $this->load->view('main/invoice_print_view');
        }
        else if($page == "view")
        {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header',$module);
            $this->load->view('main/invoice_solo_view',$module);
            $this->load->view('main/template/footer');
        }
        else if($page == "edit")
        {
            $invoice_id = $this->input->get("invoice_id");
            $module["invoice"] = $this->db->where("id",$invoice_id)->get("invoices")->row();
            $module["customer_address"] = $this->db->where("id",$module["invoice"]->customer_id)->get("customers")->row();
            $module["bank"] = $this->db->where("id",$module["invoice"]->bank)->get("banks")->row();
            $module["payment_terms"] = $this->db->where("id",$module["invoice"]->payment_terms)->get("payment_terms")->row();
            if( $module["invoice"] == null)
            {
                echo "invoice not found";
            }
            $module["invoice_lines"] = $this->db->where("invoice_id",$invoice_id)->get("invoice_lines");
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header',$module);
            $this->load->view('main/invoices_update_view',$module);
            $this->load->view('main/template/footer');
        }
        else if($page == "list")
        {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header',$module);
            $this->load->view('main/invoices_view',$module);
            $this->load->view('main/template/footer');
        }

    }

    
	

	public function get_profile_data()
    {
        $this->db->where("user_id",$this->session->userdata("USERID"));
        $result = $this->db->get("user_profiles");
        $user_profile = $result->row();
        $this->db->select("id,username,role_id,date_created,date_modified,created_by,modified_by");
        $this->db->where("id",$this->session->userdata("USERID"));
        $result = $this->db->get("user_accounts");
        $user_account = $result->row();
        $return["user_profile"] = $user_profile;
        $return["user_account"] = $user_account;
        echo json_encode($return); 
    }
    
    public function update_profile()
	{   
		$upload_path = './uploads/profile_image/'; 
        if(isset($_FILES["profile_image"]["name"]))  
        {  
            
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 

            $this->db->where("id",$this->session->userdata("USERID"));
			$result = $this->db->get("user_profiles");
			if($result->row()->profile_image != null)
			{
				if($result->row()->profile_image != "default_dp.png")
				{
					unlink($upload_path.$result->row()->profile_image);
				}
			}
            $config['upload_path'] = $upload_path;  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $new_filename = str_replace(" ","_","profile_".$this->input->post("username"))."_".date("YmdHisU");
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('profile_image',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
                
             
            $data = $this->upload->data();
            $this->users_model->profile_image = $data["file_name"];
		}
        $this->users_model->username = $this->input->post("username");
        $this->users_model->first_name = $this->input->post("first_name");
        $this->users_model->middle_name = $this->input->post("middle_name");
        $this->users_model->last_name = $this->input->post("last_name");
        $this->users_model->contact_number = $this->input->post("contact_number");
        $this->users_model->address = $this->input->post("address");
        $this->users_model->password = $this->input->post("password");
        $this->users_model->old_password = $this->input->post("old_password");
        $this->users_model->email_address = $this->input->post("email_address");
        $this->users_model->user_id = $this->session->userdata("USERID");
        $this->users_model->birthday = $this->input->post("birthday");
		echo $this->users_model->update_profile();
	}
	
}
