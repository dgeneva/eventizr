<?php

class ER_Admin extends CI_Model {

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
		$query = $this->db->get('er_admin');
		return $query->result();
    }

	function getObject($id, $limit=10, $offset=0){
		$data = array();
		$query = $this->db->get_where('er_admin', array('id' => $id), $limit, $offset); 
	  	if ($query->num_rows() > 0){
	      $data = $query->row_array();
	    }
	    $query->free_result();  
	    return $data;  
	 }

    function createObject() 
	{
       	$data = array( 
			'username' => $_POST['username'],
			'email' => $_POST['email'],
			'password' => md5($_POST['password']),
			'status' => $_POST['status']
		);
		
		$this->db->insert('er_admin', $data);
    }

	function deleteObject($id)
    {
	 	 $this->db->where('id', $id);
		 $this->db->delete('er_admin');
    }

	function deactivateObject($id)
    {
        $data = array('status' => 0);
	 	 $this->db->where('id', $id);
		 $this->db->update('er_admin', $data);
    }

	function activateObject($id)
    {
        $data = array('status' => 1);
	 	 $this->db->where('id', $id);
		 $this->db->update('er_admin', $data);
    }

    function updateObject()
    {	
		$data = array( 
			'username' => $_POST['username'],
			'email' => $_POST['email'],
			'status' => $_POST['status']
		);

	 	$this->db->where('id', $_POST['id']);
		$this->db->update('er_admin', $data);
    }

}

?>