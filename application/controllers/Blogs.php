<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->settings_model->get_settings();  
		$this->v_counter->insert_visitor();   
	}
	public function index()
	{
        $data["module_name"] = strtolower($this->router->fetch_class());
        $data["title"] = "Blogs";
        $search = $this->input->get("q");
        $search_url = "q=".$search;
        $page = $this->input->get("page");
        $base_url = base_url()."blogs?";
        if($page == null)
        {
            $page = 1;
        }
        $page_url_prev = "page=".($page - 1);
        $page_url_next = "page=".($page + 1);
        $start = 3 * ($page - 1);
        $next_start = $start + 3;
        $data["prev_url"] = "";
        $data["next_url"] = "";
        if($search == "")
        { 
            $data["blogs"] = $this->db->query("SELECT t1.id,t1.description,t1.author,t1.title,t1.date_created,t2.file_name,t1.content FROM blogs AS t1 LEFT JOIN media AS t2 on t2.id = t1.cover_image WHERE t1.content_type='blogs' AND t1.status = 1 ORDER BY t1.date_created DESC limit $start,3")->result();
            $next = $this->db->query("SELECT t1.id,t1.description,t1.author,t1.title,t1.date_created,t2.file_name,t1.content FROM blogs AS t1 LEFT JOIN media AS t2 on t2.id = t1.cover_image WHERE t1.content_type='blogs' AND t1.status = 1 ORDER BY t1.date_created DESC limit $next_start,3")->result();
            if($page != 1)
            {
                $data["prev_url"] = $base_url.$page_url_prev;
                if($search != "")
                {
                    $data["prev_url"] = $base_url.$page_url_prev."&".$search_url;
                }
            }
            if($next!=null)
            {
                $data["next_url"] = $base_url.$page_url_next;
                if($search != "")
                {
                    $data["next_url"] = $base_url.$page_url_next."&".$search_url;
                }
            }
        }
        else
        {
            $data["blogs"] = $this->db->query("SELECT t1.id,t1.description,t1.author,t1.title,t1.date_created,t2.file_name,t1.content FROM blogs AS t1 LEFT JOIN media AS t2 on t2.id = t1.cover_image WHERE t1.content_type='blogs' AND t1.status = 1 AND (t1.title like '%$search%' OR t1.content like '%$search%' OR t1.description like '%$search%') ORDER BY t1.date_created DESC limit $start,3")->result();
            $next = $this->db->query("SELECT t1.id,t1.description,t1.author,t1.title,t1.date_created,t2.file_name,t1.content FROM blogs AS t1 LEFT JOIN media AS t2 on t2.id = t1.cover_image WHERE t1.content_type='blogs' AND t1.status = 1 AND (t1.title like '%$search%' OR t1.content like '%$search%' OR t1.description like '%$search%') ORDER BY t1.date_created DESC limit $next_start,3")->result();
         
            if($page != 1)
            {
                $data["prev_url"] = $base_url.$page_url_prev;
                if($search != "")
                {
                    $data["prev_url"] = $base_url.$page_url_prev."&".$search_url;
                }
            }
            if($next!=null)
            {
                $data["next_url"] = $base_url.$page_url_next;
                if($search != "")
                {
                    $data["next_url"] = $base_url.$page_url_next."&".$search_url;
                }
            }
        }
        $data["page"] = "blogs";
        $data["search"] = $search;
        $data["recent_blog"] = $this->db->query("SELECT t1.id,t1.description,t1.author,t1.title,t1.date_created,t2.file_name,t1.content FROM blogs AS t1 LEFT JOIN media AS t2 on t2.id = t1.cover_image WHERE t1.content_type='blogs' AND t1.status = 1 ORDER BY t1.date_created DESC limit 0,2")->result();
        $this->load->view('template/header.php',$data);
        $this->load->view('blogs_view');
        $this->load->view('template/footer.php',$data);
    }
    
    public function page()
    {
        if($this->uri->segment(3) != "")
        {
            $page = $this->uri->segment(3);
            $data["module_name"] = strtolower($this->router->fetch_class());
            $id = explode("-",$page);
            $id = $id[count($id) - 1];
            $this->db->where("id",$id);
            $data["page"] = "blogs";
            $data["post"] = $this->db->query("SELECT t1.id,t1.description,t1.author,t1.title,t1.date_created,t2.file_name,t1.content FROM blogs AS t1 LEFT JOIN media AS t2 on t2.id = t1.cover_image WHERE t1.id = $id")->row();
            $data["recent_blog"] = $this->db->query("SELECT t1.id,t1.description,t1.author,t1.title,t1.date_created,t2.file_name,t1.content FROM blogs AS t1 LEFT JOIN media AS t2 on t2.id = t1.cover_image WHERE t1.content_type='blogs' AND t1.status = 1 ORDER BY t1.date_created DESC limit 0,2")->result();
            $this->load->view('template/header.php',$data);
            $this->load->view('blog_view');
            $this->load->view('template/footer.php',$data);
        }
        else
        {
            redirect(base_url()."blogs");
        }
    }

}
