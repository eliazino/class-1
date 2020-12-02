<?php
require_once("dbHelper/db.php");
$err = "";
$succ = "";
if(!isset($_POST["dishName"])){
    return;
}
    extract($_POST); //Creates names as variable with value of submission
	$fileType = $_FILES["imageFile"]["type"];
	$fileSize = $_FILES["imageFile"]["size"];
	if($fileSize/1024 > "20048") {
		//Its good idea to restrict large files to be uploaded.
		$err = "Filesize is not correct it should equal to 2 MB or less than 200 MB.";
		exit();
	} //FileSize Checking

	if(
		$fileType != "image/png" &&
		$fileType != "image/gif" &&
		$fileType != "image/jpg" &&
		$fileType != "image/jpeg" &&
		$fileType != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" &&
		$fileType != "application/zip" &&
		$fileType != "application/pdf"
	) {
			$err = "Sorry this file type is not supported we accept only. Jpeg, Gif, PNG, or ";
			exit();
     }
    $dir = "uploads/";
    if(!is_dir($dir)){ mkdir($dir, 0777, true); };
	$upFile = $dir.date("Y_m_d_H_i_s").$_FILES["imageFile"]["name"];
	if(is_uploaded_file($_FILES["imageFile"]["tmp_name"])) {
		if(!move_uploaded_file($_FILES["imageFile"]["tmp_name"], $upFile)) {
			$err = "Problem could not move file to destination. Please check again later";
			exit;
		}
	} else {
		$err = "Problem: Possible file upload attack. Filename: ";
		$err = $_FILES["imageFile"]["name"];
		exit;
	}
    $imageFile = $upFile;
    $unitPrice = $_POST["unitPrice"];
    $dishName = $_POST["dishName"];
    $maxunit = $_POST["maxunit"];
    $minunit = $_POST["minunit"];
    $descr = $_POST["descr"];

    $dbn = new db();
    $db = $dbn->connect();
    $sql = "INSERT INTO `menu` (`name`, `price`, `minquantity`, `maxquantity`, `image`, `descr`) VALUES (:name, :price, :minquantity, :maxquantity, :image, :descr)";
	$f = $db->prepare($sql);
	$f->bindValue(":name", $dishName);
    $f->bindValue(":price", $unitPrice);
    $f->bindValue(":minquantity", $minunit);
    $f->bindValue(":maxquantity", $maxunit);
    $f->bindValue(":image", $imageFile);
    $f->bindValue(":descr", $descr);
    $f->execute();
    $succ = "Data added!";
