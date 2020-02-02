<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DefaultController extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('ProductModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('pagination');
	}

	public function index(){	

		if($this->input->cookie('email') && $this->input->cookie('password'))
			$this->UserModel->login($this->input->cookie('email'),$this->input->cookie('password'));

		$config['base_url'] = site_url('DefaultController/index/');
		$config['total_rows'] = $this->ProductModel->record_count();
		$config['per_page'] = 20;
		$this->pagination->initialize($config);
		$data['product_info']=$this->ProductModel->get_all_products(20,$this->uri->segment(3));
		$data['category'] = $this->ProductModel->get_all_categories();
		$this->load->view('index',$data);	
	}


	public function Register(){
		$this->load->view('Register');
	}

	public function Login(){
		$this->load->view('Login');
	}

	public function Logout(){
		//unset the session data
		$this->session->unset_userdata('logged_in');
		//destroy the session
		$this->session->sess_destroy();
		//load the login page
		$this->index();
	}

	public function InsertCustomer(){
		if ($this->input->post('submitInsert')){
		
			// //set validation rules
			$this->form_validation->set_rules('authorID', 'Author ID', 'required');
			$this->form_validation->set_rules('firstName', 'First Name', 'required');
			$this->form_validation->set_rules('lastName', 'Last Name', 'required');	
			$this->form_validation->set_rules('yearBorn', 'Year Born', 'required');

			//get values from post
			$aCustomer['customerName'] = $this->input->post('customerName');
			$aCustomer['contactFirstName'] = $this->input->post('contactFirstName');
			$aCustomer['contactLastName'] = $this->input->post('contactLastName');
			$aCustomer['phone'] = $this->input->post('phone');
			$aCustomer['addressLine1'] = $this->input->post('addressLine1');
			$aCustomer['addressLine2'] = $this->input->post('addressLine2');
			$aCustomer['city'] = $this->input->post('city');
			$aCustomer['country'] = $this->input->post('country');
			$aCustomer['email'] = $this->input->post('email');
			$aCustomer['password'] = MD5($this->input->post('password'));

			//check if the form has passed validation
			// if (!$this->form_validation->run()){
			// 	//validation has failed, load the form again
			// 	$this->load->view('insertAuthorView', $anAuthor);
			// 	return;
			// }

			//check if insert is successful
			if ($this->UserModel->insertUserModel($aCustomer)) {
				$this->index();
			}
			else {
				$data['message'] = "Uh oh ... problem on insert";
				//load the view to display the message
				$this->load->view('displayMessageView', $data);
			}
			return;
		}
			$aCustomer['customerName'] = "";
			$aCustomer['contactFirstName'] = "";
			$aCustomer['contactLastName'] = "";
			$aCustomer['phone'] = "";
			$aCustomer['addressLine1'] = "";
			$aCustomer['addressLine2'] = "";
			$aCustomer['city'] = "";
			$aCustomer['country'] = "";
			$aCustomer['email'] = "";
			$aCustomer['password'] = "";

		//load the form
		$this->load->view('Register', $aCustomer);
	}


	function verify_login() {
			//set the validation rules for the login form
			//This code ensures that both the username and password
			//	are trimed of extra spaces at the beginning and end and	are required fields
			//The check_database function is also called
			//callback_ allows you to write your own form validation code
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

			$email = $this->input->post('email');
			$password = MD5($this->input->post('password'));

			if(isset($_POST['rememberMe']))
				$rememberMe = true;

			if($this->form_validation->run() == false) {
				//validation failed -> display login form
				$this->load->view('Login');
			} else { 
				//validation passed (inc a call to check_database() via a callback) -> display secret content
				if(isset($rememberMe)){
					 $this->input->set_cookie('email',$email,time()+(86400) );
					 $this->input->set_cookie('password',$password,time()+(86400) );
				
				}
				redirect('DefaultController/Index');
			}
		}

	//sessions 2018
	//my callback function to validate the users credentials
	function check_database($password) {
		//only get here if form validation succeeded. now validate the users details against the DB
		$email = $this->input->post('email');
	   //query the DB
	   $result = $this->UserModel->login($email, MD5($password));
	   //if a valid user write their id & name to session data
		if($result) {
			$sess_array = array();
			foreach($result as $row) {
				$sess_array = array(
					'customerNumber' => $row->customerNumber,
					'email' => $row->email,
					'userType' =>$row->userType

				);
				$this->session->set_userdata('logged_in', $sess_array);		
			}
			//return true -> we have a valid user
			return true;
		}
		else {
			//return false ->we have an invalid user
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}

}

