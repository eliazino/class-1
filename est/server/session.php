<?php
require_once("dbHelper/db.php");
session_start();
error_reporting(0);
$lerr = "";
$rerr = "";
if(isset($_SESSION["username"])){
    $type = $_SESSION["type"];
    if($type == 2){
        echo "<script>location.replace('admin/index.php')</script>";
    }else{
        echo "<script>location.replace('index.php')</script>";
    }
}
if(isset($_POST["type"])){
    if($_POST["type"] == "login"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $title = $_POST["title"];
        $password = hash("sha256", $username.$password."_salted");
        $dbn = new db();
        if($title == 1){
            $profile = json_decode($dbn->selectFromQueryV2("SELECT username, fullname FROM customer WHERE username = ? AND password = ?", array($username, $password)));
            if(count($profile) > 0){
                $_SESSION["username"] = $profile[0]->username;
                $_SESSION["fullname"] = $profile[0]->fullname;
                $_SESSION["type"] = 1;                
                $lsucc = "Login succesful";                
                echo "<script>location.replace('index.php')</script>";
            }else{
                $lerr = "Username and password does not match our record";
            }
            return;
        }
        if($title == 2){
            $profile = json_decode($dbn->selectFromQueryV2("SELECT username, fullname FROM admin WHERE username = ? AND password = ?", array($username, $password)));
            if(count($profile) > 0){
                $_SESSION["username"] = $profile[0]->username;
                $_SESSION["fullname"] = $profile[0]->fullname;
                $_SESSION["type"] = 2;
                $lsucc = "Login succesful";
                echo "<script>location.replace('admin/index.php')</script>";
            }else{
                $lerr = "Username and password does not match our record";
            }
            return;
        }
        $lerr = "You have not selected a valid login type";           
    }
}
if(isset($_POST["type"])){
    if($_POST["type"] == "register"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];        
        $phone = $_POST["phone"];
        $fullname = $_POST["fullname"];
        if(strlen($fullname) < 6){
            $rerr = "Fullname Must be at least 7 chars long";
            return;
        }
        if(strlen($username) < 6){
            $rerr = "Username Must be at least 7 chars long";
            return;
        }
        if(strlen($password) < 6){
            $rerr = "Password Must be at least 7 chars long";
            return;
        }
        if(strlen($phone) < 3){
            $rerr = "Phone is invalid";
            return;
        }
        if($password != $password2){
            $rerr = "Password does not match";
            return;
        }
        $password = hash("sha256", $username.$password."_salted");
        $dbn = new db();
        if($dbn->isExistV2("SELECT id FROM customer WHERE username = ?", array($username))){
            $rerr = "The username exists. Please use another username";
            return;
        }
        $db = $dbn->connect();
        $sql = "INSERT INTO customer (username, phone, fullname, password) VALUES (:username, :phone, :fullname, :password)";
		$f = $db->prepare($sql);
		$f->bindValue(":username", $username);
        $f->bindValue(":phone", $phone);
        $f->bindValue(":fullname", $fullname);
        $f->bindValue(":password", $password);
        $f->execute();
        $ruser = $username;
        $rsucc = "Registration completed succesfully";
    }
}