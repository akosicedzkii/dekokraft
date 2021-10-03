<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends CI_Controller {
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

    public function reflenish()
    {
        $product_variant_id = $this->input->post("product_variant_id");
        $count = $this->input->post("count");
        $this->load->model("stocks_model");
        $this->stocks_model->add_stock($count,$product_variant_id);
        $this->logs->log = "Created New Stock - ID:". $product_variant_id. " Count: ".$count ;
        $this->logs->details = "Created New Stock - ID:". $product_variant_id. " Count: ".$count ;
        $this->logs->module = "stocks";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        echo true;
    }

    public function reduce()
    {
        $product_variant_id = $this->input->post("product_variant_id");
        $count = $this->input->post("count");
        $this->load->model("stocks_model");
        $this->stocks_model->reduce_stock($count,$product_variant_id);
        $this->logs->log = "Reduced Stock - ID:". $product_variant_id. " Count: ".$count ;
        $this->logs->details = "Reduced Stock - ID:". $product_variant_id. " Count: ".$count ;
        $this->logs->module = "stocks";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        echo true;
    }

}
