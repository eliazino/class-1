<?php

//              0     1     2      3    4 
$years = array(1991, 1992, 1993, 1994, 1995);
$number = [1, 2, 3, 90, 5, 6 ];
$education = array("Primary", "Secondary", "1st Degree", "2nd Degree");

$number[3]  = 4;



/*echo $years[0];
echo "\n";
echo $education[3];
echo "\n";*/

//Associative
$education = array("Primary" => array("Years"=>6, "Certificate"=>"None"),

            "Secondary" => array("Years"=>7, "Certificate"=>"SSCE"),

            "1st Degree" => array("Years"=>5, "Certificate"=>"BTech"),

             "2nd Degree"=> array("Years"=>2, "Certificate"=>"MBC"));

$primaryEducation = $education["Primary"];
$primaryEducationCertificate = $primaryEducation["Certificate"];
//echo $primaryEducationCertificate;

$secondDegree = $education["2nd Degree"];
$yearSecondDegree = $secondDegree["Years"];
echo $yearSecondDegree;




