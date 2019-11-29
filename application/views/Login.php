<?php
//sessions 2018
//new view for login
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
   <h1>Moylish Market Login</h1> 
<?php echo validation_errors();
   
		echo form_open('DefaultController/verify_login'); 
		
		echo "Enter Email";
		echo form_input('email');
		
		echo "<br><br>";
		
		echo "Enter Password";
		echo form_password('password');
		
		echo "<br><br>";
		
		echo form_submit("Login", "Login!"); 
	?>
<?php
	$this->load->view('footer'); 
?>
