<?php
require_once '../utils/db_connect.php';

$operation = '';
foreach ($_POST as $key => $value) {
	$position = strpos($key, 'operation_');
	
	if (gettype($position) != "boolean") {
		$operation = substr($key, $position + 10);
	}
}

$folder_id = -1;
if (isset($_POST['folder']) and strlen($_POST['folder']) > 0) {
	$folder_id = $_POST['folder'];
}

$parent_id = -1;
$folder_list = executeSelect("SELECT * from folders WHERE id = $folder_id");
if (isset($folder_list['0'])) {
	$parent_id = $folder_list['0']['parent'];
}

if ($operation == 'add') {
	$file_edit = array();
	$file_edit['0'] = array('id' => '', 'folder' => $folder_id, 'name' => '', 'description' => '');
}

if ($operation == 'edit') {
	if (isset($_POST['id'])) {
		$file_edit = executeSelect("SELECT * FROM files WHERE id = " . $_POST['id']);
		$folder_id = $file_edit['0']['folder'];
	}
}

if ($operation == 'delete') {
	if (isset($_POST['id'])) {
		executeOperation("DELETE FROM files WHERE id = " . $_POST['id']);
	}
}

if ($operation == 'save') {
	$id = $_POST['id'];
	$folder = $_POST['folder'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	
	if (isset($id) and strlen($id) > 0) {
		//it is update
		executeOperation("UPDATE files SET name = '$name', description = '$description' WHERE id = $id");
	} else {
		// it is insert
		$id = getMaxId("files") + 1;
		executeOperation("INSERT INTO files values($id, $folder, '$name', '$description')");
	}
	
	move_uploaded_file($_FILES['file']['tmp_name'], "../files/$id");
}


$file_list = executeSelect("SELECT * FROM files WHERE folder = $folder_id ORDER BY id");
require_once 'view.php';
?>