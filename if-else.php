<?php
$x = 3; $y = 4;

$bool1 = $x > $y; //False
$bool2 = $x < $y; //True
$bool3 = $x == $y; //False
$bool4 = $x <= $y; //True

$boolTrue = true;
$boolFalse = false;

$a = $boolTrue && $boolFalse; //False
$b = $boolTrue || $boolFalse; //True


$age = $argv[1];
$balance = $argv[2];
if( $age >= 18){
    if($balance >= 1000){
        echo "Chief, welcome to our main bar";
    }elseif($balance >= 500){
        echo "Poor ass, Just come in here";
    }
    else{
        echo "Please Go and get more money";
    }    
}else{
    echo "We don't allow underage drinking";
}