<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderModel extends CI_Model
{
    function __construct()
    {	parent::__construct();
		$this->load->database();
    }


    public function insertOrderModel($order)
	{	
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE;     //set this to false to prevent DB errors from showing up for user

		$this->db->insert('orders',$order);
		if ($this->db->affected_rows() ==1) {
			return true;
		}
		else {
			return false;
		}

		$this->db->db_debug = $db_debug; //set it back to original setting
	}

	public function record_count(){
    	return $this->db->count_all('orders');
    }

    public function drilldown($orderNumber)
	{	$this->db->select("*"); 
		$this->db->from('orders');
		$this->db->where('orderNumber',$orderNumber);
		$query = $this->db->get();
		return $query->result();
    }

	public function get_all_orders($limit,$offset) 
	{ //gets all products that are not discontinued
		$this->db->limit($limit,$offset);
		$this->db->select("*"); 
		$this->db->from('orders');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_user_orders($customerNumber) 
	{ //gets all products that are not discontinued
		$this->db->select("*"); 
		$this->db->from('orders');
		$this->db->where('customerNumber',$customerNumber);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_statuses(){
		$this->db->distinct();
		$this->db->select("status"); 
		$this->db->from('orders');
		$query = $this->db->get();
		return $query->result();
	}

	public function update_order_comment($comments, $orderNumber){
		$this->db->set('comments',$comments);
		$this->db->where('orderNumber',$orderNumber);
		$this->db->update('orders');
	}

	public function get_latest_user_order($customerNumber){
		$this->db->select('*');
		$this->db->order_by("orderNumber", "desc");
		$this->db->limit(1);
		$this->db->from('orders');
		$this->db->where('customerNumber',$customerNumber);
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>