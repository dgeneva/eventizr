<?php

class ER_Fair extends CI_Model {

    // var $title   = '';
    //     var $content = '';
    //     var $date    = '';

    function __construct() 
	{
        // Call the Model constructor
        parent::__construct();
    }
   

	function objectsForOwner($owner_id=0){
		$sql = "SELECT * FROM er_fair WHERE owner_id = ?"; 
		$query = $this->db->query($sql, array($owner_id));
		return $query->result();
	 }

	function getObject($id=0, $owner_id=0){
		$sql = "SELECT * FROM er_fair WHERE uid = ? AND owner_id = ?"; 
		$query = $this->db->query($sql, array($id, $owner_id));
		return $query->result();
	 }
	
	function delete($id)
    {
		$this->db->delete('er_fair', array('id' => $id)); 
    }

	function insert(){
		$data = array( 
							'title' => $_POST['title'],
							'country' => $_POST['country'],
							'city' => $_POST['city'],
							'website' => $_POST['website'],
							'more_info_url' => $_POST['more_info_url'],
							'start_date' => $_POST['start_date'],
							'end_date' => $_POST['end_date'],
							'owner_id' => $_POST['owner_id'],
							'venue' => $_POST['venue'],
							'venue_website' => $_POST['venue_website'],
							'api_key' => $_POST['api_key']
						);

		$this->db->insert('er_fair', $data);
	}

	function update($id)
    {
		$data = array( 
					'title' => $_POST['title'],
					'country' => $_POST['country'],
					'city' => $_POST['city'],
					'website' => $_POST['website'],
					'more_info_url' => ($_POST['password']),
					'start_date' => ($_POST['start_date']),
					'end_date' => ($_POST['end_date']),
					'owner_id' => ($_POST['owner_id']),
					
				);

	 	$this->db->where('id', $id);
		$this->db->update('er_fair', $data);
    }
	
}


?>