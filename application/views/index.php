<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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

	<br><br>
	<h1 class="main">Our Products</h1>

	<div class="row">
		<?php foreach($product_info as $row){?>	
	    <div class="col-md-4">
	      <div class="thumbnail">
	        <a href="<?php echo site_url('ProductController/viewProduct/'.$row->produceCode);?>" >
	          <img src="<?php echo $img_base.'/products/thumbs/'.$row->photo;?>" class ="img-thumbnail" alt="Lights" style="width:100%">
	          <div class="caption">
	            <p><?php echo $row->description;?></p>
	          </div>
	        </a>
	      </div>
	    </div>
 	 <?php }//end foreach?> 
 	 </div>

	
<?php
$this->load->view('footer'); 
?>