<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("portal/invoices_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function insert_invoices()
	{
       
        $params = array(
            'invoice_date' => date("Y-m-d h:i:s a"),
            'customer_id' => $this->input->post('customer_name'),
            'invoice_number' => $this->input->post('invoice_number'),
            'mo_number' => $this->input->post('mo_number'),
            'iq' => $this->input->post('iq'),
            'remarks' => $this->input->post('remarks'),
            'packing_instruction' => $this->input->post('packing_instruction'),
            'invoice_type' => $this->input->post('invoice_type'),
            'bank' => $this->input->post('bank'),
            'payment_terms' => $this->input->post('payment_terms'),
            'delivery_time' => $this->input->post('delivery_time'),
            'shipping_instruction' => $this->input->post('shipping_instruction'),
            'markings' => $this->input->post('markings'),
            'date_created' => date("Y-m-d h:i:s a"),
            'created_by' => $this->session->userdata("USERID"),
            'status' => 0,
            
        );
        $invoice_items = json_decode($this->input->post("invoice_items"));    
        $invoice_id = $this->invoices_model->add_invoice($params,$invoice_items);
	}

	public function edit_invoices()
	{
        $this->invoices_model->username = $this->input->post("username");
        $this->invoices_model->first_name = $this->input->post("first_name");
        $this->invoices_model->middle_name = $this->input->post("middle_name");
        $this->invoices_model->last_name = $this->input->post("last_name");
        $this->invoices_model->contact_number = $this->input->post("contact_number");
        $this->invoices_model->address = $this->input->post("address");
        $this->invoices_model->role = $this->input->post("role");
        $this->invoices_model->status = $this->input->post("status");
        $this->invoices_model->email_address = $this->input->post("email_address");
        $this->invoices_model->birthday = $this->input->post("birthday");
        $this->invoices_model->user_id = $this->input->post("user_id");
        $existing =  $this->invoices_model->check_invoicesname_exist("edit");
		if(!$existing)
		{
			echo $this->invoices_model->update_invoices();
		}
		else
		{
			echo "username is existing";
		}
	}

	public function delete_invoices()
	{
        
        $id = $this->input->post("id");
        $this->db->where("user_id",$id);
        $data_profile = $this->db->get("user_profiles");
        $this->db->where("user_id",$id);
        $result = $this->db->delete("user_profiles");
        if($result)
        {
            $this->db->select("id,username,role_id,date_created,date_modified,created_by,modified_by");
            $this->db->where("id",$id);
            $data_account = $this->db->get("user_accounts");

            $this->db->where("id",$id);
            echo $result = $this->db->delete("user_accounts");
            $data = json_encode($data_profile->row());
            $this->logs->log = "Deleted User - ID: ". $data_account->row()->id .", Username: ".$data_account->row()->username ;
            $this->logs->details = json_encode($data) . " User Details: ".json_encode( $data_account->row() );
            $this->logs->module = "invoices";
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
        }
	}

    public function get_invoices_data()
    {
        $id = $this->input->post("id");
        $this->db->where("user_id",$id);
        $result = $this->db->get("user_profiles");
        $user_profile = $result->row();
        $this->db->select("id,username,role_id,date_created,date_modified,created_by,modified_by");
        $this->db->where("id",$id);
        $result = $this->db->get("user_accounts");
        $user_account = $result->row();
        $return["user_profile"] = $user_profile;
        $return["user_account"] = $user_account;
        echo json_encode($return); 
    }
    
    

    public function get_invoices_roles()
    {
        echo $this->invoices_model->get_invoices_roles($this->input->post("term"));
    }

    public function check_invoicesname_exist()
    {
        $method = $this->input->get("method");
        
        $this->invoices_model->username = $this->input->get("username");
        if($method == "edit")
        {
            $this->invoices_model->user_id = $this->input->get("user_id");
        }
        $existing =  $this->invoices_model->check_invoicesname_exist($method);
        if(!$existing)
        {
            header("Status: 200");
        }else{
            header("HTTP/1.0 400 Username is already used");
        }
    }

    public function get_invoice_list()
    {
        $invoice_id = $this->input->get("invoice_id");
        $this->db->select("product_variants.color,invoice_lines.*,products.description,products.code");
        $this->db->join("product_variants"," product_variants.id=invoice_lines.product_id");
        $this->db->join("products"," products.id=product_variants.product_id");
        $result = $this->db->get("invoice_lines")->result();
        echo json_encode($result);
    }
    public function get_invoices_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.id","t6.customer_name","(SELECT SUM(product_price) from invoice_lines WHERE invoice_id=t1.id) as total_amount","t1.invoice_type","t1.remarks","t1.date_created","t4.username as created_by","t1.date_modified","t5.username as modified_by","t1.status as status");  
        $this->dt_model->where  = array("t1.id","t1.id","t6.customer_name","t1.invoice_type","t1.remarks","t1.date_created","t4.username","t1.date_modified","t5.username","t1.status");  
        $select_columns = array("id","id","customer_name","total_amount","invoice_type","remarks","date_created","created_by","date_modified","modified_by","status");  
        $this->dt_model->table = "invoices AS t1 LEFT JOIN user_profiles AS t2 ON t2.user_id = t1.id LEFT JOIN user_accounts AS t4 ON t4.id = t1.created_by LEFT JOIN user_accounts AS t5 ON t5.id = t1.modified_by LEFT JOIN customers as t6 ON t6.id = t1.customer_id";  
        $this->dt_model->index_column = "t1.id";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by" )
                    {
                        $row[] = $aRow[$col];
                    } 
                    else if($col == "total_amount" )
                    {
                        $row[] = "$ ".$aRow[$col];
                    }
                    else if($col == "status")
                    {
                        if($aRow[$col] == "0")
                        {
                            $row[] = '<center><small class="label bg-gray">Inactive</small></center>';
                        }
                        else if($aRow[$col] == "1")
                        {
                            $row[] = '<center><small class="label bg-green">Active</small></center>';
                        }
                        else if($aRow[$col] == "4")
                        {
                            $row[] = '<center><small class="label bg-orange">Pending</small></center>';
                        }
                        else
                        {
                            $row[] = '<center><small class="label bg-red">Error</small></center>';
                        }
                    }
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            
            $btns = '';
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
            <a href="'.base_url("portal/main/invoices/edit?invoice_id=".$aRow['id']).'"  class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow['id'].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
        
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output ); 
    }

    
}
