<?php
class DBController {
	// private $host = "localhost";
	// private $user = "u875809167_explicit9ja";
	// private $password = "explicit9ja2019";
	// private $database = "u875809167_explicit9ja_db";

	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "explicit9ja";
	
	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->selectDB($conn);
		}
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function selectDB($conn) {
		mysqli_select_db($this->connectDB(), $this->database);
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->connectDb(), $query);
		$row=mysqli_fetch_assoc($result);
	if(!empty($row))
		return $row;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->connectDb(),$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
	
	function updateQuery($query) {
		$result  = mysqli_query($this->connectDb(),$query);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		} else {
			return $result;
		}
	}
	
	function insertQuery($query) {
		$result  = mysqli_query($this->connectDb(),$query);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		} else {
			return $result;
		}
	}
	
	function deleteQuery($query) {
		$result  = mysqli_query($this->connectDb(),$query);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		} else {
			return $result;
		}
	}
}
?>
