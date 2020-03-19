<?php

class Invoices_model extends CI_Model {

        function add_invoice($params)
        {
                echo $this->db->insert('invoices',$params);
                $id =  $this->db->insert_id();

                $this->logs->log = "Created Invoice - ID: ". $id  ;
                $this->logs->details =  " Invoice Details: ".json_encode( $params );
                $this->logs->module = "invoices";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_invoices()
        {
                $data["username"] = $this->username ; 
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["role_id"] = $this->role;
                $data["status"] = $this->status;
                $data["modified_by"] = $this->session->userdata("USERID");
                $this->db->where("id",$this->user_id);
                $result = $this->db->update('user_accounts', $data);

                $data_profile["last_name"] = $this->last_name; 
                $data_profile["first_name"] = $this->first_name;
                $data_profile["middle_name"] = $this->middle_name; 
                $data_profile["contact_number"] = $this->contact_number;
                $data_profile["email_address"] = $this->email_address;
                $data_profile["birthday"] = $this->birthday;
                $data_profile["address"] = $this->address; 
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["modified_by"] = $this->session->userdata("USERID");
                $this->db->select("id,username,role_id,date_created,date_modified,created_by,modified_by");
                $this->db->where("id",$this->user_id);
                $data_account = $this->db->get("user_accounts");
                $this->db->where("user_id",$this->user_id);
                echo $result = $this->db->update('user_profiles', $data_profile);
                $data = json_encode($data_profile);
                $this->logs->log = "Updated User - ID: ". $this->user_id .", Username: ".$this->username ;
                $this->logs->details = json_encode($data) . " User Details: ".json_encode( $data_account->row() );
                $this->logs->module = "invoices";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

        public function get_invoice_roles($search)
        {
                $this->db->like("role_name",$search);
                $result = $this->db->select("id,role_name as text")->get("roles");
                return json_encode($result->result());
        }

        public function update_profile()
        {
               
                $this->db->where("id",$this->user_id);
                $query = $this->db->get("user_accounts");
                $salt = $query->row()->salt; 
                if($this->password != null)
                {
                        $data["password"] = hash ( "sha256",  $salt.$this->password );
                }
               
                $combined_password =  hash ( "sha256",  $salt.$this->old_password );
                if($combined_password ==  $query->row()->password)
                {
                        $data["date_modified"] = date("Y-m-d H:i:s A");
                        $data["modified_by"] = $this->session->userdata("USERID");
                        $this->db->where("id",$this->user_id);
                        $result = $this->db->update('user_accounts', $data);
                        if($this->profile_image)
                        {
                                $data_profile["profile_image"] = $this->profile_image; 
                                
                                $this->session->set_userdata("USERIMG",$this->profile_image);
                        }
                        $data_profile["last_name"] = $this->last_name; 
                        $data_profile["first_name"] = $this->first_name;
                        $data_profile["middle_name"] = $this->middle_name; 
                        $data_profile["contact_number"] = $this->contact_number;
                        $data_profile["email_address"] = $this->email_address;
                        $data_profile["birthday"] = $this->birthday;
                        $data_profile["address"] = $this->address; 
                        $data["date_modified"] = date("Y-m-d H:i:s A");
                        $data["modified_by"] = $this->session->userdata("USERID");
                        $this->db->select("id,username,role_id,date_created,date_modified,created_by,modified_by");
                        $this->db->where("id",$this->user_id);
                        $data_account = $this->db->get("user_accounts");
                        $this->db->where("user_id",$this->user_id);
                        echo $result = $this->db->update('user_profiles', $data_profile);
                        $data = json_encode($data_profile);
                        $this->logs->log = "Updated Profile - ID: ". $this->user_id .", Username: ".$this->username ;
                        $this->logs->details = json_encode($data) . " User Details: ".json_encode( $data_account->row() );
                        $this->logs->module = "invoices";
                        $this->logs->created_by = $this->session->userdata("USERID");
                        $this->logs->insert_log();
                }
                else
                {
                        echo "Incorrect password";
                }

        }
      
}

?>