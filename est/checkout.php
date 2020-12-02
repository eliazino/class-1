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
	<title>Checkout</title>
    <style>
    td{
        padding:12px
    }
    .total td{
        font-style:italic;        
    }
    .total{
        border:#f2f2f2;
        border-style: solid;
    }
    .head td{
        font-weight:bold
    }
    .btn{
        display: inline-block;
        font-weight: 400;
        color: #212529;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        cursor: pointer;
    }
    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .btn-success {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }
    </style>
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
<div class="wrapper" style="padding:12px">
	<div class="desc">
		<h1>Checkout</h1>
	</div>
	<div class="content">
    <table style="border-collapse: collapse; width: 100%;" border="0">
    <tbody>
    <tr class="head">
    <td style="width: 5%;"></td>
    <td style="width: 25%;"></td>
    <td style="width: 25%;"></td>
    <td style="width: 10%;">Unit</td>
    <td style="width: 5%;">Quantity</td>
    <td style="width: 10%;">Total</td>
    <td style="width: 20%;"></td>
    </tr>

    <?php
    $totalUnit = 0;
    $totalQuantity = 0;
    $Sum = 0;
    $cart = $services->getCart();
    if(count($cart) > 0){
        for($i=0; $i < count($cart); $i++){
            $products = $services->getProducts($cart[$i]->id);
            if(count($products) < 1){
                continue;
            }
            $totalUnit += intval($products[0]->price);
            $totalQuantity += intval($cart[$i]->quantity);
            $Sum += intval($cart[$i]->quantity)*$products[0]->price;
    ?>
        <tr>
        <td style="width: 5%;"><?php echo $i + 1; ?></td>
        <td style="width: 25%;"><img src="<?php echo 'admin/'.$products[0]->image; ?>" alt="Img" class="product-grid__img" style="width:100%; height:auto" /></td>
        <td style="width: 25%;"><?php echo $products[0]->name; ?></td>
        <td style="width: 10%;"><?php echo $products[0]->price; ?></td>
        <td style="width: 5%;"><?php echo $cart[$i]->quantity; ?></td>
        <td style="width: 10%;"><?php echo intval($cart[$i]->quantity)*$products[0]->price; ?></td>
        <td style="width: 20%;">
            <form action="checkout.php" method="post">
            <input type="hidden" value="<?php echo $i ?>" name ="cartItem">
            <button name="removeCart" class="btn btn-danger"><i class="fa fa-times"></i> Remove</button>
            </form>
        </td>
        </tr>
    <?php
        }
        }else{
            ?>
            <tr>
                <td colspan="7"><h2>Opps! Nothing in your cart</h2></td>
            </tr>
            <?php
        }
    ?>
    <tr class="total">
    <td style="width: 5%;"></td>
    <td style="width: 25%;"></td>
    <td style="width: 25%;"></td>
    <td style="width: 10%;"><?php echo number_format($totalUnit, 2); ?></td>
    <td style="width: 5%;"><?php echo $totalQuantity; ?></td>
    <td style="width: 10%;"><?php echo number_format($Sum, 2); ?></td>
    <td style="width: 20%;"></td>
    </tr>
    </tbody>
</table>
        <form action="checkout.php" method="post">
            <div align="right" style="padding:6px"><button class="btn btn-success" name="checkout"><i class="fa fa-credit-card"></i> Checkout</button>
        </form>
    </div>
</div>
</div>
</body>
</html>
