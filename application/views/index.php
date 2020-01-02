<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<div class="main">
	<img class="img-fluid" style="width:100%" src="<?php echo $img_base . "site/logo.jpg"?>" />	
</div>

	<h1 class="main">Our Products</h1> 

	<?php if(isset($this->session->userdata['logged_in']['userType']) &&  ($this->session->userdata['logged_in']['userType'] == 2)){?>
		<a href="<?php echo site_url('ProductController/handleInsert/');?>">Add New Product</a>
	<?php }?>
	

	<div class="row">
		<?php foreach($product_info as $row){?>	
	    <div class="col-md-3">
	      <div class="thumbnail">
	        <a href="<?php echo site_url('ProductController/viewProduct/'.$row->produceCode);?>" >
	          <img src="<?php echo $img_base.'/products/thumbs/'.$row->photo;?>" class ="img-thumbnail" alt="Lights" style="width:100%">
	          <div class="caption">
	            <p><?php echo $row->description;?></p>
	            
	          </div>
	        </a>
	        <?php if(isset($this->session->userdata['logged_in']['userType']) &&  ($this->session->userdata['logged_in']['userType'] == 2)){?>
        			<p><button type="button" class="btn btn-primary">Delete</button>
    					<button type="button" class="btn btn-primary">Edit</button></p>
	            			
	            <?php }?>
	      </div>
	    </div>
 	 <?php }//end foreach?> 
 	 </div>

	<?php echo $this->pagination->create_links(); ?>
<?php
$this->load->view('footer'); 
?>