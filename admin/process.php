<?php

require_once '../utils/db_connect.php';

connect();

if (isset($_POST["action"])) {
	require_once $_POST["action"] . '/controller.php';	
}

close_connection();
?>