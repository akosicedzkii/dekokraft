<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_settings extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

    public function update_settings()
    {
        if(isset($_FILES["site_logo"]["name"]))  
        {
            $upload_path = './uploads/site_logo/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 

            $result = $this->db->get("site_settings");
            $ext = pathinfo($_FILES["site_logo"]["name"], PATHINFO_EXTENSION);
            $allowed =  array('gif','png' ,'jpg','jpeg');
            if(!in_array($ext,$allowed) ) 
            {
                echo 'Invalid Logo type';
                die();
            }
            if( $result->row()->site_logo != "")
            {
                if(file_exists ( $upload_path.$result->row()->site_logo ))
                {
                    unlink($upload_path.$result->row()->site_logo);
                }
            }
            $config['upload_path'] = $upload_path;  
            
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $new_filename = "site_logo";
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config);
            $this->upload->initialize($config); 
            if(!$this->upload->do_upload('site_logo',$new_filename))  
            {  
                echo $this->upload->display_errors(). " For Logo " ; 
                die(); 
            }
            else
            {
                
                $data_upload = $this->upload->data();
               
                $data["site_logo"] = $data_upload["file_name"];
            }  
        }

        if(isset($_FILES["site_icon"]["name"]))  
        {
            $upload_path = './uploads/site_icon/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 

           
            $result = $this->db->get("site_settings");
            
            $ext = pathinfo($_FILES["site_icon"]["name"], PATHINFO_EXTENSION); 
            $allowed =  array('ico');
            if(!in_array($ext,$allowed) ) 
            {
                echo 'Invalid Icon type';
                die();
            }
            if($result->row()->site_icon != "")
            {
                if(file_exists ( $upload_path.$result->row()->site_icon ))
                {
                    unlink($upload_path.$result->row()->site_icon);
                }
            }
            $config_icon['upload_path'] = $upload_path;  
            $config_icon['allowed_types'] = 'ico';  
            $new_filename = "site_icon";
            $config_icon['file_name']= $new_filename ;
            $this->load->library('upload', $config_icon); 
            $this->upload->initialize($config_icon);
            if(!$this->upload->do_upload('site_icon',$new_filename))  
            {  
                echo $this->upload->display_errors() . " For Icon " ; 
                die(); 
            }
            else
            {
                $data_icon = $this->upload->data();
                $data["site_icon"] = $data_icon["file_name"];
            }  
        }

        if(isset($_FILES["mid_banner_image"]["name"]))  
        {
            $upload_path = './uploads/mid_banner_image/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 

            $result = $this->db->get("site_settings");
            $ext = pathinfo($_FILES["mid_banner_image"]["name"], PATHINFO_EXTENSION);
            $allowed =  array('gif','png' ,'jpg','jpeg');
            if(!in_array($ext,$allowed) ) 
            {
                echo 'Invalid Logo type';
                die();
            }
            if( $result->row()->mid_banner_image != "")
            {
                if(file_exists ( $upload_path.$result->row()->mid_banner_image ))
                {
                    unlink($upload_path.$result->row()->mid_banner_image);
                }
            }
            $config['upload_path'] = $upload_path;  
            
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $new_filename = "mid_banner_image";
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config);
            $this->upload->initialize($config); 
            if(!$this->upload->do_upload('mid_banner_image',$new_filename))  
            {  
                echo $this->upload->display_errors(). " For Mid Banner Image " ; 
                die(); 
            }
            else
            {
                
                $data_upload = $this->upload->data();
               
                $data["mid_banner_image"] = $data_upload["file_name"];
            }  
        }
        $data["site_name"] = $this->input->post("site_name");
        $data["company_address"] = $this->input->post("company_address");
        $data["contact_number"] = $this->input->post("contact_number");
        $data["fax_number"] = $this->input->post("fax_number");
        $data["contact_us_email_address"] = $this->input->post("contact_us_email_address");
        $data["facebook_url"] = $this->input->post("facebook_url");
        $data["twitter_url"] = $this->input->post("twitter_url");
        $data["instagram_url"] = $this->input->post("instagram_url");
        $data["paypal_button"] = $this->input->post("paypal_button");


        
        $data["contact_us_subject_reply"] = $this->input->post("contact_us_subject_reply");
        $data["contact_us_body_reply"] = $this->input->post("contact_us_body_reply");

        echo $this->db->update("site_settings",$data);
        $this->logs->log = "Updated Site Settings";
        $this->logs->details = json_encode($data);
        $this->logs->module = "site_settings";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
    }

    public function remove_file()
    {
        $file_name = $this->input->post("file_name");
        $settings_module = $this->input->post("settings_module");
        $folder = $this->input->post("folder");
        
        $path = './uploads/'.$folder.'/' . $file_name; 
        unlink($path);
        echo $path;
        $data[$settings_module] = "";
        $this->db->update("site_settings",$data);  
         $this->logs->log = "Removed/Deleted ".$settings_module;
        $this->logs->module = "site_settings";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        echo true;
    }
}
