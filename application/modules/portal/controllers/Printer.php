<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Printer extends CI_Controller
{
    private $user_access;
    private $default_page;
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->default_page == "dashboard") {
            redirect(base_url()."portal/main/".$this->default_page);
        } else {
            redirect(base_url()."portal/main/page/".$this->default_page);
        }
    }


    public function dashboard()
    {
        if (!in_array($this->router->fetch_method(), $this->user_access)) {
            redirect(base_url()."portal/main/".$this->default_page);
        }
        $module["module_name"] = $this->router->fetch_method();
        $module["menu"] = $this->user_access;
        $this->db->distinct();
        $this->db->select("ip_address");
        $module["unique_visitors"] = $this->db->get("visit_counts")->num_rows();
        $query = "SELECT t2.code,t2.description,CONCAT(t1.color,' (',t1.color_abb,')') as color,t1.cover_image FROM product_variants as t1 LEFT JOIN products as t2 ON t2.id = t1.product_id ORDER BY t1.date_created DESC LIMIT 4";
        $module["product_variants"] = $this->db->query($query)->result();
        $module["product_category"] = $this->db->get("products")->result();

        $this->db->order_by("user_accounts.id", "desc");
        $this->db->select('*');
        $this->db->from('user_accounts');
        $this->db->join('user_profiles', 'user_profiles.user_id = user_accounts.id');
        $module["users"]= $this->db->get()->result();

        $module["month_products"] = $this->db->where("month(date_created)", date("m"))->where("year(date_created)", date("Y"))->get("product_variants")->num_rows();



        $module["today_visitors"] = $this->db->where("day(date_created)", date("d"))->where("month(date_created)", date("m"))->where("year(date_created)", date("Y"))->get("visit_counts")->num_rows();

        $module["all_products"] = $this->db->get("product_variants")->num_rows();
        $module["total_invoice"] = $this->db->get("invoices")->num_rows();
        $module["total_invoice_this_month"] = $this->db->where("month(date_created)", date("m"))->where("year(date_created)", date("Y"))->get("invoices")->num_rows();
        $module["pending_invoice"] = $this->db->where("status", 0)->get("invoices")->num_rows();
        $module["pending_products"] = $this->db->where("status", 4)->get("products")->num_rows();
        $module["total_customers"] = $this->db->get("customers")->num_rows();
        $module["stock_counts"] = $this->db->where("status!=","1")->get("stocks")->num_rows();

        $this->load->view('main/template/header', $module);
        $this->load->view('main/main_view', $module);
        $this->load->view('main/template/footer');
    }


    public function page()
    {
        $_view = $this->uri->segment(4, 0);
        if (!in_array($_view, $this->user_access)) {
            redirect(base_url()."portal/main/".$this->default_page);
        }
        $module["module_name"] = $_view;
        $module["menu"] = $this->user_access;
        $module["site_settings"] = $this->db->get("site_settings")->row();
        $module["roles"] = $this->db->get("roles")->result();
        $this->load->view('main/template/header', $module);
        $this->load->view("main/$_view"."_view", $module);
        $this->load->view('main/template/footer');
    }



    public function invoices()
    {
        $page = $this->uri->segment(4, 0);

        if (!in_array($this->router->fetch_method(), $this->user_access)) {
            redirect(base_url()."portal/main/".$this->default_page);
        }
        if ($page == "new") {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/invoices_create_view', $module);
            $this->load->view('main/template/footer');
        } elseif ($page == "print") {
            $invoice_id = $this->input->get("invoice_id");
            $module["invoice"] = $this->db->where("id", $invoice_id)->get("invoices")->row();
            $module["mo"] = $this->db->where("invoice_id", $invoice_id)->get("marketing_order")->row();
            $module["customer_address"] = $this->db->where("id", $module["invoice"]->customer_id)->get("customers")->row();
            $module["bank"] = $this->db->where("id", $module["invoice"]->bank)->get("banks")->row();
            $module["payment_terms"] = $this->db->where("id", $module["invoice"]->payment_terms)->get("payment_terms")->row();
            $module["user"] = $this->db->select('username')->where("id", $module["invoice"]->created_by)->get("user_accounts")->row();
            if ($module["invoice"] == null) {
                echo "invoice not found";
            }
            $this->db->select("product_variants.color,product_variants.color_abb,invoice_lines.*,products.description,products.weight_of_box,products.inner_carton,products.master_carton,products.in_,products.mstr,products.class,products.code,products.fob");
            $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
            $this->db->join("products", " products.id=product_variants.product_id");
            $this->db->where("invoice_id", $invoice_id);
            //$this->db->order_by("products.description", "asc");
            $module["invoice_lines"]= $this->db->get("invoice_lines")->result();
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/invoice_print_view', $module);
        } elseif ($page == "view") {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/invoice_solo_view', $module);
            $this->load->view('main/template/footer');
        } elseif ($page == "edit") {
            $invoice_id = $this->input->get("invoice_id");
            $module["invoice"] = $this->db->where("id", $invoice_id)->get("invoices")->row();
            $module["mo"] = $this->db->where("invoice_id", $invoice_id)->get("marketing_order")->row();
            $module["customer_address"] = $this->db->where("id", $module["invoice"]->customer_id)->get("customers")->row();
            $module["bank"] = $this->db->where("id", $module["invoice"]->bank)->get("banks")->row();
            $module["payment_terms"] = $this->db->where("id", $module["invoice"]->payment_terms)->get("payment_terms")->row();
            if ($module["invoice"] == null) {
                echo "invoice not found";
            }
            $module["invoice_lines"] = $this->db->where("invoice_id", $invoice_id)->get("invoice_lines");
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/invoices_update_view', $module);
            $this->load->view('main/template/footer');
        } elseif ($page == "list") {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/invoices_view', $module);
            $this->load->view('main/template/footer');
        }
    }

    public function marketing_order()
    {
        $page = $this->uri->segment(4, 0);

        if (!in_array($this->router->fetch_method(), $this->user_access)) {
            redirect(base_url()."portal/main/".$this->default_page);
        }
        if ($page == "new") {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/invoices_create_view', $module);
            $this->load->view('main/template/footer');
        } elseif ($page == "print") {
            $invoice_id = $this->input->get("invoice_id");
            $with = $this->input->get("with");
            $wo = $this->input->get("wo");
            if(isset($wo)){
              $module["noPrice"] = 'true';
            }
            if($invoice_id==''){
              echo "invoice not found";
            }else{
              $module["invoice"] = $this->db->where("id", $invoice_id)->get("invoices")->row();
              $module["mo"] = $this->db->where("invoice_id", $invoice_id)->get("marketing_order")->row();
              $module["customer_address"] = $this->db->where("id", $module["invoice"]->customer_id)->get("customers")->row();
              $module["bank"] = $this->db->where("id", $module["invoice"]->bank)->get("banks")->row();
              $module["payment_terms"] = $this->db->where("id", $module["invoice"]->payment_terms)->get("payment_terms")->row();
              // if ($module["invoice"] == null) {
              //     echo "invoice not found";
              // }
              $this->db->select("products.weight_of_box,products.inner_carton,products.master_carton,products.class,product_variants.color_abb,product_variants.color,invoice_lines.*,products.description,products.code,products.fob,products.in_,products.mstr");
              $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
              $this->db->join("products", " products.id=product_variants.product_id");
              $this->db->where("invoice_id", $invoice_id);
              // $this->db->order_by("products.description", "asc");
              $module["invoice_lines"]= $this->db->get("invoice_lines")->result();
              $module["module_name"] = $this->router->fetch_method();
              $module["menu"] = $this->user_access;

              if($with=='1'){
                $this->db->select("job_type,deadline,id");
                $this->db->where("mo_id", $module["mo"]->id);
                $module["jopo"]= $this->db->get("job_orders")->result();
                $module["with"]='1';
              }else{
                $module["with"]='0';
              }

              $this->load->view('main/marketing_order_print_view', $module);
            }

        } elseif ($page == "prints") {
          $invoice_id = $this->input->get("invoice_id");
          $module["mo"] = $this->db->where("invoice_id", $invoice_id)->get("marketing_order")->row();
          $module["invoice"] = $this->db->where("id", $invoice_id)->get("invoices")->row();
          $module["customer_address"] = $this->db->where("id", $module["invoice"]->customer_id)->get("customers")->row();
          $this->db->select("products.weight_of_box,products.inner_carton,products.master_carton,products.class,product_variants.color_abb,product_variants.color,invoice_lines.*,products.description,products.code,products.fob,products.in_,products.mstr,product_profiles.in_poly_size,product_profiles.in_poly_cont,product_profiles.mstr_poly_size,product_profiles.mstr_poly_cont");
          $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
          $this->db->join("products", " products.id=product_variants.product_id");
          $this->db->join("product_profiles", " product_profiles.product_variant_id=product_variants.id");
          $this->db->where("invoice_lines.invoice_id", $invoice_id);
          $this->db->order_by("products.description", "asc");
          $module["invoice_lines"]= $this->db->get("invoice_lines")->result();
          $arr=array();
          $color_arr=array();
          foreach ($module["invoice_lines"] as $mat) {
              $this->db->select("materials.material_name,materials.unit,materials.cost,materials.jp,materials.type as tipe,ppm.qty,product_profiles.product_variant_id,ppm.product_profile_id,invoice_lines.id as invoice_id");
              $this->db->join("materials", "ppm.material_id=materials.id");
              $this->db->join("product_profiles", " product_profiles.id=ppm.product_profile_id");
              $this->db->join("invoice_lines", " product_profiles.product_variant_id=invoice_lines.product_id");
              // $this->db->where("product_profiles.product_variant_id", $mat->product_id);
              $this->db->where("invoice_lines.id", $mat->id);
              $material_list =  $this->db->order_by("materials.material_name", "asc")->get("product_profile_materials as ppm")->result_array();
              array_push($arr, $material_list);
              $this->db->select("materials.material_name,materials.unit,materials.cost,materials.jp,materials.type as tipe,product_profiles.product_variant_id,color_materials.qty,invoice_lines.quantity,ppm.qty as ppm_count");
              $this->db->join("color_materials", "ppm.material_id=color_materials.color_id");
              $this->db->join("materials", "color_materials.material_id=materials.id");
              $this->db->join("product_profiles", " product_profiles.id=ppm.product_profile_id");
              $this->db->join("invoice_lines", " product_profiles.product_variant_id=invoice_lines.product_id");
              //$this->db->where("product_profiles.product_variant_id", $mat->product_id);
              $this->db->where("invoice_lines.id", $mat->id);
              $colorMaterial_list =  $this->db->order_by("materials.material_name", "asc")->get("product_profile_materials as ppm")->result_array();
              array_push($color_arr, $colorMaterial_list);
          }
          $module["materials"]=$arr;
          $module["colorMaterials"]=$color_arr;
          $this->load->view('main/marketingOrder_mbq_printView', $module);
        } elseif ($page == "view") {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/invoice_solo_view', $module);
            $this->load->view('main/template/footer');
        } elseif ($page == "edit") {
            $invoice_id = $this->input->get("invoice_id");
            $module["invoice"] = $this->db->where("id", $invoice_id)->get("invoices")->row();
            $module["mo"] = $this->db->where("invoice_id", $invoice_id)->get("marketing_order")->row();
            $module["customer_address"] = $this->db->where("id", $module["invoice"]->customer_id)->get("customers")->row();
            $module["bank"] = $this->db->where("id", $module["invoice"]->bank)->get("banks")->row();
            $module["payment_terms"] = $this->db->where("id", $module["invoice"]->payment_terms)->get("payment_terms")->row();
            if ($module["invoice"] == null) {
                echo "invoice not found";
            }
            $module["invoice_lines"] = $this->db->where("invoice_id", $invoice_id)->get("invoice_lines");
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/marketing_order_create_view', $module);
            $this->load->view('main/template/footer');
        } elseif ($page == "list") {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/invoices_view', $module);
            $this->load->view('main/template/footer');
        }
    }
    public function product_profiles()
    {
        $page = $this->uri->segment(4, 0);

        if (!in_array($this->router->fetch_method(), $this->user_access)) {
            redirect(base_url()."portal/main/".$this->default_page);
        }
        if ($page == "new") {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;

            $product_variant_id = $this->input->get("product_variant_id");
            $this->db->select("product_variants.*,products.class,products.code,products.description,products.in_,products.mstr,products.inner_carton,products.master_carton");
            $this->db->join("products", "products.id=product_variants.product_id");
            $this->db->where("product_variants.id", $product_variant_id);
            $module["product_variants"] = $this->db->get("product_variants")->row();
            $product_profile_id = $this->db->where("product_variant_id", $product_variant_id)->get("product_profiles")->row();
            $module["material_groups"] = null;
            $ret = array();
            $module["net_weight"] = "";
            $module["resin_unit_price"] = "";
            $module["finishing_unit_price"] = "";
            $module["spray_unit_price"] = "";
            $module["hand_paint_unit_price"] = "";
            $total_r=0;
            $total_m=0;
            $total_f=0;
            $total_ap=0;
            if (!$product_profile_id == null) {
                $this->db->where("product_profile_id", $product_profile_id->id);
                $result =  $this->db->get("product_material_group")->result_array();
                $module["net_weight"] = $product_profile_id->net_weight;
                $module["resin_unit_price"] = $product_profile_id->resin_unit_price;
                $module["finishing_unit_price"] = $product_profile_id->finishing_unit_price;
                $module["spray_unit_price"] = $product_profile_id->spray_unit_price;
                $module["hand_paint_unit_price"] = $product_profile_id->hand_paint_unit_price;

                $module["prod_profile_details"] = $product_profile_id;
                if ($result != null) {
                    foreach ($result as $res) {
                        $this->db->join("materials", "materials.id=product_profile_materials.material_id");
                        $material_list =$this->db->order_by("FIELD(materials.jp, 'M', 'R', 'FA', 'FB', 'FC')")->where("product_material_group_id", $res["id"])->get("product_profile_materials")->result_array();
                        array_push($res, $material_list);
                        array_push($ret, $res);
                    }
                }

                foreach ($ret as $material_items) {
                  if($material_items[0] != null)
                  {
                    switch ($material_items[0][0]['jp']) {
                            case 'R':
                              $total_r=$total_r+floatval($material_items[0][0]['qty'])*floatval($material_items[0][0]['cost']);
                              break;

                            case 'M':
                              $total_m=$total_m+floatval($material_items[0][0]['qty'])*floatval($material_items[0][0]['cost']);
                              break;

                            case ('F' || 'FA' || 'FB' || 'FC'):
                              $total_f=$total_f+floatval($material_items[0][0]['qty'])*floatval($material_items[0][0]['cost']);
                              break;

                            case 'AP':
                              $total_ap=$total_ap+floatval($material_items[0][0]['qty'])*floatval($material_items[0][0]['cost']);
                              break;

                            default:
                              // code...
                              break;
                          }
                  }
                }
            }
            $module["total_material"] = array('total_r'=>$total_r,'total_m'=>$total_m,'total_f'=>$total_f,'total_ap'=>$total_ap);
            $module["material_groups"] = $ret;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/product_profiles_add_view', $module);
            $this->load->view('main/template/footer');
        } elseif ($page == "print") {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;

            $product_variant_id = $this->input->get("product_variant_id");
            $this->db->select("product_variants.*,products.class,products.code,products.description,products.inner_carton,products.master_carton,products.in_,products.mstr");
            $this->db->join("products", "products.id=product_variants.product_id");
            $this->db->where("product_variants.id", $product_variant_id);
            $module["product_variants"] = $this->db->get("product_variants")->row();
            $product_profile_id = $this->db->where("product_variant_id", $product_variant_id)->get("product_profiles")->row();
            $module["material_groups"] = null;
            $ret = array();
            $module["net_weight"] = "";
            if (!$product_profile_id == null) {
                //$this->db->where("product_profile_id", $product_profile_id->id);
                //$result =  $this->db->get("product_material_group")->result_array();
                $module["net_weight"] = $product_profile_id->net_weight;
                $module["prod_profile"] = $product_profile_id;
                //if ($result != null) {
                //foreach ($result as $res) {
                $this->db->join("materials", "materials.id=product_profile_materials.material_id");
                //$material_list =$this->db->order_by("product_profile_materials.id", "desc")->where("product_material_group_id", $res["id"])->get("product_profile_materials")->result_array();
                $material_list =$this->db->order_by("FIELD(materials.jp, 'M', 'R', 'FA', 'FB', 'FC')")->where("product_profile_materials.product_profile_id", $product_profile_id->id)->get("product_profile_materials")->result_array();
                //array_push($res, $material_list);
                //array_push($ret, $res);
                //}
                //}
            }
            $module["material_groups"] = $material_list;
            //$module["material_groups"] = $ret;
            $this->load->view('main/product_profile_print_view', $module);
        } elseif ($page == "list") {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/product_profiles_view', $module);
            $this->load->view('main/template/footer');
        }
    }

    public function job_orders($page="",$id="")
    {
        if ($page == "print") {
            //$id = $this->input->get("job_id");
            $with = $this->input->get("with");
            $module["wClient"] = ($with==1)?'yes':'no';

            $this->db->select('jo.*,sub.name,sub.subcon_details,sub.address,sub.code,pt.code as payment_code,mo.invoice_id,c.customer_name,c.company_name');
            $this->db->join('subcon as sub', 'jo.subcon_id=sub.id');
            $this->db->join('marketing_order as mo', 'jo.mo_id=mo.id');
            $this->db->join('invoices as inv', 'mo.invoice_id=inv.id', 'left');
            $this->db->join('customers as c', 'inv.customer_id=c.id', 'left');
            $this->db->join('payment_terms as pt', 'inv.payment_terms=pt.id', 'left');
            $this->db->where('jo.id', $id);
            $module["job_orders"]=$this->db->get("job_orders as jo")->row();

            $this->db->select("product_variants.color,product_variants.color_abb,invoice_lines.*,products.description,products.weight_of_box,products.inner_carton,products.master_carton,products.class,products.code,products.fob,product_profiles.net_weight,product_profiles.resin_unit_price,product_profiles.finishing_unit_price,job_order_lines.job_type as jo_type,job_order_lines.jo_count");
            $this->db->join("product_variants", "product_variants.id=invoice_lines.product_id","left");
            $this->db->join("products", "products.id=product_variants.product_id","left");
            $this->db->join("job_order_lines", "job_order_lines.invoice_line_id=invoice_lines.id","left");
            $this->db->join("product_profiles", "product_variants.id=product_profiles.product_variant_id","left");
            // $this->db->where("invoice_id", $module["job_orders"]->invoice_id);
            $this->db->where("job_order_lines.jo_id", $module["job_orders"]->id);
            $this->db->order_by("invoice_lines.id", "asc");
            $module["invoice_lines"]= $this->db->get("invoice_lines")->result();
            $arr=array();
            foreach ($module["invoice_lines"] as $mat) {
                $this->db->select("materials.material_name,materials.unit,materials.jp,ppm.qty,ppm.product_variant_id");
                $this->db->join("materials", "ppm.material_id=materials.id");
                $this->db->where("ppm.product_variant_id", $mat->product_id);
                $material_list =  $this->db->order_by("materials.jp", "asc")->get("product_profile_materials as ppm")->result_array();
                array_push($arr, $material_list);
            }
            $module["materials"]=$arr;
            $this->load->view('main/job_orders_print_view', $module);
        } elseif ($page == "prints") {
            //$id = $this->input->get("job_id");

            $this->db->select('jo.id,jo.job_type,jo.mo_id,sub.name,sub.subcon_details,sub.address,sub.code,pt.code as payment_code,mo.invoice_id,c.customer_name');
            $this->db->join('subcon as sub', 'jo.subcon_id=sub.id');
            $this->db->join('marketing_order as mo', 'jo.mo_id=mo.id');
            $this->db->join('invoices as inv', 'mo.invoice_id=inv.id', 'left');
            $this->db->join('customers as c', 'inv.customer_id=c.id', 'left');
            $this->db->join('payment_terms as pt', 'inv.payment_terms=pt.id', 'left');
            $this->db->where('jo.id', $id);
            $module["job_orders"]=$this->db->get("job_orders as jo")->row(); 

            $this->db->select("product_variants.color,product_variants.color_abb,invoice_lines.id,products.description,products.weight_of_box,products.inner_carton,products.master_carton,products.class,products.code,products.fob,product_profiles.net_weight,job_order_lines.job_type as jo_type,job_order_lines.jo_count");
            $this->db->join("product_variants", "product_variants.id=invoice_lines.product_id", "left");
            $this->db->join("products", "products.id=product_variants.product_id", "left");
            $this->db->join("job_order_lines", "job_order_lines.invoice_line_id=invoice_lines.id", "left");
            $this->db->join("product_profiles", "product_variants.id=product_profiles.product_variant_id", "left");
            // $this->db->where("invoice_id", $module["job_orders"]->invoice_id);
            $this->db->where("job_order_lines.jo_id", $module["job_orders"]->id);
            // $this->db->order_by("products.description", "asc");
            $this->db->order_by("invoice_lines.id", "asc");
            $module["invoice_lines"]= $this->db->get("invoice_lines")->result();
            // $arr=array();
            // foreach ($module["invoice_lines"] as $mat) {
            //     $this->db->select("materials.material_name,materials.unit,materials.jp,ppm.qty,ppm.product_variant_id");
            //     $this->db->join("materials", "ppm.material_id=materials.id");
            //     $this->db->where("ppm.product_variant_id", $mat->product_id);
            //     $material_list =  $this->db->order_by("materials.jp", "asc")->get("product_profile_materials as ppm")->result_array();
            //     array_push($arr, $material_list);
            // }
            // $module["materials"]=$arr;
            $arr=array();
            $color_arr=array();
            foreach ($module["invoice_lines"] as $mat) {
                $this->db->select("materials.material_name,materials.unit,materials.cost,materials.jp,materials.type as tipe,ppm.qty,product_profiles.product_variant_id,ppm.product_profile_id,invoice_lines.id as invoice_id,jol.jo_count");
                $this->db->join("materials", "ppm.material_id=materials.id");
                $this->db->join("product_profiles", " product_profiles.id=ppm.product_profile_id");
                $this->db->join("invoice_lines", " product_profiles.product_variant_id=invoice_lines.product_id");
                $this->db->join("job_order_lines as jol", "invoice_lines.id=jol.invoice_line_id", "left");
                // $this->db->where("product_profiles.product_variant_id", $mat->product_id);
                $this->db->where("invoice_lines.id", $mat->id);
                $material_list =  $this->db->order_by("materials.material_name", "asc")->get("product_profile_materials as ppm")->result_array();
                array_push($arr, $material_list);
                $this->db->select("materials.material_name,materials.unit,materials.cost,materials.jp,materials.type as tipe,product_profiles.product_variant_id,color_materials.qty,invoice_lines.quantity,ppm.qty as ppm_count,jol.jo_count");
                $this->db->join("color_materials", "ppm.material_id=color_materials.color_id");
                $this->db->join("materials", "color_materials.material_id=materials.id");
                $this->db->join("product_profiles", " product_profiles.id=ppm.product_profile_id");
                $this->db->join("invoice_lines", " product_profiles.product_variant_id=invoice_lines.product_id");
                $this->db->join("job_order_lines as jol", "invoice_lines.id=jol.invoice_line_id", "left");
                //$this->db->where("product_profiles.product_variant_id", $mat->product_id);
                $this->db->where("invoice_lines.id", $mat->id);
                $colorMaterial_list =  $this->db->order_by("materials.material_name", "asc")->get("product_profile_materials as ppm")->result_array();
                array_push($color_arr, $colorMaterial_list);
            }
            $module["materials"]=$arr;
            $module["colorMaterials"]=$color_arr;
            $content = $this->load->view('main/jobOrders_listSubBq_print_view', $module, TRUE);

            $fp = fopen("/var/www/html/dekokraft/prints/". "$id.html","wb");
            fwrite($fp,$content);
            fclose($fp);
        }
    }

    public function prints()
    {
        $page = $this->uri->segment(4, 0);
        if ($page == "color_composition") {
            $id = $this->input->get("id");
            $ids = explode(",", $id);
            //$ids=array(18,18);
            foreach ($ids as $id) {
                $this->db->or_where("id", $id);
            }
            $results = $this->db->get("materials")->result_array();

            $ret = array();
            foreach ($results as $res) {
                $this->db->join("materials", "materials.id=color_materials.material_id");
                $this->db->where("color_id", $res["id"]);
                $material_list =  $this->db->order_by("color_materials.id", "asc")->get("color_materials")->result_array();
                array_push($res, $material_list);
                array_push($ret, $res);
            }
            $module["color_materials"] = $ret;
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/color_composition_print_view', $module);
        }

        if ($page == "job_order") {
            $id = $this->input->get("id");
            $ids = explode(",", $id);
            foreach ($ids as $id) {
                $this->db->or_where("id", $id);
            }
            $results = $this->db->get("job_orders")->result_array();

            $ret = array();
            foreach ($results as $res) {
                $this->db->join("materials", "materials.id=color_materials.material_id");
                $this->db->where("color_id", $res["id"]);
                $material_list =  $this->db->order_by("color_materials.id", "asc")->get("color_materials")->result_array();
                array_push($res, $material_list);
                array_push($ret, $res);
            }
            $module["color_materials"] = $ret;
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/color_composition_print_view', $module);
        }
    }

    public function get_profile_data()
    {
        $this->db->where("user_id", $this->session->userdata("USERID"));
        $result = $this->db->get("user_profiles");
        $user_profile = $result->row();
        $this->db->select("id,username,role_id,date_created,date_modified,created_by,modified_by");
        $this->db->where("id", $this->session->userdata("USERID"));
        $result = $this->db->get("user_accounts");
        $user_account = $result->row();
        $return["user_profile"] = $user_profile;
        $return["user_account"] = $user_account;
        echo json_encode($return);
    }

    public function update_profile()
    {
        $upload_path = './uploads/profile_image/';
        if (isset($_FILES["profile_image"]["name"])) {
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $this->db->where("id", $this->session->userdata("USERID"));
            $result = $this->db->get("user_profiles");
            if ($result->row()->profile_image != null) {
                if ($result->row()->profile_image != "default_dp.png") {
                    unlink($upload_path.$result->row()->profile_image);
                }
            }
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $new_filename = str_replace(" ", "_", "profile_".$this->input->post("username"))."_".date("YmdHisU");
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('profile_image', $new_filename)) {
                echo $this->upload->display_errors();
                die();
            }


            $data = $this->upload->data();
            $this->users_model->profile_image = $data["file_name"];
        }
        $this->users_model->username = $this->input->post("username");
        $this->users_model->first_name = $this->input->post("first_name");
        $this->users_model->middle_name = $this->input->post("middle_name");
        $this->users_model->last_name = $this->input->post("last_name");
        $this->users_model->contact_number = $this->input->post("contact_number");
        $this->users_model->address = $this->input->post("address");
        $this->users_model->password = $this->input->post("password");
        $this->users_model->old_password = $this->input->post("old_password");
        $this->users_model->email_address = $this->input->post("email_address");
        $this->users_model->user_id = $this->session->userdata("USERID");
        $this->users_model->birthday = $this->input->post("birthday");
        echo $this->users_model->update_profile();
    }

    public function purchase_orders(){
      $page = $this->uri->segment(4, 0);
      if ($page == "print") {
        $id = $this->input->get("po_id");
        $this->db->select("pv.description,pv.color,pv.color_abb,p.class,p.code,il.quantity,il.discount,il.product_price,pol.po_count,po.resin_unit_price as resinp,po.finishing_unit_price as finishp,po.spray_unit_price as spray,po.hand_paint_unit_price as handp");
        $this->db->join('invoice_lines as il', 'pol.invoice_line_id=il.id', 'left');
        $this->db->join('product_profiles as po', 'il.product_id=po.product_variant_id', 'left');
        $this->db->join('product_variants as pv', 'il.product_id=pv.id', 'left');
        $this->db->join('products as p', 'pv.product_id=p.id', 'left');
        $this->db->where("pol.po_id", $id);
        // $this->db->order_by("p.description", "asc");
        $module['p_o'] = $this->db->get("purchase_order_lines as pol")->result();

        $this->db->select("s.name,po.id,po.job_type,mo.invoice_id,po.deadline,mo.id as mo_id,c.company_name,po.date_created");
        $this->db->join('subcon as s', 'po.subcon_id=s.id', 'left');
        $this->db->join('marketing_order as mo', 'po.mo_id=mo.id', 'left');
        $this->db->join('invoices as i', 'mo.invoice_id=i.id', 'left');
        $this->db->join('customers as c', 'i.customer_id=c.id', 'left');
        $this->db->where("po.id", $id);
        $module['detail'] = $this->db->get("purchase_orders as po")->result();

        $this->load->view('main/purchase_orders_print_view', $module);
      } elseif ($page == "prints") {
        $id = $this->input->get("po_id");

        $this->db->select("s.name,po.id,po.job_type,mo.invoice_id,po.deadline,mo.id as mo_id,c.company_name,po.date_created");
        $this->db->join('subcon as s', 'po.subcon_id=s.id', 'left');
        $this->db->join('marketing_order as mo', 'po.mo_id=mo.id', 'left');
        $this->db->join('invoices as i', 'mo.invoice_id=i.id', 'left');
        $this->db->join('customers as c', 'i.customer_id=c.id', 'left');
        $this->db->where("po.id", $id);
        $module['detail'] = $this->db->get("purchase_orders as po")->result();

        $this->db->select("pv.description,pv.color,pv.color_abb,p.class,p.code,il.quantity,il.discount,il.product_price,pol.po_count,po.resin_unit_price as resinp,po.finishing_unit_price as finishp,po.spray_unit_price as spray,po.hand_paint_unit_price as handp");
        $this->db->join('invoice_lines as il', 'pol.invoice_line_id=il.id', 'left');
        $this->db->join('product_profiles as po', 'il.product_id=po.product_variant_id', 'left');
        $this->db->join('product_variants as pv', 'il.product_id=pv.id', 'left');
        $this->db->join('products as p', 'pv.product_id=p.id', 'left');
        $this->db->where("pol.po_id", $id);
        // $this->db->order_by("p.description", "asc");
        $module['p_o'] = $this->db->get("purchase_order_lines as pol")->result();

        $arr=array();
        $color_arr=array();
        foreach ($module["p_o"] as $mat) {
            $this->db->select("materials.material_name,materials.unit,materials.cost,materials.jp,materials.type as tipe,ppm.qty,product_profiles.product_variant_id,ppm.product_profile_id,invoice_lines.id as invoice_id,pol.po_count");
            $this->db->join("materials", "ppm.material_id=materials.id");
            $this->db->join("product_profiles", " product_profiles.id=ppm.product_profile_id");
            $this->db->join("invoice_lines", " product_profiles.product_variant_id=invoice_lines.product_id");
            $this->db->join("purchase_order_lines as pol", " invoice_lines.id=pol.invoice_line_id");
            // $this->db->where("product_profiles.product_variant_id", $mat->product_id);
            //$this->db->where("invoice_lines.id", $mat->invoice_line_id);
            $this->db->where("pol.po_id", $id);
            $material_list =  $this->db->order_by("materials.material_name", "asc")->get("product_profile_materials as ppm")->result_array();
            array_push($arr, $material_list);
            $this->db->select("materials.material_name,materials.unit,materials.cost,materials.jp,materials.type as tipe,product_profiles.product_variant_id,color_materials.qty,invoice_lines.quantity,ppm.qty as ppm_count,pol.po_count");
            $this->db->join("color_materials", "ppm.material_id=color_materials.color_id");
            $this->db->join("materials", "color_materials.material_id=materials.id");
            $this->db->join("product_profiles", " product_profiles.id=ppm.product_profile_id");
            $this->db->join("invoice_lines", " product_profiles.product_variant_id=invoice_lines.product_id");
            $this->db->join("purchase_order_lines as pol", " invoice_lines.id=pol.invoice_line_id");
            //$this->db->where("product_profiles.product_variant_id", $mat->product_id);
            //$this->db->where("invoice_lines.id", $mat->invoice_line_id);
            $this->db->where("pol.po_id", $id);
            $colorMaterial_list =  $this->db->order_by("materials.material_name", "asc")->get("product_profile_materials as ppm")->result_array();
            array_push($color_arr, $colorMaterial_list);
        }
        $module["materials"]=$arr;
        $module["colorMaterials"]=$color_arr;

        $this->load->view('main/purchaseOrders-SubBQ-print', $module);
      }
    }
}
