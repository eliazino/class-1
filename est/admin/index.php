<?php
session_start();
if(!isset($_SESSION["type"])){
    die("<h1>ACCESS DENIED!</h1>");
}
if($_SESSION["type"] != 2){
    die("<h1>ACCESS DENIED!</h1>");
}
require_once("../server/createFile.php");
require_once("../server/getservice.php");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../style/products.css">
	<link rel="stylesheet" href="../style/afbc.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../scripts/adminJS.js"></script>
	<title>Home::Admin</title>
</head>
<body>
<div class="header">
  <a href="#default" class="logo">FoodFresh</a>
  <div class="header-right">
    <a class="active" href="#home">Home</a>
    <a href="orders.php">
        <i class="fa fa-shopping-cart"></i>
        Orders
    </a>
    <?php
	if(isset($_SESSION["username"])){
		echo '<a href="../destroy.php">'.$_SESSION["username"].'(Logout)</a>';
	}else{
		echo '<a href="../account.php">login</a>';
	}
	?>
  </div>
</div> 
<div class="wrapper">
	<div class="desc">
		<h1>Food Fresh off the kitchen</h1>
	</div>
    <div style="padding:7px">
    <span style="color:red"><?php echo $err ?></span>
    <span style="color:green"><?php echo $succ ?></span>
	<div class="alert alert-info" role="alert">
		 <span style="cursor:pointer" class="createShow" id="createShow">Add a Product <i class="fa fa-plus"></i></span>
		 <hr/>
		<div class="upload-product" id ="createMother" style="display:none">
		<form name="uploadProduct" method="post" id="uploadProduct" enctype="multipart/form-data">
		<div class="form-group">
			<label for="exampleFormControlInput1">Enter Dish Name</label>
			<input type="text" class="form-control" id="dishname" name="dishName" placeholder="Moin Moin" value="<?php echo $_POST["dishName"]; ?>">
		</div>
		<div class="form-group">
			<label for="unitPrice">Unit price</label>
			<input type="number" class="form-control" id="unitPrice" name = "unitPrice" value="<?php echo $_POST["unitPrice"]; ?>">
		</div>
        <div class="form-group">
			<label for="maxunit">Maximum Order Unit</label>
			<input type="number" class="form-control" id="maxunit" name = "maxunit" value="<?php echo $_POST["maxunit"]; ?>">
		</div>
        <div class="form-group">
			<label for="minunit">Minimum Order Unit</label>
			<input type="number" class="form-control" id="minunit" name = "minunit" value="<?php echo $_POST["minunit"]; ?>">
		</div>		
		<div class="form-group">
			<label for="descr">Description</label>
			<textarea class="form-control" id="descr" rows="2" name = "descr"><?php echo $_POST["descr"]; ?></textarea>
		</div>
        <div class="form-group">
			<label for="imageFile">Description</label>
			<input type="file" class="form-control-file" id = "imageFile" name = "imageFile" />
		</div>
        <div align="right"><div onclick="submitProduct(this)" class="btn btn-info">Create</div></div>
		</form>
		</div>
	</div>
	</div>

	<div class="content">
		<!-- content here -->
		<div class="product-grid product-grid--flexbox">
			<div class="product-grid__wrapper">
                <!-- Product list start here -->
                
                <?php 
                $services = new getServices();
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
							<img src="<?php echo $products[$i]->image; ?>" alt="Img" class="product-grid__img" />
						</div>
						<span class="product-grid__title"><?php echo $products[$i]->name; ?></span>
						<span class="product-grid__price"><?php echo $products[$i]->price; ?>€</span>
						<div class="product-grid__extend-wrapper">
							<div class="product-grid__extend">
								<p class="product-grid__description"><?php echo $products[$i]->descr; ?></p>								
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