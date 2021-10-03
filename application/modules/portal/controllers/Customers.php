<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("portal/customers_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_customers()
	{
        $this->customers_model->id = $this->input->post("id");
        $this->customers_model->customer_name = $this->input->post("customer_name");
        $this->customers_model->attn = $this->input->post("attn");
        $this->customers_model->customer_address = $this->input->post("customer_address");
        $this->customers_model->customer_mobile = $this->input->post("customer_mobile");
        $this->customers_model->customer_fax = $this->input->post("customer_fax");
        $this->customers_model->customer_email = $this->input->post("customer_email");
        $this->customers_model->company_name = $this->input->post("company_name");
        $this->customers_model->state = $this->input->post("state");
        $this->customers_model->city = $this->input->post("city");
        $this->customers_model->country = $this->input->post("country");
        $this->customers_model->postal_code = $this->input->post("postal_code");
        $this->customers_model->status = $this->input->post("status");
        
        $this->customers_model->date_created = date("Y-m-d H:i:s A");
        $this->customers_model->created_by =  $this->session->userdata("USERID");
        echo $this->customers_model->insert_customers();
	}

	public function edit_customers()
	{
        $this->customers_model->id = $this->input->post("id");
        $this->customers_model->attn = $this->input->post("attn");
        $this->customers_model->customer_name = $this->input->post("customer_name");
        $this->customers_model->customer_address = $this->input->post("customer_address");
        $this->customers_model->customer_mobile = $this->input->post("customer_mobile");
        $this->customers_model->customer_fax = $this->input->post("customer_fax");
        $this->customers_model->customer_email = $this->input->post("customer_email");
        $this->customers_model->company_name = $this->input->post("company_name");
        $this->customers_model->state = $this->input->post("state");
        $this->customers_model->city = $this->input->post("city");
        $this->customers_model->country = $this->input->post("country");
        $this->customers_model->postal_code = $this->input->post("postal_code");
        $this->customers_model->status = $this->input->post("status");
        $this->customers_model->date_modified = date("Y-m-d H:i:s A");
        $this->customers_model->modified_by =  $this->session->userdata("USERID");
        echo $this->customers_model->update_customers();
	}

	public function delete_customers()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_customers = $this->db->get("customers");
        $this->db->where("id",$id);
        $data["status"] = 3;
        echo $result = $this->db->update("customers",$data);
        $data = json_encode($data_customers->row());
        $this->logs->log = "Deleted customers - ID:". $data_customers->row()->id .", customers Title: ".$data_customers->row()->name ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "customers";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_customers_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("customers");
        $customers = $result->row(); 
        $return["customers"] = $customers;
        echo json_encode($return); 
    } 

    public function get_customers_selection()
    {
        
        $search = $this->input->get("term[term]");
        $this->db->like("customer_name",$search);  
        $this->db->where("status",1);
        $this->db->or_like("company_name",$search);  
        $this->db->where("status",1);  
        $this->db->select("company_name as text"); 
        $this->db->select("attn as attn"); 
        $this->db->select("customer_address as address"); 
        $this->db->select("id as id");
        $this->db->limit(10);
        $filteredValues=$this->db->get("customers")->result_array();

        echo json_encode(array(
            'items' => $filteredValues,"q"=>$this->db->last_query()
        ));
    }
    public function get_customers_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.customer_name","t1.company_name","t1.attn","t1.customer_address","IF(t1.status=1,'Active','Inactive') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.customer_name","t1.company_name","t1.attn","t1.customer_address","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","customer_name","company_name","attn","customer_address","status","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "customers AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by ";  
        $this->dt_model->index_column = "t1.id";
        $this->dt_model->staticWhere = "t1.status != 3"; 
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
                    else if($col == "status")
                    {
                        if($aRow[$col] == "Inactive")
                        {
                            $row[] = '<center><small class="label bg-gray">'.$aRow[$col].'</small></center>';
                        }
                        else if($aRow[$col] == "Active")
                        {
                            $row[] = '<center><small class="label bg-green">'.$aRow[$col].'</small></center>';
                        }
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {    
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/customers/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a>";
                        }
                        else
                        {
                            $row[] = "None";
                        }
                     }
                    else
                    {
                        $row[] = $aRow[$col] ;
                    }
            }
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" name="View Details"></a>-->
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" name="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["customer_name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" name="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
