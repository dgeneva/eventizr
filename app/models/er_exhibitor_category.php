<?php

class ER_Exhibitor_Category extends CI_Model{
	
	function __construct() 
	{
        // Call the Model constructor
        parent::__construct();
    }

	function getAllObjects(){

		$query = $this->db->get('er_exhibitor_category');
		return $query->result();

	}
	
	public function getAllCategories(){
		$rawData = $this->getAllObjects();
		$values = array_values($rawData);
		$categories = array();
		
		foreach($values as $val){
			array_push($categories, $val);
		}
		
		return $categories;
	}

}