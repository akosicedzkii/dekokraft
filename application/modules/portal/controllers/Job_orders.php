<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job_orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();
        $this->load->model("portal/job_orders_model");

        if ($this->session->userdata("USERID") == null) {
            echo "Sorry you are not logged in";
            die();
        }
    }

    public function add_job_orders()
    {
        if ($this->input->post("selected_items") == null) {
            echo "Please select an item!";
            die();
        }
        $jo_items = explode(",", $this->input->post("selected_items"));
        $jo_count = explode(",", $this->input->post("jo_count_values"));
        $counter = 1;
        foreach ($jo_items as $item) {
            $result = $this->job_orders_model->validate_jo_item($item, $this->input->post("job_type"));
            if ($result != null) {
                $results["warning"] = "Line # ". $counter ." already exist on other JO#:". $result->jo_id;
                echo json_encode($results);
                die();
            }

            $counter++;
        }
        $this->job_orders_model->mo_id = $this->input->post("marketing_order");
        $this->job_orders_model->deadline = $this->input->post("deadline");
        $this->job_orders_model->subcon_id = $this->input->post("subcon");
        $this->job_orders_model->status = 0;
        $this->job_orders_model->remarks = $this->input->post("remarks");
        $this->job_orders_model->job_type = $this->input->post("job_type");

        $this->job_orders_model->date_created = $this->input->post("date_created");
        $this->job_orders_model->created_by =  $this->session->userdata("USERID");

        echo $this->job_orders_model->insert_job_orders($jo_items,$jo_count);
    }

    public function edit_job_orders()
    {
        $job_orders_id = $this->input->post("id");
        $this->job_orders_model->id = $this->input->post("id");
        if ($this->input->post("selected_items") == null) {
            $results["warning"] ="Please select an item!";
            echo json_encode($results);
            die();
        }
        $jo_items = explode(",", $this->input->post("selected_items"));
        $jo_count = explode(",", $this->input->post("jo_count_values"));
        $counter = 1;
        foreach ($jo_items as $item) {
            $result = $this->job_orders_model->validate_jo_item($item, $this->input->post("job_type"), $job_orders_id);
            if ($result != null) {
                $results["warning"] = "Line # ". $counter ." already exist on other JO#:". $result->jo_id;
                echo json_encode($results);
                die();
            }
            $counter++;
        }
        $this->job_orders_model->mo_id = $this->input->post("marketing_order");
        $this->job_orders_model->subcon_id = $this->input->post("subcon");
        $this->job_orders_model->status = 0;
        $this->job_orders_model->remarks = $this->input->post("remarks");
        $this->job_orders_model->job_type = $this->input->post("job_type");
        $this->job_orders_model->deadline = $this->input->post("deadline");

        $this->job_orders_model->date_created = $this->input->post("date_created");
        $this->job_orders_model->date_modified = date("Y-m-d H:i:s A");
        $this->job_orders_model->modified_by =  $this->session->userdata("USERID");
        $this->job_orders_model->id = $job_orders_id;
        $this->db->where("jo_id", $job_orders_id);
        $this->db->delete("job_order_lines");
        echo $this->job_orders_model->update_job_orders($jo_items,$jo_count);
    }

    public function delete_job_orders()
    {
        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $data_job_orders = $this->db->get("job_orders");
        $this->db->where("id", $id);
        $data["status"] = 3;
        echo $result = $this->db->delete("job_orders");

        $this->db->where("jo_id", $id);
        $result = $this->db->delete("job_order_lines");
        $data = json_encode($data_job_orders->row());
        $this->logs->log = "Deleted job_orders - ID:". $data_job_orders->row()->id  ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "job_orders";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
    }
    public function complete_job_orders()
    {
        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $data_job_orders = $this->db->get("job_orders");
        $this->db->where("id", $id);
        $data["status"] = 1;
        echo $result = $this->db->update("job_orders", $data);

        //$this->db->where("jo_id", $id);
        //$result = $this->db->delete("job_order_lines");
        $data = json_encode($data_job_orders->row());
        $this->logs->log = "Completed job orders - ID:". $data_job_orders->row()->id  ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "job_orders";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
    }
    public function get_job_orders_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $result = $this->db->get("job_orders");
        $job_orders = $result->row();
        $return["job_orders"] = $job_orders;
        $return["job_orders"]->deadline = date("Y-m-d", strtotime($job_orders->deadline));
        $return["job_orders"]->date_created = date("Y-m-d", strtotime($job_orders->date_created));
        $return["subcon"] = $this->db->where("id", $job_orders->subcon_id)->get("subcon")->row();
        $return["marketing_order"] =  $this->db->where("id", $job_orders->mo_id)->get("marketing_order")->row();

        // $this->db->select("job_order_lines.id as jo_line_id,job_order_lines.jo_id,product_variants.color,invoice_lines.*,products.description,products.code,products.fob");
        //$this->db->join("job_order_lines"," job_order_lines.invoice_line_id=invoice_lines.id", 'left');
        $this->db->select("product_variants.color,invoice_lines.*,products.description,products.code,products.fob");
        $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
        $this->db->join("products", " products.id=product_variants.product_id");
        //$this->db->order_by("products.description","asc");
        $this->db->where("invoice_lines.invoice_id", $return["marketing_order"]->invoice_id);
        $return["invoice_lines"] = $this->db->get("invoice_lines")->result();
        $this->db->where("jo_id", $id);
        $this->db->where("job_type", $job_orders->job_type);
        $this->db->where("subcon_id", $job_orders->subcon_id);
        $return["jo_lines"] =  $this->db->order_by("invoice_line_id")->get("job_order_lines")->result();
        echo json_encode($return);
    }

    public function get_job_orders_selection()
    {
        $search = $this->input->get("term[term]");
        $this->db->like("name", $search);
        $this->db->where("status", 1);
        $this->db->select("name as text");
        $this->db->select("id as id");
        $this->db->limit(10);
        $filteredValues=$this->db->get("job_orders")->result_array();

        echo json_encode(array(
            'items' => $filteredValues
        ));
    }

    public function get_invoice_list()
    {
        $invoice_id = $this->input->get("invoice_id");
        $this->db->select("product_variants.color,invoice_lines.*,products.description,products.code,products.fob");
        $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
        $this->db->join("products", " products.id=product_variants.product_id");
        $this->db->where("invoice_id", $invoice_id);
        $result = $this->db->get("invoice_lines")->result();
        echo json_encode($result);
    }
    public function get_job_orders_list()
    {
        $this->load->model("portal/data_table_model", "dt_model");
        $this->dt_model->select_columns = array("t1.id","t1.id","(SELECT name from subcon WHERE ID = t1.subcon_id) as subcon_id","t1.mo_id","t1.deadline","t1.remarks","t1.job_type","IF(t1.status=1,'Completed','Pending') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");
        $this->dt_model->where  = array("t1.id","t1.id","t1.subcon_id","t1.mo_id","t1.deadline","t1.remarks","t1.job_type","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");
        $select_columns = array("id","id","subcon_id","mo_id","deadline","remarks","job_type","status","date_created","created_by","date_modified","modified_by");
        $this->dt_model->table = "job_orders AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by ";
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
                if ($col == "username" || $col == "created_by" || $col == "modified_by") {
                    $row[] = $aRow[$col];
                } elseif ($col == "status") {
                    if ($aRow[$col] == "Pending") {
                        $btns = '<a href="#" onclick="_complete('.$aRow['id'].',\''.$aRow["id"].'\');return false;" class="glyphicon glyphicon-check text-green" data-toggle="tooltip" name="Complete Purchase Order"></a>
                                     <a href="#" onclick="_edit('.$aRow['id'].',\''.$aRow["job_type"].'\');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" name="Edit"></a>';
                        $row[] = '<center><small class="label bg-gray">'.$aRow[$col].'</small></center>';
                    } elseif ($aRow[$col] == "Completed") {
                        $row[] = '<center><small class="label bg-green">'.$aRow[$col].'</small></center>';
                    }
                } elseif ($col == "date_created") {
                    if ($aRow[$col] != null) {
                        $row[] = date("Y-m-d", strtotime($aRow[$col]));
                    } else {
                        $row[] = "None";
                    }
                } elseif ($col == "deadline") {
                    if ($aRow[$col] != null) {
                        $row[] = date("Y-m-d", strtotime($aRow[$col]));
                    } else {
                        $row[] = "None";
                    }
                }  else {
                    $row[] = $aRow[$col] ;
                }
            }
            // <a href="#" onclick="_print('.$aRow['id'].',\''.$aRow["id"].'\');return false;" class="glyphicon glyphicon-print text-orange" data-toggle="tooltip" name="Print"></a>
            $btns .= '
            <a href="'.base_url("portal/main/job_orders/print?job_id=".$aRow['id']).'&with=1" target=_blank class="glyphicon glyphicon-print text-orange" data-toggle="tooltip" title="Print Job Order"></a>
            <a href="'.base_url("portal/main/job_orders/print?job_id=".$aRow['id']).'&with=0" target=_blank class="glyphicon glyphicon-print" style="color:#F95335" data-toggle="tooltip" title="Print Job Order without Client"></a>
            <a href="'.base_url("portal/main/job_orders/prints?job_id=".$aRow['id']).'" target=_blank class="glyphicon glyphicon-print" style="color:#674A40" data-toggle="tooltip" title="Print Job Order List and Sub BQ"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["id"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" name="Delete"></a>';
            array_push($row, $btns);
            $output['data'][] = $row;
        }
        echo json_encode($output);
    }
}
