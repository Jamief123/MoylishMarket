<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerModel extends CI_Model
{
    function __construct()
    {	parent::__construct();
		$this->load->database();
    }
	
	function insertCustomerModel($customer)
	{	$this->db->insert('customers',$customer);
		if ($this->db->affected_rows() ==1) {
			return true;
		}
		else {
			return false;
		}
	}

	function login($email, $password) {
		$this -> db -> select('customerNumber, email, password');
		$this -> db -> from('customers');
		$this -> db -> where('email', $email);
		$this -> db -> where('password', MD5($password));
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1) 
			return $query->result();
	   else
			return false;
	}	

	
}
?>