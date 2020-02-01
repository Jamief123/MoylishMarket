<?php
//sessions 2018
//new view for login
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<div class="jumbotron">
   <h1 class="display-4" >Log in to Moylish Market</h1> 
   <div class="formInputs">
	   	<?php echo validation_errors();
		   
				echo form_open('DefaultController/verify_login'); 
				
				echo "Enter Email";
				echo form_input('email','',"class='form-control form-group'");
				
				echo "Enter Password";
				echo form_password('password','',"class='form-control form-group'");

				echo form_checkbox('rememberMe',"class='form-control form-group'");
				echo "Remember me";

				echo form_submit("Login", "Login!","class='btn btn-warning form-control form-group'"); 
			?>
   </div>
	
	<?php
		$this->load->view('footer'); 
?>
</div>

