<?php
function connect() {
	$server='localhost';
	$user='root';
	$password='';
	$db='church';

	global $con;
	$con = mysqli_connect($server, $user, $password, $db);
}

function close_connection() {
	global $con;
	mysqli_close($con);
}

function executeSelect($query) {
	global $con;
	
	// echo $query;
	
	$result = array();
	$sql = mysqli_query($con, $query);
	while($res = mysqli_fetch_assoc($sql)) {
		array_push($result, $res);
	}
	mysqli_free_result($sql);

	return $result;
}

function executeOperation($query) {
	global $con;
	
	$sql = mysqli_query($con, $query);
	mysqli_commit($con);
}

function getMaxId($table) {
	global $con;

	$id = 0;
	$sql = mysqli_query($con, "SELECT max(id) AS max_id  FROM $table");
	while($res = mysqli_fetch_assoc($sql)) {
		$id = $res['max_id'];
	}
	mysqli_free_result($sql);

	return $id;
}

?>
