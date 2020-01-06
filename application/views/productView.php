<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>


<?php foreach ($view_data as $row) { ?>
		
	<div class="row">
		<div class="col-md-5 productView">
			<h2><?php echo $row->description ?></h2>
			<hr>
			<h3><?php echo $row->productLine ?></h3>
			<hr>
			<img src="<?php echo $img_base.'products/full/'.$row->photo; ?>" class="img-rounded" alt="<?php echo $row->description ?>">
		</div>

		<div class="col-md-3 productDetails ml-auto mr-3">
			<p class="price">€<?php echo $row->bulkSalePrice ?> & FREE DELIVERY</p>
			<p><?php echo $row->quantityInStock ?> left in stock</p>
			<p>Get it by 
				<span class="etaDelivery">
					<?php 
					//echoing out the date in a formatted manner
					echo date('l', strtotime(' +1 day')).",";
				 	echo " ". date('d', strtotime(' +1 day'));
				 	echo date('S', strtotime(' +1 day')); ?>
			 	</span> if you order before 6pm today!</p>

			 <p>
			 	Quantity: 
			 	<select name="quantity"  id="quantity" tabindex="0" >
	                <option value="1" selected="">1
	                </option>
	                <option value="2">2
	                </option>
	                <option value="3">3
	                </option>
				</select>
			 </p>

			 <a class="btn btn-warning "><i class="fa fa-shopping-basket"></i>Add To Basket</a>
			 <a class="btn btn-warning"><i class="fa fa-list"></i>Add To WishList</a>

			
		</div>
	</div>
		

<?php }
	$this->load->view('footer'); 
?>