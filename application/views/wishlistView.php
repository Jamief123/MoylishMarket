<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>

<?php

//var_dump($view_data);

?>

<div class="wishlist">
	<div class="row">
		<div class="col-md-12">
			<?php foreach ($view_data as $row): ?>
				<div class="wishlistItem">
					<div class="row justify-content-end">
						<div class="col-md-9">
						<img src="<?php echo $img_base.'/products/full/'.$row->photo;?>">
						<a href="<?php echo site_url('ProductController/viewProduct/'.$row->produceCode)?>" >
							<p><?php echo $row->description;?></p>
						</a>
					</div>
					
					<div class="col-md-3">
						<form method= "POST" name="basketAdd" action="<?php echo site_url('ProductController/addToBasket');?>">
							Quantity: 
							<p><input type="number" name ="quantity" value="1"></p>
							<input type="hidden" name="produceCode" value="<?php echo $row->produceCode ?>">
							<input type="hidden" name="description" value="<?php echo $row->description ?>">
							<button class="btn btn-warning" type="submit" name="submitBasketAdd"><i class="fa fa-shopping-basket"></i> Add To Basket</button>
						</form>

						<div class="dateAdded">
							Date Added: <?php echo $row->dateAdded ?>
						</div>
						<p>
							<a href="<?php echo site_url('ProductController/deleteItemFromWishlist/'.$row->produceCode)?>">(Remove)</a>
						</p>
					</div>
					</div>
					
				</div>	
				
			<?php endforeach; ?>
		</div>
	</div>
	
</div>


<?php
$this->load->view('footer'); 
?>