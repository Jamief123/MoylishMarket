<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderDetailsModel extends CI_Model
{
    function __construct()
    {	parent::__construct();
		$this->load->database();
    }


    public function insertOrderDetailsModel($orderDetails)
	{	
		$db_debug = $this->db->db_debug; //save setting
		//$this->db->db_debug = FALSE;     //set this to false to prevent DB errors from showing up for user

		$this->db->insert('orderdetails',$orderDetails);
		if ($this->db->affected_rows() ==1) {
			return true;
		}
		else {
			return $this->db->error();
		}

		$this->db->db_debug = $db_debug; //set it back to original setting
	}

	
}
?>