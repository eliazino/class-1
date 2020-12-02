<?php
session_start();
require_once("server/getservice.php");
require_once("server/orderhelper.php");
$services = new getServices();
$cartCount = $services->countCart();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/products.css">
	<link rel="stylesheet" href="style/afbc.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>HOME</title>
</head>
<body>
<div class="header">
  <a href="#default" class="logo">FoodFresh</a>
  <div class="header-right">
    <a class="active" href="index.php">Home</a>
	<?php
	if(isset($_SESSION["username"])){
		echo '<a href="destroy.php">'.$_SESSION["username"].'(Logout)</a>';
		echo '<a href="orders.php">Your Orders</a>';
	}else{
		echo '<a href="account.php">login</a>';
	}
	?>
    <a href="checkout.php">
        <i class="fa fa-shopping-cart"></i>
        Cart <span class="badge badge-dark"><?php echo $cartCount; ?></span>
    </a>
  </div>
</div> 
<div class="wrapper">
	<div class="desc">
		<h1>Food Fresh off the kitchen</h1>
	</div>
	<div class="content">
		<!-- content here -->
		<div class="product-grid product-grid--flexbox">
			<div class="product-grid__wrapper">


			<?php                 
                $products = $services->getProducts();
                if(count($products) < 1){
                    echo "<h1>No menu today</h1>";
				}				
                for($i=0; $i < count($products); $i++){							
                ?>
				<!-- Single product -->
				<div class="product-grid__product-wrapper">
					<div class="product-grid__product">
						<div class="product-grid__img-wrapper">			
							<img src="<?php echo 'admin/'.$products[$i]->image; ?>" alt="Img" class="product-grid__img" />
						</div>
						<span class="product-grid__title"><?php echo $products[$i]->name; ?></span>
						<span class="product-grid__price"><?php echo $products[$i]->price; ?>€</span>
						<div class="product-grid__extend-wrapper">
							<div class="product-grid__extend">
								<p class="product-grid__description"><?php echo $products[$i]->descr; ?></p>
								<form action="index.php" method="post">
									<input type="number" name="quantity" id="q<?php echo $products[$i]->id; ?>" value="<?php echo $products[$i]->minquantity; ?>" min="<?php echo $products[$i]->minquantity; ?>" max = "<?php echo $products[$i]->maxquantity; ?>" class="product-grid__btn product-grid__view" />
									<input type="hidden" name="id" id="hv<?php echo $products[$i]->id; ?>" value="<?php echo $products[$i]->id; ?>" />
									<button <?php $services->productExistInCart($products[$i]->id)? "disabled='disabled'" : "" ?> name="addcart" class="product-grid__btn product-grid__add-to-cart"><i class="fa fa-cart-arrow-down"></i> Add to cart</button>
								</form>								
							</div>
						</div>
					</div>
                </div>
                <?php
                }
                ?>

			</div>		
		</div>
	</div>
</div>
</body>
</html>