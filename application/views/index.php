<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<div class="main">
	<img class="img-fluid" style="width:100%" src="<?php echo $img_base . "site/logo.png"?>" />	
</div>

<div id="indexProductHeader">
	<!-- <span id="indexHeader">Our Products</span> -->

	<?php if(isset($this->session->userdata['logged_in']['userType']) &&  ($this->session->userdata['logged_in']['userType'] == 2)){?>
		<p><a class ="btn btn-warning" href="<?php echo site_url('ProductController/handleInsert/');?>">Add New Product</a></p>
	<?php }?>
	<form action="<?php echo site_url('ProductController/category/');?>" method="get">
		<select  name ="category" class="form-control placeholder" id ="categorySort" >
			<option value="" selected disabled hidden>Category</option>
			<?php foreach($category as $row){ ?>
				<option value="<?php echo $row->productLine ?>" ><?php echo $row->productLine ?></option>
			<?php }?>
		</select>
		<p><input type="submit" name="submitCategory" value="Filter" class ="btn btn-warning" id="categoryApply" /></p>
	</form>
</div>

<div class="row">
	<?php foreach($product_info as $row){ ?>	
	    <div class="col-md-3">
	        <div class="thumbnail">
	        <a href="<?php echo site_url('ProductController/viewProduct/'.$row->produceCode);?>" >
	          <img src="<?php echo $img_base.'/products/thumbs/'.$row->photo;?>" class ="img-thumbnail" alt="Lights" style="width:100%">
	          <div class="caption">
	            <p><?php echo $row->description;?></p>
	          </div>
	        </a>
	        	<?php if(isset($this->session->userdata['logged_in']['userType']) &&  ($this->session->userdata['logged_in']['userType'] == 2)){?>
	    			<p>
	    				<a onclick="return checkDelete()" class="btn btn-primary" href="<?php echo site_url('ProductController/discontinueProduct/'.$row->produceCode);?>">Discontinue</a>
						<a class="btn btn-primary" href="<?php echo site_url('ProductController/editProduct/'.$row->produceCode);?>">Edit</a>
						<a onclick="return checkDelete()" class="btn btn-primary" href="<?php echo site_url('ProductController/deleteProduct/'.$row->produceCode);?>">Delete</a>
					</p>
	            			
	            <?php }?>
	  		</div>
		</div>
 	<?php }//end foreach ?> 
 </div>
 
 <div class="pagination">
 	<?php echo $this->pagination->create_links(); ?>
 </div>


<?php
$this->load->view('footer'); 
?>