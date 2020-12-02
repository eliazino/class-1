<?php
if(isset($_POST["addcart"])){
    $quantity = $_POST["quantity"];
    $id = $_POST["id"];
    $std = new stdClass();
    $std->id = $id;
    $std->quantity = $quantity;
    $services = new getServices();
    if(!$services->productExistInCart($id)){
        $products = $services->addToCart($std);
    }    
}

if(isset($_POST["removeCart"])){
    $index = $_POST["cartItem"];
    $services = new getServices();
    $services->removeFromCart($index);
}

if(isset($_POST["checkout"])){
    if(!isset($_SESSION["username"])){
        echo "<script>alert('You need to login first!'); location.replace('account.php');</script>";
        return;
    }
    $services = new getServices();
    $cartItem = $services->getCart();
    for($i=0; $i <count($cartItem); $i++){
        $item = $cartItem[$i];
        $quantity = $item->quantity;
        $id = $item->id;        
        $sql = "INSERT INTO orders (username, date, menuID, quantity) VALUES (:username, :date, :menuID, :quantity)";
        $dbn = new db();
        $db = $dbn->connect();
        $f = $db->prepare($sql);
        $today = date("d/m/Y H:i:s");
        $f->bindValue(":username", $_SESSION["username"]);
        $f->bindValue(":date", $today);
        $f->bindValue(":menuID", $id);
        $f->bindValue(":quantity", $quantity);
        $f->execute();
        $services->removeFromCart($i);
    }
}
if(isset($_POST["orderstatus"])){
    $status = $_POST['status'];
    $id = $_POST['id'];
    $sql = "UPDATE orders SET status = :status WHERE id = :id";
    $dbn = new db();
    $db = $dbn->connect();
    $f = $db->prepare($sql);       
    $f->bindValue(":status", $status);
    $f->bindValue(":id", $id);
    $f->execute();
}