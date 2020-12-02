<?php
require_once("dbHelper/db.php");
class getServices{
    public function getProducts($id = "-"){
        $dbn = new db();
        if($id == "-"){
            $products = json_decode($dbn->selectFromQueryV2("SELECT * FROM menu"));
        }else{
            $products = json_decode($dbn->selectFromQueryV2("SELECT * FROM menu WHERE id = ?", array($id)));
        }
        return $products;
    }

    public function getOrders($username = ""){
        $dbn = new db();
        if($username == "-"){
            $products = json_decode($dbn->selectFromQueryV2("SELECT orders.*, menu.name, menu.image, menu.price FROM orders, menu WHERE orders.menuID = menu.id"));
        }else{
            $products = json_decode($dbn->selectFromQueryV2("SELECT orders.*, menu.name, menu.image, menu.price FROM orders, menu WHERE orders.menuID = menu.id AND orders.username = ?", array($username)));
        }
        return $products;
    }

    public function countCart(){
        if(isset($_SESSION["_cart"])){
            $ob = json_decode($_SESSION["_cart"]);            
            return count($ob);
        }
        return 0;
    }

    public function addToCart($payload){        
        $ob = [];
        if(isset($_SESSION["_cart"])){
            $ob = json_decode($_SESSION["_cart"]);
            array_push($ob, $payload);
        }else{
            $ob[0] = $payload;
        }        
        $job = json_encode($ob);
        $_SESSION["_cart"] = $job;
        return true;
    }

    public function getCart(){        
        if(isset($_SESSION["_cart"])){
            $ob = json_decode($_SESSION["_cart"]);
           return $ob;
        }        
        return [];
    }

    public function removeFromCart($index){
        if(isset($_SESSION["_cart"])){
            $ob = json_decode($_SESSION["_cart"], true);
            $newOb = [];
            for($i=0; $i < count($ob); $i++){
                if($i == $index){
                    continue;
                }
                array_push($newOb, $ob[$i]);
            }
            $nob = json_encode($newOb);
            $_SESSION["_cart"] = $nob;
            return true;
        }
        return false;
    }

    public function productExistInCart($id){
        if(isset($_SESSION["_cart"])){
            $ob = json_decode($_SESSION["_cart"]);
            for($i=0; $i < count($ob); $i++){
                if($ob[$i]->id == $id){
                    return true;
                }
            }
        }        
        return false;
    }

}