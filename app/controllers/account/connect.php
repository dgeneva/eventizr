<?php

// Account

class Connect extends ER_Controller {
	
	public function __construct()
	{
		parent::__construct();
        // Your own constructor code

		$navigation['main_navigation'] = 'account';
		$this->load->vars($navigation);
     }

	/* Controller call for pages
	=======================================================*/
	
	function index()
	{
			if ($this->er_session->logged_in){
				// $data['title'] = "Account Connect";
				// 				$data['main_view'] = 'fair/manage/my_fairs';
				// 				$this->load->vars($data);
				// 				$this->load->view(ADMIN_WRAPPER);
				redirect('fair/manage/my_fairs');
			}else{
				$data['title'] = "Account Connect";
				$data['main_view'] = 'account/index';
				$this->load->vars($data);
				$this->load->view(BOOTSTRAP);
			}
	 }
	
	function login()
	{		
		$loggedUser = $this->ER_Account->findUser($this->input->post('username'), $this->input->post('password'));
		
		if($loggedUser != null){
		 	$this->er_session->set_userdata('user_data', $loggedUser);
			$this->er_session->logged_in = TRUE;
	
			redirect('fair/manage/my_fairs');
			
		}else{
			//$data['title'] = "Login";
			$data['main_view'] = 'account/dashboard';
			$this->load->vars($data);
			$this->load->view(BOOTSTRAP);
		}	
	}
		

	
	
	
	/* Actions in forms
	=======================================================*/
	
	function loginAction()
	{
		$loggedUser = $this->ER_Account->findUser($this->input->post('username'), $this->input->post('password'));
		
		if($loggedUser != null){
		 	$this->er_session->set_userdata('user_data', $loggedUser);
			$this->er_session->logged_in = TRUE;
			redirect('account/profile/dashboard');
		}else{
			$data['title'] = "Login";
			$data['main_view'] = 'account/login';
			$this->load->vars($data);
			$this->load->view('account/wrapper');
		}
	}
	
	function logout()
	{
		$this->er_session->logged_in = FALSE;
		$this->er_session->unset_userdata('user_data');
		$data['title'] = "Logout";
		$data['main_view'] = 'account/logged_out_success';
		$this->load->vars($data);
		$this->load->view('account/wrapper');
	}
	
	
	function testjson(){
		$comma_separated_deals = '"code":"value"';
		$this->output->set_content_type('application/json');
		$this->output->set_output('{ "deals": ['.$comma_separated_deals.']}');
	}

	

	
	
	/* Account Creation steps
	=======================================================*/
	function register(){

		if ($this->er_session->logged_in){
			redirect('account/profile/dashboard');
			}else{
				$config = array(
				               array(
				                     'field'   => 'email', 
				                     'label'   => 'Email', 
				                     'rules'   => 'required|valid_email'
				                  ),
				               array(
				                     'field'   => 'first', 
				                     'label'   => 'First Name', 
				                     'rules'   => 'required|min_length[2]'
				                  ),
				               array(
				                     'field'   => 'last', 
				                     'label'   => 'Last Name', 
				                     'rules'   => 'required|min_length[2]'
				                  ),   
				               array(
				                     'field'   => 'username', 
				                     'label'   => 'Username', 
				                     'rules'   => 'required|min_length[3]'
				                  ),
								array(
				                     'field'   => 'password', 
				                     'label'   => 'Password', 
				                     'rules'   => 'required|min_length[3]'
				                  ),
								array(
				                     'field'   => 'confirm_password', 
				                     'label'   => 'Re-Type Password', 
				                     'rules'   => 'required|matches[password]'
				                  )
				            );

				$this->form_validation->set_rules($config);

				if ($this->form_validation->run() == FALSE)
				{
					$data['title'] = "Register";
					$data['main_view'] = 'account/form_register';
					$this->load->vars($data);
					$this->load->view('account/wrapper');
				}else{
					// success submit !
					$this->ER_Account->createAccount();
					$this->ER_Account->sendCompleteEmail();
					redirect('account/connect/complete','refresh');
					return;
				}
			}
	}

	// almost complete
	function complete(){
	   	$data['title'] = "Account - Welcome";
		$data['main_view'] = 'account/complete';
		$this->load->vars($data);
		$this->load->view('sitewide_template');
		
	}
	
	
	
	
	
	
	
	
// end of file	
}