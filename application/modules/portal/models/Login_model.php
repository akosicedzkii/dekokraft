<?php

class Login_model extends CI_Model {
    
        public $username;
        public $password;
        public $email_address;

        public function validate_login()
        {
            $this->db->where("username",$this->username);
            $query = $this->db->get("user_accounts");
            if($query->row() == null)
            {
                return "User not found";
            }
            else
            {
                
                $username = $query->row()->username;
                $password = $query->row()->password;
                $user_id = $query->row()->id;
                $salt = $query->row()->salt;
                if($username != $this->username)
                {
                    return "User not found";
                }
                $combined_password =  hash ( "sha256",  $salt.$this->password );
                if($combined_password == $password)
                {
                    if($query->row()->status != 1)
                    {
                        return "User not active";
                    }
                    $this->session->set_userdata("USERNM",$username);
                    $this->session->set_userdata("USERID",$user_id);
                    $this->session->set_userdata("USERTYPE",$query->row()->role_id);

                    $this->db->where("user_id",$this->session->userdata("USERID"));
                    $result = $this->db->get("user_profiles");
                    $result = $result->row();
                    $full_name = str_replace("  "," ",ucwords($result->first_name." ".$result->middle_name." ".$result->last_name));
                    $this->session->set_userdata("FULLNM",$full_name);
                    $this->session->set_userdata("USERIMG",$result->profile_image);

                    $this->logs->log = "Logged in" ;
                    $this->logs->details = $username;
                    $this->logs->module = "login";
                    $this->logs->created_by = $this->session->userdata("USERID");
                    $this->logs->insert_log();
                    return "true";
                }
                else
                {
                    return "false";
                }
            }
        }

        public function forgot_password()
        {
            $this->db->where("username",$this->username);
            $query = $this->db->get("user_accounts");
            if($query->row() == null)
            {
                echo "User not found";
            }
            else
            {
                
                $username = $query->row()->username;
                $user_id = $query->row()->id;
                $salt = $query->row()->salt;
                if($username != $this->username)
                {
                    echo "User not found";
                    die();
                }
                $new_password = random_string('alnum', 8);
                $new_password_hashed =  hash ( "sha256",  $salt.$new_password );
                $this->db->where("user_id",$user_id);
                $result = $this->db->get("user_profiles");
                $email_address = $result->row()->email_address;
                if($email_address != $this->email_address)
                {
                    echo "Email Address not found";
                    die();
                }
                //send new password to email
                $this->db->where("id",$user_id);
                $data["password"] = $new_password_hashed;
                $this->db->update("user_accounts",$data);
                $to = $email_address;
                $body = "Username: ".$username."<br>Your new password is: " . $new_password ."<br>Login on: ".base_url("portal/login");;
                $subject = "Password Reset(".SITE_NAME.")";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"to=$to&body=$body&subject=$subject&attachment=");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $server_output = curl_exec ($ch);

                curl_close ($ch);
                $this->logs->log = "Reset Password" ;
                $this->logs->details = $username;
                $this->logs->module = "forgot_password";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
                return "true";
            }
        }

}

?>