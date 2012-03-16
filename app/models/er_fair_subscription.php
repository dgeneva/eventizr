<?php

class ER_Fair_Subscription extends CI_Model{

	
	function __construct() 
	{
        // Call the Model constructor
        parent::__construct();
    }

	function createAccount(){
		
		$now = date(time());
		
		$data = array( 
			'email' => $_POST['email'],
			'first' => $_POST['first'],
			'last' => $_POST['last'],
			'sector' => $_POST['sector'],
			'lang' => $_POST['lang'],
			'phone' => $_POST['phone'],
			'company_website' => $_POST['company_website'],
			'date_created' => $now
		);
		

		$this->db->insert('er_fair_subscription', $data);
		
		$this->sendmail($_POST['email']);
		$this->sendmail_admin($data);
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
		
		
		$data['message_body'] = $this->load->view('email_messages/msg_confirm_fair_registration.php', '' ,TRUE);
		$email = $this->load->view('email_messages/msg_html_wrapper.php', $data, TRUE);

		$this->email->from('noreply@ephj.ch', 'EPHJ - EPMT - SMT');
		$this->email->to($to); 
		
		//$this->email->cc('dgeneva@mac.com'); 
		//$this->email->bcc('them@their-example.com'); 

		$this->email->subject('Votre demande de participation à EPHJ - EPMT - SMT');
		$this->email->message($email);	
	
		$this->email->send();
		//echo $this->email->print_debugger();

	}
	
	
	/* ====================================================
	*  Email pour accepter la préinscription de l'exposant
	*  s====================================================
	*/
	
	public function sendmail_confirm_subscription($to, $fair='ALL'){
		
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
		
		$user_info['title'] = "Dashboard Home";
		$user_info['salon'] = $fair;
		$data['message_body'] = $this->load->view('email_messages/msg_confirm_fair_registration_accepted.php', $user_info ,TRUE);
		$email = $this->load->view('email_messages/msg_html_wrapper.php', $data, TRUE);

		$this->email->from('noreply@ephj.ch', 'votre inscription à EPHJ - EPMT - SMT');
		$this->email->to($to); 
		
		//$this->email->cc('dgeneva@mac.com'); 
		//$this->email->bcc('them@their-example.com'); 

		$this->email->subject('Votre demande de participation à EPHJ - EPMT - SMT');
		$this->email->message($email);	
	
		$this->email->send();
		//echo $this->email->print_debugger();

	}
	
	
	/* ====================================================
	*  Copie à l'admin de la demande de préinscription
	*  ====================================================
	*/
	private function sendmail_admin($user_info){
		
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
		
		
		$data['message_body'] = $this->load->view('email_messages/msg_confirm_fair_registration_admin.php', $user_info, TRUE);
		//print_r($user_info); 		
		//$this->load->vars($data);
		$email = $this->load->view('email_messages/msg_html_wrapper.php', $data, TRUE);

		$this->email->from('noreply@ephj.ch', 'EPHJ - EPMT - SMT');
		$this->email->to(ADMIN_EMAIL); 
		//$this->email->cc('dgeneva@mac.com'); 
		$this->email->bcc(ADMIN_EMAIL_2); 

		$this->email->subject('Nouvelle demande d\'inscription');
		$this->email->message($email);	
	
		$this->email->send();
		//echo $this->email->print_debugger();

	}
	
	
	
}