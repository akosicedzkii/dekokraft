<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {
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

	public function add_media()
	{
        $module = $this->input->post("module");
        $allowed_files = $this->input->post("allowed_files");
        $file_type = $this->input->post("file_type");
        $upload_path = './uploads/'.$module.'/'; 
        if(isset($_FILES["media_file"]["name"]))  
        {  
            
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 
            $config['upload_path'] = $upload_path;  
            //$config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $config['allowed_types'] = $allowed_files;  
            $new_filename = $module."_".date("YmdHisU");
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('media_file',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
            else  
            {  
                $data = $this->upload->data();
                
                $data_media["file_name"] = $data["file_name"]; 
                $data_media["module"] = $module; 
                $data_media["type"] = $file_type;
                $data_media["created_by"] = $this->session->userdata("USERID"); 
                $data_media["date_created"] = date("Y-m-d H:i:s A"); 
            }  
        }else{
            echo "Errosr". $upload_path . $data["file_name"];
            die();
        } 
        echo $this->db->insert("media",$data_media);

	}

	public function delete_media()
	{
        $module = $this->input->post("module");
        $dir = './uploads/'.$module.'/'; 
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_media = $this->db->get("media");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("media");
        unlink($dir.$data_media->row()->file_name);
        $data = json_encode($data_media->row());
        $this->logs->log = "Deleted media - ID:". $data_media->row()->id .", Media Name: ".$data_media->row()->file_name ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "media";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_media_list()
    {
        $module = $this->input->get("module");
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.file_name","t1.date_created","t2.username");  
        $this->dt_model->where  = array("t1.id","t1.file_name","t1.date_created","t2.username");  
        $select_columns = array("id","file_name","date_created","username");  
        $this->dt_model->table = "media AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by ";  
        $this->dt_model->index_column = "t1.id";
        if($this->session->userdata("USERTYPE") !=0 )
        {
            $this->dt_model->staticWhere = "t1.module = '$module'";
        }
        else
        {
            $this->dt_model->staticWhere = "t1.module = '$module' AND t1.created_by = ".$this->session->userdata("USERID");
        }
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"]; 
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            $btns = '<input type="radio" value="'.$aRow['id'].'"  data="'.base_url().'uploads/'.$module.'/'.$aRow["file_name"].'"  name="selected_image">';
            array_unshift($row,$btns);
            foreach ($select_columns as $col) {
                if($col == "username" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }
                   else if($col == "file_name")
                    { 
                        if($aRow[$col] != null || $aRow[$col] != "")
                        {  
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/$module/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\")'></a>";
                        }
                        else
                        {
                            $row[] = "None";
                        }
                    }
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            
            $btns = '<a href="#" onclick="_delete_media('.$aRow['id'].',\''.base_url()."uploads/$module/".$aRow["file_name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }

}
