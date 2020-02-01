<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->helper('url'); 
	$cssbase = base_url()."assets/css/";
	$jsbase = base_url()."assets/js/";
	$img_base = base_url()."assets/images/";
	$base = base_url() . index_page();
?>

<!DOCTYPE>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Moylish Market</title>
<link href="https://img.icons8.com/dusk/64/000000/shopping-cart.png" rel="icon" type="image/x-icon" />
<link href="<?php echo $cssbase . "style.css"?>" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="<?php echo $jsbase."common.js"?>"></script>
<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous">
</script>

</head>

<body>
	
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
			  <a class="navbar-brand" href="<?php echo site_url('DefaultController/Index')?>">Home</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">

			      <!-- Different navbar depending on user login status -->
			      <?php if(!$this->session->userdata('logged_in')){ ?>
				      <li class="nav-item">
				        	<a class="nav-link" href="<?php echo site_url('DefaultController/Login')?>">Log In</a>
				      </li>
				      <li class="nav-item">
				        	<a class="nav-link" href="<?php echo site_url('DefaultController/Register')?>">Register</a>
				      </li>
			      <?php }else{ ?>
			      	<li class="nav-item">
				        	<a class="nav-link" href="<?php echo site_url('DefaultController/Logout')?>">Log Out </a>
				      </li>
				      <?php if(isset($this->session->userdata['logged_in']['userType']) &&  ($this->session->userdata['logged_in']['userType'] == 2)){  ?>
					      <li class="nav-item dropdown">
					        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					          Admin Management
					        </a>
					        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
					          <a class="dropdown-item" href="#">Manage Users</a>
					          <a class="dropdown-item" href=" <?php echo site_url('OrderController/manageOrders') ?>">Manage Orders</a>
					          <a class="dropdown-item" href="#">Manage Products</a>
					          <!-- <div class="dropdown-divider"></div>
					          <a class="dropdown-item" href="#">Something else here</a>
					        </div> -->
					      </li>
			  			<?php } //end if that checks for user type?> 
			  <?php }//end else ?>
					  
			  <!-- End of navbar depending on login status -->

			      <li class="nav-item">
		  		  		<a class="nav-link" href="<?php echo site_url('ProductController/viewWishlist')?>"><i class="fa fa-list"></i> Wishlist</a>
			      </li>
			      <li class="nav-item">
			  		  		<a class="nav-link" href="<?php echo site_url('OrderController/manageOrders')?>"><i class="fa fa-money-bill"></i> Orders</a>
				      </li>
			    </ul>
			    <ul class="navbar-nav ml-auto">
			    	<li class="nav-item">
			  		  		<a class="nav-link" href="<?php echo site_url('ProductController/viewBasket')?>"><i class="fa fa-shopping-basket"></i> Basket</a>
				      </li>
			    </ul>

			    <form class="form-inline my-2 my-lg-0" method="get" action="<?php echo site_url('ProductController/findProducts/');?>">
			      <input class="form-control mr-sm-2" type="search" name="productSearch" placeholder="Search" aria-label="Search">
			      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			    </form>
			  </div>
			</nav>
		</header>
	<div class="container">
