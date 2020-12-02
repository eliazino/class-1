<?php
session_start();
require_once("../server/getservice.php");
require_once("../server/orderhelper.php");
$services = new getServices();
$cartCount = $services->countCart();
if(!isset($_SESSION["username"])){
    die("<h1>ACCESS DENIED!</h1>");
}
if($_SESSION['type'] != 2){
    die("<h1>ACCESS DENIED!</h1>");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style/products.css">
    <link rel="stylesheet" href="../style/afbc.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Customer Orders::Admin</title>
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
        echo '<a href="orders.php">Orders</a>';
	}else{
		echo '<a href="account.php">login</a>';
	}
	?>
  </div>
</div>
<div class="wrapper" style="padding:12px">
	<div class="desc">
		<h1>Orders</h1>
	</div>
	<div class="content">
    <table style="border-collapse: collapse; width: 100%;" border="0">
    <tbody>
    <tr class="head">
    <td style="width: 5%;"></td>
    <td style="width: 20%;"></td>
    <td style="width: 15%;"></td>
    <td style="width: 5%;">Unit</td>
    <td style="width: 5%;">Quantity</td>
    <td style="width: 10%;">Total</td>
    <td style="width: 10%;">Date</td>
    <td style="width: 10%;">User</td>
    <td style="width: 10%;">Order Status</td>
    <td style="width: 10%;">Action</td>
    </tr>
    <?php
    $cart = $services->getOrders($_SESSION['username']);
    if(count($cart) > 0){
        for($i=0; $i < count($cart); $i++){
    ?>
        <tr>
        <td style="width: 5%;"><?php echo $i+1; ?></td>
        <td style="width: 25%;"><img src="<?php echo $cart[$i]->image; ?>" alt="Img" class="product-grid__img" style="width:100%; height:auto" /></td>
        <td style="width: 15%;"><?php echo $cart[$i]->name; ?></td>
        <td style="width: 5%;"><?php echo $cart[$i]->price; ?></td>
        <td style="width: 5%;"><?php echo $cart[$i]->quantity; ?></td>
        <td style="width: 10%;"><?php echo intval($cart[$i]->quantity)*$cart[$i]->price; ?></td>
        <td style="width: 10%;"><?php echo $cart[$i]->date;; ?></td>
        <td style="width: 10%;"><?php echo $cart[$i]->username; ?></td>
        <td style="width: 15%;">
            <?php
                if($cart[$i]->status == "0"){
                    echo '<span class="badge badge-secondary">Order is pending</span>';
                }
                if($cart[$i]->status == "1"){
                    echo '<span class="badge badge-success">Order has Shipped</span>';
                }
                if($cart[$i]->status == "-1"){
                    echo '<span class="badge badge-danger">Order was cancelled</span>';
                }
            ?>
        </td>
        <td>
        <?php
                if($cart[$i]->status == "0"){
                    echo '<form action="orders.php" method="post"><input type="hidden" name="status" value = "1" /><input type="hidden" name="id" value = "'.$cart[$i]->id.'" /><button name="orderstatus" type="submit" class="btn btn-link btn-xm">Shipped</button></form>';
                    echo '<form action="orders.php" method="post"><input type="hidden" name="status" value = "-1" /><input type="hidden" name="id" value = "'.$cart[$i]->id.'" /><button name="orderstatus" type="submit" class="btn btn-danger btn-xm">Rejected/Cancelled</button></form>';
                }
            ?>
        </td>
        </tr>
    <?php
        }
    }
    else{
    ?>
    <tr>
        <td colspan="10"><h2>Opps! You have not ordered any food yet</h2></td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>
</div>
</div>
</body>
</html>
