<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("portal/news_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_news()
	{
        $this->news_model->title = $this->input->post("title");
        $this->news_model->description = $this->input->post("description");
        $this->news_model->content = $this->input->post("content");
        $this->news_model->status = $this->input->post("status");
        $this->news_model->cover_image = $this->input->post("cover_image");
        echo $this->news_model->insert_news();
	}

	public function edit_news()
	{
        $news_id = $this->input->post("id");
        $this->news_model->title = $this->input->post("title");
        $this->news_model->description = $this->input->post("description");
        $this->news_model->content = $this->input->post("content");
        $this->news_model->status = $this->input->post("status");
        $this->news_model->cover_image = $this->input->post("cover_image");
        $this->news_model->id = $news_id;
        echo $this->news_model->update_news();
	}

	public function delete_news()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_news = $this->db->get("news_and_updates");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("news_and_updates");
        $data = json_encode($data_news->row());
        $this->logs->log = "Deleted News - ID:". $data_news->row()->id .", News Title: ".$data_news->row()->title ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "news";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_news_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("news_and_updates");
        $news = $result->row(); 
        if($news->cover_image != null)
        {
            if(is_numeric( $news->cover_image ))
            {
                $news->cover_image_id = $news->cover_image;
                $news->cover_image = $this->db->where("id",$news->cover_image)->get("media")->row()->file_name;
            }
        }
        $return["news"] = $news;
        echo json_encode($return); 
    }

    public function get_news_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.title","t4.file_name as cover_image","IF(t1.status=1,'Enabled','Disabled') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.title","t4.file_name","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","title","cover_image","status","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "news_and_updates AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by LEFT JOIN media as t4 on t4.id = t1.cover_image";  
        $this->dt_model->index_column = "t1.id";
        $this->dt_model->staticWhere = "t1.content_type = 'news'";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {    
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/news/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a>";
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
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["title"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
