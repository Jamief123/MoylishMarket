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
	<div class="row">
		<?php foreach($view_data as $row){?>	
	    <div class="col-md-4">
	      <div class="thumbnail">
	        <a href="<?php echo site_url('ProductController/viewProduct/'.$row->produceCode);?>" >
	          <img src="<?php echo $img_base.'/products/thumbs/'.$row->photo;?>" class ="img-thumbnail" alt="Lights" style="width:100%">
	          <div class="caption">
	            <p><?php echo $row->description;?></p>
	            
	          </div>
	        </a>
	        <?php if(isset($this->session->userdata['logged_in']['userType']) &&  ($this->session->userdata['logged_in']['userType'] == 2)){	?>
        			<p>
        				<a  class="btn btn-primary">Delete</a>
					   <a  class="btn btn-primary">Edit</a>
					</p>
	            			
	            <?php }?>
	      </div>
	    </div>
 	 <?php }//end foreach?> 
 	 </div>

	
<?php
$this->load->view('footer'); 
?>