<?php

class ER_City extends CI_Model {

    // var $title   = '';
    //     var $content = '';
    //     var $date    = '';

    function __construct() 
	{
        // Call the Model constructor
        parent::__construct();
    }
   

	function allObjects($options = array())
	    {
		    $this->db->select('name');
		    $this->db->like('name', $options['searchQuery']);
	   		$query = $this->db->get('er_city');
			return $query->result();
	    }
	
}


?>