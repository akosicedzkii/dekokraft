<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_order extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();
        $this->load->model("portal/marketing_order_model");

        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_marketing_order()
	{
        $this->marketing_order_model->name = $this->input->post("name");
        $this->marketing_order_model->code = $this->input->post("code");
        $this->marketing_order_model->status = $this->input->post("status");
        $this->marketing_order_model->address = $this->input->post("address");
        $this->marketing_order_model->marketing_order_details = $this->input->post("marketing_order_details");

        $this->marketing_order_model->date_created = date("Y-m-d H:i:s A");
        $this->marketing_order_model->created_by =  $this->session->userdata("USERID");
        echo $this->marketing_order_model->insert_marketing_order();
	}

	public function edit_marketing_order()
	{
        $marketing_order_id = $this->input->post("id");
        $this->marketing_order_model->name = $this->input->post("name");
        $this->marketing_order_model->code = $this->input->post("code");
        $this->marketing_order_model->address = $this->input->post("address");
        $this->marketing_order_model->marketing_order_details = $this->input->post("marketing_order_details");
        $this->marketing_order_model->status = $this->input->post("status");
        $this->marketing_order_model->date_modified = date("Y-m-d H:i:s A");
        $this->marketing_order_model->modified_by =  $this->session->userdata("USERID");
        $this->marketing_order_model->id = $marketing_order_id;
        echo $this->marketing_order_model->update_marketing_order();
	}

	public function delete_marketing_order()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_marketing_order = $this->db->get("marketing_order");
        $this->db->where("id",$id);
        $data["status"] = 3;
        echo $result = $this->db->update("marketing_order",$data);
        $data = json_encode($data_marketing_order->row());
        $this->logs->log = "Deleted marketing_order - ID:". $data_marketing_order->row()->id .", marketing_order Title: ".$data_marketing_order->row()->name ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "marketing_order";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();

	}

    public function get_marketing_order_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("marketing_order");
        $marketing_order = $result->row();
        $return["marketing_order"] = $marketing_order;
        echo json_encode($return);
    }

    public function get_marketing_order_selection()
    {

        $search = $this->input->get("term[term]");
        $this->db->like("id",$search);
        $this->db->where("status",0);
        $this->db->select("id as text");
        $this->db->select("id as id");
        $this->db->select("invoice_id");
        $this->db->limit(10);
        $filteredValues=$this->db->get("marketing_order")->result_array();

        echo json_encode(array(
            'items' => $filteredValues
        ));
    }

    public function get_invoice_list()
    {
        $invoice_id = $this->input->get("invoice_id");
        $this->db->select("product_variants.color,invoice_lines.*,products.description,products.code,products.fob");
        $this->db->join("product_variants"," product_variants.id=invoice_lines.product_id");
        $this->db->join("products"," products.id=product_variants.product_id");
        $this->db->where("invoice_id",$invoice_id);
        $result = $this->db->get("invoice_lines")->result();
        echo json_encode($result);
    }

    public function get_marketing_order_list()
    {
        $this->load->model("portal/data_table_model","dt_model");
        $this->dt_model->select_columns = array("t1.id","t1.id","t1.invoice_id","t5.customer_name","IF(t1.status=1,'Done','New') as status","t1.date_created","t2.username as created_by","t4.date_modified","t3.username as modified_by");
        $this->dt_model->where  = array("t1.id","t1.id","t1.invoice_id","t5.customer_name","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");
        $select_columns = array("id","id","invoice_id","customer_name","status","date_created","created_by","date_modified","modified_by");
        $this->dt_model->table = "marketing_order AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN invoices AS t4 ON t4.id = t1.invoice_id LEFT JOIN customers AS t5 ON t5.id = t4.customer_id LEFT JOIN user_accounts AS t3 ON t3.id = t4.modified_by ";
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
                        if($aRow[$col] == "New")
                        {
                            $row[] = '<center><small class="label bg-gray">'.$aRow[$col].'</small></center>';
                        }
                        else if($aRow[$col] == "Done")
                        {
                            $row[] = '<center><small class="label bg-green">'.$aRow[$col].'</small></center>';
                        }
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/marketing_order/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a>";
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

            $this->db->select("count(mo_id) as counts");
            $this->db->where("mo_id",$aRow['id']);
            $jo_num = $this->db->get("job_orders")->row();
            $with='';
            if($jo_num->counts>0){
              $with = '<a href="'.base_url("portal/main/marketing_order/print?invoice_id=".$aRow['invoice_id']).'&with=1" target=_blank class="glyphicon glyphicon-print text-orange" data-toggle="tooltip" title="Print Marketing Order with Details"></a> ';
            }
            $btns = '<a href="'.base_url("portal/main/marketing_order/print?invoice_id=".$aRow['invoice_id']).'&with=0" target=_blank class="glyphicon glyphicon-print text-blue" data-toggle="tooltip" title="Print Marketing Order w/o Details"></a> '.$with;
            $btns .= '<a href="'.base_url("portal/main/marketing_order/print?invoice_id=".$aRow['invoice_id']).'&with=1&wo=1" target=_blank class="glyphicon glyphicon-print" style="color:#F95335" data-toggle="tooltip" title="MO Print without price"></a> ';
            $btns .= '<a href="'.base_url("portal/main/marketing_order/prints?invoice_id=".$aRow['invoice_id']).'" target=_blank class="glyphicon glyphicon-print" style="color:#674A40" data-toggle="tooltip" title="MASTER BILL OF QUANTITY"></a>';
            // <!--<a href="'.base_url("portal/main/marketing_order/edit?invoice_id=".$aRow['id']).'"  class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>-->
            // <!--<a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["customer_name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" name="Delete"></a>-->
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
