<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ER_Session extends CI_Session {

    public $logged_in = FALSE;
	
    public function  __construct() {
      	parent::__construct();
		$this->is_logged_in();
    }

    public function is_logged_in()
    {
        $logged = $this->userdata('user_data');
        $this->logged_in = ($logged) ? TRUE : FALSE;
    }


	//stores the full object
	public function loggedUserData()
    {
        return $this->userdata('user_data');
    }

	public function loggedUserValueForKey($key)
    {
		$allData = $this->userdata('user_data');
        return $allData[$key];
    }

	public function logged_user_id()
    {
        $luid = $this->userdata('user_data');
        return $luid['id'];
    }
	
}