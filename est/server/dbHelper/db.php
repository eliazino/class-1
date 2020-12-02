<?php
error_reporting();
class db{
	/*
		Config
	*/

	private $dbhost = '127.0.0.1';
	private $dbuser = 'root';
	private $dbpass = '';
	private $dbname = 'omsys';

	/*
		Connection
	*/
	public function connect(){
		$dbh = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbh;
	}
	function unArray($str){
		if(substr($str, 0, 1) == "["){
			$newStr = json_decode($str);
			$newArr = $newStr[0];
			$newArr = json_encode($newArr);
			return $newArr;
		}else{
			return $str;
		}
	}	
	function isExistV2($query, $binds = array()){
		$db = $this->connect();
		$f = $db->prepare($query);
		for($i = 0; $i < count($binds); $i++){
			$f->bindParam($i+1, $binds[$i]);
		}
		$f->execute();
		$row = $f->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($row);
		if($row){
			//if($row[0]["coun"])
			return true;
		}else{
			return false;
		}
	}
	function queryCount($query){
		$dbn = $this->connect();
		$q = $dbn->query($query);
		try{
			if($q->fetchColumn() > 0){
				return $q->fetchColumn();
			}else{
				return 0;
			}
		}catch(PDOException $e){
			return 0;
		}
	}
	function selectFromQueryV2($query, $binds = array()){
		$db = $this->connect();
		$f = $db->prepare($query);
		for($i = 0; $i < count($binds); $i++){
			$f->bindParam($i+1, $binds[$i]);
		}
		$f->execute();
		$row = $f->fetchAll(PDO::FETCH_ASSOC);
		if($row){
			$data = json_encode($row, true);
		}else{
			$data = "[]";
		}
		return $data;
	}
}
?>