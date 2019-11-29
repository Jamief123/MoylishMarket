<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<div class="main">
	<img class="img-fluid" style="width:100%" src="<?php echo $img_base . "site/logo.jpg"?>" />
	<h1>Moylish Market</h1>
	<p>Information about our products</a>
		<a href="<?php  anchor('DefaultController/Login')?>">Log In</a>
	
</div>
	
<?php
$this->load->view('footer'); 
?>