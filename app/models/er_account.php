<?php

class ER_Account extends CI_Model {

    // var $title   = '';
    //     var $content = '';
    //     var $date    = '';

    function __construct() 
	{
        // Call the Model constructor
        parent::__construct();
    }
    
    function getAllObjects()
    {
		$query = $this->db->get('er_account');
		return $query->result();
    }

	function getObject($id, $limit=1, $offset=0){
		$data = array();
		$query = $this->db->get_where('er_account', array('id' => $id), $limit, $offset); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
	    }
	    $query->free_result();  
	    return $data;  
	}
	
	function findUser($username, $password, $limit=10, $offset=0){
		$data = array();
		$query = $this->db->get_where('er_account', array('username' => $username, 'password' => sha1($password)), $limit, $offset); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
	    }
	    $query->free_result();  
	    return $data;  
	}

	function createAccount(){
		
		$_username = trimmedLowerCaseString($_POST['username']);
		$now = date(time());
		
		$data = array( 
			'email' => $_POST['email'],
			'first' => $_POST['first'],
			'last' => $_POST['last'],
			'username' => $_username,
			'password' => sha1($_POST['password']),
			'token' => $_POST['token'],
			'date_created' => $now
		);
		
		createAccountFolders($_username);//shoud be moved after the email confirmation process

		$this->db->insert('er_account', $data);
	}

	function deleteObject($id)
    {
	 	 $this->db->where('id', $id);
		 $this->db->delete('er_account');
    }

	function deactivate($id)
    {
        $data = array('status' => 0);
	 	 $this->db->where('id', $id);
		 $this->db->update('er_account', $data);
    }

	function activate($id)
    {
        $data = array('status' => 1);
	 	 $this->db->where('id', $id);
		 $this->db->update('er_account', $data);
    }

    function updateObject()
    {	
		$now = time();
		$data = array( 
			'username' => $_POST['username'],
			'email' => $_POST['email'],
			'first' => $_POST['first'],
			'last' => $_POST['last'],
			'date_updated' => $now
		);

	 	$this->db->where('id', $_POST['id']);
		$this->db->update('er_account', $data);
    }

	function sendmail(){		
		$data['message'] = "Hey there, you've got mail!";
		//$data['to'] = $_POST['to'];
		$email = $this->load->view('account/email_templates/complete_registration', $data, TRUE);

		$this->email->from('registration@eventizr.ch', 'Eventizr');
		$this->email->to('dgeneva@mac.com'); 
		//$this->email->cc('dgeneva@mac.com'); 
		//$this->email->bcc('them@their-example.com'); 

		$this->email->subject('Registration at Eventizr');
		$this->email->message($email);	
	
		$this->email->send();
		//echo $this->email->print_debugger();

	}
	
}


?>