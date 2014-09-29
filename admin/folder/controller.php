<?php
require_once '../utils/db_connect.php';

$operation = '';
foreach ($_POST as $key => $value) {
	$position = strpos($key, 'operation_');
	
	if (gettype($position) != "boolean") {
		$operation = substr($key, $position + 10);
	}
}

$parent_id = -1;
if (isset($_POST['parent']) and strlen($_POST['parent']) > 0) {
	$parent_id = $_POST['parent'];
}

if ($operation == 'subfolder') {
	if (isset($_POST['id']) and strlen($_POST['id']) > 0) {
		$parent_id = $_POST['id'];
	}
}

if ($parent_id > 0) {
	$folder_tree = executeSelect("SELECT * FROM folders WHERE id = $parent_id");
	while ($folder_tree[0]['parent'] > 0) {
		$new_folder_tree = executeSelect("SELECT * FROM folders WHERE id = " . $folder_tree[0]['parent']);
		$new_folder_tree[0]['child'] = $folder_tree;
		$folder_tree = $new_folder_tree;
	}
}

if ($operation == 'add') {
	$folder_edit = array();
	$folder_edit['0'] = array('id' => '', 'name' => '');
}

if ($operation == 'edit') {
	if (isset($_POST['id'])) {
		$folder_edit = executeSelect("SELECT * FROM folders WHERE id = " . $_POST['id']);
	}
}

if ($operation == 'delete') {
	if (isset($_POST['id'])) {
		executeOperation("DELETE FROM folders WHERE id = " . $_POST['id']);
	}
}

if ($operation == 'save') {
	// print_r($_POST);
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	$parent = $_POST['parent'];
	
	if (isset($_POST['id']) and strlen($_POST['id']) > 0) {
		//it is update
		executeOperation("UPDATE folders SET name = '$name' WHERE id = $id");
	} else {
		// it is insert
		$id = getMaxId("folders") + 1;
		executeOperation("INSERT INTO folders values($id, '$name', $parent)");
	}
}

$folder_list = executeSelect("SELECT * FROM folders WHERE parent is null and $parent_id = -1 or parent = $parent_id ORDER BY id");
require_once 'view.php';
?>