<?php
$education = array("Primary" => array("Years"=>6, "Certificate"=>"None"),

"Secondary" => array("Years"=>7, "Certificate"=>"SSCE"),

"1st Degree" => array("Years"=>5, "Certificate"=>"BTech"),

 "2nd Degree"=> array("Years"=>2, "Certificate"=>"MBC"));

 ///  Education       Years        Certificate
 echo "Education            Years           Certificate\n";
 foreach($education as $key=>$value){     
     echo $key."            ".$value["Years"]."         ".$value["Certificate"]."\n";
 }