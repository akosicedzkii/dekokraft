<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    private $user_access;
    private $default_page;
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();
        $this->load->model("portal/users_model");
        if ($this->session->userdata("USERID") == null) {
            redirect(base_url()."portal/login");
        }
        $this->user_access = $this->settings_model->get_user_access();
        $this->default_page = $this->settings_model->get_role_default_page();
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
        $module["user_counts"] = $this->db->get("user_accounts")->num_rows();

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
            if ($module["invoice"] == null) {
                echo "invoice not found";
            }
            $this->db->select("product_variants.color,product_variants.color_abb,invoice_lines.*,products.description,products.weight_of_box,products.inner_carton,products.master_carton,products.class,products.code,products.fob");
            $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
            $this->db->join("products", " products.id=product_variants.product_id");
            $this->db->where("invoice_id", $invoice_id);
            $this->db->order_by("products.id", "asc");
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
            $module["invoice"] = $this->db->where("id", $invoice_id)->get("invoices")->row();
            $module["mo"] = $this->db->where("invoice_id", $invoice_id)->get("marketing_order")->row();
            $module["customer_address"] = $this->db->where("id", $module["invoice"]->customer_id)->get("customers")->row();
            $module["bank"] = $this->db->where("id", $module["invoice"]->bank)->get("banks")->row();
            $module["payment_terms"] = $this->db->where("id", $module["invoice"]->payment_terms)->get("payment_terms")->row();
            if ($module["invoice"] == null) {
                echo "invoice not found";
            }
            $this->db->select("products.weight_of_box,products.inner_carton,products.master_carton,products.class,product_variants.color_abb,product_variants.color,invoice_lines.*,products.description,products.code,products.fob");
            $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
            $this->db->join("products", " products.id=product_variants.product_id");
            $this->db->where("invoice_id", $invoice_id);
            $module["invoice_lines"]= $this->db->get("invoice_lines")->result();
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;
            $this->load->view('main/marketing_order_print_view', $module);
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
            $this->db->select("product_variants.*,products.class,products.code,products.description");
            $this->db->join("products", "products.id=product_variants.product_id");
            $this->db->where("product_variants.id", $product_variant_id);
            $module["product_variants"] = $this->db->get("product_variants")->row();
            $product_profile_id = $this->db->where("product_variant_id", $product_variant_id)->get("product_profiles")->row();
            $module["material_groups"] = null;
            $ret = array();
            $module["net_weight"] = "";
            if (!$product_profile_id == null) {
                $this->db->where("product_profile_id", $product_profile_id->id);
                $result =  $this->db->get("product_material_group")->result_array();
                $module["net_weight"] = $product_profile_id->net_weight;
                if ($result != null) {
                    foreach ($result as $res) {
                        $this->db->join("materials", "materials.id=product_profile_materials.material_id");
                        $material_list =$this->db->order_by("product_profile_materials.id", "desc")->where("product_material_group_id", $res["id"])->get("product_profile_materials")->result_array();
                        array_push($res, $material_list);
                        array_push($ret, $res);
                    }
                }
            }
            $module["material_groups"] = $ret;
            $this->load->view('main/template/header', $module);
            $this->load->view('main/product_profiles_add_view', $module);
            $this->load->view('main/template/footer');
        } elseif ($page == "print") {
            $module["module_name"] = $this->router->fetch_method();
            $module["menu"] = $this->user_access;

            $product_variant_id = $this->input->get("product_variant_id");
            $this->db->select("product_variants.*,products.class,products.code,products.description");
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

    public function job_orders()
    {
        $page = $this->uri->segment(4, 0);
        if ($page == "print") {
            $id = $this->input->get("job_id");

            $this->db->select('jo.*,sub.name,sub.subcon_details,sub.address,sub.code,pt.code as payment_code,mo.invoice_id,c.customer_name');
            $this->db->join('subcon as sub', 'jo.subcon_id=sub.id');
            $this->db->join('marketing_order as mo', 'jo.mo_id=mo.id');
            $this->db->join('invoices as inv', 'mo.invoice_id=inv.id', 'left');
            $this->db->join('customers as c', 'inv.customer_id=c.id', 'left');
            $this->db->join('payment_terms as pt', 'inv.payment_terms=pt.id', 'left');
            $this->db->where('jo.id', $id);
            $module["job_orders"]=$this->db->get("job_orders as jo")->row();

            $this->db->select("product_variants.color,product_variants.color_abb,invoice_lines.*,products.description,products.weight_of_box,products.inner_carton,products.master_carton,products.class,products.code,products.fob");
            $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
            $this->db->join("products", " products.id=product_variants.product_id");
            $this->db->join("job_order_lines", "job_order_lines.invoice_line_id=invoice_lines.id");
            $this->db->join("product_profiles", "product_variants.id=product_profiles.product_variant_id");
            // $this->db->where("invoice_id", $module["job_orders"]->invoice_id);
            $this->db->where("job_order_lines.jo_id", $module["job_orders"]->id);
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
        }
    }

    public function prints()
    {
        $page = $this->uri->segment(4, 0);
        if ($page == "color_composition") {
            // $id = $this->input->get("id");
            // $ids = explode(",", $id);
            $ids=array(18,18);
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
}
