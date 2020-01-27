<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderController extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('OrderModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	
	public function handleCheckout(){
		$order['orderDate'] = date('Y-m-d');
		$order['requiredDate'] = date('Y-m-d', strtotime("+1 day"));
		$order['status'] = "In Process";
		$order['comments'] = $this->input->post('comments');
		$order['customerNumber'] = $_SESSION['logged_in']['customerNumber'];

		if($this->OrderModel->InsertOrderModel($order))
			$data['message'] = 'order placed';
		else
			$data['message'] = 'problem inserting order';
		$this->load->view('displayMessageView', $data);
	}

}

