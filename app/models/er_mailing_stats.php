<?php



class ER_Mailing_Stats extends CI_Model{
	
	function __construct() 
	{
        // Call the Model constructor
        parent::__construct();
    }

/*	
	function findNewsletter($token){
		$data = array();
		$query = $this->db->get_where('er_emailing_stats', array('token' => $token)); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
	    }
	    $query->free_result();  
	    return $data;  
	}
*/	

	function log($_token, $_email){
		//print_r($_GET);
			
		$email = urldecode($_email);
		$now = date(time());
		$allHeaders = getallheaders();
		$data = array( 
			'email' => $email,
			'content_referer' => $_token,
			'date_Created' => $now,
			'token' => $_token,
			'headers' => implode($allHeaders)
		);
		
		$this->db->insert('er_mailing_stats', $data);
		
	}
	
	//FIX ME check if user exists -> update or insert for token
	
	function findUser($_token, $_email){
		$data = array();
		$query = $this->db->get_where('er_mailing_stats', array('email' => $email, )); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
	    }
	    $query->free_result();  
	    return $data;  
	}
	
	function update($_token, $_email){
		$now = time();
		$data = array( 
			'username' => $_POST['username'],
			'email' => $_POST['email'],
			'first' => $_POST['first'],
			'last' => $_POST['last'],
			'date_updated' => $now
		);

	 	$this->db->where('id', $_POST['id']);
		$this->db->update('er_mailing_stats', $data);
	}
	
	function insert($_token, $_email){
		$email = urldecode($_email);
		$now = date(time());
		$allHeaders = getallheaders();
		$data = array( 
			'email' => $email,
			'content_referer' => $_token,
			'date_Created' => $now,
			'token' => $_token,
			'headers' => implode($allHeaders)
		);
		
		$this->db->insert('er_mailing_stats', $data);
	}
	

	
	
	
	
	
}