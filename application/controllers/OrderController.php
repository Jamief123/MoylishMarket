<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderController extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('OrderModel');
		$this->load->model('OrderDetailsModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('cart');
	}

	
	public function handleCheckout(){
		$order['orderDate'] = date('Y-m-d');
		$order['requiredDate'] = date('Y-m-d', strtotime("+1 day"));
		$order['status'] = "In Process";
		$order['comments'] = $this->input->post('comments');
		$order['customerNumber'] = $_SESSION['logged_in']['customerNumber'];

		//insert an order into database
		if($this->OrderModel->InsertOrderModel($order))
			$data['message'] = 'order placed';
		else
			$data['message'] = 'problem inserting order';

		//get the latest order number for that user
		$latestOrder = $this->OrderModel->get_latest_user_order($_SESSION['logged_in']['customerNumber']);

		foreach($latestOrder as $row){
			$latestOrderNumber = $row['orderNumber'];
		}

		//insert orderdetails for that order
		foreach($this->cart->contents() as $items){
			$orderDetail['orderNumber'] = $latestOrderNumber;
			 $orderDetail['productCode'] = $items['id'];
			 $orderDetail['quantityOrdered'] = $items['qty'];
			 $orderDetail['priceEach'] = $items['price'];
			 $this->OrderDetailsModel->insertOrderDetailsModel($orderDetail);
		}
		$this->load->view('displayMessageView', $data);

	}

	public function manageOrders(){
		if(isset($this->session->userdata['logged_in']['userType'])){
			if(($this->session->userdata['logged_in']['userType'] == 2)){
				$config['base_url'] = site_url('OrderController/manageOrders/');
				$config['total_rows'] = $this->OrderModel->record_count();
				$config['per_page'] = 20;
				$this->pagination->initialize($config);
				$data['order_info']=$this->OrderModel->get_all_orders(20,$this->uri->segment(3));
				$data['status'] = $this->OrderModel->get_all_statuses();
				$this->load->view('orderView',$data);	
			}else{
				$customerNumber = $this->session->userdata['logged_in']['customerNumber'];
				$data['order_info']=$this->OrderModel->get_user_orders($customerNumber);
				$this->load->view('userOrderView',$data);
			}
		}else{
			$data['message'] = 'Sorry, you must be logged in to view orders';
			$this->load->view('displayMessageView',$data);
		}
	}

	public function editOrder(){
		$comments = $_POST['orderComment'];
		$orderNumber =$_POST['orderNumber'];
		$this->OrderModel->update_order_comment($comments, $orderNumber);
		$this->manageOrders();
	}

	public function viewOrderDetails($orderNumber){
		$view_data['order_info'] =$this->OrderDetailsModel->get_order_details($orderNumber);
		$this->load->view('viewOrderDetails',$view_data);
	}


	// public function editOrder($orderNumber){
	// 	if(isset($this->session->userdata['logged_in']['userType']) &&  ($this->session->userdata['logged_in']['userType'] == 2)){
	// 		$data['edit_data']= $this->OrderModel->drilldown($orderNumber);
	// 		$this->load->view('updateOrderView', $data);
	// 	}else{
	// 		$data['message'] = "You must be an admin to do that";
	// 		$this->load->view('displayMessageView',$data);
			
	// 	}

	// }




}
