<?php

class ER_Exhibitor extends CI_Model {

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
		$query = $this->db->get('er_exhibitor');
		return $query->result();
    }

	function getObject($id){
		$data = array();
		$query = $this->db->get_where('er_exhibitor', array('id' => $id)); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
	    }
	    $query->free_result();  
	    return $data;  
	 }
	
	function getAllExhibitors($searchKey){

		if($searchKey == '0'){
			$this->db->select('*');
		 	$this->db->from('er_exhibitor');
		 	$this->db->where('is_group', '1');
		}else{
			$this->db->select('*');
		 	$this->db->from('er_exhibitor');
		 	$this->db->like('name', $searchKey, 'after');
		}

		$this->db->order_by("name", "asc");

		return $this->db->get()->result();

	}

	function getAllGroups(){
		$data = array();
		$query = $this->db->get_where('er_exhibitor', array('is_group' => '1')); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
	    }
	    $query->free_result();  
	    return $data;  
	}

	function findUserWithToken($_token){
		$data = array();
		if($_token == ''){
			$_token = '123456gdsaukg12733_______029128719';
		}
		$query = $this->db->get_where('er_exhibitor', array('token' => $_token)); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
	    }
	    $query->free_result();  
	    return $data;
	}

	function findUser($email, $password){
		$data = array();
		if($email == ''){
			$email = '----__-&5ç67ç3"*"';
		}
		$query = $this->db->get_where('er_exhibitor', array('account_email' => $email, 'password' => md5($password))); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
	    }
	    $query->free_result();  
	    return $data;
	}
	
	private function refetchExhibitorId($id){
		$data = array();
		$query = $this->db->get_where('er_exhibitor', array('id' => $_POST['id'])); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
			$this->er_session->unset_userdata('user_data');
			$this->er_session->set_userdata('user_data', $data);
	    }
	    $query->free_result();  
	    return $data;
	}
	
	private function updateSessionData($id){
		$data = array();
		$query = $this->db->get_where('er_exhibitor', array('id' => $_POST['id'])); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
			$this->er_session->unset_userdata('user_data');
			$this->er_session->set_userdata('user_data', $data);
	    }
	$query->free_result();  
	}
	
	function setNewPassword($aPassword){
		$data = array('password' => md5($aPassword),
		'token' => genRandomString(40));
		$this->db->where('id', $_POST['id']);
		$this->db->update('er_exhibitor', $data);
		$this->updateSessionData($_POST['id']);
	}
	
	function updateInfo(){
		$_is_ephj_secondary = 0;
		$_is_epmt_secondary = 0;
		$_is_smt_secondary = 0;
		if(isset($_POST['is_ephj_secondary'])){
				$_is_ephj_secondary = 1;
		}
		if(isset($_POST['is_epmt_secondary'])){
				$_is_epmt_secondary = 1;
		}
		if(isset($_POST['is_smt_secondary'])){
				$_is_smt_secondary = 1;
		}
	
		$now = time();
		$data = array('name' 	=> $_POST['name'],
			'company_website' 	=> $_POST['company_website'],
			'company_email' 	=> $_POST['company_email'],
			'company_phone' 	=> $_POST['company_phone'],
			'company_fax' 		=> $_POST['company_fax'],
			'category_id' 		=> $_POST['category_id'],
			'booth_manager' 	=> $_POST['booth_manager'],
			'booth_manager_phone' => $_POST['booth_manager_phone'],
			'booth_manager_email' => $_POST['booth_manager_email'],
			'tags'				=> $_POST['tags'],
			'short_description'	=> $_POST['short_description'],
			'is_ephj_secondary'	=> $_is_ephj_secondary,
			'is_epmt_secondary'	=> $_is_epmt_secondary,
			'is_smt_secondary'	=> $_is_smt_secondary,
			'date_modified' 	=> $now);
			
		$this->db->where('id', $_POST['id']);
		$this->db->update('er_exhibitor', $data);
		$this->updateSessionData($_POST['id']);
		//return $this->refetchExhibitorId($_POST['id']);
	}	
}