<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_orders extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();
        $this->load->model("portal/purchase_orders_model");

        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_purchase_orders()
	{
        if($this->input->post("selected_items") == null)
        {
            echo "Please select an item!";
            die();
        }
        $po_items = explode(",",$this->input->post("selected_items"));
        $po_count = explode(",", $this->input->post("po_count_values"));
        $counter = 1;
        foreach($po_items as $item)
        {
            $result = $this->purchase_orders_model->validate_po_item($item,$this->input->post("job_type"));
            if($result != null)
            {
                $results["warning"] = "Line # ". $counter ." already exist on other JO#:". $result->po_id;
                echo json_encode($results);
                die();
            }

            $counter++;
        }
        $this->purchase_orders_model->mo_id = $this->input->post("marketing_order");
        $this->purchase_orders_model->subcon_id = $this->input->post("subcon");
        $this->purchase_orders_model->deadline = $this->input->post("deadline");
        $this->purchase_orders_model->status = 0;
        $this->purchase_orders_model->remarks = $this->input->post("remarks");
        $this->purchase_orders_model->job_type = $this->input->post("job_type");

        $this->purchase_orders_model->date_created = $this->input->post("date_created");
        $this->purchase_orders_model->created_by =  $this->session->userdata("USERID");

        echo $this->purchase_orders_model->insert_purchase_orders($po_items,$po_count);
	}

	public function edit_purchase_orders()
	{
        $purchase_orders_id = $this->input->post("id");
        $this->purchase_orders_model->id = $this->input->post("id");
        if($this->input->post("selected_items") == null)
        {
            echo "Please select an item!";
            die();
        }
        $po_items = explode(",",$this->input->post("selected_items"));
        $po_count = explode(",", $this->input->post("po_count_values"));
        $counter = 1;
        foreach($po_items as $item)
        {
            $result = $this->purchase_orders_model->validate_po_item($item,$this->input->post("job_type"),$purchase_orders_id);
            if($result != null)
            {
                $results["warning"] = "Line # ". $counter ." already exist on other PO#:". $result->po_id;
                echo json_encode($results);
                die();
            }
            $counter++;
        }
        $this->purchase_orders_model->mo_id = $this->input->post("marketing_order");
        $this->purchase_orders_model->subcon_id = $this->input->post("subcon");
        $this->purchase_orders_model->status = 0;
        $this->purchase_orders_model->deadline = $this->input->post("deadline");
        $this->purchase_orders_model->remarks = $this->input->post("remarks");
        $this->purchase_orders_model->job_type = $this->input->post("job_type");

        $this->purchase_orders_model->date_created = $this->input->post("date_created");
        $this->purchase_orders_model->date_modified = date("Y-m-d H:i:s A");
        $this->purchase_orders_model->modified_by =  $this->session->userdata("USERID");
        $this->purchase_orders_model->id = $purchase_orders_id;
        $this->db->where("po_id", $purchase_orders_id);
        $this->db->delete("purchase_order_lines");
        echo $this->purchase_orders_model->update_purchase_orders($po_items,$po_count);
	}

	public function delete_purchase_orders()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_purchase_orders = $this->db->get("purchase_orders");
        $this->db->where("id",$id);
        $data["status"] = 3;
        echo $result = $this->db->delete("purchase_orders");

        $this->db->where("po_id",$id);
        $result = $this->db->delete("purchase_order_lines");
        $data = json_encode($data_purchase_orders->row());
        $this->logs->log = "Deleted purchase_orders - ID:". $data_purchase_orders->row()->id  ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "purchase_orders";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();

	}


	public function complete_purchase_orders()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_purchase_orders = $this->db->get("purchase_orders");
        $this->db->where("id",$id);
        $data["status"] = 1;
        echo $result = $this->db->update("purchase_orders",$data);

        //$this->db->where("po_id",$id);
        //$result = $this->db->delete("purchase_order_lines");
        $data = json_encode($data_purchase_orders->row());
        $this->logs->log = "Completed purchase_orders - ID:". $data_purchase_orders->row()->id  ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "purchase_orders";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();

    }

    public function get_purchase_orders_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("purchase_orders");
        $purchase_orders = $result->row();
        $return["purchase_orders"] = $purchase_orders;
        $return["purchase_orders"]->deadline = date("Y-m-d", strtotime($purchase_orders->deadline));
        $return["purchase_orders"]->date_created = date("Y-m-d", strtotime($purchase_orders->date_created));
        $return["subcon"] = $this->db->where("id", $purchase_orders->subcon_id)->get("subcon")->row();
        $return["marketing_order"] =  $this->db->where("id", $purchase_orders->mo_id)->get("marketing_order")->row();

        // $this->db->select("job_order_lines.id as jo_line_id,job_order_lines.jo_id,product_variants.color,invoice_lines.*,products.description,products.code,products.fob");
        //$this->db->join("job_order_lines"," job_order_lines.invoice_line_id=invoice_lines.id", 'left');
        $this->db->select("product_variants.color,invoice_lines.*,products.description,products.code,products.fob");
        $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
        $this->db->join("products", " products.id=product_variants.product_id");
        //$this->db->order_by("products.description","asc");
        $this->db->where("invoice_lines.invoice_id", $return["marketing_order"]->invoice_id);
        $return["invoice_lines"] = $this->db->get("invoice_lines")->result();
        $this->db->where("po_id", $id);
        $this->db->where("job_type", $purchase_orders->job_type);
        $this->db->where("subcon_id", $purchase_orders->subcon_id);
        $return["po_lines"] =  $this->db->order_by("invoice_line_id")->get("purchase_order_lines")->result();
        echo json_encode($return);
    }

    public function get_purchase_orders_selection()
    {

        $search = $this->input->get("term[term]");
        $this->db->like("name",$search);
        $this->db->where("status",1);
        $this->db->select("name as text");
        $this->db->select("id as id");
        $this->db->limit(10);
        $filteredValues=$this->db->get("purchase_orders")->result_array();

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
    public function get_purchase_orders_list()
    {
        $this->load->model("portal/data_table_model","dt_model");
        $this->dt_model->select_columns = array("t1.id","t1.id","(SELECT name from subcon WHERE ID = t1.subcon_id) as subcon_id","t1.mo_id","t1.deadline","t1.remarks","t1.job_type","IF(t1.status=1,'Complete','Pending') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");
        $this->dt_model->where  = array("t1.id","t1.id","t1.subcon_id","t1.mo_id","t1.deadline","t1.remarks","t1.job_type","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");
        $select_columns = array("id","id","subcon_id","mo_id","deadline","remarks","job_type","status","date_created","created_by","date_modified","modified_by");
        $this->dt_model->table = "purchase_orders AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by ";
        $this->dt_model->index_column = "t1.id";
        $this->dt_model->staticWhere = "t1.status != 3";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];

        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            $btns="";
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }else if($col == "date_created" || $col =="deadline")
                    {
                        $row[] = date("Y-m-d",strtotime($aRow[$col]));
                    }
                    else if($col == "status")
                    {
                        if($aRow[$col] == "Pending")
                        {
                            $row[] = '<center><small class="label bg-gray">'.$aRow[$col].'</small></center>';
                            $btns = '<a href="#" onclick="_complete('.$aRow['id'].',\''.$aRow["id"].'\');return false;" class="glyphicon glyphicon-check text-green" data-toggle="tooltip" name="Complete Purchase Order"></a>
                            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" name="Edit"></a>';
                        }
                        else if($aRow[$col] == "Complete")
                        {
                            $row[] = '<center><small class="label bg-green">'.$aRow[$col].'</small></center>';
                        }
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/purchase_orders/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a>";
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

            $btns .= ' <a href="'.base_url("portal/main/purchase_orders/print?po_id=".$aRow['id']).'" target=_blank class="glyphicon glyphicon-print text-orange" data-toggle="tooltip" name="Purchase Order Print"></a>';
            $btns .= ' <a href="'.base_url("portal/main/purchase_orders/prints?po_id=".$aRow['id']).'" target=_blank class="glyphicon glyphicon-print" style="color:#674A40" data-toggle="tooltip" name="Purchase Order Sub BQ Print"></a>';
            $btns .= ' <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["id"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" name="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
