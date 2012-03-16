<?php

class ER_Mailing_Subscription extends CI_Model{
	
	function __construct() 
	{
        // Call the Model constructor
        parent::__construct();
    }

	
	function findUser($email){
		$data = array();
		$query = $this->db->get_where('er_mailing_subscription', array('email' => $email)); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
	    }
	    $query->free_result();  
	    return $data;  
	}
	

	function createEntry($email){
		
		$_email = trimmedLowerCaseString($email);
		$now = date(time());
		
		$data = array( 
			'email' => $_email,
			'is_active' => '1',
			'lang' => 'fr_FR',
			'date_created' => $now
		);
		
		$this->db->insert('er_mailing_subscription', $data);
		
		$this->sendmail($_email);
	}
	
	private function sendmail($to){	
		
			// required authentication for infomaniak
			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html'; // instead of text

			$config['protocol'] = "smtp";
			$config['smtp_host'] = "mail.ephj.ch"; 
			$config['smtp_user'] = "noreply@ephj.ch";
			$config['smtp_pass'] = "n0reply";
			$config['smtp_port'] = "25";
			$config['smtp_auth'] = true;

			$this->email->initialize($config);	
		
		$data['message_body'] = $this->load->view('email_messages/confirm_newsletter_registration_message.php', null, TRUE);
		$email = $this->load->view('email_messages/msg_html_wrapper.php', $data, TRUE);

		$this->email->from('noreply@ephj.ch', 'EPHJ - EPMT - SMT');
		$this->email->to($to); 
		//$this->email->cc('dgeneva@mac.com'); 
		//$this->email->bcc('them@their-example.com'); 

		$this->email->subject('Votre souscription à la Newsletter EPHJ - EPMT - SMT');
		$this->email->message($email);	
	
		$this->email->send();
		//echo $this->email->print_debugger();

	}
	
	
	
	
}