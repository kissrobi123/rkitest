<?php
require_once '../utils/db_connect.php';

$operation = '';

foreach ($_POST as $key => $value) {
	$position = strpos($key, 'operation_');
	if ($position >= 0) {
		$operation = substr($key, $position + 10);
	}
}

if ($operation == 'add') {
	$language_edit = array();
	$language_edit['0'] = array('id' => '', 'language' => '', 'active' => '');
}

if ($operation == 'edit') {
	if (isset($_POST['id'])) {
		$language_edit = executeSelect("SELECT * FROM languages WHERE id = " . $_POST['id']);
	}
}

if ($operation == 'delete') {
	if (isset($_POST['id'])) {
		executeOperation("DELETE FROM languages WHERE id = " . $_POST['id']);
	}
}

if ($operation == 'save') {
	// print_r($_POST);
	
	$id = $_POST['id'];
	$language = $_POST['language'];
	$active = isset($_POST['active']) ? 1 : 0;
	
	if (isset($_POST['id']) and strlen($_POST['id']) > 0) {
		//it is update
		executeOperation("UPDATE languages SET language = '$language', active=$active WHERE id = $id");
	} else {
		// it is insert
		$id = getMaxId("languages") + 1;
		executeOperation("INSERT INTO languages values($id, '$language', $active)");
	}

	move_uploaded_file($_FILES['file']['tmp_name'], "../images/languages/$id");
}

$language_list = executeSelect("SELECT * FROM languages");
require_once 'view.php';

?>