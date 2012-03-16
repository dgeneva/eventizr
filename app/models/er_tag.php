<?php

class ER_Tag extends CI_Model {

    // var $title   = '';
    //     var $content = '';
    //     var $date    = '';

    function __construct() 
	{
        // Call the Model constructor
        parent::__construct();
    }

	function getAllObjects(){
		$query = $this->db->get('er_tag');
		return $query->result();
	}
   
	public function getAllTags(){
		$rawData = $this->getAllObjects();
		$values = array_values($rawData);
		$tags = array();
		foreach($values as $val){
			array_push($tags, $val);
		}
		return $tags;
	}
	
	
}


?>