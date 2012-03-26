<?php

// Account

class Manage extends ER_Controller {
	
	public function __construct(){
		parent::__construct();
        // Your own constructor code

		
		$navigation['main_navigation'] = 'account';
		$this->load->vars($navigation);
     }

	/* Controller call for pages
	=======================================================*/
	
	function index(){	
		$data['title'] = "Account INDEX 2";
		$data['main_view'] = 'account/index';
		$this->load->vars($data);
		$this->load->view(BOOTSTRAP);
	 }
	
	/* ====================================================
	*  ACCOUNT LOGIN LOGOUT ACTIONS & MANAGEMENT
	*  ====================================================
	*/



	public function manage_account()
	{
		$data['title'] = "Index";
		$data['sidebar_view'] = 'account/account_sidebar_navigation';
		$data['main_view'] = 'account/account_edit';
		$this->load->vars($data);
		$this->load->view(BOOTSTRAP);
	}

	public function do_update_account()
	{
		$this->ER_Account->updateObject();

		// update session info with new data
		$updatedUser = $this->ER_Account->getObject($this->input->post('id'));
		$this->er_session->set_userdata('user_data', $updatedUser);

		redirect('account/manage/dashboard');
	}


	/* ====================================================
	*  LISTS
	*  ====================================================
	*/

	public function dashboard()
	{
		$data['title'] = "Index";
		$data['main_view'] = 'account/dashboard';
		$this->load->vars($data);
		$this->load->view(BOOTSTRAP);
	}

	public function fair_subscriptions(){
			$data['title'] = "FAIR SUBSCRIPTIONS";
			$data['main_view'] = 'account/fair_subscriptions_list';
			$this->load->vars($data);
			$this->load->view(ADMIN_WRAPPER);
	}
}