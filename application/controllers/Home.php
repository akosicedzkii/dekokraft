<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();  
    }
	public function index()
	{
		$this->v_counter->insert_visitor();   
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "HOME - Unioil";
		$query = "SELECT t2.file_name as banner_image, t3.file_name as inner_banner_image,t1.description,t1.title FROM banners as t1 LEFT JOIN media as t2 on t2.id = t1.banner_image LEFT JOIN media as t3 on t3.id = t1.inner_banner_image WHERE t1.status = 1";
		$data["banners"] = $this->db->query($query)->result();
		$query = "SELECT t2.file_name as banner_image,t1.link FROM mid_banners as t1 LEFT JOIN media as t2 on t2.id = t1.banner_image WHERE t1.status = 1";
		$data["mid_banners"] = $this->db->query($query)->result();
		$data["page"] = "home";
		$data["dynamic_settings"] = $this->db->get("dynamic_settings")->row();
        $this->db->limit(3, 0);
        $this->db->where("status","1");
        $this->db->where("content_type","blogs");
        $data["charities"] = $this->db->query("SELECT t1.id,t1.description,t1.author,t1.title,t1.date_created,t2.file_name,t1.content FROM charities AS t1 LEFT JOIN media AS t2 on t2.id = t1.cover_image WHERE t1.content_type='charities' AND t1.status = 1 ORDER BY t1.date_created DESC limit 0,10")->result();
		
		$this->load->view('template/header.php',$data);
		$this->load->view('home_view');
		$this->load->view('template/footer.php',$data);
	}
	
	
    public function get_all_station()
    {
        $branch = $this->db->get("branches");

		$test = array();
		$return = "{";
        foreach($branch->result() as $row)
        {
            $return .= '"'.strtolower(str_replace(" ","",$row->branch_name)).'" : {';
				$return .= '"name" : "'.$row->branch_name.'",';
					$return .= '"branches" : {';
						$this->db->where("branch_id",$row->id);
						$stations = $this->db->get("stations");
						$return_station = ""; 
							foreach($stations->result() as $row_stations)
							{
								$return_station .= '"'. str_replace("'", "",  str_replace('"', '',strtolower(str_replace(" ","",$row_stations->station_name)))).'" : {';
									$return_station .= '"name" : "'.  str_replace('"', '',str_replace("'", "", ucwords($row_stations->station_name))).'",';
									$return_station .= '"contact" : "'.  str_replace('"', '',str_replace("'", "", ucwords($row_stations->contact_number))).'",';
									$return_station .= '"map-url" : "'.  str_replace('"', '', str_replace("'", "", $row_stations->map_url)).'"';
								$return_station .= '},';
							}
							$return_station = rtrim($return_station,",") . "}";
							$return .= $return_station.'},';
						
        }
		$return = rtrim($return,",") . "}";
		echo json_encode($return,true);
	}
	
	public function get_gas_price()
	{
		$store_name = $this->input->post("station_name");
		$branch_name = $this->input->post("branch_name");
		$query = "SELECT t1.id as station_id,t2.id as branch_id FROM stations as t1 LEFT JOIN branches as t2 ON t2.id = t1.branch_id WHERE t1.station_name='".$store_name."' AND t2.branch_name = '".$branch_name."' LIMIT 1";
		$result = $this->db->query($query);


		$query = "SELECT * from products where product_category_id = 1 AND status = 1 AND (visibility = 'price_only' OR visibility = 'price_and_promotion')";
		$fuel_list =  $this->db->query($query)->result();
		$return = "<tbody>";
		foreach($fuel_list as $row)
		{
			$this->db->where("station_id",$result->row()->station_id);
			$this->db->where("fuel_id",$row->id);
			$fuel_price_query = $this->db->get("stations_fuel_prices");
			$price = "00.00";
			if($fuel_price_query->row() != null)
			{	
				$price = $fuel_price_query->row()->price;
			}
			if($price != null || $price != "")
			{
				if($price != "00.00")
				{
					$return .='<tr>
						<td>'.ucwords($row->product_name).'</td>
					<td>
						<div class="price-container" data-price="'.$price.'">';
		
						
						$str_price = str_split($price);
						foreach($str_price as $char  ) {
							if($char != null){
								$return .= '<div class="price-digit">'.$char.'</div>';
							}
						}
						$return .= '</div>
					</td>
					</tr>';
				}
			}
			
		}
		$return .= "</tbody>";
		echo $return;

	}
}
