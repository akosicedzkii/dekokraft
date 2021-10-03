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
            'attn' => $this->input->post('attn'),
            'customer_id' => $this->input->post('customer_name'),
            'invoice_number' => $this->input->post('invoice_number'),
            'iq' => $this->input->post('iq'),
            'remarks' => $this->input->post('remarks'),
            'packing_instruction' => $this->input->post('packing_instruction'),
            'invoice_type' => $this->input->post('invoice_type'),
            'bank' => $this->input->post('bank'),
            'payment_terms' => $this->input->post('payment_terms'),
            'delivery_time' => $this->input->post('delivery_time'),
            'shipping_instruction' => $this->input->post('shipping_instruction'),
            'markings' => $this->input->post('markings'),
            'label_instructions' => $this->input->post('label_instructions'),
            'invoice_remarks' => $this->input->post('invoice_remarks'),
            'date_created' => date("Y-m-d h:i:s a"),
            'created_by' => $this->session->userdata("USERID"),
            'pdf_due' => $this->input->post('pdf_due'),
            'status' => 0,
            
        );
        $invoice_items = json_decode($this->input->post("invoice_items"));    
        $invoice_id = $this->invoices_model->add_invoice($params,$invoice_items);
	}

	public function update_invoices()
	{
        $params = array(
            'attn' => $this->input->post('attn'),
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
            'date_modified' => date("Y-m-d h:i:s a"),
            'modified_by' => $this->session->userdata("USERID"),
            'invoice_remarks' => $this->input->post('invoice_remarks'),
            'label_instructions' => $this->input->post('label_instructions'),
            'pdf_due' => $this->input->post('pdf_due'),
            'id' =>$this->input->post("id")
            
        );
        $invoice_items = json_decode($this->input->post("invoice_items"));    
        $invoice_id = $this->invoices_model->update_invoices($params,$invoice_items);
	}

	public function delete_invoice()
	{
        
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_invoice = $this->db->get("invoices");
        $this->db->where("id",$id);
        $data["status"] = 3;
        echo $result = $this->db->update("invoices",$data);
        $nvoice_lines = $this->db->where("invoice_id",$id)->get("invoice_lines")->result();
        $data = json_encode($data_invoice->row());
        $this->logs->log = "Deleted invoice - ID:". $data_invoice->row()->id  ;
        $this->logs->details = json_encode($data) . " Lines: ". json_encode($nvoice_lines);
        $this->logs->module = "invoices";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
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

    public function create_mo()
    {
        echo $this->invoices_model->create_mo($this->input->post("id"));
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
        $invoice_status = $this->db->where("id",$invoice_id)->get("invoices")->row()->status;
        $this->db->select("product_variants.color,invoice_lines.*,products.description,products.code,products.fob");
        $this->db->join("product_variants"," product_variants.id=invoice_lines.product_id");
        $this->db->join("products"," products.id=product_variants.product_id");
        //$this->db->order_by("products.id","asc");
        $this->db->where("invoice_id",$invoice_id);
        if($invoice_status == 0)
        {
            $this->db->where("product_variants.status !=","3");
        }
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
        $this->dt_model->staticWhere ="t1.status = 0 OR t1.status = 1";
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
                            $row[] = '<center><small class="label bg-gray">New</small></center>';
                        }
                        else if($aRow[$col] == "1")
                        {
                            $row[] = '<center><small class="label bg-green">Done</small></center>';
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
            $create_mo = '<a href="#" onclick="_create_mo('.$aRow['id'].',\''.$aRow['id'].'\');return false;"  class="glyphicon glyphicon-plus text-green" data-toggle="tooltip" title="Create Marketing Ordering"></a>';
            $results = $this->db->where("invoice_id",$aRow['id'])->get("marketing_order");
            if($results->result() != null)
            {
                $create_mo ="";
            }
            $btns = ''; 
            $btns = '<a href="'.base_url("portal/main/invoices/print?invoice_id=".$aRow['id']).'" target=_blank class="glyphicon glyphicon-print text-orange" data-toggle="tooltip" title="Print Invoice"></a>
            '.$create_mo.'
            <a href="'.base_url("portal/main/invoices/edit?invoice_id=".$aRow['id']).'"  class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow['id'].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
         
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output ); 
    } 

    
}
