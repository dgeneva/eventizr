<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ER_Controller
require_once APPPATH.'libraries/swift_mailer/swift_required.php';


class ER_Controller extends CI_Controller {
 
	//$loggedUser = $this->er_session->userdata('user_data');
	
function __construct() {

	parent::__construct();
	// 	$user_id = $this->session->userdata('user_id');
	// 	$this->data['user'] = $this->user_lib->get($user_id);
	//	echo 'hello world';
	}
}