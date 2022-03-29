<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proto_molds extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();
        $this->load->model("portal/proto_molds_model");

        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }


	public function edit_products()
	{
        $this->proto_molds_model->id = $this->input->post("id");
        $this->proto_molds_model->proto = $this->input->post("proto");
        $this->proto_molds_model->molds = $this->input->post("molds");
        echo $this->proto_molds_model->update_proto_molds();
	}



    public function get_old_price()
    {
        $id = $this->input->post("id");
        $this->db->where("product_id",$id);
        $data_products = $this->db->get("product_price_history");
        $result = $data_products->result();
        $data_return = "";
        if($result != null)
        {
            foreach($result as $row)
            {
                $data_return .= "<tr><td>". date("Y-m-d H:i:s A",strtotime($row->date_created)) ."</td><td>". $row->price."</td></tr>";
            }
        }
        echo $data_return;

    }
    public function get_products_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("products");
        $products = $result->row();
        if($products->cover_image != null)
        {
            if(is_numeric( $products->cover_image ))
            {
                $products->cover_image_id = $products->cover_image;
                $products->cover_image = $this->db->where("id",$products->cover_image)->get("media")->row()->file_name;
            }
        }
        $return["products"] = $products;
        echo json_encode($return);
    }
    public function get_products_selection()
    {

        $search = $this->input->get("term[term]");
        $this->db->like("title",$search);
        //$this->db->where("status",1);
        $this->db->or_like("code",$search);
        //$this->db->where("status",1);
        $this->db->or_like("class",$search);
        //$this->db->where("status",1);
        $this->db->select("title as text");
        $this->db->select("class");
        $this->db->select("code");
        $this->db->select("description");
        $this->db->select("id");
        $this->db->limit(10);
        $filteredValues=$this->db->get("products")->result_array();

        echo json_encode(array(
            'items' => $filteredValues
        ));
    }
    public function get_products_list()
    {
        $this->load->model("portal/data_table_model","dt_model");

        $this->dt_model->select_columns = array("t1.id","t1.class","t1.code","t1.description","t1.inner_carton","t1.master_carton","t1.weight_of_box","t1.minimum_of_quantity","t1.lowest_cost","t1.fob","(SELECT price from product_price_history where product_id=t1.id order by id desc limit 1,1) as old_price","t1.proto","t1.molds","t1.status","(SELECT COUNT(*) FROM STOCKS WHERE status = 0 and product_variant_id in(SELECT id from product_variants WHERE product_id = t1.id   and product_variants.status = 1)) as quantity");
        if($this->session->userdata("USERTYPE") ==1)
        {
            $this->dt_model->select_columns = array("t1.id","t1.class","t1.code","t1.description","t1.inner_carton","t1.master_carton","t1.weight_of_box","t1.minimum_of_quantity","t1.lowest_cost","t1.fob","(SELECT price from product_price_history where product_id=t1.id order by id desc limit 1,1) as old_price","t1.proto","t1.molds","t1.status","(SELECT COUNT(*) FROM STOCKS WHERE status = 0 and  product_variant_id in(SELECT id from product_variants WHERE product_id = t1.id   and product_variants.status = 1)) as quantity","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");
        }

        $this->dt_model->where  = array("t1.id","t1.class","t1.code","t1.description","t1.inner_carton","t1.master_carton","t1.weight_of_box","t1.minimum_of_quantity","t1.lowest_cost","t1.fob","t1.proto","t1.molds","t1.status");
        if($this->session->userdata("USERTYPE") ==1)
        {
            $this->dt_model->where  = array("t1.id","t1.class","t1.code","t1.description","t1.inner_carton","t1.master_carton","t1.weight_of_box","t1.minimum_of_quantity","t1.lowest_cost","t1.fob","t1.proto","t1.molds","t1.status","t1.inner_carton","t1.date_created","t2.username","t1.date_modified","t3.username");
        }

        $select_columns = array("id","class","code","description","inner_carton","master_carton","weight_of_box","minimum_of_quantity","lowest_cost","fob","old_price","quantity","proto","molds","status");
        if($this->session->userdata("USERTYPE") ==1){
            $select_columns = array("id","class","code","description","inner_carton","master_carton","weight_of_box","minimum_of_quantity","lowest_cost","fob","old_price","quantity","proto","molds","status","date_created","created_by","date_modified","modified_by");
        }
        $this->dt_model->table = "products AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by";
        $this->dt_model->index_column = "t1.id";
        if($this->session->userdata("USERTYPE") ==1){
            $this->dt_model->staticWhere = "";
        }else{
            $this->dt_model->staticWhere = "t1.status != 3";
        }
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
                    }else if($col == "weight_of_box")
                    {
                      $res_mstr=0;
                      $mstr_data=trim(strtolower($aRow['master_carton']));
                      $slice_mstr=explode('x',$mstr_data);
                      if(count($slice_mstr)>0){
                        foreach ($slice_mstr as $value) {
                          $res_mstr=($res_mstr<1)?$res_mstr+floatval(trim($value)):$res_mstr*floatval(trim($value));
                        }
                        $res_mstr=$res_mstr/61023;
                      }
                        $row[] = number_format($res_mstr,4);
                    }
                    else if($col == "fob")
                    {
                        $row[] = "$ ". $aRow[$col] ;
                    } else if($col == "old_price")
                    {
                        if($aRow[$col]==null)
                        {
                            $aRow[$col] = $aRow["fob"]; 
                        }
                        $row[] = "$ ". $aRow[$col] ;
                    }else if($col == "quantity")
                    {
                        if($aRow[$col] == null){
                            $row[] = 0;
                        }else{
                            $row[] = $aRow[$col] ;
                        }

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
                        }else if($aRow[$col] == "4"){
                            $row[] = '<center><small class="label bg-orange">Pending</small></center>';
                        }else if($aRow[$col] == "3"){
                            $row[] = '<center><small class="label bg-red">Deleted</small></center>';
                        }
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {
                            $row[] = "<center><a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/products/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a></center>";
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

            $btns = '<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }



}
