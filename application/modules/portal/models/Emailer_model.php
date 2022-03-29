<?php

class Emailer_model extends CI_Model {

    public $from;
    public $to;
    public $subject;
    public $message;
    public $attachment;
    public $from_name;

    public function send_email()
    {
       
        // Load email library and passing configured values to email library
        $this->load->library('email');
        // Sender email address
        $this->email->from("mailerunioil@gmail.com","Mailer");
        // Receiver email address.for single email
        $this->email->to($this->to);
        // Subject of email
        $this->email->subject($this->subject);
        // Message in email
        $this->email->message($this->message);
        // It returns boolean TRUE or FALSE based on success or failure
        try{
            $this->email->send();
            echo 'Message has been sent.';
        }catch(Exception $e){
            echo $e->getMessage();
        }

    }
}

?>